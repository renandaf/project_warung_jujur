<?php
namespace App\Http\Controllers;

use App\Models\Dagangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DaganganController extends Controller
{
/**
 * index
 *
 * @return void
 */
    public function index()
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
            'desc' => 'required',
            'stok' => 'required',
            'harga' => 'required',
        ]);
//response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
//save to database
        $dagangan = Dagangan::create([
            'nama' => $request->nama,
            'desc' => $request->desc,
            'stok' => $request->stok,
            'harga' => $request->harga,
        ]);
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
            'desc' => 'required',
            'stok' => 'required',
            'harga' => 'required',
        ]);
//response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
//find post by ID
        $dagangan = Dagangan::findOrFail($posts->id);
        if ($dagangan) {
//update post
            $dagangan->update([
                'nama' => $request->nama,
                'desc' => $request->desc,
                'stok' => $request->stok,
                'harga' => $request->harga,
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
        if ($dagangan) {
//delete post
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
