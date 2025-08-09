<?php

namespace App\Http\Resources;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserResource extends JsonResource
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
        'name' => $this->name,
        'email' => $this->email,
        'no_telp' => $this->no_telp,
        'umur' => $this->umur,
        'alamat' => $this->alamat,
        'foto' => $this->profile_photo ? Storage::url($this->profile_photo) : null,
        ];
    }
}
