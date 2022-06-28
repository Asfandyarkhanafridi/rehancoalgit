<?php

namespace App\Http\Controllers;

use App\Models\Party;
use App\Models\Party_payment;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Party_paymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $parties = Party::all();
        $party_payments = Party_payment::all();
        $sales = Sale::groupBy('party_id')->get();
        return view('/party_payment/index', ['party_payments' => $party_payments, 'sales' => $sales, 'parties' => $parties]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Party_payment::create($request->all());
        return redirect()->back()->with('message', 'Party Payment Added!');
    }

    public function show(Party $party)
    {
	    $paymentsParty = \App\Models\Party_payment::where('party_id',$party->id)->get();
	    $sales = \App\Models\Sale::where('party_id',$party->id)->get();
	    $paymentsAmountParty = $paymentsParty->sum('amount');
	    $salesAmount = $sales->sum('amount');
	    $totalAmount = $salesAmount - $paymentsAmountParty;
	    $creditDebitRecordsParty = \App\Models\Party_payment::creditDebitRecordsParty($party->id);
	    return view('party_payment.detail', ['party' => $party,'payments'=> $paymentsParty,'sales'=> $sales,
		                                          'paymentsAmount'=> $paymentsAmountParty,'salesAmount'=>$salesAmount,
												  'totalAmount'=>$totalAmount,'creditDebitRecordsParty'=>$creditDebitRecordsParty]);
    }

    public function edit(Party_payment $party_payment)
    {
        return view('party_payment.index')
            ->with('party_payment', Party_payment::where('id', $party_payment)->first());
    }

    public function update(Request $request, Party_payment $party_payment)
    {
        $data = $request->validate([
            'amount' => 'required',
        ]);
        $party_payment->update($data);
        return redirect()->back()->with('message', 'Party Payment Updated!');
    }

    public function destroy(Party_payment $party_payment)
    {
        $data = Party_payment::where('party_payment', $party_payment);
        $party_payment->delete($data);
        return redirect()->back()->with('message', 'Party Payment Deleted!');
    }
}
