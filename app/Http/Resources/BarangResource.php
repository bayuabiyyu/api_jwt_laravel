<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BarangResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'ini_id' => $this->id,
            'ini_kode' => $this->kode_barang,
            'ini_nama' => $this->nama_barang,
        ];
        // return parent::toArray($request);
        return $data;
    }
}
