<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF;
use App\Product;
use Auth;
use App\Ingredient;
use DB;

class PdfController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
    	$id = Auth::user()->id;
        $path = 'images/'.Auth::user()->directorium .'-'. Auth::user()->unique_str.'/';
        $products = DB::select('SELECT * FROM products WHERE user_id ='.$id);
        $ingredients = Ingredient::all();

        $pdf = new TCPDF();

        $pdf::SetTitle('QR Kod');
        $pdf::AddPage();

        //set JPEG quality
        $pdf::setJPEGQuality(75);

        $toolcopy = '<table nobr="true" cellpadding="2">';

        foreach (array_chunk($products, 2) as $a) {

            $toolcopy .= '<tr>';
            foreach($a as $array_chunk) {

                $toolcopy .= '<td><p>'.$array_chunk->name.'</p><br>';

                $toolcopy .= '<p>Sastojci: ';

                foreach($ingredients as $ing){

                    if($array_chunk->id == $ing->product_id){

                        $toolcopy .= $ing->name.' ';
                                          
                    } 

                }

                $toolcopy .= '</p></td>'; 

                $toolcopy .= '<td align="left"><img src="'.$path.'/'.$array_chunk->qr_name.'"></td>';

            }
            $toolcopy .= '</tr>';
            
        }
        
        $toolcopy .= '</table>';

        $pdf::writeHTML($toolcopy, true, 0, true, 0);

        $pdf::Output('qr_kodovi.pdf');
    }

 
}
