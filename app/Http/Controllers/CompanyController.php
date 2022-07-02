<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('/company/index')
            ->with('companies', Company::orderBy('updated_at', 'DESC')->get());
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'company_name' => 'required',
            'contact_person' => 'required',
        ]);
        Company::create($data);

        return redirect()->back()->with('message', 'Company Added!');
    }

    public function show(Company $company)
    {

    }

    public function edit(Company $company)
    {
        return view('company.index')
            ->with('company', Company::where('id', $company)->first());
    }

    public function update(Request $request, Company $company)
    {
        $data = $request->validate([
            'company_name' => 'required',
            'contact_person' => 'required',
        ]);
        $company->update($data);
        return redirect()->back()->with('message', 'Company Updated!');
    }

    public function destroy(Company $company)
    {
        //
    }
}
