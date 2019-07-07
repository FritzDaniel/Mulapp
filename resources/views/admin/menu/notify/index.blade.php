@extends('admin.layouts.app')

@section('title')
    Mul-App | Notify User
@endsection

@section('css')

    <link rel="stylesheet" href="{{ asset('assets/adminLTE/bower_components/select2/dist/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/adminLTE//plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

    <style>
        .select2-container--default .select2-selection--single, .select2-selection .select2-selection--single {
            border: 1px solid #d2d6de;
            border-radius: 0;
            padding: 6px 4px;
            height: 34px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #3c8dbc;
            border-color: #367fa9;
            padding: 1px 10px;
            color: #fff;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: white;
            cursor: pointer;
            display: inline-block;
            font-weight: bold;
            margin-right: 10px;
        }

        .select2-container--default .select2-selection--multiple {
            background-color: white;
            border: 1px solid #aaa;
            border-radius: 4px;
            cursor: text;
            padding-left: 8px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 33px !important;
        }
    </style>

@endsection

@section('headerTitle')
    Notification
    <small>Admin</small>
@endsection

@section('content')

    @if (session('status'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Success!</h4>
            {{ session('status') }}
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> There were some problems with your input!</h4>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Quick Send Notification</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">

                    <div class="form-group">
                        <label>Send to</label>
                        <select class="form-control" id="sendForm">
                            <option value="1" selected>All user</option>
                            <option value="2">Single User</option>
                            <option value="3">Multiple User</option>
                        </select>
                    </div>

                    @include('admin.menu.notify.partials.form1')

                    @include('admin.menu.notify.partials.form2')

                    @include('admin.menu.notify.partials.form3')

                </div>
                <div class="box-footer">
                    @include('admin.menu.notify.partials.btnForm')
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Notification List</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                @if($dataNotify->isEmpty())

                    <div class="box-body">
                        Empty Data!
                    </div>

                @else
                <div class="box-body table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Send to</th>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dataNotify as $key => $notify)
                            <tr>
                                <td>{{ $key+1 }}.</td>
                                <td>{{ isset($notify) ? $notify->type : '' }}</td>
                                <td>{{ isset($notify) ? $notify->title : '' }}</td>
                                <td>{{ isset($notify) ? \Carbon\Carbon::parse($notify->created_at)->format('d-M-Y') : '' }}</td>
                                <td>
                                    <a href="{{ route('admin.notify.detail',$notify->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    @if(!empty($keyword))

                    @else
                        <div class="text-center">
                            {{ $dataNotify->links() }}
                        </div>
                    @endif
                </div>
                @endif
                <!-- /.box-body -->
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script src="{{ asset('assets/adminLTE/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

    <script src="{{ asset('assets/adminLTE//plugins/bootstrap-wysihtml5/html5editor-fixed.js') }}"></script>

    <script>
        $(function () {
            $('#body_form1').wysihtml5();
            $('#body_form2').wysihtml5();
            $('#body_form3').wysihtml5();
        })
    </script>

    <script>
        $(document).ready(function() {
            $('#form2_selectUser').select2();
            $('#form3_selectUser').select2({
                placeholder: "Select multiple user",
                allowClear: true
            });
        });
    </script>

    <script>
        $('#sendForm').on('change',function () {
            var value = this.value;

            if (value == 1)
            {
                $('#form_1').show();
                $('#btn_1').show();

                $('#form_2').hide();
                $('#btn_2').hide();

                $('#form_3').hide();
                $('#btn_3').hide();
            }
            else if(value == 2)
            {
                $('#form_1').hide();
                $('#btn_1').hide();

                $('#form_2').show();
                $('#btn_2').show();

                $('#form_3').hide();
                $('#btn_3').hide();
            }
            else
            {
                $('#form_1').hide();
                $('#btn_1').hide();

                $('#form_2').hide();
                $('#btn_2').hide();

                $('#form_3').show();
                $('#btn_3').show();
            }
        });
    </script>

    <script>

        $('#btn_1').on('click',function () {
            sessionStorage.setItem('selected','form_1');
            $('#form_1').submit();
        });
        $('#btn_2').on('click',function () {
            sessionStorage.setItem('selected','form_2');
            $('#form_2').submit();
        });
        $('#btn_3').on('click',function () {
            sessionStorage.setItem('selected','form_3');
            $('#form_3').submit();
        });

        if (sessionStorage.getItem('selected') == "form_1")
        {
            $("#sendForm").val("1");
            $('#form_1').show();
            $('#form_2').hide();
            $('#form_3').hide();
            $('#btn_1').show();
            $('#btn_2').hide();
            $('#btn_3').hide();
        }
        else if(sessionStorage.getItem('selected') == "form_2")
        {
            $("#sendForm").val("2");
            $('#form_1').hide();
            $('#form_2').show();
            $('#form_3').hide();
            $('#btn_1').hide();
            $('#btn_2').show();
            $('#btn_3').hide();
        }
        else if(sessionStorage.getItem('selected') == "form_3")
        {
            $("#sendForm").val("3");
            $('#form_1').hide();
            $('#form_2').hide();
            $('#form_3').show();
            $('#btn_1').hide();
            $('#btn_2').hide();
            $('#btn_3').show();
        }
    </script>

@endsection