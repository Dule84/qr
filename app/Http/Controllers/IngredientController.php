<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingredient;
use App\Product;

class IngredientController extends Controller
{
    public function editIngredients($id){

    	$product = Product::find($id);
    	$ingredients = Ingredient::where('product_id', $id)->get();

    	return view('product.ing')->withProduct($product)->withIngredients($ingredients);
    }

    public function updateIng(Request $request, $id)
    {
        $ing = Ingredient::where('product_id', $id);

        $this->deleteIng($id);

        foreach($request->name as $name){
        	$ing->name = $name;
        	$ing->product_id = $request->product_id;

        	$ing->save();
    	}

        return redirect()->route('dashboard');
    }

    public function deleteIng($id) {

        $ing = Ingredient::findOrFail($id);

        $ing->delete();

        return redirect()->route('dashboard');
    }
}
