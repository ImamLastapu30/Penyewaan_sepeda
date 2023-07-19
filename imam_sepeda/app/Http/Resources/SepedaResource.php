<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SepedaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'id'=>$this->id,
            'nama' => $this->nama,
            'harga' => 'Rp. ' . number_format($this->harga) . '/ jam' ,
            'deskripsi' => $this->deskripsi,
            'disewakan' => $this->disewakan,
            'merk' =>$this->merk,
        ];
    }
}
