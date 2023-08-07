<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification; // Make sure to import the Notification model

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::all();
        return view('notifications.index', compact('notifications'));
    }

    public function create()
    {
        return view('notifications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ], [
            'date.required' => 'Tanggal harus diisi',
            'title.required' => 'Judul harus diisi',
            'title.string' => 'Judul hanya boleh diisi karakter A-Z a-z',
            'tilte.max' => 'Judul hanya boleh diisi maksimal 255 karakter!',
            'description.required' => 'Deskripsi harus diisi',
            'description.string' => 'Deskripsi hanya boleh diisi karakter A-Z a-z'
        ]);

        Notification::create($request->all());

        return redirect()->route('notifications.index')->with('success', 'Notification created successfully!');
    }

    public function edit(Notification $notification, $id)
    {
        $notification = Notification::find($id);
        abort_if(!$notification, 400, 'Notifikasi tidak ditemukan');
        return view('notifications.edit', compact('notification'));
    }

    public function update(Request $request, Notification $notification, $id)
    {
        $notification = Notification::find($id);
        abort_if(!$notification, 400, 'Notifikasi tidak ditemukan');

        $request->validate([
            'date' => 'required|date',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ], [
            'date.required' => 'Tanggal harus diisi',
            'title.required' => 'Judul harus diisi',
            'title.string' => 'Judul hanya boleh diisi karakter A-Z a-z',
            'tilte.max' => 'Judul hanya boleh diisi maksimal 255 karakter!',
            'description.required' => 'Deskripsi harus diisi',
            'description.string' => 'Deskripsi hanya boleh diisi karakter A-Z a-z'
        ]);

        $notification->update($request->all());

        return redirect()->route('notifications.index')->with('success', 'Notification updated successfully!');
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();

        return redirect()->route('notifications.index')->with('success', 'Notification deleted successfully!');
    }
}
