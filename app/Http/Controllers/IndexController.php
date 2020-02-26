<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;
use App\Ingredient;
use App\Merchandise;

class IndexController extends Controller
{
    
    public function signin()
    {
    	return view('login.login');
    }

    public function signup()
    {
    	return view('login.register');
    }

    public function getProductByUser($city, $dir, $slug){

		$result = User::where('city_slug', $city)->where('directorium', $dir)->first(); 
		$product = Product::where('product_slug', $slug)->first(); 
        $ingredients = Ingredient::where('product_id', $product->id)->get();
        $merchs = Merchandise::where('slug', $slug)->get();

    	return view('single')->withResult($result)->withProduct($product)->withIngredients($ingredients)->withMerchs($merchs);
    }
}
