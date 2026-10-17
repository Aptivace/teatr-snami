<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use App\Models\Spectacle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RewardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function admin()
    {
        $rewards = Reward::all();

        return view('admin-rewards', compact('rewards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $spectacles = Spectacle::all();

        return view('admin-rewards-add', compact('spectacles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'festival_name' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'url' => 'required|file|mimes:jpeg,png,jpg,pdf|max:10240', // Принимаем картинки или PDF до 10МБ
            'spectacle_id' => 'nullable|exists:spectacles,id',
        ]);

        $filePath = null;

        if ($request->hasFile('url')) {
            $file = $request->file('url');
            $uuid = Str::uuid();
            $extension = $file->getClientOriginalExtension();
            $filename = "{$uuid}.{$extension}";

            // Сохраняем в storage/app/public/rewards
            $filePath = $file->storeAs('rewards', $filename, 'public');
        }

        Reward::create([
            'name' => $validated['name'],
            'festival_name' => $validated['festival_name'],
            'year' => $validated['year'],
            'url' => $filePath, // Записываем путь к файлу в колонку url
            'spectacle_id' => $validated['spectacle_id'] ?? null,
        ]);

        return redirect('/admin/rewards')->with('success', 'Награда успешно добавлена!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reward $reward)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reward $reward)
    {
        $spectacles = Spectacle::all();

        return view('admin-rewards-add', compact('reward', 'spectacles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reward $reward)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'festival_name' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'url' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:10240', // При обновлении файл опционален
            'spectacle_id' => 'nullable|exists:spectacles,id',
        ]);

        $filePath = $reward->url; // Оставляем старый путь по умолчанию

        if ($request->hasFile('url')) {
            // Удаляем старый файл, если он был
            if ($reward->url && Storage::disk('public')->exists($reward->url)) {
                Storage::disk('public')->delete($reward->url);
            }

            // Загружаем новый
            $file = $request->file('url');
            $uuid = Str::uuid();
            $extension = $file->getClientOriginalExtension();
            $filename = "{$uuid}.{$extension}";

            $filePath = $file->storeAs('rewards', $filename, 'public');
        }

        $reward->update([
            'name' => $validated['name'],
            'festival_name' => $validated['festival_name'],
            'year' => $validated['year'],
            'url' => $filePath,
            'spectacle_id' => $validated['spectacle_id'] ?? null,
        ]);

        return redirect('/admin/rewards')->with('success', 'Награда успешно обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reward $reward)
    {
        $reward->delete();

        return redirect('/admin/rewards')->with('success', 'Награда успешно удалена!');
    }
}
