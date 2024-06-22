@extends('layouts.auth')

@section('content')
    <div class="auth-container d-flex">

        <div class="align-self-center container mx-auto">

            <div class="row">

                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
                    <div class="card mb-3 mt-3">
                        <div class="card-body">

                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                
                                <div class="row">
                                    <div class="col-md-12 mb-3">

                                        <h2>Reset Password</h2>
                                        <p>Enter your email to reset password</p>

                                        @if (session('status'))
                                            <div class="alert alert-success alert-dismissible fade show mb-2 border-0" role="alert">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                                                <strong>Success!</strong> {{ session('status') }}</button>
                                            </div>
                                        @endif

                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Email<span class="text-danger">*</span></label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required readonly autocomplete="email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label class="form-label">Password<span class="text-danger">*</span></label>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label class="form-label">Password Confirmation<span class="text-danger">*</span></label>
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <button class="btn btn-secondary w-100">RESET PASSWORD</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="text-center">
                                            <p class="mb-0">Back to previous page? <a href="{{ route('login') }}" class="text-primary">Sign In</a></p>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
