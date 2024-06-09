<?php

namespace App\Http\Controllers;

use App\Models\Produtos;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function getAllProducts() 
    {
        $products =  Produtos::get()->toJson(JSON_PRETTY_PRINT);
        return response($products, 200);
    }
    public function decreaseStock($id) 
    {
        if(Produtos::where('codigo', $id)->exists()) {
            $product = Produtos::find($id);
            if ($product->quantidade > 0) {
                $product->quantidade -= 1;
                $product->save();

                return response()->json([
                    "message" => "Produto retirado com suceso"
                ], 200);
            } else {
                return response()->json([
                    "message" => "Produto sem estoque"
                ], 400);
            }
        } else {
            return response()->json([
                "message" => "Produto não encontrado"
            ], 404); 
        }
    }
    public function createProduct(Request $request)
    {
        $product = new Produtos();

        if ($request->has('nome') && !is_null($request->nome)) {
            $product->nome = $request->nome;
        } else {
            return response()->json([
                "error" => "O campo 'nome' não pode ser nulo."
            ], 400);
        }
        if ($request->has('descricao') &&!is_null($request->descricao)) {
            $product->descricao = $request->descricao;
        } else {
            return response()->json([
                "error" => "O campo 'descricao' não pode ser nulo."
            ], 400); 
        }
        if ($request->has('valor') &&!is_null($request->valor)) {
            $product->valor = $request->valor;
        } else {
            return response()->json([
                "error" => "O campo 'valor' não pode ser nulo."
            ], 400); 
        }
        if ($request->has('quantidade') &&!is_null($request->quantidade)) {
            $product->quantidade = $request->quantidade; 
        } else {
            return response()->json([
                "error" => "O campo 'quantidade' não pode ser nulo."
            ], 400);
        }
        $product->save();
    
        return response()->json([
            "message" => "Registro do produto criado"
        ], 201);
    }
    public function updateProduct(Request $request, $id) 
    {
        if (Produtos::where('codigo', $id)->exists()) {
            $products = Produtos::find($id);
            $products->nome = is_null($request->nome) ? $products->nome : $request->nome;
            $products->descricao = is_null($request->descricao) ? $products->descricacao : $request->descricao;
            $products->valor = is_null($request->valor) ? $products->valor : $request->valor;
            $products->quantidade = is_null($request->quantidade) ? $products->quantidade : $request->quantidade;
            $products->save();

            return response()->json([
                "message" => "records updated successfully"
            ], 200);
            } else {
            return response()->json([
                "message" => "Product not found"
            ], 404);
        }
    }
}
