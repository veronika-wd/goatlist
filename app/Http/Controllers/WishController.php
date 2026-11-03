<?php

namespace App\Http\Controllers;

use App\Models\Wish;
use App\Models\Category;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WishController extends Controller {

    // Публичный список с фильтрацией
    public function index(Request $request) {
        $query = Wish::with(['category', 'status']);

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('status_id')) {
            $query->where('status_id', $request->status_id);
        }

        match($request->sort) {
            'price_asc' => $query->orderBy('price'),
            'price_desc' => $query->orderByDesc('price'),
            default => $query->latest()
        };

        return view('wishes.index', [
            'wishes' => $query->paginate(12),
            'categories' => Category::all(),
            'statuses' => Status::all()
        ]);
    }

    // Публичный просмотр одного желания
    public function show(Wish $wish) {
        $wish->load(['category', 'status']);
        return view('wishes.show', compact('wish'));
    }

    // АДМИНКА: Список желаний
    public function adminIndex() {
        $wishes = Wish::with(['category', 'status'])->latest()->paginate(20);
        return view('admin.wishes.index', compact('wishes'));
    }

    // Форма создания
    public function create() {
        return view('admin.wishes.create', [
            'categories' => Category::all(),
            'statuses' => Status::all()
        ]);
    }

    // Сохранение нового желания
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'link' => 'nullable|url|max:2048',
            'category_id' => 'required|exists:categories,id',
            'status_id' => 'required|exists:statuses,id',
            'is_ready' => 'nullable|boolean',
            'image' => 'nullable|image|max:2048|mimes:jpg,jpeg,png,webp',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('wishes', 'public');
        }

        $validated['is_ready'] = $request->has('is_ready');

        Wish::create($validated);

        return redirect()->route('admin.wishes.index')
            ->with('success', 'Желание успешно создано!');
    }

    // Форма редактирования
    public function edit(Wish $wish) {
        return view('admin.wishes.edit', [
            'wish' => $wish,
            'categories' => Category::all(),
            'statuses' => Status::all()
        ]);
    }

    // Обновление желания
    public function update(Request $request, Wish $wish) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'link' => 'nullable|url|max:2048',
            'category_id' => 'required|exists:categories,id',
            'status_id' => 'required|exists:statuses,id',
            'is_ready' => 'nullable|boolean',
            'image' => 'nullable|image|max:2048|mimes:jpg,jpeg,png,webp',
        ]);

        if ($request->hasFile('image')) {
            // Удаляем старое изображение
            if ($wish->image) Storage::disk('public')->delete($wish->image);
            $validated['image'] = $request->file('image')->store('wishes', 'public');
        }

        $validated['is_ready'] = $request->has('is_ready');

        $wish->update($validated);

        return redirect()->route('admin.wishes.index')
            ->with('success', 'Желание обновлено!');
    }

    // Удаление
    public function destroy(Wish $wish) {
        if ($wish->image) Storage::disk('public')->delete($wish->image);
        $wish->delete();

        return redirect()->route('admin.wishes.index')
            ->with('success', 'Желание удалено.');
    }
}
