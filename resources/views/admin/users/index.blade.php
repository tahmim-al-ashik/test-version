@extends('admin.layouts.app')
<!-- resources/views/admin/users/index.blade.php -->
@section('content')
    <!-- Include Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Container-fluid starts-->
    <div class="row" style="padding: 20px">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4>User Management</h4>
                        <span>List of all users</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive signal-table">
                        <table class="table table-hover text-center">
                            <thead>
                            <tr>
                                <th scope="col">#Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Phone & Email</th>
                                <th scope="col">Services</th>
                                <th scope="col">Packages</th>
                                <th scope="col">Subscription type</th>
                                <th scope="col">Date of registration</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->phone }}<br>{{ $user->email }}</td>
                                    <td>
                                        @foreach($user->services as $service)
                                            {{ $service->name }}<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($user->packages as $package)
                                            {{ $package->name }}<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($user->services as $service)
                                            @if($service->pivot->package_id)
                                                @php
                                                    $package = \App\Models\Admin\Package::find($service->pivot->package_id);
                                                @endphp
                                                {{ $service->pivot->registration_type ? ucwords($service->pivot->registration_type) : 'Personal' }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($user->services as $service)
                                            {{ optional($service->pivot->created_at)->format('Y-m-d') }}<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="action-icon edit-action"><i class="fa fa-edit"></i></a>
                                        <span class="action-icon delete-action" data-id="{{ $user->id }}"><i class="fa fa-trash"></i></span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        .table {
            width: 100%;
            margin: 0 auto;
        }
        .action-icon {
            margin: 0 10px;
        }
        .fa-edit {
            color: green;
        }
        .fa-trash {
            color: red;
        }
        .table td, .table th {
            vertical-align: middle;
            text-align: center;
        }
        .card-header h4 {
            font-weight: 500;
        }
        .pagination {
            display: flex;
            justify-content-center;
            padding-left: 0;
            list-style: none;
            border-radius: 0.25rem;
        }
        .pagination li {
            margin: 0 5px;
        }
        .pagination .active span,
        .pagination .disabled span {
            color: #6c757d;
        }
        .pagination .active span {
            font-weight: bold;
        }
        .pagination a {
            color: #007bff;
            text-decoration: none;
        }
        .pagination a:hover {
            color: #0056b3;
            text-decoration: underline;
        }
    </style>

    <script>
        document.querySelectorAll('.delete-action').forEach(function(element) {
            element.addEventListener('click', function() {
                var userId = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + userId).submit();
                    }
                });
            });
        });
    </script>
@endsection
