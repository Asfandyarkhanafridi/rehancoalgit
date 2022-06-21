@extends('layouts.main')
@section('title','Purchase')

@section('main-content')
    <div class="container-fluid" >
        <div class="row container-fluid p-4">
            <div class="col-sm-10">
                <h1>Purchase</h1>
            </div>
            <div class="col-sm-2">
                <button
                    class="btn btn-outline-success btn-lg custom"
                    data-toggle="modal"
                    data-target="#addRecord"
                >
                    Purchase
                </button>
                <div class="modal fade" id="addRecord">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content ">
                            <div class="modal-header">
                                <h2 class="modal-title" id="exampleModalLabel">Purchase</h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" name="myForm" action="{{route('purchase.store')}}">
                                   @csrf
                                    <div class="form-group row">
                                        <label class="control-label col-sm-5 required">Date</label>
                                        <div class="col-sm-12">
                                            <input type="text" onfocus= "(this. type='date')" class="form-control" name="date" value="<?php echo date('Y-m-d');?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-5 required">Company</label>
                                        <div class="col-sm-12" style="text-align: left; ">
                                        <select class="form-select" name="company_id" id="select1" style="width: 100%; child-align: left">
                                            <option selected disabled>Select Company</option>
                                            @foreach($companies as $c)
                                            <option value="{{$c->id}}">{{$c->company_name}}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-5 required">Quality</label>
                                        <div class="col-sm-12">
                                        <select class="form-select" name="quality_id" id="select2" style="width: 100%">
                                            <option selected disabled>Select Quality</option>
                                            @foreach($qualities as $q)
                                                <option value="{{$q->id}}">{{$q->quality}}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-5 required">Rate</label>
                                        <div class="col-sm-12">
                                                <input type="number" class="form-control" placeholder="Rate" name="rate" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-5 required">Weight</label>
                                        <div class="col-sm-12 ">
                                                <input type="number" class="form-control" placeholder="Weight" name="weight" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-5 required" >Load</label>
                                        <div class="col-sm-12">
                                                <input type="number" class="form-control" placeholder="Load" name="load" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-5 required">Mate</label>
                                        <div class="col-sm-12" style="text-align: left">
                                            <input type="number" class="form-control" placeholder="Mate" name="mate" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-5">Detail</label>
                                        <div class="col-sm-12">
                                                <input type="text" class="form-control" placeholder="Detail" name="detail" value="" >
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="edit" class="btn btn-success">Submit</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
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
                        Purchase Detail
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
                                        <th>Amount</th>
                                        <th width="7%">Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Entry Date</th>
                                        <th>Company</th>
                                        <th>Amount</th>
                                        <th width="7%">Action</th>
                                    </tr>
                                    </tfoot>
                                    <!-- This is Table Body -->
                                    <tbody>
                                    @foreach ($purchases as $purchase)
                                        <tr>
                                            <td>{{ $purchase->id }}</td>
                                            <td>{{date('d-m-Y', strtotime($purchase->date))}}</td>
                                            <td>{{ $purchase->company->company_name }}</td>
                                            <?php
                                                $sumAmount = \App\Models\Purchase::where('company_id', $purchase->company_id)->sum('amount');
                                            ?>
                                            <td>{{ $sumAmount }}</td>
                                            <center><td>
                                                    <!-- Edit Icon  -->
                                                    <center>
                                                        <a href="{{route('purchase.show',$purchase->id)}}" class="visibility" title="Show"><i class="material-icons">S</i></a>
                                                        <a href="/purchase/{{$purchase->id}}" class="edit" title="Edit" data-toggle="modal" data-target="#purchase{{$purchase->id}}"><i class="material-icons">edit</i></a>
                                                        <a href="{{route('purchase.destroy',$purchase->id)}}" class="delete" title="Delete"><i class="material-icons">delete</i></a>
                                                    </center>
                                                    <!-- Edit Modal Start -->
                                                    <div class="modal fade" id="purchase{{$purchase->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content ">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Purchase</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="post" name="myForm" action="{{route('purchase.update',$purchase->id)}}">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="form-group row">
                                                                            <label class="control-label col-sm-5 required ">Date</label>
                                                                            <div class="col-sm-12">
                                                                                    <input type="text" class="form-control"  onfocus= "(this. type='date')" name="date" value="{{$purchase->date}}" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="control-label col-sm-5 required">Company</label>
                                                                            <div class="col-sm-12" style="text-align: left !important;">
                                                                                <select class="form-select" aria-label="Default select example" name="company_id" required>
                                                                                @foreach($companies as $c)
                                                                                        <option value="{{$c->id}}">{{$c->company_name}}</option>
                                                                                @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="control-label col-sm-5 required">Quality</label>
                                                                            <div class="col-sm-12">
                                                                                <select class="form-select" aria-label="Default select example" name="quality_id" required>
                                                                                    @foreach($qualities as $q)
                                                                                        <option value="{{$q->id}}">{{$q->quality}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="control-label col-sm-5 required">Rate</label>
                                                                            <div class="col-sm-12">
                                                                                    <input type="number" class="form-control" placeholder="Rate" name="rate" value="{{$purchase->rate}}" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="control-label col-sm-5 required">Weight</label>
                                                                            <div class="col-sm-12">
                                                                                    <input type="number" class="form-control" placeholder="Weight" name="weight" value="{{$purchase->weight}}" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="control-label col-sm-5 required">Load</label>
                                                                            <div class="col-sm-12">
                                                                                    <input type="number" class="form-control" placeholder="Load" name="load" value="{{$purchase->load}}" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="control-label col-sm-5 required">Mate</label>
                                                                            <div class="col-sm-12">
                                                                                    <input type="number" class="form-control" placeholder="Mate" name="mate" value="{{$purchase->mate}}" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="control-label col-sm-5">Detail</label>
                                                                            <div class="col-sm-12">
                                                                                    <input type="text" class="form-control" placeholder="Detail" name="detail" value="{{$purchase->detail}}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" name="edit" class="btn btn-success">Submit</button>
                                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /Edit Modal End -->
                                                </td>
                                            </center>
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
@section('more_scripts')
    <script>
        $(window).on('load', function (){
            $('#addRecord').modal('show');
        });
    </script>
@endsection


