@extends('admin.layouts.app')
<!-- resources/views/admin/users/adminprofile.blade.php -->
@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <div class="container-fluid">
        <div class="edit-profile">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">My Profile</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.update.profile') }}">
                                @csrf
                                @method('PUT')
                                <div class="row mb-2">
                                    <div class="profile-title">
                                        <div class="media">
                                            <img class="img-70 rounded-circle" alt="" src="../assets/images/user/7.jpg">
                                            <div class="media-body">
                                                <h5 class="mb-1">{{ $user->name }}</h5>
                                                <p>{{ $user->role }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <h6 class="form-label">Bio</h6>
                                    <textarea class="form-control" rows="5" name="bio">{{ $user->bio }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email-Address</label>
                                    <input class="form-control" name="email" placeholder="your-email@domain.com" value="{{ $user->email }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Current Password</label>
                                    <div class="input-group">
                                        <input class="form-control" type="password" id="password" name="password" placeholder="Current Password">
                                        <div class="input-group-append">
                                            <span class="input-group-text" onclick="togglePassword('password');"><i class="fa fa-eye"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">New Password</label>
                                    <div class="input-group">
                                        <input class="form-control" type="password" id="newPassword" name="new_password" placeholder="New Password">
                                        <div class="input-group-append">
                                            <span class="input-group-text" onclick="togglePassword('newPassword');"><i class="fa fa-eye"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Retype New Password</label>
                                    <div class="input-group">
                                        <input class="form-control" type="password" id="confirmNewPassword" name="new_password_confirmation" placeholder="Retype New Password">
                                        <div class="input-group-append">
                                            <span class="input-group-text" onclick="togglePassword('confirmNewPassword');"><i class="fa fa-eye"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-footer">
                                    <button class="btn btn-primary btn-block" type="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <form class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Edit Profile</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label class="form-label">Role</label>
                                        <input class="form-control" type="text" value="{{ $user->role }}">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <input class="form-control" type="text" value="{{ $user->username }}">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Email address</label>
                                        <input class="form-control" type="email" value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">First Name</label>
                                        <input class="form-control" type="text" value="{{ $user->first_name }}">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Last Name</label>
                                        <input class="form-control" type="text" value="{{ $user->last_name }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Address</label>
                                        <input class="form-control" type="text" value="{{ $user->address }}">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">City</label>
                                        <input class="form-control" type="text" value="{{ $user->city }}">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Postal Code</label>
                                        <input class="form-control" type="number" value="{{ $user->postal_code }}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label class="form-label">Country</label>
                                        <input class="form-control" type="text" value="{{ $user->country }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div>
                                        <label class="form-label">About Me</label>
                                        <textarea class="form-control" rows="4">{{ $user->about }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-primary" type="submit">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            var field = document.getElementById(fieldId);
            var fieldType = field.getAttribute('type');
            if (fieldType === 'password') {
                field.setAttribute('type', 'text');
            } else {
                field.setAttribute('type', 'password');
            }
        }
    </script>
@endsection
