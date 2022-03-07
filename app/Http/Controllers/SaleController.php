<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Party;
use App\Models\Party_payment;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Quality;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {


        $companiesStock = Sale::getStock();
        $qualitiesStock = Sale::getStock();
        $companies = Company::all();
        $qualities = Quality::all();
        $parties = Party::all();
        $sales = Sale::all();
        return view('/sale/index',['sales'=>$sales,'parties'=>$parties,'companies'=>$companies,'qualities'=>$qualities]);
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'date'          => 'required',
            'party_id'      => 'required',
            'company_id'    => 'required',
            'quality_id'    => 'required',
            'weight'        => 'required',
            'rate'          => 'required',
        ]);

        $data['detail'] = $request->detail;
        $data['amount'] = $data['rate'] * $data['weight'];
        $sale = Sale::create($data);

        $party_id = $data['party_id'];
        $credit = 0;
        $debit = 0;
        function getLastBalanceSale($party_id) {
            return DB::table('party_payments')->where('party_id', $party_id)->orderBy('id', 'desc')->take(1)->value('amount');
        }
        function getLastStatusSale($party_id) {
            return DB::table('party_payments')->where('party_id', $party_id)->orderBy('id', 'desc')->take(1)->value('status');
        }

        //Data Insertion in Party_payments Table
        $party_data = [
            'party_id'    => $data['party_id'],
            'sale_id'     => $sale->id,
            'credit'      => $data['amount'],
            'debit'       => 0,
            'status'      => 'credit',
            'amount'      => $data['amount'],
        ];
        $creditdebit1 = $party_data['status'];
        $amount = $party_data['credit'];

        $lastStatusSale = getLastStatusSale($party_id);
        $lastBalanceSale = getLastBalanceSale($party_id);
        if (($lastStatusSale == 'credit')||($lastStatusSale == '')) {
            $credit = $amount;
            $amount = $lastBalanceSale + $credit;
        }

        else if(($lastStatusSale == 'debit')||($lastStatusSale == '')) {
            $debit = $amount;
            $amount = $lastBalanceSale - $debit;
        }

        $party_data['credit'] = $credit;
        $party_data['debit']  = $debit;
        $party_data['status'] = $creditdebit1;
        $party_data['amount'] = $amount;

        Party_payment::create($party_data);

        return redirect()->back()->with('message', 'Sale Data Added!');
    }

    public function show(Sale $sale)
    {

    }

    public function edit(Sale $sale)
    {
        return view('sale.index')
            ->with('sale', Sale::where('id', $sale)->first());
    }

    public function update(Request $request, Sale $sale)
    {
        $data= $request->validate([
            'date' => 'required',
            'party_id' => 'required',
            'company_id' => 'required',
            'quality_id' => 'required',
            'weight' => 'required',
            'rate' => 'required',
        ]);
        $sale->update($data);
        return redirect()->back()->with('message', 'Sale data Updated!');
    }

    public function destroy(Sale $sale)
    {
        $data = Sale::where('sale', $sale);
        $sale->delete($data);
        return redirect()->back()->with('message', 'Sale data Deleted!');
    }}
