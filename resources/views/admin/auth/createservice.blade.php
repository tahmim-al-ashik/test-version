@extends('admin.layouts.app')
<!-- resources/views/admin/auth/createservice.blade.php -->
@section('content')
    <!-- Include Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Container-fluid starts-->
    <div class="container mt-5 p-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="form-container">
                    <div class="form-header">Service</div>
                    <form id="serviceForm">
                        <div class="form-group">
                            <label for="serviceName">Service Name</label>
                            <input type="text" class="form-control" id="serviceName" placeholder="Service Name">
                        </div>
                        <div class="form-group">
                            <label for="serviceDescription">Service Description</label>
                            <textarea class="form-control" id="serviceDescription" rows="3" placeholder="Service Description"></textarea>
                        </div>
                        <div id="packagesContainer"></div>
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
                        <input type="text" class="form-control" id="packageName${packageCount}" placeholder="Package Name">
                    </div>
                    <div class="form-group" id="packageDescriptionContainer${packageCount}">
                        <label>Add Description</label>
                        <div class="d-flex">
                            <input type="text" class="form-control" placeholder="Description">
                            <button type="button" class="btn btn-add-description ml-2" onclick="addDescription(${packageCount})">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="packagePrice${packageCount}">Price</label>
                        <input type="text" class="form-control" id="packagePrice${packageCount}" placeholder="Price">
                    </div>
                    <div class="form-group">
                        <label for="packageDiscount${packageCount}">Discount</label>
                        <input type="text" class="form-control" id="packageDiscount${packageCount}" placeholder="Discount">
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
                    <input type="text" class="form-control" placeholder="Add Description ${descriptionCount}">
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
    </script>
@endsection
