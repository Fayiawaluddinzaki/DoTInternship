<?php

namespace App\Http\Controllers;

use App\Helpers\Restfull;
Use App\Models\Buku;
use Exception;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Buku::all();

        // if($data){
        //     return Restfull::createApi(200, 'Data ditemukan', $data);
        // }else{
        //     return Restfull::createApi(404, 'Data tidak ditemukan');
        // }

        if (count($data) > 0) {
            return Restfull::createApi(200, 'Data ditemukan', $data);
        } else {
            return Restfull::createApi(404, 'Data tidak ditemukan');
        }
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
        //
        try {
            $request->validate([
                'judul' => 'required',
                'penulis' => 'required',
                'penerbit' => 'required',
                'kategori_id' => 'required',
            ]);
            $buku = Buku::create(
                [
                    'judul' => $request->judul,
                    'penulis' => $request->penulis,
                    'penerbit' => $request->penerbit,
                    'kategori_id' => $request->kategori_id,
                ]);
                $data= Buku::where('id','=',$buku->id)->get();

                if($data){
                    return Restfull::createApi(200, 'Data berhsil ditambahkan', $data);
                }else{
                    return Restfull::createApi(404, 'Data tidak ditemukan');
                }
        } catch (Exception $error) {
            return Restfull::createApi(500, 'Data gagal ditambahkan');
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
        //
        $data= Buku::where('id', '=', $id)->get();

                if($data){
                    return Restfull::createApi(200, 'Data ditemukan', $data);
                }else{
                    return Restfull::createApi(404, 'Data tidak ditemukan');
                }
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
        //
        try {
            // $request->validate([
            //     'judul' => 'required',
            //     'penulis' => 'required',
            //     'penerbit' => 'required',
            //     'kategori_id' => 'required',
            // ]);
            $buku = Buku::findOrFail($id);
            $buku->update(
                [
                    'judul' => $request->judul,
                    'penulis' => $request->penulis,
                    'penerbit' => $request->penerbit,
                    'kategori_id' => $request->kategori_id,
                ]);
                $data= Buku::where('id','=',$buku->id)->get();

                if($data){
                    return Restfull::createApi(200, 'Data berhasil di update', $data);
                }else{
                    return Restfull::createApi(404, 'Data tidak ditemukan');
                }
        } catch (Exception $error) {
            return Restfull::createApi(500, 'Data gagal ditambahkan');
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
        //
        try {
            $buku = Buku::findOrFail($id);
            $buku->delete();
            return Restfull::createApi(200, 'Data berhasil dihapus');
        } catch (Exception $error) {
            return Restfull::createApi(500, 'Data gagal dihapus');
        }
    }
}
