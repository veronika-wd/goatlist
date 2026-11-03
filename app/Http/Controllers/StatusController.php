<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller {

    public function index() {
        return view('admin.statuses.index', [
            'statuses' => Status::latest()->get()
        ]);
    }

    public function create() {
        return view('admin.statuses.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:statuses,name'
        ]);

        Status::create($validated);

        return redirect()->route('admin.statuses.index')
            ->with('success', 'Статус создан!');
    }

    public function edit(Status $status) {
        return view('admin.statuses.edit', compact('status'));
    }

    public function update(Request $request, Status $status) {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:statuses,name,'.$status->id
        ]);

        $status->update($validated);

        return redirect()->route('admin.statuses.index')
            ->with('success', 'Статус обновлен!');
    }

    public function destroy(Status $status) {
        $status->delete();
        return redirect()->route('admin.statuses.index')
            ->with('success', 'Статус удален.');
    }
}
