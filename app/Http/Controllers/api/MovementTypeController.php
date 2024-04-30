<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MovementType;

class MovementTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movementType = MovementType::all();

        return response()->json([
            'data' => $movementType,
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
        $newMovementType = MovementType::create([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Tipo de movimiento creado correctamente',
            'data' => $newMovementType,
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
        $updatedMovementType = MovementType::where('id', $id)
            ->update([
                'code' => $request->code,
                'name' => $request->name,
                'description' => $request->description,
            ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Tipo de movimiento actualizado correctamente',
            'data' => $updatedMovementType,
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
        $deletedMovementType = MovementType::where('id', $id)
            ->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Tipo de movimiento eliminado correctamente',
            'data' => $deletedMovementType,
        ], 200);
    }
}
