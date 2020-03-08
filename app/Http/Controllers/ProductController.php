<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Auth;
use App\Ingredient;
use Session;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function insertProduct()
    {
    	return view('product.index');
    }

    public function product(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'ing_name' => 'required'
        ],[
            'name.required' => 'Ime proizvoda je obavezno!',
            'ing_name.required' => 'Svaki sastojak je obavezan!'
        ]);

    	$product = new Product();

    	$user_id = Auth::user()->id;
        $user_dir = Auth::user()->directorium;
        $str = Auth::user()->unique_str;
        $city = Auth::user()->city_slug;

    	$product->name = $request->name;

        $array_from_to = array(
                         ' ' => '-',      
                         'Č' => 'C',
                         'Đ' => 'Dj',
                         'Š' => 'S',
                         'Ž' => 'Z');
            
        $file = strtr($request->name,$array_from_to);

    	$product->product_slug = strtolower($file);
    	$product->user_id = $user_id;

        $qr_name = uniqid().'.png';

        $product->qr_name = $qr_name;

        \QrCode::format('png')->size(150)
                ->errorCorrection('H')
                ->generate('http://104.248.19.84/company/'. $city .'/'.$user_dir.'/'.$product->product_slug, public_path('images/'.$user_dir.'-'.$str.'/'. $qr_name));

    	if($product->save()){
            foreach($request->ing_name as $ing_name){
                $ing = new Ingredient();
                $ing->name = $ing_name;
                $ing->product_id = $product->id;
                $ing->save();
            }
        }

    	return redirect()->route('dashboard')->with('success', 'Uspesno dodan proizvod!');
    }

    public function editProduct($id)
    {
        $product = Product::find($id);

        return view('product.edit')->withProduct($product);
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::find($id);

        $user_id = Auth::user()->id;

        $product->name = $request->name;
        $product->user_id = $user_id;

        $product->save();

        return redirect()->route('dashboard');
    }

    public function getDownload($id){

        $user_dir = Auth::user()->directorium;
        $str = Auth::user()->unique_str;

        $product = Product::find($id);

        $file = public_path('images/'.$user_dir.'-'.$str.'/'. $product->qr_name);

        $headers = array('Content-Type: image/png',);

        return response()->download($file, $product->qr_name, $headers);
    }

    public function deleteProduct($id) {

        $product = Product::findOrFail($id);
        $ing = Ingredient::where('product_id', $product->id)->get()->toArray();

        $user_dir = Auth::user()->directorium;
        $str = Auth::user()->unique_str;

        unlink(public_path('images/'.$user_dir.'-'.$str.'/'. $product->qr_name));

        $product->delete();

        return redirect()->route('dashboard');
    }

}
