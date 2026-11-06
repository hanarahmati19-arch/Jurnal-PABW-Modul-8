<?php

namespace Modules\Peminjaman\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Peminjaman\Http\Requests\PeminjamanRequest;
use Modules\Peminjaman\Models\Peminjaman;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Peminjaman::latest()->get();

        return view('peminjaman::index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PeminjamanRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('bukti')) {
            $data['bukti'] = $request->file('bukti')->store('bukti_peminjaman', 'public');
        }

        Peminjaman::create($data);

        return response()->json(['message' => 'Data berhasil ditambah']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PeminjamanRequest $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('bukti')) {
            if ($peminjaman->bukti) {
                Storage::disk('public')->delete($peminjaman->bukti);
            }

            $data['bukti'] = $request->file('bukti')->store('bukti_peminjaman', 'public');
        }

        $peminjaman->update($data);

        return response()->json(['message' => 'Data berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->bukti) {
            Storage::disk('public')->delete($peminjaman->bukti);
        }

        $peminjaman->delete();
        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}

