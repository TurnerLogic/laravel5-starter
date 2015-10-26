@extends('layouts.master')

@section('content')

<div class="container">

    <h1>Register</h1>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/auth/register" id="form-register">
        {!! csrf_field() !!}
        <legend>User Info</legend>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="{{ old('phone') }}" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" id="agree_to_terms" name="agree_to_terms" required> 
                I agree to the <a href="#todo" target="_blank">Terms of Service</a>.
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>

</div>

@stop
