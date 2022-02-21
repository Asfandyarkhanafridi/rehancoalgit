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
        $purchases = Purchase::all();
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

        $company_id = $data['company_id'];
        $credit = 0;
        $debit = 0;
        function getLastBalancePurchase($company_id) {
            return DB::table('company_payments')->where('company_id', $company_id)->orderBy('id', 'desc')->take(1)->value('amount');
        }
        function getLastStatusPurchase($company_id) {
            return DB::table('company_payments')->where('company_id', $company_id)->orderBy('id', 'desc')->take(1)->value('status');
        }
        //Data Insertion in Company_payments Table
        $company_data = [
            'company_id'    => $data['company_id'],
            'purchase_id'   => $purchase->id,
            'debit'         => $data['amount'],
            'credit'        => 0,
            'status'        => 'debit',
            'amount'        => $data['amount'],
        ];
        $creditdebit1 = $company_data['status'];
        $amount = $company_data['debit'];

        $lastStatusPurchase = getLastStatusPurchase($company_id);
        $lastBalancePurchase = getLastBalancePurchase($company_id);

        if (($lastStatusPurchase == 'credit')||($lastStatusPurchase == '')) {
            $credit = $amount;
            $amount = $lastBalancePurchase + $credit;
        }

        else if(($lastStatusPurchase == 'debit')||($lastStatusPurchase == '')) {
            $debit = $amount;
            $amount = $lastBalancePurchase - $debit;
        }

        $company_data['credit'] = $credit;
        $company_data['debit']  = $debit;
        $company_data['status'] = $creditdebit1;
        $company_data['amount'] = $amount;

        Company_payment::create($company_data);

        return redirect()->back()->with('message', 'Purchase Data Added!');
    }

    public function show(Purchase $purchase)
    {

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
