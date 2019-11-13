@extends('backend.layouts.master')
@section('title', 'Edit Sub Category')
@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Edit Sub Category</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.sub_category.index')}}">Sub Category</a></li>
                    <li class="breadcrumb-item active">Edit Sub Category</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
    <div class="row">
        <div class="col-xl-8 offset-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Edit Category</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.sub_category.update', $sub_category->id) }}" method="post" enctype="multipart/form-data" class="passenger-validation" name="passenger-validation">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Sub Category Name</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $sub_category->name }}" required>
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Category Name</label>
                                    <div class="col-lg-9">
                                        <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                                            <option value="">Please select a Parent category.</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"@if(($category->id)==($sub_category->category_id))selected @endif>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Sub Category Description</label>
                                    <div class="col-lg-9">
                                        <textarea type="text" class="form-control" name="description" id="description">{{ $sub_category->description }}</textarea>

                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Sub Category Image</label>
                                    <div class="col-lg-9">
                                        <input type="file" class="form-control" name="image" id="image">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary" onClick="validateFn();">Submit</button>
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
                }
            });

        }

    </script>
    <!--End JS Form Validation -->
@endpush
