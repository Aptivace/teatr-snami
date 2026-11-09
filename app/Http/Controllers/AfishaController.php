<?php

namespace App\Http\Controllers;

use App\Models\Afisha;
use App\Models\Spectacle;
use Illuminate\Http\Request;

class AfishaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Afisha::query()->where('status', 'active'); // или 'active', в зависимости от ваших статусов

        // Если выбран конкретный месяц через фильтр
        if ($request->has('month')) {
            $query->whereMonth('date', $request->month);
        }

        $pending_afishes = $query->get();

        $expired_afishes = Afisha::query()->where("status", "completed")->get();

        // Получаем список месяцев (числовые значения, например: [10, 11, 12]), в которых есть актуальные афиши
        $availableMonths = Afisha::query()
            ->where('status', 'active')
            ->selectRaw('MONTH(date) as month')
            ->distinct()
            ->pluck('month')
            ->toArray();

        return view('afisha', compact('pending_afishes', 'expired_afishes', 'availableMonths'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Передаем список спектаклей, чтобы привязать афишу к конкретной постановке
        $spectacles = Spectacle::all();

        return view('admin-afisha-add', compact('spectacles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'spectacle_id' => 'required|exists:spectacles,id',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|string|max:50', // Например: "19:00"
            'price' => 'required|integer|min:0',
            'desc' => 'nullable|string',
            'ticket_url' => 'required|string|max:255',
            'status' => 'required|string|in:pending,active,cancelled,completed', // Ограничиваем допустимые статусы
        ]);

        Afisha::create($validated);

        return back()->with('success', 'Афиша успешно создана!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Afisha $afisha)
    {
        $otherDates = Afisha::where(['spectacle_id' => $afisha->spectacle_id, 'status' => 'active'])
            ->where('id', '!=', $afisha->id)
            ->where('date', '>=', now())
            ->orderBy('date')
            ->limit(5)
            ->get();

        return view('afisha-item', compact('afisha', 'otherDates'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Afisha $afisha)
    {
        $spectacles = Spectacle::all();

        return view('admin-afisha-add', compact('afisha', 'spectacles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Afisha $afisha)
    {
        $validated = $request->validate([
            'spectacle_id' => 'required|exists:spectacles,id',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|string|max:50',
            'price' => 'required|integer|min:0',
            'desc' => 'nullable|string',
            'ticket_url' => 'required|string',
            'status' => 'required|string|in:pending,active,cancelled,completed',
        ]);

        $afisha->update($validated);

        return back()->with('success', 'Афиша успешно обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Afisha $afisha)
    {
        $afisha->delete();

        return back()->with('success', 'Афиша успешно удалена!');
    }
}
