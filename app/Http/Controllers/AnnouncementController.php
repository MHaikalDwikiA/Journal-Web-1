<?php

namespace App\Http\Controllers;

use App\Jobs\SendAnnouncementNotificationJob;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $query = Announcement::query();
        $announcements = $query->get();

        return view('announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('announcements.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'date' => 'required|date',
                'title' => 'required|max:255|min:5',
                'description' => 'required',
            ],
            [
                'date.required' => 'Tanggal harus diisi!',
                'date.date' => 'Harus berformat tanggal!',
                'title.required' => 'Judul harus diisi!',
                'title.max' => 'Maksimal 255 karakter!',
                'title.min' => 'Minimal 5 karakter!',
                'description|required' => 'Deskripsi harus diisi!'
            ]
        );

        $announcement = new Announcement;
        $announcement->date = $request->date;
        $announcement->title = $request->title;
        $announcement->description = $request->description;
        $announcement->save();

        SendAnnouncementNotificationJob::dispatch($announcement->id);

        return redirect()->route('announcements.index')->withSuccess('Pengumuman berhasil ditambahkan!');
    }

    public function show($id)
    {
        $announcement = Announcement::find($id);
        abort_if(!$announcement, 400, 'Pengumuman tidak ditemukan');

        return view('announcements.show', compact('announcement'));
    }

    public function edit($id)
    {
        $announcement = Announcement::find($id);
        abort_if(!$announcement, 400, 'Pengumuman tidak ditemukan');

        return view('announcements.edit', compact('announcement'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'date' => 'required|date',
                'title' => 'required|max:255|min:5',
                'description' => 'required',
            ],
            [
                'date.required' => 'Tanggal harus diisi!',
                'date.date' => 'Harus berformat tanggal!',
                'title.required' => 'Judul harus diisi!',
                'title.max' => 'Maksimal 255 karakter!',
                'title.min' => 'Minimal 5 karakter!',
                'description|required' => 'Deskripsi harus diisi!'
            ]
        );

        $announcement = Announcement::find($id);
        abort_if(!$announcement, 400, 'Pengumuman tidak ditemukan');

        $announcement->date = $request->date;
        $announcement->title = $request->title;
        $announcement->description = $request->description;
        $announcement->save();

        return redirect()->route('announcements.index')->withSuccess('Pengumuman berhasil diubah!');
    }

    public function destroy($id)
    {
        $announcement = Announcement::find($id);
        abort_if(!$announcement, 400, 'Pengumuman tidak ditemukan');

        $announcement->delete();
        return redirect()->route('announcements.index')->withSuccess('Pengumuman berhasil dihapus!');
    }
}
