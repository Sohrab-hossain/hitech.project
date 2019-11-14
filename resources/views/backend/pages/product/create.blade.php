@extends('backend.layouts.master')
@section('title', 'Add Product')
@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Add Product</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.product.index')}}">Product</a></li>
                    <li class="breadcrumb-item active">Add Product</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Add Product Table</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data" class="passenger-validation" name="passenger-validation">
                        @csrf
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Product Name</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Price</label>
                                    <div class="col-lg-9">
                                        <input type="number" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Offer Price</label>
                                    <div class="col-lg-9">
                                        <input type="number" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Product Description</label>
                                    <div class="col-lg-9">
                                        <textarea class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>



                            <div class="col-xl-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Quantity</label>
                                    <div class="col-lg-9">
                                        <input type="number" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Category</label>
                                    <div class="col-lg-9">
                                        <select class="form-control @error('category_id') is-invalid @enderror">
                                            <option value="">Please Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Sub Category</label>
                                    <div class="col-lg-9">
                                        <select class="form-control @error('sub_category_id') is-invalid @enderror">
                                            <option value="">Please Select Sub Category</option>
                                            @foreach ($sub_categories as $sub_category)
                                                <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('sub_category_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Brand</label>
                                    <div class="col-lg-9">
                                        <select class="form-control @error('brand_id') is-invalid @enderror">
                                            <option value="">Please Select Brand</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Status</label>
                                    <div class="col-lg-9">
                                        <select class="select">
                                            <option>Select</option>
                                            <option value="0">Deactive</option>
                                            <option value="1">Active</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="card-title">
                            <div class="row">
                                <div class="col-xl-6"><h4 class="pull-left">Product Images:</h4></div>
                                <div class="col-xl-6"> <a class="btn btn-primary pull-right" id="addfilehtml">Add Image</a></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label class="label">Image/Video 1:</label>
                                        <div class="">
                                            <input type="file" class="form-control">
                                        </div>
                                    </div>
                                    <div id="addfile"></div>

                                </div>

                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection


<!-- Extra essential CSS & JS -->
@push('css')
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{asset('assets/backend/css/select2.min.css')}}">
    <!--For JS Form Validation error -->
    <style>
        .error{
            color: red;
        }
    </style>
    <!--End JS Form Validation error-->

@endpush


@push('scripts')
    <!-- Select2 JS -->
    <script src="{{asset('assets/backend/js/select2.min.js')}}"></script>
    <!--For JS Validation -->
    <script src="{{asset('assets/backend/plugins/validate_jquery/jquery.validate.js')}}"></script>
    <script type="text/javascript">
        function validateFn(){
            $(".passenger-validation").validate({
                rules: {
                    // simple rule, converted to {required:true}
                    name: {
                        required: true,
                        minlength: 2,
                        maxlength: 70
                    },
                    category_id: {
                        required: true
                    },
                    /*password: {
                        required: true,
                        minlength: 5
                    },
                    // compound rule
                    email: {
                        required: true,
                        email: true
                    }*/
                },
                messages: {
                    name: {
                        required: "Please enter a Category Name",
                        minlength: "Your username must consist of at least 2 characters",
                        maxlength: "Your Brand Name must consist under 70 characters"
                    },
                    category_id: {
                        required: "Please Select a Category Name"
                    },
                   /* password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    }*/

                }
            });

        }

    </script>
    <!--End JS Form Validation -->
    <script  type="text/javascript">
        $("#addfilehtml").click(function(){
            $("#addfile").after('<div class="col-lg-6 mb-3"><label class="label">Image/Video 1:</label><div class=""><input type="file" class="form-control"></div></div>');
        });
    </script>
@endpush
