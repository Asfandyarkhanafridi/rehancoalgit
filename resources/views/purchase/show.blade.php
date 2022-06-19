@extends('layouts.main')
@section('title',"All Purchase")

@section('main-content')
    <div class="container-fluid" >
        <div class="row container-fluid p-4">
            <div class="col-sm-10">
                <h1>All Purchases for {{$purchase->company->company_name}}</h1>
            </div>
        </div>
        <div class="row container-fluid">
            <div class="col-sm-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Purchase Detail For {{$purchase->company->company_name}}
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
                            <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Entry Date</th>
                                    <th>Company</th>
                                    <th>Quality</th>
                                    <th>Rate</th>
                                    <th>Weight</th>
                                    <th>Load</th>
                                    <th>Mate</th>
                                    <th>Detail</th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Entry Date</th>
                                    <th>Company</th>
                                    <th>Quality</th>
                                    <th>Rate</th>
                                    <th>Weight</th>
                                    <th>Load</th>
                                    <th>Mate</th>
                                    <th>Detail</th>
                                    <th>Amount</th>
                                </tr>
                                </tfoot>
                                <!-- This is Table Body -->
                                <tbody>
                                @foreach ($purchasesForCompany as $purchase)
                                    <tr>
                                        <td>{{ $purchase->id }}</td>
                                        <td>{{date('d-m-Y', strtotime($purchase->date))}}</td>
                                        <td>{{ $purchase->company->company_name }}</td>
                                        <td>{{ $purchase->quality->quality }}</td>
                                        <td>{{ $purchase->rate }}</td>
                                        <td>{{ $purchase->weight }}</td>
                                        <td>{{ $purchase->load }}</td>
                                        <td>{{ $purchase->mate }}</td>
                                        <td>{{ $purchase->detail }}</td>
                                        <td>{{ $purchase->amount }}</td>
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


