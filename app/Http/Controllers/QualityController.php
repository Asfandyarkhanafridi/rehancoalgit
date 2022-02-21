<?php

namespace App\Http\Controllers;

use App\Models\Quality;
use Illuminate\Http\Request;

class QualityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('/quality/index')
            ->with('qualities', Quality::orderBy('updated_at' , 'DESC')->get());
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'quality' => 'required',

        ]);
        Quality::create([
            'quality' => $request->input('quality'),
            'description' => $request->input('description'),
        ]);
        return redirect()->back()->with('message', 'Quality Added!');

    }

    public function show(Quality $quality)
    {
        //
    }

    public function edit(Quality $quality)
    {
        return view('quality.index')
            ->with('quality', Quality::where('id', $quality)->first());
    }

    public function update(Request $request, Quality $quality)
    {
        $data= $request->validate([
            'quality' => 'required',

        ]);
        $quality->update($data);
        return redirect()->back()->with('message', 'Quality Updated!');
    }

    public function destroy(Quality $quality)
    {
        //
    }
}
