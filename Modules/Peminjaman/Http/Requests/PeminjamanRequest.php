<?php

namespace Modules\Peminjaman\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeminjamanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'nama_peminjam' => 'required|string',
            'judul_buku' => 'required|string',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'status' => 'required|in:Dipinjam,Dikembalikan',
            'bukti' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ];
    }
}
