@extends('backend.layouts.master')
@section('title', 'Add Category')
@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Add Category</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Category</a></li>
                    <li class="breadcrumb-item active">Add Category</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
    <div class="row">
        <div class="col-xl-8 offset-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Add Category</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Category Name</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="name" id="name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Category Description</label>
                                    <div class="col-lg-9">
                                        <textarea type="text" class="form-control" name="description" id="description"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Category Image</label>
                                    <div class="col-lg-9">
                                        <input type="file" class="form-control" name="image" id="image">
                                    </div>
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

@endpush


@push('scripts')
    <!-- Select2 JS -->
    <script src="{{asset('assets/backend/js/select2.min.js')}}"></script>
@endpush
