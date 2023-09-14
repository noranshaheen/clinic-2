@extends('User.Layout.master')

@section('title')
    Booking
@endsection


@section('content')
    <div class="container py-4">
        @if (isset($success))
            <div class="alert alert-success py-3">
                {{ $success }}
            </div>
            @php
                unset($success);
            @endphp
        @endif
        <div class="d-flex flex-column gap-3 details-card doctor-details">
            <div class="details d-flex gap-2 align-items-center">
                <img src="{{ asset($doctor->image) }}" alt="doctor" class="img-fluid rounded-circle" height="150"
                    width="150">
                <div class="details-info d-flex flex-column gap-3 ">
                    <h4 class="card-title fw-bold">{{ $doctor->name }}</h4>
                    <h6 class="card-title fw-bold">{{$doctor->major->name}}</h6>
                </div>
            </div>
            <hr />
            <form class="form" method="POST" action="{{ route('user.booking.store', $doctor->id) }}">
                @csrf
                <div class="form-items">
                    <div class="mb-3">
                        <label class="form-label required-label" for="name">Name</label>
                        <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" >
                        @error('name')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label required-label" for="phone">Phone</label>
                        <input type="tel" name="phone" value="{{old('phone')}}" class="form-control" id="phone" >
                        @error('phone')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label required-label" for="email">Email</label>
                        <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email" >
                        @error('email')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label required-label" for="date">Date</label>
                        <input type="date" name="date" value="{{old('date')}}" class="form-control" id="date" >
                        @error('date')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Confirm Booking</button>
            </form>

        </div>
    </div>
@endsection