@extends('Admin.Layout.master')

@section('title')
    Doctors
@endsection

@section('breadcrumbs')
    Doctors
@endsection

@section('content')
    <div class="content">
        <a href="{{ route('admin.doctors.create') }}" class="btn btn-success">Create Doctor</a>
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
                        <th scope="col">Major</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($doctors as $doctor)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset($doctor->image) }}" class="rounded rounded-circle" alt="user"
                                    style="width: 100px; height:100px">
                            </td>
                            <td>{{ $doctor->name }}</td>
                            <td>{{ $doctor->major->name }}</td>
                            <td>
                                <a href="{{route('admin.doctors.edit',$doctor->id)}}">Edit</a>
                                <form action="{{route('admin.doctors.destroy',$doctor->id)}}" method="POST"> 
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
                {{ $doctors->links() }}
            </p>
        </div>
    </div>
@endsection
