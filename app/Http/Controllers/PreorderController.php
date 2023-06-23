<?php
namespace App\Http\Controllers;

use App\Models\Preorder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $preorder = Preorder::latest()->get();
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
            'desc' => 'required',
            'stok' => 'required',
            'estimasi' => 'required',
            'harga' => 'required',
        ]);
//response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
//save to database
        $preorder = Preorder::create([
            'nama' => $request->nama,
            'desc' => $request->desc,
            'stok' => $request->stok,
            'estimasi' => $request->estimasi,
            'harga' => $request->harga,
        ]);
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
            'desc' => 'required',
            'stok' => 'required',
            'estimasi' => 'required',
            'harga' => 'required',
        ]);
//response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
//find post by ID
        $preorder = Preorder::findOrFail($post->id);
        if ($preorder) {
//update post
            $preorder->update([
            'nama' => $request->nama,
            'desc' => $request->desc,
            'stok' => $request->stok,
            'estimasi' => $request->estimasi,
            'harga' => $request->harga,
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
            'message' => 'data preorder Not Found',
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
        if ($preorder) {
//delete post
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
