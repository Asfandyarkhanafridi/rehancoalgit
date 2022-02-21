<?php

namespace App\Http\Controllers;

use App\Models\Party;
use Illuminate\Http\Request;

class PartyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('/party/index')
            ->with('parties', Party::orderBy('updated_at' , 'DESC')->get());
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'party_name' => 'required',
            'contact_person' => 'required',

        ]);
        Party::create($data);
        return redirect()->back()->with('message', 'Party Added!');

    }

    public function show(Party $party)
    {
        //
    }

    public function edit(Party $party)
    {
        return view('party.index')
            ->with('party', Party::where('id', $party)->first());
    }

    public function update(Request $request, Party $party)
    {
        $data= $request->validate([
            'party_name' => 'required',
            'contact_person' => 'required',

        ]);
        $party->update($data);
        return redirect()->back()->with('message', 'Party Updated!');
    }

    public function destroy(Party $party)
    {
        //
    }
}
