<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Produk;
//use Facade\FlareClient\Http\Response;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produk::all();
        $response = [
            'massage' => 'List Produk',
            'data' => $produk
        ];

        return response()->json($response);
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
    public function store(Request $request)
    {
        /*$request->validate([
            'kode_produk' => 'required',
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);

        $produk = New Produk;
        $produk->kode_produk = $request->kode_produk;
        $produk->nama = $request->nama;
        $produk->deskripsi = $request->deskripsi;

        return response()->json([
            'message' => 'Produk Ditambahkan!',
            'data_produk' => $produk
        ]);*/

        $validator = Validator::make($request->all(), [
            'kode_produk' => ['required'],
            'nama' => ['required'],
            'deskripsi' => ['required']

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $produk = Produk::create($request->all());
            $response = [
                'message' => 'Produk Berhasil Ditambahkan!',
                'data' => $produk
            ];

            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Gagal' . $e->errorInfo
            ]);
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produk = Produk::findOrFail($id);

        $response = [
            'message' => 'Produk Detail',
            'data' => $produk
        ];

        return response()->json($response);

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
        $produk = Produk::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'kode_produk' => ['required'],
            'nama' => ['required'],
            'deskripsi' => ['required']

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        try {
            $produk->update($request->all());
            $response = [
                'message' => 'Produk Berhasil Diupdate!',
                'data' => $produk
            ];

            return response()->json($response);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Gagal' . $e->errorInfo
            ]);
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        try {
            $produk->delete();
            $response = [
                'message' => 'Produk Berhasil Dihapus!',
            ];

            return response()->json($response);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Gagal' . $e->errorInfo
            ]);
            
        }
    }
}
