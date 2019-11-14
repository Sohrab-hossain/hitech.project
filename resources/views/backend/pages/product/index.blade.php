@extends('backend.layouts.master')
@section('title', 'Product')
@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Product</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Product Tables</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="{{route('admin.product.create')}}" class="btn add-btn"><i class="fa fa-plus"></i> Create product</a>
            </div>
            <div>
                <button type="button" class="btn add-btn dropdown-toggle mr-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Report</button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Print</a>
                    <a class="dropdown-item" href="#">PDF</a>
                    <a class="dropdown-item" href="#">Excel</a>
                    <a class="dropdown-item" href="#">CSV</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
    <!--Alert Message -->
    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show">
            {{session('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    <div class="row">
        <div class="col-sm-12">
            <div class="card mb-0">
                <div class="card-header">
                    <h4 class="card-title mb-0 pull-left">All Product Datatable</h4>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        {{--<table class="datatable table table-stripped mb-0">--}}
                        <table class="table table-stripped">
                            <thead>
                            <tr>
                                <th>SI</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Offer Price</th>
                                <th>Quantity</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($products as $key=>$product)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$product->product_name}}</td>
                                    <td>{{$product->product_price}}</td>
                                    <td>{{$product->offer_price}}</td>
                                    <td>{{$product->product_quantity}}</td>
                                    <td>Image Here</td>
                                    {{--<td>
                                        @if ($product->image)
                                            <img src="{{ asset('storage/'.$product->image) }}" alt="img" style="width: 50px; height: 50px">
                                        @else
                                            <img src="{{ asset('#') }}" style="width: 50px; height: 50px" >
                                        @endif

                                    </td>--}}
                                    <td>{{($product->status)==0 ? 'Deactive':'Active'}}</td>
                                    <td>
                                        <form id="delete-form" action="{{ route('admin.product.delete',$product->id) }}" method="POST" onsubmit="return checkDelete(); ">
                                            <a class="btn btn-primary" href="{{route('admin.product.show',$product->id)}}" aria-label="Show" title="Show">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                            <a class="btn btn-primary" href="{{route('admin.product.edit',$product->id)}}" aria-label="Edit" title="Edit">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>

                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"> <i class="fa fa-trash-o" aria-hidden="true"></i></button>

                                        </form>

                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pull-right">
                            {{ $products -> links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


<!-- Extra essential CSS & JS -->
@push('css')
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{asset('assets/backend/css/dataTables.bootstrap4.min.css')}}">

@endpush


@push('scripts')
    <!-- Datatable JS -->
    <script src="{{asset('assets/backend/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/dataTables.bootstrap4.min.js')}}"></script>
    <!--JS Delete Alert Message -->
    <script type="text/javascript">
        function checkDelete(){
            chk = confirm(" Are you sure to delete this ?");

            if(chk)
            {
                finalCheck = confirm("This data deleted permanently. So are you sure to delete this ?");
                if(finalCheck)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
            }

        }
    </script>
@endpush
