@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Detail User
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="text-right">
                            <a href="#" class="btn btn-sm btn-info"><i class="fa fa-edit"> Edit</i></a>
                            <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"> Delete</i></a>
                        </div>
                        
                        <div class="text-center">
                            <img src="" alt="">
                        </div>

                        {{ $data }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
