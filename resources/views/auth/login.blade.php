@extends('_layout.main')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <form method="POST" action="/auth/login">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="username">Email</label>
                    <input type="text" class="form-control" id="username" name="email" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="passwd">Password</label>
                    <input type="password" class="form-control" id="passwd" name="password">
                </div>
                <div>
                    <label>
                        <input type="checkbox" name="remember"> Remember Me
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-key"></i> Login
                </button>
            </form>
        </div>
    </div>
@stop