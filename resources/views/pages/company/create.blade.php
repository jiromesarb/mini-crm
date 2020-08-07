@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('company.index') }}">Company Management</a></li>
                    <li class="breadcrumb-item">Create Company</li>
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
                            <h5 class="mb-0 card-title">Create Company</h5>
                            <hr class="my-1" style="border-top: 3px solid #8c8b8b;" width="40px" align="left">
                            <div class="clearfix"></div><br>
                        </div>
                        <div class="col-md-6 col-5">
                            <div class="float-right">
                                <a href="{{ route('company.index') }}" class="btn btn-secondary"><span class="fa fa-list"></span></a>
                            </div>
                        </div>
                    </div>

                    @include('includes.notif')
                    <div class="row d-flex justify-content-center">

                        <div class="col-md-6">
                            <form action="{{ route('company.store') }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label>Company Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                                </div>

                                <div class="form-group">
                                    <label>Website</label>
                                    <input type="text" name="website" class="form-control" value="{{ old('website') }}">
                                </div>

                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                                </div>

                                <div class="form-group">
                                    <label>Logo</label>
                                    <input type="file" name="logo" class="form-control-file">
                                </div>

                                <div class="form-form">
                                    <button class="text-light btn btn-md btn-success">Save</button>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@stop
