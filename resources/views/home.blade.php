@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
        <div>
            <li class="nav-item d-none d-sm-inline-block ">
                <a href="{{route('post.index')}}" class="nav-link align='center'" >На главную</a>
            </li>
        </div>
    </div>
</div>
@endsection
