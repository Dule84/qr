<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Auth;
use App\Merchandise;

class DashboardController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
    public function dashboard()
    {
    	$id = Auth::user()->id;
        $path = 'images/'.Auth::user()->directorium .'-'. Auth::user()->unique_str.'/';
    	$products = Product::where('user_id', $id)->get();
        $merchs = Merchandise::where('user_id', $id)->get();


    	return view('dashboard.dashboard')->withProducts($products)->withPath($path)->withMerchs($merchs);
    }
}
