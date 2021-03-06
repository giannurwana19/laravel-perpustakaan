@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="form-group">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
            value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">

        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
            value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
            name="password" required autocomplete="new-password" placeholder="Password">

        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
            autocomplete="new-password" placeholder="Confirm Password">
    </div>

    <button type="submit" class="btn btn-primary btn-block mb-2">
        {{ __('Register') }}
    </button>

    <div class="text-center">
        <span>Have Acount?</span><a href="{{ route('login') }}" class="btn btn-link">Login</a>
    </div>

</form>
@endsection