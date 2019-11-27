<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BarangCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $data = [
            'data' => $this->collection->transform(function($data){
                return [
                    'ini_id' => $data->id,
                    'ini_kode' => $data->kode_barang,
                    'ini_nama' => $data->nama_barang,
                    'create' => $data->created_at->diffForHumans(),
                ];
            })
        ];
        // return parent::toArray($request);
        return $data;
    }
}
