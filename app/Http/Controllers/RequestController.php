<?php
namespace App\Http\Controllers;

use App\Models\Req;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RequestController extends Controller
{
/**
 * index
 *
 * @return void
 */
    public function index()
    {
//get data from table posts
        $req = Req::latest()->get();
//make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Request',
            'data' => $req,
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

        $req = Req::findOrfail($id);
//make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Request',
            'data' => $req,
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
            'nama_dagangan' => 'required',
            'jumlah' => 'required',
            'total' => 'required',
            'status' => 'required',
        ]);
//response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
//save to database
        $req = Req::create([
            'nama_dagangan' => $request->nama_dagangan,
            'jumlah' => $request->jumlah,
            'total' => $request->total,
            'status' => $request->status,
        ]);
//success save to database
        if ($req) {
            return response()->json([
                'success' => true,
                'message' => 'data Req Created',
                'data' => $req,
            ], 201);
        }
//failed save to database
        return response()->json([
            'success' => false,
            'message' => 'data Req Failed to Save',

        ], 409);
    }
/**
 * update
 *
 * @param mixed $request
 * @param mixed $post
 * @return void
 */
    public function update(Request $request, Req $req)
    {
//set validation
        $validator = Validator::make($request->all(), [
            'nama_dagangan' => 'required',
            'jumlah' => 'required',
            'total' => 'required',
            'status' => 'required',
        ]);
//response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
//find post by ID
        $req = Req::findOrFail($post->id);
        if ($req) {
//update post
            $req->update([
                'nama_dagangan' => $request->nama_dagangan,
                'jumlah' => $request->jumlah,
                'total' => $request->total,
                'status' => $request->status,
            ]);
            return response()->json([
                'success' => true,
                'message' => 'data Req Updated',
                'data' => $req,
            ], 200);
        }
//data post not found
        return response()->json([
            'success' => false,
            'message' => 'data Req Not Found',
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
        $req = Req::findOrfail($id);
        if ($req) {
//delete post
            $req->delete();
            return response()->json([
                'success' => true,
                'message' => 'data Req Deleted',
            ], 200);
        }
//data post not found
        return response()->json([
            'success' => false,
            'message' => 'data Req Not Found',
        ], 404);
    }
}
