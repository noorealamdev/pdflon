@extends('backend.layouts.master')

@section('content')

    @include('backend.partials.alert')
    <div class="col-8 col-md-8 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Profile</h4>
            </div>

            <div class="card-body">

                <form action="{{ route('profile.update', $user->id) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="name">{{ 'Name' }} <span class="field-required">*</span></label>
                        <input id="name" name="name" type="text" class="form-control" value="{{ $user->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">{{ 'Email' }} <span class="field-required">*</span></label>
                        <input id="email" name="email" type="email" class="form-control" value="{{ $user->email }}" required>
                    </div>
                    <div class="form-group">
                        <label>Image (size 128 x 128) (.svg, .jpg, .jpeg, .png)</label>
                        <input class="form-control" type="file" name="profile_photo_path">
                        @if(!empty($user->profile_photo_path))
                            <img src="{{ asset('uploads/'. $user->profile_photo_path) }}" alt="" width="130" height="130">
                        @endif
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
