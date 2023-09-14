@extends('Admin.Layout.master')

@section('title')
    Users
@endsection

@section('breadcrumbs')
    Users
@endsection

@section('content')
    <div class="content">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="px-2"
        method="POST" action="{{ route('admin.users.store') }}"
        enctype="multipart/form-data"
        >
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email"  value="{{old('email')}}" class="form-control" id="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" value="{{old('password')}}" class="form-control" id="password">
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">Image</label>
                <input class="form-control" name="image"  value="{{old('image')}}" type="file" id="file">
            </div>

            <div class="form-group">
                <label>Select Role</label>
                <select name="role" class="form-control">

                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
