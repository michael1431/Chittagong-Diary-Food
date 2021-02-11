<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::whereStatus(1)->orderBy('created_at','DESC')->paginate(20);
        $invoice_options=Invoice::where('status',1)->get();
        return view('admin.invoice.invoice-list',compact('invoices','invoice_options'));
    }
    public function printInvoice($id,Request $request)
    {
        $invoice = Invoice::find($id);
        if($request->chalan){
            return view('admin.invoice.invoice-info-chalan',compact('invoice'));
        }
        return view('admin.invoice.invoice-info',compact('invoice'));
    }
}
