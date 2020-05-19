@extends('app')

@section('body')
    <div id="main-body" class="container">
        <div class="row">
            <div class="col-md-2 offset-md-2">
                @include('user.nav-link')
            </div>
            <div class="col-md-6">
                <div id="sign-calendar" class="row">
                    <sign-calendar></sign-calendar>
                </div>
            </div>
        </div>
    </div>
    @include('user.sign-calendar')
@endsection
