@extends('MasterTemplate.mpp')

@section('header')
    ChangePassword
@endsection()

@section('content')

<div class="row">
    <div class="col-md-3"></div>

    <div class="col-md-12 col-lg-6">
        <div class="panel panel-default">
            <div class="panel-title">
            Change Password
           
            </div>
                <div class="panel-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                  
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                  
                        
                    <form class="form-horizontal" action="/changePassword" method="PUT">
                        {{@csrf_field()}}

                        <div class="form-group">
                            <label class="col-sm-4 control-label form-label">Old Password</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" name="current_password" required="required">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label form-label">New Password</label>
                            <div class="col-sm-8">
                            <input type="password" class="form-control" name="new_password" required="required">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label form-label">Confirm Password</label>
                            <div class="col-sm-8">
                            <input type="password" class="form-control" name="new_confirm_password" required="required">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                            <button type="submit" class="btn btn-default btn-block">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
        </div>
    </div>

<div class="col-md-3"></div>
</div>



@endsection