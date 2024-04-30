<?php


namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Movement;

class MovementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movementType = Movement::all();

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
        $requestUser = $request->user();
        $newMovementType = Movement::create([
            'product_id' => $request->product_id,
            'product_variant_id' => $request->product_variant_id,
            'user_id' => $requestUser->id,
            'vendor_id' => $requestUser->id,
            'customer_id' => 0,
            'store_id' => $request->store_id,
            'pos_id' => 0,
            'movement_type_id' => $request->movement_type_id,
            'movement_code' => $request->movement_code,
            'qty' => $request->qty,
            'total_db' => $request->total_db,
            'total_cr' => $request->total_cr,
            'status' => 0,
            'updated_by' => $requestUser->id,
            'date' => $request->date,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Movimiento creado correctamente',
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
        //
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
    }
}
