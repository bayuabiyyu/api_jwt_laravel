<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\Http\Requests\BarangRequest;
use App\Http\Resources\BarangCollection;
use App\Http\Resources\BarangResource;

class BarangController extends Controller
{

    private $barang;

    /**
     * Constructor init variabel model from global property
     *
     */

    public function __construct(Barang $barang)
    {
        $this->barang = $barang;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->barang->all();
        return (new BarangCollection($data))->additional([
            'success' => true,
            'message' => 'found data',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BarangRequest $request)
    {
        $data = [
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang
        ];
        $this->barang->create($data);
        $response = [
            'success' => true,
            'code' => 200,
            'message' => 'OK, Data has been saved',
        ];
        return response()->json($response, $response['code']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->barang->where('id', $id)->firstOrFail();
        return (new BarangResource($data))->additional([
            'success' => true,
            'message' => 'found data',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = [
            'nama_barang' => $request->nama_barang
        ];
        $this->barang->where('id', $id)->firstOrFail()->update($data);
        $response = [
            'success' => true,
            'code' => 200,
            'message' => 'OK, Data has been update',
        ];
        return response()->json($response, $response['code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->barang->where('id', $id)->firstOrFail()->delete();
        $response = [
            'success' => true,
            'code' => 200,
            'message' => 'OK, Data has been delete',
        ];
        return response()->json($response, $response['code']);
    }
}
