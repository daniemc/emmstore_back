<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use DateTime;

class ProductsController extends Controller
{

    public function list(Request $request)
    {
        $products = Product::all();

        return response()->json([
            'data' => $products,
        ], 200);
    }

    public function save(Request $request)
    {
        $requestUser = $request->user();
        $newProduct = Product::create([
            'code' => $request->code,
            'name' => $request->name,
            'barrcode' => $request->barrcode,
            'active' => $request->active,
            'created_by' => $requestUser->id,
            'updated_by' => $requestUser->id,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Producto creado correctamente',
            'data' => $newProduct,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $requestUser = $request->user();
        $updatedProduct = Product::where('id', $id)
            ->update([
                'code' => $request->code,
                'name' => $request->name,
                'barrcode' => $request->barrcode,
                'active' => $request->active,
                'updated_by' => $requestUser->id,
                'updated_at' => new DateTime(),
            ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Producto actualizado correctamente',
            'data' => $updatedProduct,
        ], 200);
    }

    public function delete(Request $request, $id)
    {
        $deletedProduct = Product::where('id', $id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Producto eliminado correctamente',
            'data' => $deletedProduct,
        ], 200);
    }


}
