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

        <form class="px-2" method="POST" action="{{ route('admin.doctors.update', $doctor->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" value="{{ $doctor->name }}" class="form-control" id="name">
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">Image</label>
                <input class="form-control" name="image" value="" type="file" id="file">
                <div>
                    <img src="{{ asset($doctor->image) }}" class="rounded rounded-circle" alt="user"
                        style="width: 100px; height:100px">
                </div>
            </div>
            <div class="form-group">
                <label>Select Major</label>
                <select name="major_id" class="form-control">
                    @foreach ($majors as $major)
                        <option value="{{ $major->id }}" 
                            @if ($doctor->major_id == $major->id) 
                                {{ 'selected' }}
                             @endif>
                            {{ $major->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
