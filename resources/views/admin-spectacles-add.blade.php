<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ isset($spectacle) ? 'Редактировать спектакль' : 'Новый спектакль' }} — СНАМИ</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600&family=Newsreader:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
<div class="app">
    <aside>
        <a class="logo" href="/">СНАМИ</a>
        <a href="/admin">Афиши</a>
        <a href="/admin/spectacles" class="on">Репертуар</a>
        <a href="/admin/members">Состав</a>
        <a href="/admin/rewards">Награды</a>
        <a href="/admin/reviews">Отзывы</a>
        <a href="/" target="_blank">Открыть сайт</a>

        <form action="/admin/logout" method="POST" style="display: inline;">
            @csrf
            <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer; padding: 0; font: inherit;">Выйти</button>
        </form>
    </aside>
    <main>
        <div class="top">
            <h1>{{ isset($spectacle) ? 'Редактировать спектакль' : 'Новый спектакль' }}</h1>
            <a class="btn g" href="/admin/spectacles">К списку</a>
        </div>

        {{-- Вывод ошибок валидации --}}
        @if ($errors->any())
            <div style="padding: 10px; background: #f8d7da; color: #721c24; margin-bottom: 20px; border-radius: 4px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Динамический action и метод (POST для создания, PATCH для обновления) --}}
        <form class="panel" method="POST" enctype="multipart/form-data"
              action="{{ isset($spectacle) ? "/admin/spectacles/{$spectacle->id}/edit" : '/admin/spectacles' }}">
            @csrf
            @if(isset($spectacle))
                @method('PATCH')
            @endif

            <div class="f">
                <div class="full">
                    <label for="ti">Название *</label>
                    <input id="ti" name="name" value="{{ old('name', $spectacle->name ?? '') }}" required>
                </div>
                <div>
                    <label for="g">Жанр *</label>
                    <input id="g" name="genre" value="{{ old('genre', $spectacle->genre ?? '') }}" required>
                </div>
                <div>
                    <label for="di">Режиссёр *</label>
                    <input id="di" name="director" value="{{ old('director', $spectacle->director ?? '') }}">
                </div>
                <div>
                    <label for="du">Длительность, мин *</label>
                    <input id="du" type="number" min="1" name="duration" value="{{ old('duration', $spectacle->duration ?? '') }}" required>
                </div>
                <div>
                    <label for="ag">Возраст (число, например 16) *</label>
                    <input id="ag" name="age" value="{{ old('age', $spectacle->age ?? '') }}" required>
                </div>
                <div>
                    <label for="im">Изображения {{ isset($spectacle) ? '' : '*' }}
                        <small>(первое — главное, порядок можно менять)</small></label>
                    <input id="im" type="file" name="images[]" accept="image/*" multiple
                        {{ isset($spectacle) ? '' : 'required' }}>
                </div>
                <div class="full">
                    <ul id="img-prev" class="img-prev"></ul>
                </div>
                <div class="full">
                    <label for="ds">Описание *</label>
                    <textarea id="ds" name="desc" rows="10" required>{{ old('desc', $spectacle->desc ?? '') }}</textarea>
                    <small style="display:block;margin:-10px 0 18px">
                        Пустая строка — новый абзац. Стихи: каждую строку начинай со знака «&gt;»,
                        строка с одним «&gt;» — пропуск между строфами.
                    </small>
                </div>
                <div class="full">
                    <label for="ds">Краткое описание (карточка репертуара)</label>
                    <textarea id="ds" name="short_desc" rows="5">{{ old('desc', $spectacle->short_desc ?? '') }}</textarea>
                </div>
                @php
                    $selectedIds = collect(old('members', isset($spectacle) ? $spectacle->members->pluck('id')->all() : []))
                        ->map(fn ($id) => (int) $id)->all();
                @endphp

                <div class="full">
                    <label>В ролях</label>
                    <div class="pick">
                        <div class="pick-col">
                            <div class="pick-h">Все актёры</div>
                            <input type="search" id="pick-search" placeholder="Поиск по имени…" autocomplete="off">
                            <ul id="pick-available" class="pick-list">
                                @foreach(($members ?? []) as $member)
                                    @unless(in_array($member->id, $selectedIds))
                                        <li class="pick-item" data-name="{{ mb_strtolower($member->name) }}">
                                            <span>{{ $member->name }}</span>
                                            <button type="button" class="btn s ok add" data-act="add">Добавить</button>
                                            <button type="button" class="btn s bad rm" data-act="remove">Убрать</button>
                                            <input type="hidden" name="members[]" value="{{ $member->id }}" disabled>
                                        </li>
                                    @endunless
                                @endforeach
                            </ul>
                            <p class="pick-empty" id="pick-empty-available" hidden>Все актёры выбраны</p>
                        </div>

                        <div class="pick-col">
                            <div class="pick-h">Выбранные актёры <span id="pick-count"></span></div>
                            <ul id="pick-selected" class="pick-list">
                                @foreach(($members ?? []) as $member)
                                    @if(in_array($member->id, $selectedIds))
                                        <li class="pick-item" data-name="{{ mb_strtolower($member->name) }}">
                                            <span>{{ $member->name }}</span>
                                            <button type="button" class="btn s ok add" data-act="add">Добавить</button>
                                            <button type="button" class="btn s bad rm" data-act="remove">Убрать</button>
                                            <input type="hidden" name="members[]" value="{{ $member->id }}">
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                            <p class="pick-empty" id="pick-empty-selected" hidden>Пока никого не выбрано</p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn" type="submit">Сохранить спектакль</button>
        </form>
    </main>
</div>

<script>
    (() => {
        const input = document.getElementById('im');
        const list = document.getElementById('img-prev');
        const urls = new WeakMap();
        let files = [];

        const urlOf = (f) => {
            if (!urls.has(f)) urls.set(f, URL.createObjectURL(f));
            return urls.get(f);
        };

        const sync = () => {
            const dt = new DataTransfer();
            files.forEach((f) => dt.items.add(f));
            input.files = dt.files;   // именно это уйдёт на сервер, в этом порядке
            render();
        };

        const render = () => {
            list.innerHTML = '';
            files.forEach((f, i) => {
                const li = document.createElement('li');
                li.className = 'img-prev-item';
                li.innerHTML = `
                    <img src="${urlOf(f)}" alt="">
                    ${i === 0 ? '<span class="img-main">Главное</span>' : ''}
                    <div class="img-ctl">
                        <button type="button" data-act="left" data-i="${i}" ${i === 0 ? 'disabled' : ''} aria-label="Левее">←</button>
                        <button type="button" data-act="del" data-i="${i}" aria-label="Убрать">✕</button>
                        <button type="button" data-act="right" data-i="${i}" ${i === files.length - 1 ? 'disabled' : ''} aria-label="Правее">→</button>
                    </div>`;
                list.appendChild(li);
            });
        };

        // новые выбранные файлы добавляем к уже выбранным, а не заменяем
        input.addEventListener('change', () => {
            const same = (a, b) => a.name === b.name && a.size === b.size && a.lastModified === b.lastModified;
            [...input.files].forEach((f) => {
                if (!files.some((x) => same(x, f))) files.push(f);
            });
            sync();
        });

        list.addEventListener('click', (e) => {
            const btn = e.target.closest('button[data-act]');
            if (!btn) return;
            const i = Number(btn.dataset.i);

            if (btn.dataset.act === 'del') files.splice(i, 1);
            if (btn.dataset.act === 'left' && i > 0) [files[i - 1], files[i]] = [files[i], files[i - 1]];
            if (btn.dataset.act === 'right' && i < files.length - 1) [files[i + 1], files[i]] = [files[i], files[i + 1]];

            sync();
        });
    })();
</script>


<script>
    (() => {
        const available = document.getElementById('pick-available');
        const selected = document.getElementById('pick-selected');
        const search = document.getElementById('pick-search');
        const count = document.getElementById('pick-count');
        const emptyA = document.getElementById('pick-empty-available');
        const emptyS = document.getElementById('pick-empty-selected');

        const sortList = (list) => {
            [...list.children]
                .sort((a, b) => a.dataset.name.localeCompare(b.dataset.name, 'ru'))
                .forEach((li) => list.appendChild(li));
        };

        const applyFilter = () => {
            const q = search.value.trim().toLowerCase();
            [...available.children].forEach((li) => {
                li.hidden = q !== '' && !li.dataset.name.includes(q);
            });
        };

        const refresh = () => {
            const n = selected.children.length;
            count.textContent = n ? `(${n})` : '';
            emptyS.hidden = n > 0;
            emptyA.hidden = available.children.length > 0;
        };

        document.querySelector('.pick').addEventListener('click', (e) => {
            const btn = e.target.closest('button[data-act]');
            if (!btn) return;

            const li = btn.closest('.pick-item');
            const toSelected = btn.dataset.act === 'add';

            li.querySelector('input[name="members[]"]').disabled = !toSelected;
            li.hidden = false;
            (toSelected ? selected : available).appendChild(li);
            sortList(toSelected ? selected : available);

            applyFilter();
            refresh();
        });

        search.addEventListener('input', applyFilter);
        // Enter в поиске не должен отправлять форму
        search.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') e.preventDefault();
        });

        sortList(available);
        sortList(selected);
        refresh();
    })();
</script>
</body>
</html>
