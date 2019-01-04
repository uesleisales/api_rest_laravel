<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{   
    private $product;

    public function __construct(Product $product){
        $this->product = $product;
    }
    public function index(){ 
        
        $data = ['data' => $this->product->paginate(10)];

        return response()->json($data);
    }

    public function show(Product $id){
        
        $product = $this->product->find($id);

        if(!$product){
            return response()->json(['data' => ['msg' => 'Produto não foi encontrado']] , 404);
        }
        else{
            return response()->json(['data' => $id]);
        }
        
    }

    public function update(Request $request , $id){

        try{

            $productData = $request->all();
            $product     = $this->product->find($id);
            $this->product->update($productData);
            return response()->json(['msg' => 'Produto atualizado com sucesso'], 201);

        }catch(\Exception $e){

            if(config('app.debug')){
                return response()->json(ApiError::errorMessage($e->getMessage() , 1010) );
            }

            return response()->json(ApiError::errorMessage('Houve erro ao realizar operação' , 1010) , 500);

        }
    }

    public function store(Request $request){
        
        
        try{
            $productData = $request->all();
            $this->product->create($productData);
            return response()->json(['msg' => 'Produto criado com sucesso'], 201);

        }catch(\Exception $e){
            if(config('app.debug')){
                return response()->json(ApiError::errorMessage($e->getMessage() , 1010));
            }

            return response()->json(ApiError::errorMessage('Houve erro ao realizar operação' , 1010) , 500);

        }
        
    }




    public function delete(Product $id){

        try{

            $id->delete();
            return response()->json(['msg' => 'Produto removido com sucesso'] , 200);

        }catch(\Exception $e){
            if(config('app.debug')){
                return response()->json(ApiError::errorMessage($e->getMessage() , 1010));
            }

            return response()->json(ApiError::errorMessage('Houve erro ao realizar operação de remover' , 1010));

        }
    }
} 
