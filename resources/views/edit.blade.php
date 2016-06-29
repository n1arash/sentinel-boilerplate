@extends('layout')




@section('content')

    <div class="container" style="padding-top: 30px">
        <div class="row">
            <form action="/users/{{$user->id}}/edit" method="post" enctype="application/x-www-form-urlencoded">
                {{csrf_field()}}
                {{ method_field('PUT') }}
                <div class="col-md-12">
                    <div class="form-group">
                        <input class="form-control" name="first_name" placeholder="First Name" type="text" value="{{$user->first_name}}" required autofocus>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input class="form-control" name="text" placeholder="Last Name" type="text" value="{{$user->last_name}}" required>
                    </div>
                </div>

                <div class=" col-md-12 form-group">
                    <button type="submit" class="btn btn-block btn-danger"><i class="glyphicon glyphicon-user" style="margin-right: 4px;"></i>Update Info</button>
                </div>
            </form>
        </div>
    </div>


@endsection()

