<?php

namespace App\Http\Controllers;

use App\Models\AssessmentAspect;
use Illuminate\Http\Request;

class AssessmentAspectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aspects = AssessmentAspect::all();
        return view('aspects.index', compact('aspects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('aspects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:255|min:5'
            ],
            [
                'name.required' => 'Aspek yang dinilai harus diisi!',
                'name.max' => 'Maksimal 255 karakter!',
                'name.min' => 'Minimal 5 karakter!',
            ]
        );

        $aspects = new AssessmentAspect;
        $aspects->name = $request->name;
        $aspects->save();

        return redirect()->route('aspects.index')->withSuccess('Aspek berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $aspects = AssessmentAspect::find($id);
        abort_if(!$aspects, 400, 'Aspek tidak ditemukan');

        return view('aspects.edit', compact('aspects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $aspects = AssessmentAspect::find($id);
        abort_if(!$aspects, 400, 'Aspek tidak ditemukan');

        $request->validate(
            [
                'name' => 'required|max:255|min:5'
            ],
            [
                'name.required' => 'Aspek yang dinilai harus diisi!',
                'name.max' => 'Maksimal 255 karakter!',
                'name.min' => 'Minimal 5 karakter!',
            ]
        );

        $aspects->name = $request->name;
        $aspects->save();

        return redirect()->route('aspects.index')->withSuccess('Aspek berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $aspects = AssessmentAspect::find($id);
        abort_if(!$aspects, 400, 'Aspek tidak ditemukan');

        $aspects->delete();
        return redirect()->route('aspects.index')->withSuccess('Aspek berhasil dihapus!');
    }
}
