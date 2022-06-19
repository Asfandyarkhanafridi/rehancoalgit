@extends('layouts.main')
@section('title',"All Sales")

@section('main-content')
    <div class="container-fluid" >
        <div class="row container-fluid p-4">
            <div class="col-sm-10">
                <h1>All Sales for {{$sale->party->party_name}}</h1>
            </div>
        </div>
        <div class="row container-fluid">
            <div class="col-sm-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Sales Detail For {{$sale->party->party_name}}
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
                                    <th>Date</th>
                                    <th>Company</th>
                                    <th>Quality</th>
                                    <th>Truck</th>
                                    <th>Rate</th>
                                    <th>Weight</th>
                                    <th>Detail</th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Company</th>
                                    <th>Quality</th>
                                    <th>Truck</th>
                                    <th>Rate</th>
                                    <th>Weight</th>
                                    <th>Detail</th>
                                    <th>Amount</th>
                                </tr>
                                </tfoot>
                                <!-- This is Table Body -->
                                <tbody>
                                @foreach ($salesForParty as $sale)
                                    <tr>
                                        <td>{{ $sale->id }}</td>
                                        <td>{{date('d-m-Y', strtotime($sale->date))}}</td>
                                        <td>{{$sale->company->company_name}}</td>
                                        <td>{{$sale->quality->quality}}</td>
                                        <td>{{$sale->truck}}</td>
                                        <td>{{$sale->rate}}</td>
                                        <td>{{$sale->weight}}</td>
                                        <td>{{$sale->detail}}</td>
                                        <td>{{$sale->amount}}</td>
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


