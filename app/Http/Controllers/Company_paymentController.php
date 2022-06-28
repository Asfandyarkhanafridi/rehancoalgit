<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Company_payment;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Company_paymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $companies = Company::all();
        $company_payments = Company_payment::all();
        $purchases = Purchase::groupBy('company_id')->get();
//        $balance = Company_paymentController::latestBalance();
//        dd($balance);
        return view('/company_payment/index', ['company_payments' => $company_payments, 'purchases' => $purchases, 'companies' => $companies]);
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        Company_payment::create($request->all());
        return redirect()->back()->with('message', 'Company Payment Added!');
    }

    public function show(Company $company)
    {
	    $payments = \App\Models\Company_payment::where('company_id',$company->id)->get();
	    $purchases = \App\Models\Purchase::where('company_id',$company->id)->get();
	    $paymentsAmount = $payments->sum('amount');
	    $purchasesAmount = $purchases->sum('amount');
	    $totalAmount = $purchasesAmount - $paymentsAmount;
	    $creditDebitRecords = \App\Models\Company_payment::creditDebitRecords($company->id);
        return view('company_payment.detail', ['company' => $company,'payments'=> $payments,'purchases'=> $purchases,
	                                                'paymentsAmount'=> $paymentsAmount,'purchasesAmount'=>$purchasesAmount,
                                                    'totalAmount'=>$totalAmount,'creditDebitRecords'=>$creditDebitRecords]);
    }

    public function edit(Company_payment $company_payment)
    {
        return view('company_payment.index')
            ->with('company_payment', Company_payment::where('id', $company_payment)->first());
    }

    public function update(Request $request, Company_payment $company_payment)
    {
        $data = $request->validate([
            'amount' => 'required',
        ]);
        $company_payment->update($data);
        return redirect()->back()->with('message', 'Company Payment Updated!');
    }

    public function destroy(Company_payment $company_payment)
    {
        $data = Company_payment::where('company_payment', $company_payment);
        $company_payment->delete($data);
        return redirect()->back()->with('message', 'Company Payment  Deleted!');
    }
    
    public static function latestBalance($balance){
    	return $balance;
    }
}
