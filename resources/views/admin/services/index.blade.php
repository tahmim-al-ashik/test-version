@extends('admin.layouts.app')
@section('content')
    <!-- Include Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Container-fluid starts-->
    <div class="row" style="padding: 20px">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4>Services List</h4>
                        <span>Hoverable row use a class <code>table-hover</code> and for Horizontal border use a class <code>.table-border-horizontal</code>, Solid border Use a class<code>.border-solid .table</code> class.</span>
                    </div>
                    <!-- Add Create Icon -->
                    <div>
                        <button id="createButton" class="btn btn-outline-primary">
                            <i class="fa fa-plus"></i> Create
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Pagination -->
                    <div class="d-flex justify-content-start mb-2">
                        @if ($services->hasPages())
                            <nav aria-label="Page navigation">
                                <ul class="custom-pagination">
                                    {{-- Previous Page Link --}}
                                    @if ($services->onFirstPage())
                                        <li class="disabled"><span>« Previous</span></li>
                                    @else
                                        <li><a href="{{ $services->previousPageUrl() }}" rel="prev">« Previous</a></li>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @foreach ($services->getUrlRange(1, $services->lastPage()) as $page => $url)
                                        @if ($page == $services->currentPage())
                                            <li class="active"><span>{{ $page }}</span></li>
                                        @else
                                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    @if ($services->hasMorePages())
                                        <li><a href="{{ $services->nextPageUrl() }}" rel="next">Next »</a></li>
                                    @else
                                        <li class="disabled"><span>Next »</span></li>
                                    @endif
                                </ul>
                            </nav>
                        @endif
                    </div>

                    <div class="table-responsive signal-table">
                        <table class="table table-hover text-center">
                            <thead>
                            <tr>
                                <th scope="col">#Id</th>
                                <th scope="col">Service Name</th>
                                <th scope="col">Cover Image</th>
                                <th scope="col">Packages</th>
                                <th scope="col">Total User</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($services as $service)
                                <tr>
                                    <th scope="row">{{ $service->id }}</th>
                                    <td>{{ $service->name }}</td>
                                    <td>
                                        @if($service->cover_image)
                                            <img src="{{ Storage::url($service->cover_image) }}" alt="Cover Image" style="max-width: 100px;">
                                        @endif
                                    </td>
                                    <td>
                                        @foreach($service->packages as $package)
                                            <strong>{{ $package->name }}</strong><br>
                                            <small>{{ $package->description }}</small><br>
                                            <small>Price: {{ $package->price }}</small><br>
                                            <small>Discount: {{ $package->discount }}</small><br>
                                            @if($package->image)
                                                <img src="{{ Storage::url($package->image) }}" alt="Package Image" style="max-width: 100px;">
                                            @endif
                                            <br><br>
                                        @endforeach
                                    </td>
                                    <td>{{ $service->users_count }}</td>
                                    <td>
                                        <a href="#" class="action-icon edit-action" data-url="{{ route('admin.services.edit', $service->id) }}"><i class="fa fa-edit"></i></a>
                                        <a href="#" class="action-icon delete-action" data-id="{{ $service->id }}"><i class="fa fa-eye-slash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
                        .fa-eye-slash {
                            color: red;
                        }
                        .table td, .table th {
                            vertical-align: middle;
                            text-align: center;
                        }
                        .card-header h4 {
                            font-weight: 500;
                        }
                        /* Custom Pagination */
                        .custom-pagination {
                            display: flex;
                            justify-content: center;
                            padding-left: 0;
                            list-style: none;
                            border-radius: 0.25rem;
                        }
                        .custom-pagination li {
                            margin: 0 5px;
                        }
                        .custom-pagination .active span,
                        .custom-pagination .disabled span {
                            color: #6c757d;
                        }
                        .custom-pagination .active span {
                            font-weight: bold;
                        }
                        .custom-pagination a {
                            color: #007bff;
                            text-decoration: none;
                        }
                        .custom-pagination a:hover {
                            color: #0056b3;
                            text-decoration: underline;
                        }
                        .custom-pagination .active {
                            font-weight: bold;
                        }
                        /* Create Button Animation */
                        #createButton {
                            transition: transform 0.2s ease-in-out, background-color 0.2s ease-in-out, color 0.2s ease-in-out;
                        }
                        #createButton:active {
                            transform: scale(0.95);
                        }
                        #createButton:hover {
                            background-color: #007bff;
                            color: white;
                        }
                    </style>

                    <script>
                        document.getElementById('createButton').addEventListener('click', function() {
                            window.location.href = '{{ route('admin.services.create') }}';
                        });

                        document.querySelectorAll('.delete-action').forEach(button => {
                            button.addEventListener('click', function(event) {
                                event.preventDefault();
                                const serviceId = this.dataset.id;

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
                                        // Create a form to submit the delete request
                                        const form = document.createElement('form');
                                        form.action = `/admin/services/${serviceId}`;
                                        form.method = 'POST';
                                        form.style.display = 'none';

                                        // Add the CSRF token input
                                        const csrfInput = document.createElement('input');
                                        csrfInput.type = 'hidden';
                                        csrfInput.name = '_token';
                                        csrfInput.value = '{{ csrf_token() }}';
                                        form.appendChild(csrfInput);

                                        // Add the method input (for DELETE method)
                                        const methodInput = document.createElement('input');
                                        methodInput.type = 'hidden';
                                        methodInput.name = '_method';
                                        methodInput.value = 'DELETE';
                                        form.appendChild(methodInput);

                                        document.body.appendChild(form);
                                        form.submit();
                                    }
                                });
                            });
                        });

                        document.querySelectorAll('.edit-action').forEach(button => {
                            button.addEventListener('click', function(event) {
                                event.preventDefault();
                                const editUrl = this.dataset.url;

                                Swal.fire({
                                    title: 'Are you sure?',
                                    text: "You are about to edit this Service.",
                                    icon: 'info',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Yes, edit it!'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = editUrl;
                                    }
                                });
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection
