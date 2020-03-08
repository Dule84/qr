<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Merchandise;
use Auth;

class MerchandiseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function insertMerchandise(){

    	return view('product.merch');
    }

    public function merchandise(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ],[
            'name.required' => 'Ime proizvoda je obavezno!',
        ]);

    	$merch = new Merchandise();

    	$user_id = Auth::user()->id;
        $user_dir = Auth::user()->directorium;
        $str = Auth::user()->unique_str;
        $city = Auth::user()->city_slug;

        $array_from_to = array(
                         ' ' => '-',      
                         'Č' => 'C',
                         'Đ' => 'Dj',
                         'Š' => 'S',
                         'Ž' => 'Z');
            
        $file = strtr($request->name,$array_from_to);

        $qr_name = uniqid().'.png';

        $merch->proiz = $request->proiz;
        $merch->country = $request->country;
        $merch->uvoznik = $request->uvoznik;
    	$merch->name = $request->name;
    	$merch->sastav = $request->sastav;
    	$merch->size = $request->size;
    	$merch->maintenance = $request->maintenance;
    	$merch->slug = strtolower($file);
    	$merch->qr_name = $qr_name;
    	$merch->user_id = $user_id;

        \QrCode::format('png')->size(150)
                ->errorCorrection('H')
                ->generate('http://104.248.19.84/company/'. $city .'/'.$user_dir.'/'.$merch->slug, public_path('images/'.$user_dir.'-'.$str.'/'. $qr_name));

        $merch->save();

    	return redirect()->route('dashboard')->with('success', 'Uspesno dodan proizvod!');
    }

    public function editMerch($id)
    {
        $merch = Merchandise::find($id);

        return view('product.edit_merch')->withMerch($merch);
    }

    public function updateMerch(Request $request, $id)
    {
        $merch = Merchandise::find($id);

        $user_id = Auth::user()->id;

        $merch->proiz = $request->proiz;
        $merch->country = $request->country;
        $merch->uvoznik = $request->uvoznik;
    	$merch->name = $request->name;
    	$merch->sastav = $request->sastav;
    	$merch->size = $request->size;
    	$merch->maintenance = $request->maintenance;
    	$merch->user_id = $user_id;

        $merch->save();

        return redirect()->route('dashboard');
    }

    public function getMerchDownload($id){

        $user_dir = Auth::user()->directorium;
        $str = Auth::user()->unique_str;

        $merch = Merchandise::find($id);

        $file = public_path('images/'.$user_dir.'-'.$str.'/'. $merch->qr_name);

        $headers = array('Content-Type: image/png',);

        return response()->download($file, $merch->qr_name, $headers);
    }

    public function deleteMerch($id) {

        $merch = Merchandise::find($id);

        $user_dir = Auth::user()->directorium;
        $str = Auth::user()->unique_str;

        unlink(public_path('images/'.$user_dir.'-'.$str.'/'. $merch->qr_name));

        $merch->delete();

        return redirect()->route('dashboard');
    }
}
