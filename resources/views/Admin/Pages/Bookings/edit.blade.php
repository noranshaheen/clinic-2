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

        <form class="px-2" method="POST" action="{{ route('admin.bookings.update', $booking->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" value="{{ $booking->name }}" class="form-control" id="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" value="{{ $booking->email }}" class="form-control" id="email">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">phone</label>
                <input type="text" name="phone" value="{{ $booking->phone }}" class="form-control" id="phone">
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">date</label>
                <input type="date" name="date" value="{{ $booking->date }}" class="form-control" id="date">
            </div>

            <div class="form-group">
                <label>Select A Doctor</label>
                <select name="doctor_id" class="form-control">
                    @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id }}" @if ($doctor->doctor_id == $doctor->id) {{ 'selected' }} @endif>
                            {{ $doctor->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
