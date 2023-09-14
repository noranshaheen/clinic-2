@extends('User.Layout.master')

@section('title')
    Login
@endsection

@section('content')
    <div class="container">
        <h2 class="h1 fw-bold text-center my-4">Login</h2>
        <div class="d-flex flex-column gap-3 account-form  mx-auto mt-5">
            <form method="POST" action="{{ route('user.login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label required-label" for="email">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email"
                        required>
                    @error('email')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label required-label" for="password">password</label>
                    <input type="password" name="password" value="{{ old('passwors') }}" class="form-control" id="password"
                        required>
                    @error('password')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
            <div class="d-flex justify-content-center gap-2 flex-column flex-lg-row flex-md-row flex-sm-column">
                <span>don't have an account?</span><a class="link" href="{{ route('user.register') }}">create account</a>
            </div>
        </div>
    </div>
@endsection
