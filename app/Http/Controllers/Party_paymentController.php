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
        $parties        = Party::all();
        $party_payments = Party_payment::all();
        $sales          = Sale::groupBy('party_id')->get();
        return view('/party_payment/index',['party_payments'=>$party_payments,'sales'=>$sales,'parties'=>$parties]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $party_id = $request->party_id;
        $credit = 0;
        $debit = 0;
        function getLastBalanceParty($party_id) {
            $queryAccount2 = DB::table('party_payments')->where('party_id', $party_id)->orderBy('id', 'desc')->take(1)->value('amount');
            return $queryAccount2;
        }
        function getLastStatusParty($party_id) {
            $queryStatus = DB::table('party_payments')->where('party_id', $party_id)->orderBy('id', 'desc')->take(1)->value('status');
            return $queryStatus;
        }

        $data = $request->validate([
            'debit'    => 'required',
        ]);

        $data['party_id'] = $party_id;
        $creditdebit = $request->debit1;

        $amount = $data['debit'];

        $lastStatusParty = getLastStatusParty($party_id);
        $lastBalanceParty = getLastBalanceParty($party_id);
        if ($lastStatusParty === 'credit') {
            $credit = $amount;
            $amount = $lastBalanceParty - $credit;
        }

        else if($lastStatusParty == 'debit') {
            $debit = $amount;
            $amount = $lastBalanceParty + $debit;
        }

        $data['credit'] = $credit;
        $data['debit']  = $debit;
        $data['status'] = $creditdebit;
        $data['amount'] = $amount;

        Party_payment::create($data);
        return redirect()->back()->with('message', 'Party Payment Added!');
    }

    public function show(Party $party)
    {
        return view('party_payment.detail',['party'=>$party]);
    }

    public function edit(Party_payment $party_payment)
    {
        return view('party_payment.index')
            ->with('party_payment', Party_payment::where('id', $party_payment)->first());
    }

    public function update(Request $request, Party_payment $party_payment)
    {
        $data= $request->validate([
            'amount'    => 'required',
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
