@extends('layouts.main')
@section('title','Party')
@section('layoutSidenav-style','display:block !important;')
@section('main-content')
    <div class="container-fluid">
        <div class="row container-fluid p-4">
            <div class="col-sm-8" >
                <h1>Party</h1>
            </div>
            <div class="col-sm-4">
                <button class="btn btn-outline-success btn-lg custom" data-toggle="modal" data-target="#party">
                Add Party
                </button>
            </div>
                <div class="modal fade" id="party" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content ">
                            <div class="modal-header">
                                <h2 class="modal-title" id="exampleModalLabel">Add Party</h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" name="myForm"  action="{{route('party.store')}}">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="control-label col-sm-5 required">Party Name</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" placeholder="Party Name" name="party_name" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-5 required">Contact Person</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" placeholder="Contact Person" name="contact_person" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-5">Phone</label>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control" placeholder="Phone" name="phone" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-5">Address</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" placeholder="Address" name="address" value="">
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
            {{--Add Party Modal END--}}
        </div>
    </div>
        <div class="row container-fluid">
            <div class="col-sm-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Party Detail
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
                                    <th>Party Name</th>
                                    <th>Contact Person</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th width="5%">Edit</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Party Name</th>
                                    <th>Contact Person</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th width="5%">Edit</th>
                                </tr>
                                </tfoot>
                                <!-- This is Table Body -->
                                <tbody>
                                @foreach ($parties as $party)
                                    <tr>
                                        <td>{{ $party->id }}</td>
                                        <td>{{ $party->party_name }}</td>
                                        <td>{{ $party->contact_person }}</td>
                                        <td>{{ $party->address }}</td>
                                        <td>{{ $party->phone }}</td>
                                        <center><td>
                                                <!-- Edit Icon  -->
                                                <center><a href="/party/{{$party->id}}" class="edit" title="Edit" data-toggle="modal" data-target="#party{{$party->id}}"><i class="material-icons">&#xE254;</i></a></center>
                                                <!-- Edit Modal Start -->
                                                <div class="modal fade" id="party{{$party->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content ">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Company</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" name="myForm" action="{{route('party.update',$party->id)}}">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="form-group row">
                                                                        <label class="control-label col-sm-5 required">Party Name</label>
                                                                        <div class="col-sm-12">
                                                                            <input type="text" class="form-control" placeholder="Party Name" name="party_name" value="{{$party->party_name}}" required="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="control-label col-sm-5 required">Contact Person</label>
                                                                        <div class="col-sm-12">
                                                                            <input type="text" class="form-control" placeholder="Contact Person" name="contact_person" value="{{$party->contact_person}}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="control-label col-sm-5">Address</label>
                                                                        <div class="col-sm-12">
                                                                            <input type="text" class="form-control" placeholder="Address" name="address" value="{{$party->address}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="control-label col-sm-5">Phone</label>
                                                                        <div class="col-sm-12">
                                                                            <input type="number" class="form-control" placeholder="Phone" name="phone" value="{{$party->phone}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" name="edit" class="btn btn-success">Save changes</button>
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
            $('#party').modal('show');
        });
    </script>
@endsection

