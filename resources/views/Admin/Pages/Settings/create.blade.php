@extends('Admin.Layout.master')

@section('title')
    Settings
@endsection

@section('breadcrumbs')
    Settings
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
        method="POST" action="{{ route('admin.settings.store') }}"
        enctype="multipart/form-data"
        >
            @csrf
            <div class="mb-3">
                <label for="key" class="form-label">Key</label>
                <input type="text" name="key" value="{{old('key')}}" class="form-control" id="key">
            </div>
            <div class="mb-3">
                <label for="vlaue" class="form-label">Value</label>
                <textarea type="text" name="vlaue" value="{{old('vlaue')}}" class="form-control" id="vlaue"></textarea>
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">Image</label>
                <input class="form-control" name="image"  value="{{old('image')}}" type="file" id="file">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection