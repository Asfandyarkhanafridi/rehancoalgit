@extends('layouts.main')
@section('title','Stock')

@section('main-content')
    <div class="container-fluid" >
        <div class="row container-fluid p-4">
            <div class="col-sm-10">
                <h1>Stock</h1>
            </div>
        </div>
        <div class="row container-fluid">
            <div class="col-sm-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Stock Detail
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
                                    <th>Company</th>
                                    <th>Quality</th>
                                    <th>Stock</th>
                                   </tr>
                                </thead>
{{--                                <!-- This is Table Body -->--}}
                                <tbody>
                                @foreach($stocks as $stock)
                                    <tr>
                                        <td style="width: 7px">{{$loop->iteration}}</td>
                                        <td>{{$stock->company_name}}</td>
                                        <td>{{$stock->quality}}</td>
                                        <td>
                                            @if($stock->stock < 0 )
                                                Stock is empty
                                            @else
                                                {{$stock->stock}} Tons
                                            @endif

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


