@extends('layouts.main')
@section('title','Company Payment')

@section('main-content')
    <div class="container-fluid">
        <div class="row container-fluid p-4">
            <div class="col-sm-9">
                <h1>Company Payment</h1>
            </div>
        </div>
        <div class="row container-fluid">
            <div class="col-sm-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        List of Companies
                        @if(session()->has('message'))
                            <div class="alert alert-success" id="deleteAlert">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="myTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Company Name</th>
                                    <th>Remaining Amount</th>
                                    <th width="7%">Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Company Name</th>
                                    <th>Remaining Amount</th>
                                    <th width="7%">Action</th>
                                </tr>
                                </tfoot>
                                <!-- This is Table Body -->
                                <tbody>
                                @foreach($purchases as $purchase)
                                <tr>
                                    <td>{{$purchase->company->id}}</td>
                                    <td>{{$purchase->company->company_name}}</td>
                                    <td>{{ \App\Models\Company_payment::where('company_id', $purchase->company->id)->orderBy('id', 'desc')->take(1)->value('amount') }}</td>
                                    <td>
                                        <a href = "{{route('company_payment.show',$purchase->company->id)}}" class="btn btn-outline-success">Details</a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


