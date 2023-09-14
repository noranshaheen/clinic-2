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

        @if (session('error'))
            <div>
                <div class="alert alert-danger p-3">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <form class="px-2" method="POST" action="{{ route('admin.users.update', $user->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="email">
            </div>
            <div class="mb-3">
                <label for="old-password" class="form-label">old Password</label>
                <input type="password" name="old_password" value="" class="form-control" id="old-password">
            </div>
            <div class="mb-3">
                <label for="new-password" class="form-label">New Password</label>
                <input type="password" name="new_password" value="" class="form-control" id="new-password">
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">Image</label>
                <input class="form-control" name="image" value="" type="file" id="file">
                <div>
                    <img src="{{ asset($user->image) }}" class="rounded rounded-circle" alt="user"
                        style="width: 100px; height:100px">
                </div>
            </div>
            <div class="form-group">
                <label>Select Role</label>
                <select name="role" class="form-control">

                    <option value="admin" @if ($user->role == 'admin') {{ 'selected' }} @endif>Admin</option>
                    <option value="user" @if ($user->role == 'user') {{ 'selected' }} @endif>User</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
