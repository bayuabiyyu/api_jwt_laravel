<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Barang;
use App\Http\Requests\BarangRequest;

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
        $response = [
            'success' => true,
            'code' => 200,
            'message' => 'OK',
            'data' => $data,

        ];
        return response()->json($response, $response['code']);
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

        $insert = $this->barang->create($data);

        if($insert){
            $response = [
                'success' => true,
                'code' => 200,
                'message' => 'OK',
            ];
        }else{
            $response = [
                'success' => false,
                'code' => 500,
                'message' => 'Error',
            ];
        }

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
        $response = [
            'success' => true,
            'code' => 200,
            'message' => 'OK',
            'data' => $data,
        ];
        return response()->json($response, $response['code']);
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
        $update = $this->barang->where('id', $id)
                    ->update([
                        'nama_barang' => $request->nama_barang
                    ]);
        if($update){
        $response = [
            'success' => true,
            'code' => 200,
            'message' => 'OK',
        ];
        }else{
            $response = [
                'success' => false,
                'code' => 500,
                'message' => 'Error',
            ];
        }

        // $response = ['code' => 400, 'data' => $request->all()];
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
        $delete = $this->barang->where('id', $id)->delete();
        if($delete){
            $response = [
                'success' => true,
                'code' => 200,
                'message' => 'OK',
            ];
        }else{
            $response = [
                'success' => false,
                'code' => 500,
                'message' => 'Error',
            ];
        }
        return response()->json($response, $response['code']);
    }
}
