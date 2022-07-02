@extends('layouts.main')
@section('title','Company')

@section('main-content')
    <div class="container-fluid" >
        <div class="row container-fluid p-4">
            <div class="mr-auto">
                <h1>Company</h1>
            </div>
            <div style="position: absolute; right: 0px">
                <button
                    class="btn btn-outline-success btn-lg"
                    data-toggle="modal"
                    data-target="#addRecord"
                >
                Add Company
                </button>
                {{--Add Company Modal--}}
                <div class="modal fade" id="addRecord">
                    <div class="modal-dialog">
                        <div class="modal-content ">
                            <div class="modal-header">
                                <h2 class="modal-title" id="exampleModalLabel">Add Company</h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick = "$('.modal').hide()">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" name="myForm" id="myForm" action="{{route('company.store')}}">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="control-label col-sm-5 required">Company Name</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" placeholder="Company Name" name="company_name" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-5 required">Contact Person</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" placeholder="Contact Person" name="contact_person" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-5">Address</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" placeholder="address" name="address" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                            <label class="control-label col-sm-5">Phone</label>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control" placeholder="Phone" name="phone" value="">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success" id="addRecord">Submit</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{--Add Company Modal END--}}
            </div>
        </div>
        <div class="row container-fluid">
            <div class="col-sm-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Company Details
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
                                    <th>Company Name</th>
                                    <th>Contact Person</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th width="5%">Edit</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Company Name</th>
                                    <th>Contact Person</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th width=5%">Edit</th>
                                </tr>
                                </tfoot>
                                <!-- This is Table Body -->
                                <tbody>
                                @foreach ($companies as $company)
                                <tr>
                                    <td>{{ $company->id }}</td>
                                    <td>{{ $company->company_name }}</td>
                                    <td>{{ $company->contact_person }}</td>
                                    <td>{{ $company->address }}</td>
                                    <td>{{ $company->phone }}</td>
                                    <center><td>

                                        <!-- Edit Icon  -->
                                            <center><a href="/company/{{$company->id}}" class="edit" title="Edit" data-toggle="modal" data-target="#company{{$company->id}}"><i class="material-icons">&#xE254;</i></a></center>
                                            <!-- Edit Modal Start -->
                                            <div class="modal fade" id="company{{$company->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content ">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Company</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" name="myForm" action="{{route('company.update',$company->id)}}">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group row">
                                                                    <label class="control-label col-sm-5 required">Company Name</label>
                                                                    <div class="col-sm-12">

                                                                        <input type="text" class="form-control" placeholder="Company Name" name="company_name" value="{{$company->company_name}}" required="">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="control-label col-sm-5 required">Contact Person</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" placeholder="Contact Person" name="contact_person" value="{{$company->contact_person}}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="control-label col-sm-5">Address</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" placeholder="Address" name="address" value="{{$company->address}}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="control-label col-sm-5">Phone</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="number" class="form-control" placeholder="Phone" name="phone" value="{{$company->phone}}">
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
                            </table>
                        </div>
                        {{--Table DIV END--}}
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
