@extends('layouts.main')
@section('title','Sale')

@section('main-content')
    <div class="container-fluid" >
        <div class="row container-fluid p-4">
            <div class="col-sm-10">
                <h1>Sale</h1>
            </div>
            <div class="col-sm-2">
                <button
                    class="btn btn-outline-success btn-lg custom"
                    data-toggle="modal"
                    data-target="#addRecord"
                >
                    Sale
                </button>
                <div id="addRecord" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog " role="document">
                        <div class="modal-content ">
                            <div class="modal-header">
                                <h2 class="modal-title" id="exampleModalLabel">Sale</h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" name="myForm" action="{{route('sale.store')}}">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="control-label col-sm-5 required">Date</label>
                                        <div class="col-sm-12">
                                            <input type="text" onfocus= "(this. type='date')" class="form-control" placeholder="Today's Date" name="date" value="<?php echo date('Y-m-d');?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-5 required">Party</label>
                                        <div class="col-sm-12">
                                            <select  class="form-select" name="party_id" id="select1" style="width: 100%;">
                                                <option  selected>Select Party</option>
                                                @foreach($parties as $p)
                                                    <option  value="{{$p->id}}">{{$p->party_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-5 required">Company</label>
                                        <div class="col-sm-12">
                                            <select class="form-select" name="company_id" id="select2" style="width: 100%">
                                                <option selected>Select Company</option>
                                                @foreach($companies as $c)
                                                    <option value="{{$c->id}}">{{$c->company_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-5 required">Quality</label>
                                        <div class="col-sm-12">
                                            <select class="form-select" name="quality_id" id="select3" style="width: 100%">
                                                <option selected>Select Quality</option>
                                                @foreach($qualities as $q)
                                                    <option value="{{$q->id}}">{{$q->quality}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-5">Truck</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" placeholder="Truck" name="truck" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-5 required">Weight</label>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control" placeholder="Weight" name="weight" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-5 required">Rate</label>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control" placeholder="Rate" name="rate" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-5">Detail</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" placeholder="Detail" name="detail">
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
                        Sale Detail
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
                                    <th>Automated Date</th>
                                    <th>Entry Date</th>
                                    <th>Party</th>
                                    <th>Company</th>
                                    <th>Quality</th>
                                    <th>Truck</th>
                                    <th>Weight</th>
                                    <th>Rate</th>
                                    <th>Detail</th>
                                    <th>Amount</th>
                                    <th width="7%">Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Automated Date</th>
                                    <th>Entry Date</th>
                                    <th>Party</th>
                                    <th>Company</th>
                                    <th>Quality</th>
                                    <th>Truck</th>
                                    <th>Weight</th>
                                    <th>Rate</th>
                                    <th>Detail</th>
                                    <th>Amount</th>
                                    <th width="7%">Action</th>
                                </tr>
                                </tfoot>
                                <!-- This is Table Body -->
                                <tbody>
                                @foreach($sales as $sale)
                                <tr>
                                    <td>{{$sale->id ?? ''}}</td>
                                    <td>{{$sale->created_at}}</td>
                                    <td>{{date('d-m-Y', strtotime($sale->date))}}</td>
                                    <td>{{$sale->party->party_name}}</td>
                                    <td>{{$sale->company->company_name}}</td>
                                    <td>{{$sale->quality->quality}}</td>
                                    <td>{{$sale->truck}}</td>
                                    <td>{{$sale->weight}}</td>
                                    <td>{{$sale->rate}}</td>
                                    <td>{{$sale->detail}}</td>
                                    <td>{{$sale->amount}}</td>
                                    <center><td>
                                            <!-- Edit Icon  -->
                                            <center><a href="/sale/{{$sale->id}}" class="edit" title="Edit" data-toggle="modal" data-target="#sale{{$sale->id}}"><i class="material-icons">edit</i></a>
                                                <a href="{{route('sale.destroy',$sale->id)}}" class="delete" title="Delete"><i class="material-icons">delete</i></a>
                                            </center>
                                            <!-- Edit Modal Start -->
                                            <div class="modal fade" id="sale{{$sale->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content ">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Sale</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" name="myForm" action="{{route('sale.update', $sale->id)}}">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group row">
                                                                    <label class="control-label col-sm-5 required">Date</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" onfocus= "(this. type='date')" name="date" value="{{$sale->date}}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="control-label col-sm-5 required">Party</label>
                                                                    <div class="col-sm-12">
                                                                        <select class="form-select" aria-label="Default select example" name="party_id" >
                                                                            <option selected>Select Party</option>
                                                                            @foreach($parties as $p)
                                                                                <option value="{{$p->id}}">{{$p->party_name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="control-label col-sm-5 required">Company</label>
                                                                    <div class="col-sm-12">
                                                                        <select class="form-select" aria-label="Default select example" name="company_id" >
                                                                            <option selected>Select Company</option>
                                                                            @foreach($companies as $c)
                                                                                <option value="{{$c->id}}">{{$c->company_name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="control-label col-sm-5 required">Quality</label>
                                                                    <div class="col-sm-12">
                                                                        <select class="form-select" aria-label="Default select example" name="quality_id" >
                                                                            <option selected>Select Quality</option>
                                                                            @foreach($qualities as $q)
                                                                                <option value="{{$q->id}}">{{$q->quality}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="control-label col-sm-5 required">Truck</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" placeholder="Truck" name="truck" value="{{$sale->truck}}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="control-label col-sm-5 required">Weight</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="number" class="form-control" placeholder="Weight" name="weight" value="{{$sale->weight}}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="control-label col-sm-5 required">Rate</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="number" class="form-control" placeholder="Rate" name="rate" value="{{$sale->rate}}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="control-label col-sm-5">Detail</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" placeholder="Detail" name="detail" value="{{$sale->detail}}">
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
                                        </td></center>
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

