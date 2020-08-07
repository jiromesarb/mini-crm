@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('employee.index') }}">Employee Management</a></li>
                    <li class="breadcrumb-item">Edit</li>
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
                            <h5 class="mb-0 card-title">Edit {{ $employee->first_name . ' ' . $employee->last_name }}</h5>
                            <hr class="my-1" style="border-top: 3px solid #8c8b8b;" width="40px" align="left">
                            <div class="clearfix"></div><br>
                        </div>
                        <div class="col-md-6 col-5">
                            <div class="float-right">
                                <a href="{{ route('employee.show', $employee->id) }}" class="btn btn-info text-light"><span class="fa fa-eye"></span></a>
                                <a href="{{ route('employee.index') }}" class="btn btn-secondary"><span class="fa fa-list"></span></a>
                            </div>
                        </div>
                    </div>

                    @include('includes.notif')
                    <div class="row d-flex justify-content-center">

                        <div class="col-md-6">
                            <form action="{{ route('employee.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" name="first_name" class="form-control" value="{{ !empty(old('first_name')) ? old('first_name') : $employee['first_name'] }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" name="last_name" class="form-control" value="{{ !empty(old('last_name')) ? old('last_name') : $employee['last_name'] }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ !empty(old('email')) ? old('email') : $employee['email'] }}">
                                </div>

                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="phone" class="form-control" value="{{ !empty(old('phone')) ? old('phone') : $employee['phone'] }}">
                                </div>

                                <div class="form-group">
                                    <label>Company</label>
                                    <select name="company_id" id="" class="form-control select2-tag">
                                        @foreach($companies as $company)
                                            <option value="{{ $company['id'] }}"

                                            @if(!empty(old('company_id')))
                                                @if(old('company_id') == $company['id'])
                                                    selected
                                                @endif
                                            @else
                                                @if(!empty($employee->company))
                                                    @if($employee->company->id == $company['id'])
                                                        selected
                                                    @endif
                                                @endif
                                            @endif
                                            >{{ $company['name'] }}</option>
                                        @endforeach
                                    </select>
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
