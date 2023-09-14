@extends('User.Layout.master')


@section('content')
    {{-- content --}}
    <div class="container">
        <h2 class="h1 fw-bold text-center my-4">majors</h2>
        <div class="d-flex flex-wrap gap-4 justify-content-center">
            @foreach ($majors as $major)
                <div class="card p-2" style="width: 18rem;">
                    <img src="{{ asset($major->image) }}" class="card-img-top rounded-circle card-image-circle" alt="major">
                    <div class="card-body d-flex flex-column gap-1 justify-content-center">
                        <h4 class="card-title fw-bold text-center">{{ $major->name }}</h4>
                        @auth
                            <a href="{{ route('user.doctor.index', $major->id) }}"
                                class="btn btn-outline-primary card-button">Browse Doctors</a>
                        @endauth
                        @guest
                            <p class="text-danger text-sm text-center">
                                login to browse doctors
                            </p>
                        @endguest
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center my-3">
            @guest
            <p class="text-danger fs-4 text-capitalize my-3">
                login to browse more majors !
            </p>
        @endguest
        </div>

        <hr/>

        <h2 class="h1 fw-bold text-center my-4">doctors</h2>
        <section class="splide home__slider__doctors mb-5">
            <div class="splide__track ">
                <ul class="splide__list">

                    @foreach ($doctors as $doctor)
                        <li class="splide__slide">
                            <div class="card p-2" style="width: 18rem;">
                                <img src="{{ asset($doctor->image) }}" class="card-img-top rounded-circle card-image-circle"
                                    alt="major">
                                <div class="card-body d-flex flex-column gap-1 justify-content-center">
                                    <h4 class="card-title fw-bold text-center">{{ $doctor->nama }}</h4>
                                    <h6 class="card-title fw-bold text-center">{{ $doctor->major->name }}</h6>
                                    @auth
                                        <a href="{{ route('user.booking.create', $doctor->id) }}"
                                            class="btn btn-outline-primary card-button">Book an
                                            appointment</a>
                                    @endauth
                                    @guest
                                        <p class="text-danger text-center">
                                            you have to login to make an appointment
                                        </p>
                                    @endguest
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    </div>
@endsection
