<?php

namespace App\Http\Controllers\backend;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\models\Order;

class IndexController extends Controller
{
    function getIndex() {
    
        $month_now = carbon::now()->format('m');
        $year_now = carbon::now()->format('Y');
        for ($i=1; $i <= $month_now ; $i++) { 
            $dl['Tháng '.$i] = Order::where('state', 1)->whereMonth('updated_at', $i)->whereYear('updated_at', $year_now)->sum('total');
        }
        $data['dl'] = $dl;
        $data['so_dh'] = Order::where('state',2)->count();
        return view('backend.index', $data);
    }
    function Logout(){
        Auth::logout();
        return redirect('login');
    }
}
