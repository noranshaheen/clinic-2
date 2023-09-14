@extends('User.Layout.master')

@section('title')
    Contact Us
@endsection


@section('content')
    <div class="container">
        <h2>Contact Us</h2>
        @if (isset($success))
            <div class="alert alert-success py-3">
                {{ $success }}
            </div>
            @php
                unset($success);
            @endphp
        @endif
        <div class="d-flex flex-column gap-3 account-form mx-auto mt-5">
            <form method="POST" action="{{route('user.contact.store')}}">
                @csrf
                <div class="form-items">
                    <div class="mb-3">
                        <label class="form-label required-label" for="name">Name</label>
                        <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" required>
                        @error('name')
                        <p>{{ $message }}</p>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label required-label" for="phone">Phone</label>
                        <input type="tel"  name="phone" value="{{old('phone')}}" class="form-control" id="phone" required>
                        @error('phone')
                        <p>{{ $message }}</p>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label required-label" for="email">Email</label>
                        <input type="email"  name="email" value="{{old('email')}}" class="form-control" id="email" required>
                        @error('email')
                        <p>{{ $message }}</p>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label required-label" for="message">message</label>
                        <textarea class="form-control" value="{{old('message')}}"  name="message" id="message" required></textarea>
                        @error('message')
                        <p>{{ $message }}</p>
                    @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
    </div>
@endsection
