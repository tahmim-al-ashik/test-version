<!-- resources/views/admin/auth/admindashboard.blade.php -->
@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Dashboard</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="{{asset('template/assets/svg/icon-sprite.svg#stroke-home"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row size-column">
            <div class="col-xxl-10 col-md-12 box-col-8 grid-ed-12">
                <div class="row">
                    <div class="col-xxl-5 col-md-7 box-col-7">
                        <div class="row">
                            <div class="col-sm-12">
                                {{-- <div class="card o-hidden">
                                    <div class="card-body balance-widget"><span class="f-w-500 f-light">Total Balance</span>
                                        <h4 class="mb-3 mt-1 f-w-500 mb-0 f-22">$<span class="counter">245,154.00 </span><span class="f-light f-14 f-w-400 ms-1">this month</span></h4><a class="purchase-btn btn btn-primary btn-hover-effect f-w-500" href="#">Tap Up Balance</a>
                                        <div class="mobile-right-img"><img class="left-mobile-img" src="{{asset('template/assets/images/dashboard-2/widget-img.png')}}" alt=""><img class="mobile-img" src="{{asset('template/assets/images/dashboard-2/mobile.gif')}}" alt="mobile with coin"></div>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="col-6">
                                <div class="card small-widget">
                                    <div class="card-body primary"> <span class="f-light">New Orders</span>
                                        <div class="d-flex align-items-end gap-1">
                                            <h4>2,435</h4><span class="font-primary f-12 f-w-500"><i class="icon-arrow-up"></i><span>+50%</span></span>
                                        </div>
                                        <div class="bg-gradient">
                                            <svg class="stroke-icon svg-fill">
{{--                                                <use href="{{asset('template/assets/svg/icon-sprite.svg')}}#new-order"></use>--}}
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card small-widget">
                                    <div class="card-body warning"><span class="f-light">New Customers</span>
                                        <div class="d-flex align-items-end gap-1">
                                            <h4>2,908</h4><span class="font-warning f-12 f-w-500"><i class="icon-arrow-up"></i><span>+20%</span></span>
                                        </div>
                                        <div class="bg-gradient">
                                            <svg class="stroke-icon svg-fill">
{{--                                                <use href="{{asset('template/assets/svg/icon-sprite.svg#customers')}}"></use>--}}
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card small-widget">
                                    <div class="card-body secondary"><span class="f-light">Average Sale</span>
                                        <div class="d-flex align-items-end gap-1">
                                            <h4>$389k</h4><span class="font-secondary f-12 f-w-500"><i class="icon-arrow-down"></i><span>-10%</span></span>
                                        </div>
                                        <div class="bg-gradient">
                                            <svg class="stroke-icon svg-fill">
{{--                                                <use href="{{asset('template/assets/svg/icon-sprite.svg#sale')}}"></use>--}}
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card small-widget">
                                    <div class="card-body success"><span class="f-light">Gross Profit</span>
                                        <div class="d-flex align-items-end gap-1">
                                            <h4>$3,908</h4><span class="font-success f-12 f-w-500"><i class="icon-arrow-up"></i><span>+80%</span></span>
                                        </div>
                                        <div class="bg-gradient">
                                            <svg class="stroke-icon svg-fill">
{{--                                                <use href="{{asset('template/assets/svg/icon-sprite.svg#sale')}}"></use>--}}
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-5 col-sm-6 box-col-5">
                        <div class="appointment">
                            <div class="card">
                                <div class="card-header card-no-border">
                                    <div class="header-top">
                                        <h5 class="m-0">Valuable Customer</h5>
                                        <div class="card-header-right-icon">
                                            <div class="dropdown icon-dropdown">
                                                <button class="btn dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-more-alt"></i></button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"><a class="dropdown-item" href="#">Today</a><a class="dropdown-item" href="#">Tomorrow</a><a class="dropdown-item" href="#">Yesterday</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
{{--                                <div class="card-body pt-0">--}}
{{--                                    <div class="appointment-table customer-table table-responsive">--}}
{{--                                        <table class="table table-bordernone">--}}
{{--                                            <tbody>--}}
{{--                                            <tr>--}}
{{--                                                <td><img class="img-fluid img-40 rounded-circle me-2" src="{{asset('template/assets/images/dashboard/user/1.jpg')}}" alt="user"></td>--}}
{{--                                                <td class="img-content-box"><a class="f-w-500" href="user-profile.html">Jane Cooper</a><span class="f-light">alma.lawson@gmail.com</span></td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td><img class="img-fluid img-40 rounded-circle me-2" src="{{asset('template/assets/images/dashboard/user/2.jpg')}} alt="user"></td>--}}
{{--                                                <td class="img-content-box"><a class="f-w-500" href="user-profile.html">Cameron Willia</a><span class="f-light">tim.jennings@gmail.com</span></td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td><img class="img-fluid img-40 rounded-circle me-2" src="{{asset('template/assets/images/dashboard/user/9.jpg')}} alt="user"></td>--}}
{{--                                                <td class="img-content-box"><a class="f-w-500" href="user-profile.html">Floyd Miles</a><span class="f-light">kenzi.lawson@gmail.com</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td><img class="img-fluid img-40 rounded-circle me-2" src="{{asset('template/assets/images/dashboard/user/5.jpg')}} alt="user"></td>--}}
{{--                                                <td class="img-content-box"><a class="f-w-500" href="user-profile.html">Dianne Russell</a><span class="f-light">curtis.weaver@gmail.com</td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td><img class="img-fluid img-40 rounded-circle me-2" src="{{asset('template/assets/images/dashboard/user/3.jpg')}} alt="user"></td>--}}
{{--                                                <td class="img-content-box"><a class="f-w-500" href="user-profile.html">Guy Hawkins</a><span class="f-light">curtis.weaver@gmail.com</td>--}}
{{--                                            </tr>--}}
{{--                                            </tbody>--}}
{{--                                        </table>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-sm-6 box-col-6">
                        <div class="card">
                            <div class="card-header card-no-border">
                                <div class="header-top">
                                    <h5 class="m-0">Order this month</h5>
                                    <div class="card-header-right-icon">
                                        <div class="dropdown icon-dropdown">
                                            <button class="btn dropdown-toggle" id="orderButton" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-more-alt"></i></button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orderButton"><a class="dropdown-item" href="#">Today</a><a class="dropdown-item" href="#">Tomorrow</a><a class="dropdown-item" href="#">Yesterday</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="light-card balance-card d-inline-block">
                                    <h4 class="mb-0">$12,000 <span class="f-light f-14">(15,080 To Goal)</span></h4>
                                </div>
                                <div class="order-wrapper">
                                    <div id="order-goal"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-xxl-2 col-xl-3 col-md-4 grid-ed-none box-col-4e d-xxl-block d-none">
                        <div class="card">
                            <div class="card-header card-no-border">
                                <h5>Top Categories</h5>
                            </div>
                            <div class="card-body pt-0">
                                <ul class="categories-list">
                                    <li class="d-flex">
                                        <div class="bg-light"> <img src="{{asset('template/assets/images/dashboard-2/category/1.png')}}'" alt="vector burger"></div>
                                        <div>
                                            <h6 class="mb-0"><a href="product.html">Food & Drinks</a></h6><span class="f-light f-12 f-w-500">(12,200)</span>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="bg-light"> <img src="{{asset('template/assets/images/dashboard-2/category/2.png')}}" alt="vector furniture"></div>
                                        <div>
                                            <h6 class="mb-0"><a href="product.html">Furniture</a></h6><span class="f-light f-12 f-w-500">(7,510)</span>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="bg-light"> <img src="{{asset('template/assets/images/dashboard-2/category/3.png')}}" alt="vector grocery box"></div>
                                        <div>
                                            <h6 class="mb-0"><a href="product.html">Grocery</a></h6><span class="f-light f-12 f-w-500">(15,475)</span>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="bg-light"> <img src="{{asset('template/assets/images/dashboard-2/category/4.png')}}" alt="vector game remote"></div>
                                        <div>
                                            <h6 class="mb-0"><a href="product.html">Electronics</a></h6><span class="f-light f-12 f-w-500">(27,840)</span>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="bg-light"> <img src="{{asset('template/assets/images/dashboard-2/category/5.png')}}" alt="vector toys"></div>
                                        <div>
                                            <h6 class="mb-0"><a href="product.html">Toys</a></h6><span class="f-light f-12 f-w-500">(9,653)</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
@endsection
