@extends('Admin.Layout.master')

@section('title')
    Majors
@endsection

@section('breadcrumbs')
    Majors
@endsection

@section('content')
    <div class="content">
        <a href="{{ route('admin.majors.create') }}" class="btn btn-success">Create Major</a>
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
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($majors as $major)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset($major->image) }}" class="rounded rounded-circle" alt="major"
                                    style="width: 100px; height:100px">
                            </td>
                            <td>{{ $major->name }}</td>
                            <td>
                                <a href="{{route('admin.majors.edit',$major->id)}}">Edit</a>
                                <form action="{{route('admin.majors.destroy',$major->id)}}" method="POST"> 
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
                {{ $majors->links() }}
            </p>
        </div>
    </div>
@endsection
