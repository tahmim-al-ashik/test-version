
@extends('admin.layouts.app')
<!-- resources/views/admin/auth/servicelist.blade.php -->
@section('content')
    <!-- Include Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Container-fluid starts-->
    <div class="row" style="padding: 20px">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4>Invoice System</h4>
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
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
                    </div>

                    <div class="table-responsive signal-table">
                        <table class="table table-hover text-center">
                            <thead>
                            <tr>
                                <th scope="col">#Id</th>
                                <th scope="col">Service Name</th>
                                <th scope="col">Packages</th>
                                <th scope="col">Total User</th>
                                <th scope="col">Actions</th>
                                {{-- <th scope="col">Schedule</th> --}}
                                {{-- <th scope="col">Team Lead</th> --}}
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">#1</th>
                                <td>Invoice System</td>
                                <td>Packages<br>packages<br>packages</td>
                                <td>50</td>
                                <td>
                                    <span class="action-icon"><i class="fa fa-edit"></i></span>
                                    <span class="action-icon"><i class="fa fa-eye-slash"></i></span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">#2</th>
                                <td>Invoice System</td>
                                <td>Packages<br>packages<br>packages</td>
                                <td>50</td>
                                <td>
                                    <span class="action-icon"><i class="fa fa-edit"></i></span>
                                    <span class="action-icon"><i class="fa fa-eye-slash"></i></span>
                                </td>
                            </tr>
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
                        .pagination .page-link {
                            font-weight: 500;
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

{{--                    <script>--}}
{{--                        document.getElementById('createButton').addEventListener('click', function() {--}}
{{--                            window.location.href = '/path/to/new/page';--}}
{{--                        });--}}
{{--                    </script>--}}

                </div>
            </div>
        </div>
    </div>
@endsection
