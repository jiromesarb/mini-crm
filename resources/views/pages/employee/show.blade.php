@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('employee.index') }}">Employee Management</a></li>
                    <li class="breadcrumb-item">{{ $employee->first_name . ' ' . $employee->last_name }}</li>
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
                            <h5 class="mb-0 card-title">{{ $employee->first_name . ' ' . $employee->last_name }}</h5>
                            <hr class="my-1" style="border-top: 3px solid #8c8b8b;" width="40px" align="left">
                            <div class="clearfix"></div><br>
                        </div>
                        <div class="col-md-6 col-5">
                            <div class="float-right">
                                <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-info text-light"><span class="fa fa-pencil"></span></a>
                                <a href="{{ route('employee.index') }}" class="btn btn-secondary"><span class="fa fa-list"></span></a>
                            </div>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-center">

                        <div class="col-md-6">
                            <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label>Employee Name</label><br>
                                    <label>{{ $employee->first_name . ' ' . $employee->last_name }}</label>
                                </div>

                                <div class="form-group">
                                    <label>Email</label><br>
                                    <label>{!! nullable($employee->email) !!}</label>
                                </div>

                                <div class="form-group">
                                    <label>Phone</label><br>
                                    <label>{!! nullable($employee->phone) !!}</label>
                                </div>

                                <div class="form-group">
                                    <label>Company</label><br>
                                    <label>{!! nullable($employee->company->name) !!}</label>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@stop
