



















}    // ...existing code...    }        return response()->json($product);        $product = Product::with('category')->findOrFail($id);    {    public function show($id)    // ...existing code...{class ProductManagementController extends Controlleruse Illuminate\Http\Request;use App\Models\Product;use App\Http\Controllers\Controller;namespace App\Http\Controllers\Admin;<?php