<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'vet_id',
        'judul',
        'isi',
        'gambar'
    ];

    public function vet(): BelongsTo
    {
        return $this->belongsTo(Vet::class, 'vet_id');
    }

    public function getGambarAttribute($value)
    {
        $cleaned = trim($value, '"'); // menghapus tanda kutip ganda dari string
        return $cleaned ? Storage::url('foto_artikel/' . $cleaned) : null;
    }
}
