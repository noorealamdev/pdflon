@extends('backend.layouts.master')

@section('content')

    @include('backend.partials.alert')
    <div class="col-8 col-md-8 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Change Password</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('profile.change_password_update', $user->id) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="currentPass">{{ 'Current Password' }} <span class="field-required">*</span></label>
                        <input id="currentPass" name="current_password" type="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">{{ 'New Password' }} <span class="field-required">*</span></label>
                        <input id="password" name="password" type="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmPass">{{ 'Confirm Password' }} <span class="field-required">*</span></label>
                        <input id="confirmPass" name="password_confirmation" type="password" class="form-control" required>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
