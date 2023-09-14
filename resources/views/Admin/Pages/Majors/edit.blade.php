@extends('Admin.Layout.master')

@section('title')
    Majors
@endsection

@section('breadcrumbs')
    Majors
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

        <form class="px-2" method="POST" action="{{ route('admin.majors.update', $major->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" value="{{ $major->name }}" class="form-control" id="name">
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">Image</label>
                <input class="form-control" name="image" value="" type="file" id="file">
                <div>
                    <img src="{{ asset($major->image) }}" class="rounded rounded-circle" alt="user"
                        style="width: 100px; height:100px">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
