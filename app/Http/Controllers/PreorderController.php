<?php

namespace App\Http\Controllers;

use App\Models\Preorder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PreorderController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get data from table posts
        $preorder = Preorder::where('status', 'diterima')->latest()->get();
        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data preorder',
            'data' => $preorder,
        ], 200);
    }

    public function showAll()
    {
        //get data from table posts
        $preorder = Preorder::latest()->get();
        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data preorder',
            'data' => $preorder,
        ], 200);
    }

    public function showPemilik()
    {
        //get data from table posts
        $preorder = Preorder::where('user_id', Auth::user()->id)->latest()->get();
        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data preorder',
            'data' => $preorder,
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
        $preorder = Preorder::findOrfail($id);
        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data preorder',
            'data' => $preorder,
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
            'no_hp' => 'required',
        ]);
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        //save to database
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambar->storeAs('public/preorder', $gambar->hashName());

            $preorder = preorder::create([
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'deskripsi' => $request->deskripsi,
                'user_id' => Auth::user()->id,
                'available' => 'tersedia',
                'status' => 'diajukan',
                'gambar' => $gambar->hashName(),
            ]);
        } else {
            $preorder = preorder::create([
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'deskripsi' => $request->deskripsi,
                'user_id' => Auth::user()->id,
                'available' => 'tersedia',
                'status' => 'diajukan',
            ]);
        }
        //success save to database
        if ($preorder) {
            return response()->json([
                'success' => true,
                'message' => 'data preorder Created',
                'data' => $preorder,
            ], 201);
        }
        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'data Preorder Failed to Save',

        ], 409);
    }
    /**
     * update
     *
     * @param mixed $request
     * @param mixed $post
     * @return void
     */
    public function update(Request $request, Preorder $preorder)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'no_hp' => 'required',
        ]);
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        //find post by ID
        $preorder = Preorder::findOrFail($preorder->id);
        if (Auth::user()->id != $preorder->user_id) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        if ($preorder) {
            if ($request->hasFile('gambar')) {
                if ($preorder->gambar != 'default.png') {
                    Storage::delete('public/preroder/' . $preorder->gambar);
                }
                $gambar = $request->file('gambar');
                $gambar->storeAs('public/preorder', $gambar->hashName());
                $preorder->update([
                    'nama' => $request->nama,
                    'no_hp' => $request->no_hp,
                    'deskripsi' => $request->deskripsi,
                    'available' => $request->available,
                    'status' => 'diajukan',
                    'gambar' => $gambar->hashName(),
                ]);
            } else {
                $preorder->update([
                    'nama' => $request->nama,
                    'no_hp' => $request->no_hp,
                    'deskripsi' => $request->deskripsi,
                    'available' => $request->available,
                    'status' => 'diajukan',
                ]);
            }
            return response()->json([
                'success' => true,
                'message' => 'data preorder Updated',
                'data' => $preorder,
            ], 200);
        }
        //data post not found
        return response()->json([
            'success' => false,
            'message' => 'data preorder Not Found',
        ], 404);
    }

    public function updateStatus(Request $request, Preorder $preorder)
    {

        $preorder = Preorder::findOrFail($preorder->id);
        if (Auth::user()->role != 'admin') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        if ($preorder) {
            $preorder->update([
                'status' => $request->status,
                'catatan' => $request->catatan,
            ]);
            return response()->json([
                'success' => true,
                'message' => 'data preorder Updated',
                'data' => $preorder,
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
        $preorder = Preorder::findOrfail($id);
        if (Auth::user()->role != 'admin' || Auth::user()->id != $preorder->user_id) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        if ($preorder) {
            //delete post
            if ($preorder->gambar != 'default.png') {
                Storage::delete('public/preroder/' . $preorder->gambar);
            }
            $preorder->delete();
            return response()->json([
                'success' => true,
                'message' => 'data Preorder Deleted',
            ], 200);
        }
        //data post not found
        return response()->json([
            'success' => false,
            'message' => 'data Preorder Not Found',
        ], 404);
    }
}
