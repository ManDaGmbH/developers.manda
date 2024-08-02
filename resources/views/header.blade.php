<div class="header p-r-0 bg-primary">
    <div class="header-inner header-md-height">
        <a href="#" class="btn-link toggle-sidebar d-lg-none pg pg-menu text-white" data-toggle="horizontal-menu"></a>
        <div class="">
            <div class="brand inline no-border d-sm-inline-block">
                <img style="width: 90px;" src="{{asset('frontend/assets/img/logo.png')}}" alt="{{config('app.name')}}" data-src="{{asset('frontend/assets/img/logo.png')}}" data-src-retina="{{asset('frontend/assets/img/logo.png')}}" class="img-fluid">
            </div>
        </div>
        <div class="d-flex align-items-center">
            <!-- START User Info-->

            <div class="dropdown pull-right">
                <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="pull-left p-r-10 fs-14 font-heading d-lg-inline-block text-white">
                        <span class="semi-bold">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>
                    </div>
                </button>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">
                    <!-- <a href="{{url('/backend/user-profile')}}" class="dropdown-item"><i class="fa fa-user"></i> Profile</a> -->
                    <a href="{{url('/')}}/backend/change-password" class="dropdown-item"><i class="pg-settings_small"></i> Change Password</a>
                    <a href="javascript:" onClick="event.preventDefault();document.getElementById('logout-form').submit()" class="clearfix bg-master-lighter dropdown-item">
                        <form action="{{route('admin.logout')}}" method="POST" style="display:none;" id="logout-form">
                            @csrf
                            @method('POST')
                        </form>
                        <span class="pull-left">Logout</span>
                        <span class="pull-right"><i class="pg-power"></i></span>
                    </a>
                </div>
            </div>
            <!-- END User Info-->
        </div>
    </div>
    @auth
    <?php
    ?>
    <div class="bg-white">
        <div class="container">
            <div class="menu-bar header-sm-height" data-pages-init='horizontal-menu' data-hide-extra-li="">
                <a href="#" class="btn-link toggle-sidebar d-lg-none pg pg-close" data-toggle="horizontal-menu">
                </a>
                <ul>
                    <li class="@if(in_array('dashboard',Request::segments())) {{'active'}} @endif">
                        <a href="{{url('/')}}/backend/dashboard">Dashboard</a>
                    </li>
                    @canany(['user-list','role-list'])
                    <li class="@if(in_array('users',Request::segments()) || in_array('users-list',Request::segments()) || in_array('roles',Request::segments())) {{'active'}} @endif">
                        <a class="nav-link dropdown-toggle"
                           id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                           href="javascript:">Users</a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">
                            @can('user-list')
                            <a class="nav-link" href="{{ route('admin.users.index') }}">Manage Users</a>
                            @endcan
                            @can('role-list')
                            <a class="nav-link" href="{{ route('admin.roles.index') }}">Manage Roles</a>
                            @endcan
                        </div>
                    </li> 
                    @endcanany
                     <li class="@if(in_array('banners',Request::segments())) {{'active'}} @endif">
                        <a href="{{url('/')}}/backend/banners">Banners</a>
                    </li>
                     <li class="@if(in_array('pages',Request::segments())) {{'active'}} @endif">
                        <a href="{{url('/')}}/backend/pages">Pages</a>
                    </li>
                     <li class="@if(in_array('categories',Request::segments())) {{'active'}} @endif">
                        <a href="{{url('/')}}/backend/categories">Gallery</a>
                    </li>
                    <li class="@if(in_array('contacts',Request::segments())) {{'active'}} @endif">
                        <a href="{{url('/')}}/backend/contacts">Contacts</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @endauth
</div>

<div class="page-container ">
    <!-- START PAGE CONTENT WRAPPER -->
    <div class="page-content-wrapper ">
        <!-- START PAGE CONTENT -->
        <div class="content sm-gutter">
            <!-- START BREADCRUMBS -->
            <div class="bg-white">
                <div class="container">

                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item"><a href="{{url('/')}}/backend/dashboard">Home</a></li>
                        <?php
                        $link = URL::to('/');
                        $allSegments = Request::segments();
                        // dd($allSegments);
                        ?>
                        @for($i = 1; $i <= count(Request::segments()); $i++)
                        @if($i < count(Request::segments()) & $i > 0)
                        <?php
                        if (Request::segment($i) == 'edit') {
                            continue;
                        }
                        if (is_numeric(Request::segment($i))) {
                            continue;
                        }
                        
                        $link .= "/" . Request::segment($i);
                        
                        if ($link != URL::to('/') . "/backend") {
                            if ($i != 3 && is_int(intval(ucwords(str_replace('-', ' ', Request::segment($i)))))) {
                                $s2=str_replace('-',' ',Request::segment($i));
                                
                                ?>
                                <li class="breadcrumb-item"><a href="<?= $link ?>">{{ ucwords($s2)}}</a> </li>
                                <?php
                            }
                        }
                        ?>
                        @else  
                        <?php
                             $s2=str_replace('_',' ',str_replace('-',' ',Request::segment($i)));
                         ?>
                        <li class="breadcrumb-item active"> {{  ucwords($s2) }}</li>
                        @endif
                        @endfor  
                    </ol>
                </div>
            </div>
            <!-- END BREADCRUMBS -->
            <div class="container sm-padding-10 p-t-20 p-l-0 p-r-0">
                @include('partials.alerts')