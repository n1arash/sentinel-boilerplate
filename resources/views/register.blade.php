@extends('layout')

<link rel="stylesheet" href="/css/signin.css">

@section('content')
<div class="container" style="padding-top: 20px;">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <form role="form" method="post" action="{{url('/users/register')}}" enctype="application/x-www-form-urlencoded">
               {{csrf_field()}}
                <fieldset>
                    <h2>Register!</h2>
                    <hr class="colorgraph">
                    <div class="form-group">
                        <input type="text" name="first_name" class="form-control input-lg" placeholder="First Name">
                    </div>
                    <div class="form-group">
                        <input type="text" name="last_name" class="form-control input-lg" placeholder="Last Name">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password">
                    </div>
                    <div class="row">
                        <br>
                        <hr class="colorgraph">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                            <button class="btn btn-lg btn-success btn-block"><i class="glyphicon glyphicon-user" style="margin-right: 5px"></i>Register</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
@endsection