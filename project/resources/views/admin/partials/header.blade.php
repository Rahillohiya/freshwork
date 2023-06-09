<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <!-- <a href="index.html">
                <img src="https://www.commteldigital.com/wp-content/themes/commteldigital-child/img/commtel_digital_logo.png" alt="logo" class="logo-default">
            </a> -->
            <div class="menu-toggler sidebar-toggler">
                <span></span>
            </div>
            <a href="javascript:">
                <img src="{{ URL::asset('assets/images/logo-white.png')}}" alt="logo" class="logo-default">
            </a>


        @if(\Request::route()->getName()!='admin.docs.index')
            <!-- <a href="javascript:">
                    <img src="{{ URL::asset('assets/images/logo-white.png')}}" alt="logo" class="logo-default">
                </a> -->
                <!-- <div class="menu-toggler sidebar-toggler">
                    <span></span>
                </div> -->
            @endif

        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <!-- <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
           data-target=".navbar-collapse">
            <span></span>
        </a> -->
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <li class="search-wrapper" id="search-bar">
                    <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                    {{--<form class="" action="{{ route('insurer.logout') }}" method="POST">--}}
                    <div class="nav-search-bordered input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                                <a href="javascript:;" class="btn submit">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </span>
                    </div>
                {{--</form>--}}
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
                </li>
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
                        <span class="welcom-user">Welcome</span>
                        <span class="username username-hide-on-mobile">
                            @php
                                $firstname = '';
                                $lastname = '';
                            @endphp
                            {{$firstname.' '.$lastname}}
                        </span>
                        <i class="fa fa-angle-down"></i>
                        <img alt="" class="img-circle"
                             src="{{ URL::asset('assets/layouts/layout/img/avatar3_small.jpg')}}">

                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        {{--<li>--}}
                        {{--@php--}}
                        {{--$user = auth('insurer')->user();--}}
                        {{--@endphp--}}
                        {{--<a href="{{ route('insurer.profile.show',['id'=>$user->id]) }}">--}}
                        {{--<i class="icon-user"></i> My Profile </a>--}}
                        {{--</li>--}}

                        {{--<li>
                            <a href="app_inbox.html">
                                <i class="icon-envelope-open"></i> My Inbox
                                <span class="badge badge-danger"> 3 </span>
                            </a>
                        </li>--}}
                        {{--<li>
                            <a href="app_todo.html">
                                <i class="icon-rocket"></i> My Tasks
                                <span class="badge badge-success"> 7 </span>
                            </a>
                        </li>--}}
                        <li class="divider"></li>
                        <li>
                            <a href="javascript:">
                                <i class="icon-lock"></i> Lock Screen </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.logout') }}"> <i class="icon-key"></i> Log Out </a>


                        </li>
                    </ul>
                </li>

                <!-- END QUICK SIDEBAR TOGGLER -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
