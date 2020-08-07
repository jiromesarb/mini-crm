@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('company.index') }}">Company Management</a></li>
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
                            <h5 class="mb-0 card-title">Company Management</h5>
                            <hr class="my-1" style="border-top: 3px solid #8c8b8b;" width="40px" align="left">
                            <div class="clearfix"></div><br>
                        </div>
                        <div class="col-md-6 col-5">
                            <div class="float-right">
                                <a href="{{ route('company.create') }}" class="btn btn-success">Create New Company</a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            @include('includes.notif')
                            <table class="table">
                                <thead>
                                    <th>Company</th>
                                    <th>Address</th>
                                    <th>Website</th>
                                    <th>Email</th>
                                    <th class="text-center" width="10%"></th>
                                </thead>
                                <tbody>
                                    @foreach($companies as $company)
                                    <tr>
                                        <td>{{ $company['name'] }}</td>
                                        <td>{!! nullable($company['address']) !!}</td>
                                        <td>{!! nullable($company['website']) !!}</td>
                                        <td>{!! nullable($company['email']) !!}</td>
                                        <td class="text-center">
                                            <form action="{{ route('company.destroy', $company['id']) }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <a href="{{ route('company.show', $company['id']) }}" class="btn btn-md btn-info text-light"><span class="fa fa-eye"></span></a>
                                                <button class="btn btn-md btn-danger"><span class="fa fa-trash"></span></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-6">
                                    Total <strong>{{ number_format($companies->total() , 0 , '.' , ',' ) }}</strong> result(s)
                                </div>
                                <div class="col-md-6">
                                    <div class="float-right">
                                        {{ $companies->appends(request()->input())->links() }}
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
