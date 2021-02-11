<?php

namespace App\Http\Controllers\Marketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Sale;
use App\Invoice;

class EmployeeDashboardController extends Controller
{

    public function index()
    {
        
        return view('dashboard.marketing.employee');
    }

    public function dailyLog()
    {
        $products=Product::where('department_id',1)->get();// department_id 1 means sale-able product
        //dd($products);
        return view('dashboard.marketing.daily-log', compact('products') );
    }
    
    public function dailyReport()
    {
        $invoices = Invoice::where([['event','sales'],['related_party_type','Customer'],['related_party_id',Auth::user()->id]])->get();  
        return view('dashboard.marketing.daily-report',compact('invoices'));
    }
    public function monthlyLog()
    {
        $invoices = Invoice::where([['related_party_type','Customer'],['related_party_id',Auth::user()->id]])->get(); 
        return view('dashboard.marketing.monthly-log',compact('invoices'));
    }
}
