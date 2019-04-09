@extends('community.app')

@section('body')
    <div class="row">
        <div id="register-form" class="col-md-4 offset-md-4">
            <vue-register-form></vue-register-form>
        </div>
    </div>
    @include('community.components.register-form')
@endsection