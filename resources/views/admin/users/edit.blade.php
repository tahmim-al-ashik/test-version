@extends('admin.layouts.app')
<!-- resources/views/admin/users/edit.blade.php -->
@section('content')
    <!-- Include Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Container-fluid starts-->
    <div class="container mt-5 p-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="form-container">
                    <div class="form-header">Edit User</div>
                    <form id="userForm" method="POST" action="{{ route('admin.users.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Update User</button>
                    </form>
                </div>
            </div>

            <style>
                .form-container {
                    background-color: #e9ecef;
                    padding: 20px;
                    border-radius: 10px;
                }
                .form-header {
                    font-size: 24px;
                    font-weight: bold;
                }
            </style>
        </div>
    </div>
@endsection
