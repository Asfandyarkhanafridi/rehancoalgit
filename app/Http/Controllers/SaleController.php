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
        $sales = Sale::groupBy('party_id')->get();
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
        Sale::create($data);
        return redirect()->back()->with('message', 'Sale Data Added!');
    }

    public function show(Sale $sale)
    {
	    $salesForParty = Sale::where('party_id',$sale->party_id)->orderBy('created_at','DESC')->get();
	    return view('sale.show',compact('sale','salesForParty'));
    }

    public function edit(Sale $sale)
    {
        return view('sale.index')
            ->with('sale', Sale::where('id', $sale)->first());
    }

    public function update(Request $request, Sale $sale)
    {
        $data= $request->validate([
            'date'          =>  'required',
            'party_id'      =>  'required',
            'company_id'    =>  'required',
            'quality_id'    =>  'required',
            'weight'        =>  'required',
            'rate'          =>  'required',
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
