@extends('admin.layouts.app')

@section('title')
    Mul-App | Statistic
@endsection

@section('css')

@endsection

@section('headerTitle')
    Statistic
    <small>Admin</small>
@endsection

@section('content')

    <div class="row">

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ $userData->count() - 1 }}</h3>

                    <p>User Registrations</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('admin.users') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

    </div>

@endsection

@section('js')

@endsection