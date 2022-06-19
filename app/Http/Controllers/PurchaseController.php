<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Company_payment;
use App\Models\Purchase;
use App\Models\Quality;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
	
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $companies = Company::all();
        $qualities = Quality::all();
        $purchases = Purchase::groupBy('company_id')->get();
        return view('/purchase/index',['purchases'=>$purchases,'companies'=>$companies,'qualities'=>$qualities]);
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
       $data = $request->validate([
            'date'       => 'required',
            'company_id' => 'required',
            'quality_id' => 'required',
            'rate'       => 'required',
            'weight'     => 'required',
            'load'       => 'required',
            'mate'       => 'required',
        ]);
       
        $data['detail'] = $request->detail;
        $data['amount'] = $data['rate'] * $data['weight'];
        
        $purchase = Purchase::create($data);

        return redirect()->back()->with('message', 'Purchase Data Added!');
    }

    public function show(Purchase $purchase)
    {
    	$purchasesForCompany = Purchase::where('company_id',$purchase->company_id)->orderBy('created_at','DESC')->get();
		return view('purchase.show',compact('purchase','purchasesForCompany'));
    }

    public function edit(Purchase $purchase)
    {
        return view('purchase.index')
            ->with('purchase', Purchase::where('id', $purchase)->first());
    }

    public function update(Request $request, Purchase $purchase)
    {
        $data= $request->validate([
            'date'       => 'required',
            'company_id' => 'required',
            'quality_id' => 'required',
            'rate'       => 'required',
            'weight'     => 'required',
            'load'       => 'required',
            'mate'       => 'required',
        ]);
        $data['amount'] = $data['rate'] * $data['weight'];
        $data['amount'] = $data['rate'] * $data['weight'];
        $purchase = Purchase::update($data);
        $company_data = [
            'company_id' => $data['company_id'],
            'purchase_id' => $purchase->id,
            'debit' => $data['amount'],
            'credit' => 0,
        ];
        Company_payment::update($company_data);
        return redirect()->back()->with('message', 'Purchase data Updated!');
    }

    public function destroy(Purchase $purchase)
    {
        $data = Purchase::where('purchase', $purchase);
        $purchase->delete($data);
        return redirect()->back()->with('message', 'Purchase data Deleted!');
    }
}
