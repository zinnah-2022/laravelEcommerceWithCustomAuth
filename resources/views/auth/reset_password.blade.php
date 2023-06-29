@extends('layout.app')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="../../index2.html" class="h3"><b>Admin</b>LTE</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">We will Sent link to your Email! use that link to reset Password</p>
            <div class="container">
                @if(session()->has('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                @endif
                @if(session()->has('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                @endif
            </div>

            <form action="{{route('resetPasswordPost')}}" method="post">
                @csrf
                    <input type="text" name="token" hidden value="{{$token}}" class="form-control">
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="New password">
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Reppeted passoword">
                </div>
                <div class="row">
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <!-- /.social-auth-links -->
        </div>
        <!-- /.card-body -->
    </div>
@endsection
