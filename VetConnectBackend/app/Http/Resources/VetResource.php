<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'email' => $this->email,
            'no_telp' => $this->no_telp,
            'alamat' => $this->alamat,
            'STR' => $this->STR,
            'SIP' => $this->SIP,
            'alumni' => $this->alumni,
            'harga' => $this->harga,
            'jenis_kelamin' => $this->jenis_kelamin ? 'Laki-laki' : 'Perempuan',
            'foto' => url('storage/foto_dokter/' . $this->foto),
            'tgl_lahir' => $this->tgl_lahir,
            'deskripsi' => $this->deskripsi,
        ];
    }
}
