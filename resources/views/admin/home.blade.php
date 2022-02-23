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

                    <h3>Benvenuto {{ Auth::user()->name }}! 💻</h3>

                    <p>Dai un'occhiata ai <a href="{{route('posts.index')}}">nuovi post</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
