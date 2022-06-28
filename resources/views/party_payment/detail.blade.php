@extends('layouts.main')
@section('title','Party Payment - Details')

@section('main-content')
    <div class="container-fluid">
        <div class="row container-fluid p-4">
            <div class="col-sm-8">
                <h1>{{$party->party_name}}</h1>
            </div>
            <div class="col-sm-4" style="text-align: right">
                <a
                    href="{{route('party_payment.index')}}"
                    class="btn btn-outline-secondary custom">
                    List of Parties
                </a>
                <button class="btn btn-outline-primary" data-toggle="modal"
                        data-target="#addRecord" style="width: auto">
                    Add Payment
                </button>
            </div>
            <div class="modal fade" id="addRecord">
                <div class="modal-dialog" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h2 class="modal-title" id="exampleModalLabel">Add Payment</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" name="myForm" id="myForm" action="{{route('party_payment.store')}}">
                                @csrf
                                <div class="form-group row">
                                    <label class="control-label col-sm-2 required">Amount</label>
                                    <div class="col-sm-12">
                                        <input type="hidden" name="party_id" value="{{$party->id}}">
                                        <input type="text" class="form-control" placeholder="Amount" name="amount" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2 required">Mode</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" placeholder="Mode" name="mode" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2">Detail</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" placeholder="Detail" name="detail"
                                               value="">
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-outline-success">Submit</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row container-fluid">
            <div class="col-sm-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        List of Sales for {{$party->party_name}}
                        @if(session()->has('message'))
                            <div class="alert alert-success mt-3" id="deleteAlert">
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
                                    <th>Serial_No</th>
                                    <th>Date</th>
                                    <th>Credit</th>
                                    <th>Debit</th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <!-- This is Table Body -->
                                <tbody>
	                            <?php
	                            $balance = 0;
	                            ?>
                                @foreach( collect($creditDebitRecordsParty)->sortBy('created_at')->values() as $record)
		                            <?php
		                            if ( $record->isDebit == 0 ) {
			                            $balance += $record->amount;
		                            } else {
			                            $balance -= $record->amount;
		                            }
		                            ?>
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            @if($record->isDebit == 0)
                                                {{$record->created_at}}
                                            @else
                                                {{$record->created_at}}
                                            @endif
                                        </td>
                                        <td>
                                            @if( $record->isDebit == 0 )
                                                {{$record->amount}}
                                            @endif
                                        </td>
                                        <td>
                                            @if( $record->isDebit == 1 )
                                                {{$record->amount}}
                                            @endif
                                        </td>
                                        <td>
                                            {{ abs($balance) }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection