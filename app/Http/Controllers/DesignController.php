<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

use \Auth;

use \App\Models\Category;
use \App\Models\Restaurant;
use \App\Models\User;
use \App\Models\Design;


class DesignController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         // $this->middleware('auth');
    }





    public function update(Request $request, $id)
    {
        $restaurant_id = session('restau_id');
        $design = Design::where('restaurant_id', $restaurant_id)->first();

        // $design->restaurant_id  = $request->restaurant_id;
        $design->theme          = $request->theme;
        $design->baseColor      = $request->baseColor;
        $design->baseFamily     = $request->baseFamily;
        $design->titleColor     = $request->titleColor;
        $design->titleFamily    = $request->titleFamily;

        $design->save();

        return redirect('admin/?task=design')
        ->with('success', 'Votre restaurant à été modifié avec succès');
    }




}
