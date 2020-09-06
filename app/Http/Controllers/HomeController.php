<?php

namespace App\Http\Controllers;

use App\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $shipments = Dashboard::where('user_id', Auth::user()->id)->get();
        return view('home',['shipments'=>$shipments]);
    }

    public function create(Request $request)
    {
        $shipment = new Dashboard();
        $shipment->name = $request->name;
        $shipment->user_id = Auth::user()->id;
        $shipment->save();
        return response()->json(['data'=>$shipment,'success'=>'Data is successfully added']);

    }
    public function delete(Request $request)
    {
        if (Dashboard::where('id', $request->id)->delete()){
            return response()->json(['success'=>'Data is successfully deleted']);
        }
        return response()->json(['error'=>'Cannot delete shipment']);

    }
}
