<?php

namespace App\Http\Controllers;

use App\Models\Dagangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DaganganController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {

        $dagangan = Dagangan::where([['status', 'diterima'], ['available', 'tersedia']])->latest()->get();
        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data dagangan',
            'data' => $dagangan,
        ], 200);
    }

    public function showAll()
    {
        //get data from table posts
        $dagangan = Dagangan::latest()->get();
        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data dagangan',
            'data' => $dagangan,
        ], 200);
    }

    public function showPemilik()
    {
        //get data from table posts
        $dagangan = Dagangan::where('user_id', Auth::user()->id)->latest()->get();
        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data dagangan',
            'data' => $dagangan,
        ], 200);
    }
    /**
     * show
     *
     * @param mixed $id
     * @return void
     */
    public function show($id)
    {
        //find post by ID
        $dagangan = Dagangan::findOrfail($id);
        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data dagangan',
            'data' => $dagangan,
        ], 200);
    }
    /**
     * store
     *
     * @param mixed $request
     * @return void
     */
    public function store(Request $request)
    {

        //set validation
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'harga' => 'required',
        ]);
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        //save to database
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambar->storeAs('public/dagangan', $gambar->hashName());
            if ($request->hasFile('qr')) {
                $qr = $request->file('qr');
                $qr->storeAs('public/qr', $qr->hashName());
                $dagangan = Dagangan::create([
                    'nama' => $request->nama,
                    'harga' => $request->harga,
                    'deskripsi' => $request->deskripsi,
                    'user_id' => Auth::user()->id,
                    'qr_code' => $request->qr_code,
                    'jenis_dagangan' => $request->jenis_dagangan,
                    'available' => 'tersedia',
                    'status' => 'diajukan',
                    'gambar' =>  $gambar->hashName(),
                    'qr' => $qr->hashName(),
                ]);
            } else {
                $dagangan = Dagangan::create([
                    'nama' => $request->nama,
                    'harga' => $request->harga,
                    'deskripsi' => $request->deskripsi,
                    'user_id' => Auth::user()->id,
                    'qr_code' => $request->qr_code,
                    'jenis_dagangan' => $request->jenis_dagangan,
                    'available' => 'tersedia',
                    'status' => 'diajukan',
                    'gambar' => $gambar->hashName(),
                    'qr' => 'default.png',
                ]);
            }
        } else {
            if ($request->hasFile('qr')) {
                $qr = $request->file('qr');
                $qr->storeAs('public/qr', $qr->hashName());
                $dagangan = Dagangan::create([
                    'nama' => $request->nama,
                    'harga' => $request->harga,
                    'deskripsi' => $request->deskripsi,
                    'user_id' => Auth::user()->id,
                    'qr_code' => $request->qr_code,
                    'jenis_dagangan' => $request->jenis_dagangan,
                    'available' => 'tersedia',
                    'status' => 'diajukan',
                    'qr' => $qr->hashName(),
                    'gambar' => 'default.png',
                ]);
            } else {
                $dagangan = Dagangan::create([
                    'nama' => $request->nama,
                    'harga' => $request->harga,
                    'deskripsi' => $request->deskripsi,
                    'user_id' => Auth::user()->id,
                    'qr_code' => $request->qr_code,
                    'jenis_dagangan' => $request->jenis_dagangan,
                    'available' => 'tersedia',
                    'status' => 'diajukan',
                    'qr' => 'default.png',
                    'gambar' => 'default.png',
                ]);
            }
        }
        //success save to database
        if ($dagangan) {
            return response()->json([
                'success' => true,
                'message' => 'data dagangan Created',
                'data' => $dagangan,
            ], 201);
        }
        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Post Failed to Save',

        ], 409);
    }
    /**
     * update
     *
     * @param mixed $request
     * @param mixed $post
     * @return void
     */
    public function update(Request $request, Dagangan $dagangan)
    {

        //set validation
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'harga' => 'required',
        ]);
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        //find post by ID
        $dagangan = Dagangan::findOrFail($dagangan->id);
        if (Auth::user()->id != $dagangan->user_id) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        if ($dagangan) {
            if ($request->hasFile('gambar')) {
                if ($dagangan->gambar != 'default.png') {
                    Storage::delete('public/dagangan/' . $dagangan->gambar);
                }
                $gambar = $request->file('gambar');
                $gambar->storeAs('public/dagangan', $gambar->hashName());
                if ($request->hasFile('qr')) {
                    if ($dagangan->qr != 'default.png') {
                        Storage::delete('public/qr/' . $dagangan->qr);
                    }
                    $qr = $request->file('qr');
                    $qr->storeAs('public/qr', $qr->hashName());
                    $dagangan->update([
                        'nama' => $request->nama,
                        'harga' => $request->harga,
                        'deskripsi' => $request->deskripsi,
                        'qr_code' => $request->qr_code,
                        'jenis_dagangan' => $request->jenis_dagangan,
                        'available' => $request->available,
                        'status' => 'diajukan',
                        'gambar' => $gambar->hashName(),
                        'qr' => $qr->hashName(),
                    ]);
                } else {
                    $dagangan->update([
                        'nama' => $request->nama,
                        'harga' => $request->harga,
                        'deskripsi' => $request->deskripsi,
                        'qr_code' => $request->qr_code,
                        'jenis_dagangan' => $request->jenis_dagangan,
                        'available' => $request->available,
                        'status' => 'diajukan',
                        'gambar' => $gambar->hashName(),
                    ]);
                }
            } else {
                if ($request->hasFile('qr')) {
                    if ($dagangan->qr != 'default.png') {
                        Storage::delete('public/qr/' . $dagangan->qr);
                    }
                    $qr = $request->file('qr');
                    $qr->storeAs('public/qr', $qr->hashName());
                    $dagangan->update([
                        'nama' => $request->nama,
                        'harga' => $request->harga,
                        'deskripsi' => $request->deskripsi,
                        'qr_code' => $request->qr_code,
                        'jenis_dagangan' => $request->jenis_dagangan,
                        'available' => $request->available,
                        'status' => 'diajukan',
                        'qr' => $qr->hashName(),
                    ]);
                } else {
                    $dagangan->update([
                        'nama' => $request->nama,
                        'harga' => $request->harga,
                        'deskripsi' => $request->deskripsi,
                        'qr_code' => $request->qr_code,
                        'jenis_dagangan' => $request->jenis_dagangan,
                        'available' => $request->available,
                        'status' => 'diajukan',
                    ]);
                }
            }
            return response()->json([
                'success' => true,
                'message' => 'data dagangan Updated',
                'data' => $dagangan,
            ], 200);
        }
        //data post not found
        return response()->json([
            'success' => false,
            'message' => 'Post Not Found',
        ], 404);
    }

    public function updateStatus(Request $request, Dagangan $dagangan)
    {

        $dagangan = Dagangan::findOrFail($dagangan->id);
        if (Auth::user()->role != 'admin') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        if ($dagangan) {
            $dagangan->update([

                'status' => $request->status,
                'catatan' => $request->catatan,
            ]);
            return response()->json([
                'success' => true,
                'message' => 'data dagangan Updated',
                'data' => $dagangan,
            ], 200);
        }
        //data post not found
        return response()->json([
            'success' => false,
            'message' => 'Post Not Found',
        ], 404);
    }
    /**
     * destroy
     *
     * @param mixed $id
     * @return void
     */
    public function destroy($id)
    {
        //find post by ID
        $dagangan = Dagangan::findOrfail($id);
        if (Auth::user()->role != 'admin' || Auth::user()->id != $dagangan->user_id) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        if ($dagangan) {
            //delete post
            if ($dagangan->gambar != 'default.png') {
                Storage::delete('public/dagangan/' . $dagangan->gambar);
            }
            $dagangan->delete();
            return response()->json([
                'success' => true,
                'message' => 'data dagangan Deleted',
            ], 200);
        }
        //data post not found
        return response()->json([
            'success' => false,
            'message' => 'Post Not Found',
        ], 404);
    }
}
