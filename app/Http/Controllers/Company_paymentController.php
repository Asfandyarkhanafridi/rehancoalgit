<?php

namespace App\Http\Controllers;

use App\Models\Company_payment;
use App\Models\Company;
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
        return view('/company_payment/index',['company_payments'=>$company_payments,'purchases'=>$purchases,'companies'=>$companies]);
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $company_id = $request->company_id;
        $credit = 0;
        $debit = 0;
        function getLastBalance($company_id) {
            $queryAccount2 = DB::table('company_payments')->where('company_id', $company_id)->orderBy('id', 'desc')->take(1)->value('amount');
            return $queryAccount2;
        }
        function getLastStatus($company_id) {
            $queryStatus = DB::table('company_payments')->where('company_id', $company_id)->orderBy('id', 'desc')->take(1)->value('status');
            return $queryStatus;
        }
        $data = $request->validate([
            'credit'    => 'required',
        ]);


        $data['company_id'] = $company_id;
        $creditdebit = $request->credit1;

        $amount = $data['credit'];

        $lastStatus = getLastStatus($company_id);
        $lastBalance = getLastBalance($company_id);



        $data['credit'] = $credit;
        $data['debit']  = $debit;
        $data['status'] = $creditdebit;
        $data['amount'] = $amount;

        Company_payment::create($data);
        return redirect()->back()->with('message', 'Company Payment Added!');
    }

    public function show(Company $company)
    {
        return view('company_payment.detail',['company'=>$company]);
    }

    public function edit(Company_payment $company_payment)
    {
        return view('company_payment.index')
            ->with('company_payment', Company_payment::where('id', $company_payment)->first());
    }

    public function update(Request $request, Company_payment $company_payment)
    {
        $data= $request->validate([
            'amount'  => 'required',
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
}
