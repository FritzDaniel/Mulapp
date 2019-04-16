@extends('template.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Header Card</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        Hi
                    </div>

                    <div class="card-footer">Footer Card</div>
                </div>
            </div>
        </div>
    </div>
@endsection