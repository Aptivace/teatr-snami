<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Spectacle;
use App\Models\SpectaclesMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SpectacleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $repertuar = Spectacle::all();
        return view('repertoire', compact('repertuar'));
    }

    public function admin()
    {
        $plays = Spectacle::all();
        return view('admin-spectacles', compact('plays'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $members = Member::all();
        return view('admin-spectacles-add', compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'desc' => 'required|string',
            'short_desc' => 'nullable|string',
            'age' => 'required|integer',
            'genre' => 'required|string',
            'duration' => 'required|integer',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'members' => 'required|array|min:1',
            'members.*' => 'integer|exists:members,id',
            'director' => 'required|string',
        ]);

        // Массив для путей к картинкам, которые мы сохраним в базу
        $imagePaths = [];

        // Проверяем, есть ли файлы в запросе
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // 1. Генерируем уникальный UUID для имени файла
                $uuid = Str::uuid();

                // 2. Получаем оригинальное расширение файла (например, jpg, png)
                $extension = $image->getClientOriginalExtension();

                // 3. Собираем новое имя: uuid + расширение (например, "a1b2c3d4-....jpg")
                $filename = "{$uuid}.{$extension}";

                // 4. Сохраняем в storage/app/public/uploads (или другую папку)
                // Метод storeAs возвращает относительный путь файла внутри диска
                $path = $image->storeAs('uploads', $filename, 'public');

                // 5. Записываем путь в массив
                $imagePaths[] = $path;
            }
        }

        // Сохраняем данные в БД (предположим, у тебя есть модель)
        // Вариант 1: Если у тебя JSON поле в таблице (например, массив путей)
         $newSpectacle = Spectacle::query()->create([
             'name' => $data['name'],
             'desc' => $data['desc'],
             'short_desc' => $data['short_desc'],
             'age' => $data['age'],
             'director' => $data['director'],
             'genre' => $data['genre'],
             'duration' => $data['duration'],
             'images' => $imagePaths, // Laravel автоматически сериализует в JSON, если указан $casts
         ])->refresh();

        foreach ($data['members'] as $member) {
            SpectaclesMember::create([
                'spectacle_id' => $newSpectacle->id,
                'member_id' => $member,
            ]);
        }

        return redirect()->back()->with('success', 'Спектакль создан!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Spectacle $play)
    {
        $actors = $play->members;
        $rewards = $play->rewards;
        $afishes = $play->afishes()->where(['status' => 'active'])->get();

        return view('repertoire-item', compact('play', 'actors', 'rewards', 'afishes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Spectacle $spectacle)
    {
        $members = Member::all();

        return view('admin-spectacles-add', compact('spectacle', 'members'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Spectacle $spectacle)
    {
        // 1. Валидация входящих данных
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
            'short_desc' => "nullable|string",
            'age' => 'required|integer',
            'director' => 'required|string',
            'genre' => 'required|string',
            'duration' => 'required|integer',
            'images' => 'nullable|array', // Новые картинки опциональны при обновлении
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'delete_images' => 'nullable|array', // Массив путей старых картинок, которые нужно удалить
            'delete_images.*' => 'string',
        ]);

        // 2. Получаем текущий массив картинок из базы (предполагаем, что поле настроено как 'array' в $casts)
        $currentImages = $spectacle->images ?? [];

        // 3. Если пользователь решил удалить какие-то старые картинки
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $oldImagePath) {
                // Удаляем файл из диска storage/app/public/...
                if (Storage::disk('public')->exists($oldImagePath)) {
                    Storage::disk('public')->delete($oldImagePath);
                }
                // Убираем путь из массива
                $currentImages = array_values(array_diff($currentImages, [$oldImagePath]));
            }
        }

        // 4. Если загружены новые картинки — сохраняем их и добавляем к массиву
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $uuid = Str::uuid();
                $extension = $image->getClientOriginalExtension();
                $filename = "{$uuid}.{$extension}";

                // Сохраняем в storage/app/public/uploads
                $path = $image->storeAs('uploads', $filename, 'public');

                // Добавляем в общий массив
                $currentImages[] = $path;
            }
        }

        // 5. Обновляем основные данные записи в БД
        $spectacle->update([
            'name' => $validated['name'],
            'desc' => $validated['desc'],
            'short_desc' => $validated['short_desc'],
            'age' => $validated['age'],
            'genre' => $validated['genre'],
            'duration' => $validated['duration'],
            'images' => $currentImages, // Сохраняем итоговый актуальный список путей
        ]);

        return back()->with('success', 'Запись успешно обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spectacle $spectacle)
    {
        // 1. Проверяем, есть ли привязанные картинки, и удаляем их с диска
        if (!empty($spectacle->images) && is_array($spectacle->images)) {
            foreach ($spectacle->images as $imagePath) {
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
        }

        // 2. Удаляем саму запись из базы данных
        $spectacle->delete();

        return back()->with('success', 'Запись и все её файлы успешно удалены!');
    }
}
