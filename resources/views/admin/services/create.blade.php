@extends('admin.layouts.app')

@section('content')
    <!-- Toast Notification -->
    @if(session('success'))
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <!-- Container-fluid starts-->
    <div class="container mt-5 p-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="form-container">
                    <div class="form-header">Service</div>
                    <form id="serviceForm" method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="serviceName">Service Name</label>
                            <input type="text" class="form-control" id="serviceName" name="serviceName" placeholder="Service Name" required>
                        </div>
                        <div class="form-group">
                            <label for="serviceDescription">Service Description</label>
                            <textarea class="form-control" id="serviceDescription" name="serviceDescription" rows="3" placeholder="Service Description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="coverImage">Cover Image</label>
                            <input type="file" class="form-control" id="coverImage" name="cover_image">
                        </div>
                        <div id="packagesContainer"></div>
                        <button type="button" class="btn btn-primary mt-3" id="saveServiceBtn">Create Service</button>
                    </form>
                </div>
                <div class="d-flex justify-content-start mt-3">
                    <button type="button" class="btn btn-create" id="addPackageBtn">
                        <i class="fa fa-plus"></i> Add Package
                    </button>
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
                .btn-create {
                    background-color: transparent;
                    border: 2px solid #0000ff;
                    padding: 10px 20px;
                    color: #0000ff;
                    border-radius: 50px;
                    font-size: 16px;
                    font-weight: bold;
                    display: flex;
                    align-items: center;
                    transition: background-color 0.3s ease, color 0.3s ease, transform 0.1s ease;
                }
                .btn-create i {
                    margin-right: 10px;
                }
                .btn-create:hover {
                    background-color: #0000ff;
                    color: white;
                }
                .btn-create:active {
                    transform: scale(0.95);
                }
                .package {
                    background-color: #f8f9fa;
                    padding: 15px;
                    border-radius: 10px;
                    margin-top: 10px;
                }
                .package-header {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    font-size: 20px;
                    font-weight: bold;
                    margin-bottom: 10px;
                }
                .btn-delete, .btn-add-description, .btn-remove-description {
                    background-color: transparent;
                    border: 1px solid;
                    padding: 5px 10px;
                    border-radius: 50px;
                    font-size: 16px;
                    font-weight: bold;
                    display: flex;
                    align-items: center;
                    transition: background-color 0.3s ease, color 0.3s ease, transform 0.1s ease;
                }
                .btn-delete {
                    border-color: #ff0000;
                    color: #ff0000;
                }
                .btn-delete i {
                    margin-right: 5px;
                }
                .btn-delete:hover {
                    background-color: #ff0000;
                    color: white;
                }
                .btn-delete:active {
                    transform: scale(0.95);
                }
                .btn-add-description {
                    border-color: #003200;
                    color: #003200;
                }
                .btn-add-description:hover {
                    background-color: #003200;
                    color: white;
                }
                .btn-remove-description {
                    border-color: #ff0000;
                    color: #ff0000;
                }
                .btn-remove-description:hover {
                    background-color: #ff0000;
                    color: white;
                }
            </style>
        </div>
    </div>

    <script>
        document.getElementById('addPackageBtn').addEventListener('click', function() {
            addPackage();
        });

        document.getElementById('saveServiceBtn').addEventListener('click', function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to create a new Service!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, save it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('serviceForm').submit();
                }
            });
        });

        function addPackage() {
            const packageCount = document.querySelectorAll('.package').length + 1;
            const packageHtml = `
                <div class="package" id="package${packageCount}">
                    <div class="package-header">
                        <span>Package ${packageCount}</span>
                        <button type="button" class="btn btn-delete" onclick="deletePackage(${packageCount})">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                    </div>
                    <div class="form-group">
                        <label for="packageName${packageCount}">Package Name</label>
                        <input type="text" class="form-control" id="packageName${packageCount}" name="packages[${packageCount}][name]" placeholder="Package Name">
                    </div>
                    <div class="form-group" id="packageDescriptionContainer${packageCount}">
                        <label>Add Description</label>
                        <div class="d-flex">
                            <input type="text" class="form-control" name="packages[${packageCount}][description][]" placeholder="Description">
                            <button type="button" class="btn btn-add-description ml-2" onclick="addDescription(${packageCount})">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="packageImage${packageCount}">Package Image</label>
                        <input type="file" class="form-control" id="packageImage${packageCount}" name="packages[${packageCount}][image]">
                    </div>
                    <div class="form-group">
                        <label for="packagePrice${packageCount}">Price</label>
                        <input type="text" class="form-control" id="packagePrice${packageCount}" name="packages[${packageCount}][price]" placeholder="Price">
                    </div>
                    <div class="form-group">
                        <label for="packageDiscount${packageCount}">Discount</label>
                        <input type="text" class="form-control" id="packageDiscount${packageCount}" name="packages[${packageCount}][discount]" placeholder="Discount">
                    </div>
                </div>
            `;

            const packagesContainer = document.getElementById('packagesContainer');
            packagesContainer.insertAdjacentHTML('beforeend', packageHtml);
        }

        function deletePackage(packageId) {
            const packageElement = document.getElementById(`package${packageId}`);
            packageElement.remove();
        }

        function addDescription(packageId) {
            const descriptionCount = document.querySelectorAll(`#packageDescriptionContainer${packageId} .d-flex`).length + 1;
            const descriptionField = `
                <div class="d-flex mt-2">
                    <input type="text" class="form-control" name="packages[${packageId}][description][]" placeholder="Add Description ${descriptionCount}">
                    <button type="button" class="btn btn-add-description ml-2" onclick="addDescription(${packageId})">
                        <i class="fa fa-plus"></i>
                    </button>
                    <button type="button" class="btn btn-remove-description ml-2" onclick="removeDescription(this)">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            `;
            const packageElement = document.getElementById(`packageDescriptionContainer${packageId}`);
            packageElement.insertAdjacentHTML('beforeend', descriptionField);
        }

        function removeDescription(element) {
            element.parentElement.remove();
        }

        document.addEventListener('DOMContentLoaded', function () {
            var successToast = document.getElementById('successToast');
            if (successToast) {
                var toast = new bootstrap.Toast(successToast);
                toast.show();
            }
        });
    </script>
@endsection
