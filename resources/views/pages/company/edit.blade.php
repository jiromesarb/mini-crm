@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('company.index') }}">Company Management</a></li>
                    <li class="breadcrumb-item">Edit</li>
                    <li class="breadcrumb-item">{{ $company->name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6 col-7">
                            <h5 class="mb-0 card-title">Edit {{ $company->name }}</h5>
                            <hr class="my-1" style="border-top: 3px solid #8c8b8b;" width="40px" align="left">
                            <div class="clearfix"></div><br>
                        </div>
                        <div class="col-md-6 col-5">
                            <div class="float-right">
                                <a href="{{ route('company.show', $company->id) }}" class="btn btn-info text-light"><span class="fa fa-eye"></span></a>
                                <a href="{{ route('company.index') }}" class="btn btn-secondary"><span class="fa fa-list"></span></a>
                            </div>
                        </div>
                    </div>

                    @include('includes.notif')
                    <div class="row d-flex justify-content-center">

                        <div class="col-md-6">
                            <form action="{{ route('company.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <div class="form-group">
                                    <label>Company Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ !empty(old('name')) ? old('name') : $company['name'] }}">
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control" value="{{ !empty(old('email')) ? old('email') : $company['email'] }}">
                                </div>

                                <div class="form-group">
                                    <label>Website</label>
                                    <input type="text" name="website" class="form-control" value="{{ !empty(old('website')) ? old('website') : $company['website'] }}">
                                </div>

                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control" value="{{ !empty(old('address')) ? old('address') : $company['address'] }}">
                                </div>

                                <div class="form-group">
                                    <label>Logo</label>
                                    <input type="file" name="logo" class="form-control-file">
                                </div>

                                <div class="form-form">
                                    <button class="text-light btn btn-md btn-success">Update</button>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@stop
