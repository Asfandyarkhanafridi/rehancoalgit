@extends('layouts.main')
@section('title','Quality')

@section('main-content')
    <div class="container-fluid" >
        <div class="row container-fluid p-4">
            <div class="col-sm-8">
                <h1>Quality</h1>
            </div>
            <div class="col-sm-4">
                <button
                    class="btn btn-outline-success btn-lg custom"
                    data-toggle="modal"
                    data-target="#addRecord"
                >
                    Add Quality
                </button>
                <div class="modal fade" id="addRecord" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content ">
                            <div class="modal-header">
                                <h2 class="modal-title" id="exampleModalLabel">Add Quality</h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" name="myForm" action="{{route('quality.store')}}">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="control-label col-sm-5 required">Quality</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" placeholder="Quality" name="quality" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-5">Description</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" placeholder="Description" name="description" value="">
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
                        Quality Detail
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
                                    <th>Quality Name</th>
                                    <th>Description</th>
                                    <th width="5%">Edit</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Quality Name</th>
                                    <th>Description</th>
                                    <th width="5%">Edit</th>
                                </tr>
                                </tfoot>
                                <!-- This is Table Body -->
                                <tbody>
                                @foreach ($qualities as $quality)
                                    <tr>
                                        <td>{{ $quality->id }}</td>
                                        <td>{{ $quality->quality }}</td>
                                        <td>{{ $quality->description }}</td>
                                        <center><td>
                                                <!-- Edit Icon  -->
                                                <center><a href="/quality/{{$quality->id}}" class="edit" title="Edit" data-toggle="modal" data-target="#quality{{$quality->id}}"><i class="material-icons">&#xE254;</i></a></center>
                                                <!-- Edit Modal Start -->
                                                <div class="modal fade" id="quality{{$quality->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content ">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Company</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" name="myForm" action="{{route('quality.update',$quality->id)}}">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="form-group row">
                                                                        <label class="control-label col-sm-5 required">Quality</label>
                                                                        <div class="col-sm-12">
                                                                            <input type="text" class="form-control" placeholder="Quality" name="quality" value="{{$quality->quality}}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="control-label col-sm-5">Discription</label>
                                                                        <div class="col-sm-12">
                                                                            <input type="text" class="form-control" placeholder="Description" name="description" value="{{$quality->description}}">
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
            $('#addRecord').modal('show');
        });
    </script>
@endsection

