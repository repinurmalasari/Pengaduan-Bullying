@extends('layouts.app')

@section('content')
<div class="row justify-content-center my-5">
    <div class="col-md-8">

        <div class="card shadow-sm">
            <div class="card-body">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="card shadow-sm mt-4">
            <div class="card-body">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="card shadow-sm mt-4">
            <div class="card-body">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </div>
</div>
@endsection
