@extends('layouts.app') @section('content')

<div class="hold-transition login-page">
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col">
                <!-- <div class="login-box"> -->
                <div class="card">
                    <div class="card-header">
                        <img
                            src="https://www.uniremington.edu.co/wp-content/uploads/2019/02/logo-universdad.png"
                        />
                    </div>
                </div>

                <!-- </div> -->
            </div>
            <div class="col-2"></div>
        </div>
        <div class="row">
            <div class="col-4"></div>
            <div class="col">
                <div class="card">
                    <div class="card-header bg-navy">
                        Iniciar Sesión
                    </div>

                    <div class="card-body login-card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="input-group mb-3">
                                <input
                                    id="email"
                                    type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autocomplete="email"
                                    autofocus
                                    placeholder="Email"
                                />

                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                                <input
                                    id="password"
                                    type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                    placeholder="Password"
                                />

                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input"
                                        type="checkbox" name="remember"
                                        id="remember"
                                        {{ old("remember") ? "checked" : "" }}>

                                        <label
                                            class="form-check-label"
                                            for="remember"
                                        >
                                            Recordarme
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <div class="col-md-8 offset-md-2">
                                    <button
                                        type="submit"
                                        class="btn btn-block bg-navy"
                                    >
                                        Iniciar
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                @if (Route::has('password.request'))
                                <a
                                    class="btn btn-link"
                                    href="{{ route('password.request') }}"
                                >
                                    Recuperar Contraseña
                                </a>
                                @endif
                            </div>
                            <div class="row">
                                @if (Route::has('register'))
                                <a
                                    class="btn btn-link"
                                    href="{{ route('register') }}"
                                >
                                    Registrarme
                                </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-4"></div>
        </div>
    </div>
</div>
@endsection
