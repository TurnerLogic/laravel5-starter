@extends('layouts.master')

@section('content')

<div class="container">

    <h1>Settings</h1>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/settings" id="form-user-info">
        {!! csrf_field() !!}
        <legend>User Info</legend>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $user->name or old('name') }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $user->email or old('email') }}" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="{{ $user->phone or old('phone') }}" required>
        </div>
        <div class="form-group">
            <label for="password">Current Password (required)</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            <span class="help-block">Your current password is required to make any account info updates.</span>
        </div>
        <div class="form-group">
            <label for="new_password">New Password (optional)</label>
            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password">
            <span class="help-block">Only enter a new password if you desire to change your current password.</span>
        </div>
        <div class="form-group">
            <label for="new_password_confirmation">Confirm New Password (optional)</label>
            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Confirm New Password">
        </div>
        <button type="submit" class="btn btn-primary">Update User Info</button>
    </form>

@stop
