@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('employee.index') }}">Employee Management</a></li>
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
                            <h5 class="mb-0 card-title">Employee Management</h5>
                            <hr class="my-1" style="border-top: 3px solid #8c8b8b;" width="40px" align="left">
                            <div class="clearfix"></div><br>
                        </div>
                        <div class="col-md-6 col-5">
                            <div class="float-right">
                                <a href="{{ route('employee.create') }}" class="btn btn-success">Add New Employee</a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            @include('includes.notif')
                            <table class="table">
                                <thead>
                                    <th>Employee</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Company</th>
                                    <th class="text-center" width="10%"></th>
                                </thead>
                                <tbody>
                                    @foreach($employees as $employee)
                                    <tr>
                                        <td>{{ $employee['first_name'] . ' ' . $employee['last_name'] }}</td>
                                        <td>{!! nullable($employee['email']) !!}</td>
                                        <td>{!! nullable($employee['phone']) !!}</td>
                                        <td>{!! nullable($employee['company']['name']) !!}</td>
                                        <td class="text-center">
                                            <form action="{{ route('employee.destroy', $employee['id']) }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <a href="{{ route('employee.show', $employee['id']) }}" class="btn btn-md btn-info text-light"><span class="fa fa-eye"></span></a>
                                                <button class="btn btn-md btn-danger"><span class="fa fa-trash"></span></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-6">
                                    Total <strong>{{ number_format($employees->total() , 0 , '.' , ',' ) }}</strong> result(s)
                                </div>
                                <div class="col-md-6">
                                    <div class="float-right">
                                        {{ $employees->appends(request()->input())->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
