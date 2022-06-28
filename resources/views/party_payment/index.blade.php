@extends('layouts.main')
@section('title','Party Payment')

@section('main-content')
    <div class="container-fluid">
        <div class="row container-fluid p-4">
            <div class="col-sm-9">
                <h1>Party Payment</h1>
            </div>
        </div>
        <div class="row container-fluid">
            <div class="col-sm-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        List of Parties
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
                                    <th>Party Name</th>
                                    <th>Remaining Amount</th>
                                    <th width="7%">Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Party Name</th>
                                    <th>Remaining Amount</th>
                                    <th width="7%">Action</th>
                                </tr>
                                </tfoot>
                                <!-- This is Table Body -->
                                <tbody>
                                <?php
                                $balance = 0;
                                ?>
                                @foreach($sales as $sale)
                                <tr>
                                    <td>{{$sale->party->id}}</td>
                                    <td>{{$sale->party->party_name}}</td>
                                    <td>
                                        @foreach(collect(\App\Models\Party_payment::creditDebitRecordsParty($sale->party->id))->sortBy('created_at')->values() as $record)
			                                <?php
			                                if ( $record->isDebit == 0 ) {
				                                $balance += $record->amount;
			                                } else {
				                                $balance -= $record->amount;
			                                }
			                                ?>
                                            @if($loop->last && ($balance < 0))
                                                {{abs($balance)}} Debit
                                            @elseif($loop->last)
                                                {{$balance}} Credit
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href = "{{route('party_payment.show',$sale->party->id)}}" class="btn btn-outline-success">Payments</a>
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


