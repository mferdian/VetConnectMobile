<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Menampilkan semua artikel.
     */
    public function index()
    {
        $articles = Article::select('id', 'judul', 'gambar')->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar semua artikel',
            'data' => $articles
        ]);
    }

    /**
     * Menampilkan detail artikel berdasarkan ID.
     */
    public function show($id)
    {
        $article = Article::with('vet')->find($id);

        if (!$article) {
            return response()->json([
                'success' => false,
                'message' => 'Artikel tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail artikel ditemukan',
            'data' => [
                'id' => $article->id,
                'vet_id' => $article->vet_id,
                'judul' => $article->judul,
                'isi' => $article->isi,
                'gambar' => $article->gambar,
                'created_at' => $article->created_at,
                'updated_at' => $article->updated_at,
                'vet' => [
                    'id' => $article->vet->id,
                    'nama' => $article->vet->nama,
                    'email' => $article->vet->email,
                    'foto' => $article->vet->foto,
                    'foto_url' => $article->vet->foto_url, 
                    'no_telp' => $article->vet->no_telp,
                    'alamat' => $article->vet->alamat,
                    'STR' => $article->vet->STR,
                    'SIP' => $article->vet->SIP,
                    'alumni' => $article->vet->alumni,
                    'harga' => $article->vet->harga,
                    'jenis_kelamin' => $article->vet->jenis_kelamin,
                    'tgl_lahir' => $article->vet->tgl_lahir,
                    'deskripsi' => $article->vet->deskripsi,
                    'created_at' => $article->vet->created_at,
                    'updated_at' => $article->vet->updated_at,
                ]
            ]
        ]);
    }
}
