@extends('layouts.main')
@section('title','Company Payment - Details')

@section('main-content')
    <div class="container-fluid">
        <div class="row container-fluid p-4">
            <div class="col-sm-8">
                <h1>{{$company->company_name}}</h1>
            </div>
            <div class="col-sm-4" style="text-align: right;">
                <a
                    href="{{route('company_payment.index')}}"
                    class="btn btn-outline-primary" >
                    List of Companies
                </a>
                <button class="btn btn-outline-success" data-toggle="modal"
                       data-target="#addRecord" style="width: auto">
                    Add Payment
                </button>
            </div>
                <div class="modal fade" id="addRecord">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content ">
                            <div class="modal-header">
                                <h2 class="modal-   title" id="exampleModalLabel">Add Payment</h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" name="myForm" id="myForm" action="{{route('company_payment.store')}}">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="control-label col-sm-2 required">Amount</label>
                                        <div class="col-sm-12">
                                            <input type="hidden" name="company_id"  value="{{$company->id}}">
                                            <input type="hidden" name="credit1" value="credit">
                                            <input type="text" class="form-control" placeholder="Amount" name="credit" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-2">Mode</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" placeholder="Mode" name="mode" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-2">Detail</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" placeholder="Detail" name="detail" value="">
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success" id="btn">Submit</button>
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
                        List of Purchases for {{$company->company_name}}
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
                            <table class="table table-striped" id="myTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Credit</th>
                                    <th>Debit</th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <!-- This is Table Body -->
                                <tbody>
                                    @foreach(\App\Models\Company_payment::all() as $payment)
                                        <tr>
                                            <td>
                                               {{$payment->id}}
                                            </td>
                                            <td>
                                                {{date('d-m-Y', strtotime($payment->created_at))}}
                                            </td>
                                            <td>
                                                {{$payment->credit}}
                                            </td>
                                            <td>
                                                {{$payment->debit}}
                                            </td>
                                            <td>
                                                {{$payment->amount}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
{{--                                <tfoot>--}}
{{--                                    <tr>--}}
{{--                                        <td colspan="3"></td>--}}
{{--                                        <td>--}}
{{--                                            <strong>Total Purchase Amount</strong>--}}
{{--                                         </td>--}}
{{--                                        <td>--}}
{{--                                            {{  \App\Models\Company_payment::sum('debit') }}--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td colspan="3"></td>--}}
{{--                                        <td>--}}
{{--                                            <strong>Total Paid Amount</strong>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            {{  \App\Models\Company_payment::sum('credit') }}--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td colspan="3"></td>--}}
{{--                                        <td>--}}
{{--                                            <strong>Remaining Amount</strong>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            {{ \App\Models\Company_payment::sum('debit') -  \App\Models\Company_payment::sum('credit') }}--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                </tfoot>--}}
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
{{--    <script>--}}
{{--        $(window).on('load', function (){--}}
{{--            $('#addRecord').modal('show');--}}
{{--        });--}}
{{--    </script>--}}
@endsection
