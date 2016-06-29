@extends('layout')



@section('content')
    <div class="container">
        <div class="row">
            <form action="{{url('/users/login')}}" method="post" enctype="application/x-www-form-urlencoded">
                {{csrf_field()}}
                <div class="form-group">
                    <input class="form-control" name="email" placeholder="Email" type="text">
                </div>
                <div class="form-group">
                <input class="form-control" type="password" placeholder="Password" name="password">
                </div>
                <div class=" col-md-6 form-group">
                    <button type="submit" class="btn btn-block btn-primary"><i class="glyphicon glyphicon-user" style="margin-right: 4px;"></i>Login</button>
                </div>
                    <div class=" col-md-6 form-group">
                    <a href="{{url('/register')}}" class="btn btn-block btn-danger"><i class="glyphicon glyphicon-edit" style="margin-right: 4px;"></i>Register</a>
                </div>
            </form>
        </div>
    </div>




@endsection