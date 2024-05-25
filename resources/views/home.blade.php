<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle }}</title>
    @vite('resources/sass/app.scss')
</head>

<body>

    @extends('layouts.app')

    @section('content')
        {{--
        <nav class="navbar navbar-expand-md navbar-dark bg-primary">
            <div class="container">
                <a href="{{ route('home') }}" class="navbar-brand mb-0 h1">
                    <i class="bi-hexagon-fill me-2"></i> Data Master
                </a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <hr class="d-lg-none text-white-50">
                    <ul class="navbar-nav flex-row flex-wrap">
                        <li class="nav-item col-2 col-md-auto">
                            <a href="{{ route('home') }}" class="nav-link active">Home</a>
                        </li>
                        <li class="nav-item col-2 col-md-auto">
                            <a href="{{ route('employees.index') }}" class="nav-link">Employee List</a>
                        </li>
                    </ul>
                    <hr class="d-lg-none text-white-50">
                    <a href="{{ route('profile') }}" class="btn btn-outline-light my-2 ms-md-auto">
                        <i class="bi-person-circle me-1"></i> My Profile
                    </a>
                </div>
            </div>
        </nav>
        --}}

        {{-- <div class="container mt-4">
            <h4>{{ $pageTitle }}</h4>
            <hr>
            <div class="d-flex align-items-center py-2 px-4 bg-light rounded-3 border">
                <div class="bi-house-fill me-3 fs-1"></div>
                <h4 class="mb-0">Well done! This is {{ $pageTitle }}.</h4>
            </div>
        </div> --}}

        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        {{-- <div class="card-header">{{ __('Dashboard') }}</div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            {{ __('You are logged in!') }}
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="p-6 m-20 bg-white rounded shadow">
            {!! $chart->container() !!}
        </div>

        <script src="{{ $chart->cdn() }}"></script>
        {{ $chart->script() }}
    @endsection

    @vite('resources/js/app.js')
</body>

</html>