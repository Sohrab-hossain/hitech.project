@extends('backend.layouts.master')
@section('title', 'Add Brand')
@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Add Brand</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.brand.index')}}">Brand</a></li>
                    <li class="breadcrumb-item active">Add Brand</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
    <div class="row">
        <div class="col-xl-8 offset-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Add Brand</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.brand.store') }}" method="post" enctype="multipart/form-data" class="passenger-validation" name="passenger-validation">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Brand Name</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{old('name')}}" required>
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Brand Description</label>
                                    <div class="col-lg-9">
                                        <textarea type="text" class="form-control" name="description" id="description">{{old('description')}}</textarea>

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
                },
                messages: {
                    name: {
                        required: "Please enter a Brand Name",
                        minlength: "Your Brand Name must consist of at least 2 characters",
                        maxlength: "Your Brand Name must consist under 70 characters"
                    },

                }
            });

        }

    </script>
    <!--End JS Form Validation -->
@endpush
