<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as Controller; // ✅ ini penting
use Illuminate\Http\Request;
use App\Models\Buku;

class ControllerBuku extends Controller // ✅ ubah ke 'extends Controller'
{
    public function create(Request $request)
    {
        try {
            $data = $request->all();
            $buku = Buku::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
                'data' => $buku
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function index()
    {
        return response()->json(Buku::all());
    }

    public function detail($id)
    {
        return response()->json(Buku::find($id));
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::whereId($id)->update([
            'nama_buku' => $request->input('nama_buku'),
            'harga' => $request->input('harga'),
            'deskripsi' => $request->input('deskripsi'),
        ]);

        if ($buku) {
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diupdate',
                'data' => $buku
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data gagal diupdate',
            ], 400);
        }
    }

    public function delete($id)
    {
        $buku = Buku::find($id);
        if ($buku) {
            $buku->delete();
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan'
        ], 404);
    }
}
