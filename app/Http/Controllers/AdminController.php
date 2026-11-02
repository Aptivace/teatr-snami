<?php

namespace App\Http\Controllers;

use App\Models\Afisha;
use App\Models\User;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use PragmaRX\Google2FA\Google2FA;

class AdminController extends Controller
{
    //

    public function index()
    {
        if (!auth()->user() || auth()->user()->role !== 'admin') return view("admin-login");
        if (!auth()->user()->two_factor_confirmed_at) return redirect('/admin/security');

        $afishes = Afisha::all();

        return view("admin-afisha", compact("afishes"));

    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        $remember = $request->boolean('remember');

        if (Auth::validate($credentials)) {
            $user = User::where('email', $credentials['email'])->first();

            // 2FA включена: полноценно не логиним, ждём код
            if ($user->two_factor_confirmed_at) {
                $request->session()->regenerate();
                $request->session()->put('2fa', [
                    'id' => $user->id,
                    'remember' => $remember,
                    'expires' => now()->addMinutes(5)->timestamp,
                ]);
                return redirect('/admin/2fa');
            }

            Auth::login($user, $remember);
            $request->session()->regenerate();
            return redirect()->intended('/admin');
        }

        return back()->withErrors(['email' => 'Неверная почта или пароль'])->onlyInput('email', 'remember');
    }

    public function twoFactorForm(Request $request)
    {
        if (!$request->session()->has('2fa')) return redirect('/admin');
        return view('admin-2fa');
    }

    public function twoFactorVerify(Request $request)
    {
        $pending = $request->session()->get('2fa');

        if (!$pending || $pending['expires'] < now()->timestamp) {
            $request->session()->forget('2fa');
            return redirect('/admin')->withErrors(['email' => 'Сессия истекла, войди заново']);
        }

        $request->validate(['code' => 'required|digits:6']);

        $user = User::findOrFail($pending['id']);

        if (!(new Google2FA)->verifyKey($user->two_factor_secret, $request->code)) {
            return back()->withErrors(['code' => 'Неверный код']);
        }

        $request->session()->forget('2fa');
        Auth::login($user, $pending['remember']);
        $request->session()->regenerate();

        return redirect()->intended('/admin');
    }

    public function security(Request $request)
    {
        $user = $request->user();

        if ($user->two_factor_confirmed_at) {
            return view('admin-security', ['enabled' => true]);
        }

        $google2fa = new Google2FA;
        if (!$request->session()->has('2fa_setup_secret')) {
            $request->session()->put('2fa_setup_secret', $google2fa->generateSecretKey());
        }
        $secret = $request->session()->get('2fa_setup_secret');

        $url = $google2fa->getQRCodeUrl(config('app.name'), $user->email, $secret);
        $svg = (new Writer(new ImageRenderer(new RendererStyle(200), new SvgImageBackEnd)))->writeString($url);

        return view('admin-security', ['enabled' => false, 'svg' => $svg, 'secret' => $secret]);
    }

    public function enableTwoFactor(Request $request)
    {
        $request->validate(['code' => 'required|digits:6']);

        $secret = $request->session()->get('2fa_setup_secret');

        if (!$secret || !(new Google2FA)->verifyKey($secret, $request->code)) {
            return back()->withErrors(['code' => 'Неверный код']);
        }

        $request->user()->forceFill([
            'two_factor_secret' => $secret,
            'two_factor_confirmed_at' => now(),
        ])->save();

        $request->session()->forget('2fa_setup_secret');

        return redirect('/admin')->with('success', '2FA включена');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

}
