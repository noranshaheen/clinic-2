@extends('User.Layout.master')

@section('title')
    Majors
@endsection

@section('content')
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{route('user.dashboard.index')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">majors</li>
            </ol>
        </nav>
        <div class="majors-grid">
            <div class="d-flex flex-wrap gap-4 justify-content-center">
                @forelse ($majors as $major)
                    <div class="card p-2" style="width: 18rem;">
                        <img src="{{ asset($major->image) }}" class="card-img-top rounded-circle card-image-circle" alt="major">
                        <div class="card-body d-flex flex-column gap-1 justify-content-center">
                            <h4 class="card-title fw-bold text-center">{{ $major->name }}</h4>
                            <a href="{{ route('user.doctor.index', $major->id) }}"
                                class="btn btn-outline-primary card-button">Browse Doctors</a>
                        </div>
                    </div>
                @empty
                    <h3>No Majors</h3>
                @endforelse
            </div>
        </div>
        <div class="flex justify-content-center">
            <p>
                {{ $majors->links() }}
            </p>
        </div>
    </div>
@endsection