<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::all();

        return view('members', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120', // Одиночная картинка обязательна при создании
        ]);

        $imagePath = null;

        // Обработка загрузки файла
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $uuid = Str::uuid();
            $extension = $file->getClientOriginalExtension();
            $filename = "{$uuid}.{$extension}";

            // Сохраняем в storage/app/public/members
            $imagePath = $file->storeAs('members', $filename, 'public');
        }

        // Создаем запись в базе данных
        Member::create([
            'name' => $validated['name'],
            'role' => $validated['role'],
            'desc' => $validated['desc'] ?? null,
            'image' => $imagePath,
        ]);

        return back()->with('success', 'Участник успешно добавлен!');
    }






    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        return;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120', // При обновлении картинка опциональна
        ]);

        $imagePath = $member->image; // По умолчанию оставляем старую картинку

        // Если загружена новая картинка
        if ($request->hasFile('image')) {
            // 1. Удаляем старую картинку с диска, если она существовала
            if ($member->image && Storage::disk('public')->exists($member->image)) {
                Storage::disk('public')->delete($member->image);
            }

            // 2. Сохраняем новую
            $file = $request->file('image');
            $uuid = Str::uuid();
            $extension = $file->getClientOriginalExtension();
            $filename = "{$uuid}.{$extension}";

            $imagePath = $file->storeAs('members', $filename, 'public');
        }

        // Обновляем запись
        $member->update([
            'name' => $validated['name'],
            'role' => $validated['role'],
            'desc' => $validated['desc'] ?? null,
            'image' => $imagePath,
        ]);

        return back()->with('success', 'Данные участника обновлены!');
    }

    /**
     * Удалить участника и его файл картинки
     */
    public function destroy(Member $member)
    {
        // Удаляем файл картинки из storage, если он есть
        if ($member->image && Storage::disk('public')->exists($member->image)) {
            Storage::disk('public')->delete($member->image);
        }

        // Удаляем саму запись из базы
        $member->delete();

        return back()->with('success', 'Участник успешно удален!');
    }
}
