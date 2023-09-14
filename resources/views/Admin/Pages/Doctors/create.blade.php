@extends('Admin.Layout.master')

@section('title')
    Doctors
@endsection

@section('breadcrumbs')
    Doctors
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

        <form class="px-2" method="POST" action="{{ route('admin.doctors.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name">
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">Image</label>
                <input class="form-control" name="image" value="{{ old('image') }}" type="file" id="file">
            </div>

            <div class="form-group">
                <label>Select Major</label>
                <select name="major_id" class="form-control">
                    @foreach ($majors as $major)
                        <option value="{{$major->id}}">{{$major->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
