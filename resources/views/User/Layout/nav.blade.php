{{-- navbar --}}
<nav class="navbar navbar-expand-lg navbar-expand-md bg-primary sticky-top">
    <div class="container">
        <div class="navbar-brand">
            <a class="fw-bold text-white m-0 text-decoration-none h3" href="{{ route('user.dashboard.index') }}">VCare</a>
        </div>
        <button class="navbar-toggler btn-outline-light border-0 shadow-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <div class="d-flex gap-3 flex-wrap justify-content-center" role="group">
                <a type="button" class="btn btn-outline-light navigation--button"
                    href="{{ route('user.dashboard.index') }}">Home</a>
                @auth
                    <a type="button" class="btn btn-outline-light navigation--button"
                        href="{{ route('user.major.index') }}">majors</a>
                    <a type="button" class="btn btn-outline-light navigation--button"
                        href="{{ route('user.doctor.index') }}">Doctors</a>
                @endauth
                @guest
                    <a type="button" class="btn btn-outline-light navigation--button"
                        href="{{ route('user.login') }}">login</a>
                @endguest
                <a type="button" class="btn btn-outline-light navigation--button"
                    href="{{ route('user.register') }}">register</a>
                @auth
                    <form method="POST" action="{{ route('user.logout') }}">
                        @csrf
                        <input class="btn btn-outline-light navigation--button" type="submit" readonly value="Logout" />
                    </form>
                @endauth
            </div>
        </div>
    </div>
</nav>
