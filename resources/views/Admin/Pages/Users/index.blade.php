@extends('Admin.Layout.master')

@section('title')
    Users
@endsection

@section('breadcrumbs')
    Users
@endsection

@section('content')
    <div class="content">
        <a href="{{ route('admin.users.create') }}" class="btn btn-success">Create User</a>
        <div>
            @if (session('success'))
                <div class="alert alert-success p-3">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div>
            <table class="table my-2">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset($user->image) }}" class="rounded rounded-circle" alt="user"
                                    style="width: 100px; height:100px">
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <a href="{{route('admin.users.edit',$user->id)}}">Edit</a>
                                <form action="{{route('admin.users.destroy',$user->id)}}" method="POST"> 
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="delete" />
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex justify-content-center">
            <p>
                {{ $users->links() }}
            </p>
        </div>
    </div>
@endsection
