@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('company.index') }}">Company Management</a></li>
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
                            <h5 class="mb-0 card-title">{{ $company->name }}</h5>
                            <hr class="my-1" style="border-top: 3px solid #8c8b8b;" width="40px" align="left">
                            <div class="clearfix"></div><br>
                        </div>
                        <div class="col-md-6 col-5">
                            <div class="float-right">
                                <a href="{{ route('company.edit', $company->id) }}" class="btn btn-info text-light"><span class="fa fa-pencil"></span></a>
                                <a href="{{ route('company.index') }}" class="btn btn-secondary"><span class="fa fa-list"></span></a>
                            </div>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-center">

                        <div class="col-md-6">
                            <form action="{{ route('company.store') }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label>Company Name</label><br>
                                    <label>{{ $company->name }}</label>
                                </div>

                                <div class="form-group">
                                    <label>Email</label><br>
                                    <label>{!! nullable($company->email) !!}</label>
                                </div>

                                <div class="form-group">
                                    <label>Website</label><br>
                                    <label>{!! nullable($company->website) !!}</label>
                                </div>

                                <div class="form-group">
                                    <label>Address</label><br>
                                    <label>{!! nullable($company->address) !!}</label>
                                </div>

                                <div class="form-group">
                                    <label>Logo</label><br>
                                    <img src="{{ asset('storage/' . $company->logo) }}" width="300">
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@stop
