<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::all();

        return response()->json([
            'data' => $stores,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newStore = Store::create([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'active' => $request->active,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Tienda creada correctamente',
            'data' => $newStore,
        ], 200);
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
        $updatedStore = Store::where('id', $id)
            ->update([
                'code' => $request->code,
                'name' => $request->name,
                'description' => $request->description,
                'active' => $request->active,
            ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Tienda actualizada correctamente',
            'data' => $updatedStore,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletedStore = Store::where('id', $id)
            ->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Tienda eliminada correctamente',
            'data' => $deletedStore,
        ], 200);
    }
}
