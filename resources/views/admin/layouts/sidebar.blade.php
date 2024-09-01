<!-- resources/views/admin/layouts/sidebar.blade.php -->
<div class="sidebar-wrapper" data-sidebar-layout="stroke-svg">
    <div>
        <div class="logo-wrapper"><a href="{{route('admin.dashboard')}}"><img class="img-fluid for-light" src="{{asset('template/assets/images/logo/logo.png')}}" alt=""><img class="img-fluid for-dark" src="../assets/images/logo/logo_dark.png" alt=""></a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
        </div>
        <div class="logo-icon-wrapper"><a href="{{route('admin.dashboard')}}"><img class="img-fluid" src="{{asset('template/assets/images/logo/logo-icon.png')}}" alt=""></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"><a href="{{route('admin.dashboard')}}"><img class="img-fluid" src="{{asset('template/assets/images/logo/logo-icon.png')}}" alt=""></a>
                        {{--                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>--}}
                    </li>
{{--                    <li class="pin-title sidebar-main-title">--}}
{{--                        <div>--}}
{{--                            <h6>Pinned</h6>--}}
{{--                        </div>--}}
{{--                    </li>--}}
                    <li class="sidebar-list">
                        <label class="badge badge-light-primary"></label><a class="sidebar-link sidebar-title" href="{{route('admin.dashboard')}}">
                            <svg class="stroke-icon">
                                <use href="{{asset('template/assets/svg/icon-sprite.svg#stroke-home')}}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{asset('template/assets/svg/icon-sprite.svg#fill-home')}}"></use>
                            </svg><span class="lan-3">Dashboard</span></a>
                    </li>

                    <!-- New Services Section -->
                    <li class="sidebar-list"></i>
                        <a class="sidebar-link sidebar-title" href="#">
                            <i class="icon-package service-icon"></i>   <span class="">Services         </span></a>
                        <ul class="sidebar-submenu">
                            <li><a class="" href="{{route('admin.services.index')}}">Services List</a></li>
                            <li><a class="" href="{{ route('admin.services.create') }}">Create</a></li>

                        </ul>
                    </li>

                    <li class="sidebar-list"></i>
                        <a class="sidebar-link sidebar-title" href="#">
                            <i class="icon-user users-icone-sign"></i>   <span class="">User Management         </span></a>
                        <ul class="sidebar-submenu">
                            <li><a class="" href="{{route('admin.user-management')}}">Users List</a></li>

                        </ul>
                    </li>
                </ul>
            </div>
            {{--            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>--}}
        </nav>
    </div>
</div>

<style>
    .service-icon {
        margin-right: 12px; /* Adjust the value as needed */
    }
    .users-icone-sign {
        margin-right: 12px; /* Adjust the value as needed */
    }
</style>
