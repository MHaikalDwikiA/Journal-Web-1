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
            'description' => 'required',
        ], [
            'date.required' => 'Tanggal harus diisi',
            'title.required' => 'Judul harus diisi',
            'title.string' => 'Judul hanya boleh diisi karakter A-Z a-z',
            'tilte.max' => 'Judul hanya boleh diisi maksimal 255 karakter!',
            'description.required' => 'Deskripsi harus diisi',
        ]);

        Notification::create($request->all());

        return redirect()->route('notifications.index')->with('success', 'Notifikasi berhasil dibuat!');
    }

    public function show($id)
    {
        $notifications = Notification::find($id);
        return view('notifications.show', compact('notifications'));
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
            'description' => 'required',
        ], [
            'date.required' => 'Tanggal harus diisi',
            'title.required' => 'Judul harus diisi',
            'title.string' => 'Judul hanya boleh diisi karakter A-Z a-z',
            'tilte.max' => 'Judul hanya boleh diisi maksimal 255 karakter!',
            'description.required' => 'Deskripsi harus diisi',
        ]);

        $notification->update($request->all());

        return redirect()->route('notifications.index')->with('success', 'Notifikasi berhasil diedit!');
    }

    public function remove($id)
    {
        $notification = Notification::find($id);
        abort_if(!$notification, 400, 'Tahun Pelajaran tidak ditemukan');

        $notification->delete();

        return redirect()->route('notifications.index')->with('success', 'Notifikasi berhasil dihapus!');
    }
}
