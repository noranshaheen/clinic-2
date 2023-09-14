@extends('User.Layout.master')

@section('title')
    Register
@endsection

@section('content')
    <div class="container">
        <h2 class="h1 fw-bold text-center my-4">Register</h2>
        <div class="d-flex flex-column gap-3 account-form mx-auto mt-5">
            <form method="POST" action="{{ route('user.storeUser') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-items">
                    <div class="mb-3">
                        <label class="form-label required-label" for="name">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name"
                            required>
                        @error('name')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label required-label" for="image">image</label>
                        <input type="file" name="image" value="{{ old('image') }}" class="form-control" id="image"
                            required>
                            @error('image')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
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
                        <input type="password" name="password" value="{{ old('password') }}" class="form-control"
                            id="password" required>
                            @error('password')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Create account</button>
            </form>
            <div class="d-flex justify-content-center gap-2">
                <span>already have an account?</span><a class="link" href="{{ route('user.login') }}"> login</a>
            </div>
        </div>
    </div>
@endsection
