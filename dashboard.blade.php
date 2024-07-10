@extends('layout')
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                
                <a class="navbar-brand" href="{{ route('edit.user') }}">Update user profile</a>

              
                <a class="navbar-brand" href="{{ route('notes.create') }}">create notes</a>
                {{-- <a href="{{ route('notes.show', ['id' => $user->id]) }}" class="btn btn-primary">View Note</a> --}}
                {{-- @dd(auth()->user()->email) --}}
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
  
                    You are Logged In
                </div>
            </div>
        </div>
    </div>
</div>
@endsection