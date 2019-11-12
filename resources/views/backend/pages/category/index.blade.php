@extends('backend.layouts.master')
@section('title', 'Category')
@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Category</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active">Category Tables</li>
                </ul>
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
                    <h4 class="card-title mb-0 pull-left">All Category Datatable</h4>

                    <div class="btn-group pull-right">
                        <div class="mr-1">
                            <a href="{{route('admin.category.create')}}" class="btn btn-primary">Add New Category</a>
                        </div>

                        <button type="button" class="btn btn-primary dropdown-toggle ml-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Report</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Print</a>
                            <a class="dropdown-item" href="#">PDF</a>
                            <a class="dropdown-item" href="#">Excel</a>
                            <a class="dropdown-item" href="#">CSV</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        {{--<table class="datatable table table-stripped mb-0">--}}
                        <table class="table table-stripped">
                            <thead>
                            <tr>
                                <th>SI</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($categories as $key=>$category)
                            <tr>
                                <td>{{$key + 1}}</td>
                                {{--<td>{{$category->id}}</td>--}}
                                <td>{{$category->name}}</td>
                                <td>{{$category->description}}</td>
                                <td>
                                    @if ($category->image)
                                        <img src="{{ asset('storage/'.$category->image) }}" alt="img" style="width: 50px; height: 50px">
                                    @else
                                        <img src="{{ asset('#') }}" style="width: 50px; height: 50px" >
                                    @endif

                                    {{--@if ($category->image)
                                       <img src="{{ asset('assets/backend/uploads/categories/'.$category->image) }}" alt="img" style="width: 50px; height: 50px">
                                    @else
                                       <img src="{{ asset('dist/img/default-150x150.png') }}" style="width: 50px; height: 50px" >
                                    @endif--}}




                                </td>
                                <td>
                                    {{--<a class="btn btn-primary" href="{{route('admin.category.edit',$category->id)}}" aria-label="Edit" title="Edit">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>--}}
                                    {{--<a class="btn btn-danger" href="{{ route('admin.category.delete',$category->id) }}" aria-label="Delete"
                                       title="Delete"
                                       onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </a>--}}

                                    <form id="delete-form" action="{{ route('admin.category.delete',$category->id) }}" method="POST" onsubmit="return checkDelete(); ">
                                        <a class="btn btn-primary" href="{{route('admin.category.edit',$category->id)}}" aria-label="Edit" title="Edit">
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
                            {{ $categories -> links() }}
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
