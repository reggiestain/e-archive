<div class="app-sidebar colored">
                    <div class="sidebar-header">
                        <a class="header-brand" href="index.html">
                           <!-- <div class="logo-img">
                               <img src="{{ asset('/img/vodafone-cash.png')}}" class="header-brand-img" alt="lavalite"> 
                            </div>-->
                           <span class="text">{{config('settings.system_title')}}</span>
                        </a>
                        <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
                        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
                    </div>
                    
                    <div class="sidebar-content">
                        <div class="nav-container">
                            <nav id="main-menu-navigation" class="navigation-main">
                                <!--<div class="nav-lavel" style="text-align:center;color:#fff;font-weight:bold;font-size:18px">DMS</div>-->
                                <div class="nav-item {{ Request::is('admin/home*') ? 'active' : '' }}">
                                    <a href="{!! route('admin.dashboard') !!}"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                                </div>
                                
                                <div class="nav-item {{ Request::is('admin/users*') ? 'active' : '' }}">
                                    <a href="{!! route('users.index') !!}"><i class="ik ik-users"></i><span>Users</span> <!--<span class="badge badge-danger">150+</span>--></a>
                                </div>
                                @can('read tags')
                                <div class="nav-item {{ Request::is('admin/tags*') ? 'active' : '' }}">
                                    <a href="{!! route('tags.index') !!}"><i class="fa fa-tags"></i><span>Tags</span> <!--<span class="badge badge-success">New</span>--></a>
                                </div>
                                @endcan
                                @can('viewAny',\App\Document::class)
                                <div class="nav-item {{ Request::is('admin/documents*') ? 'active' : '' }}">
                                    <a href="{!! route('documents.index') !!}"><i class="ik ik-folder"></i><span>Documents</span> <!--<span class="badge badge-success">New</span>--></a>
                                </div>
                                @endcan
                                @if(auth()->user()->is_super_admin)
                                <div class="nav-item has-sub {{ Request::is('admin/advanced*') ? 'active' : '' }}">
                                    <a href="#"><i class="ik ik-circle"></i><span>Advanced Settings</span></a>
                                    <div class="submenu-content">
                                        <a href="{!! route('customFields.index') !!}" class="menu-item {{ Request::is('admin/advanced/custom-fields*') ? 'active' : '' }}">
                                            <i class="fa fa-edit"></i>Custom Fields</a>
                                        <a href="{!! route('fileTypes.index') !!}" class="menu-item {{ Request::is('admin/advanced/file-types*') ? 'active' : '' }}">
                                            <i class="fa fa-file"></i>{{ucfirst(config('settings.file_label_singular'))}} Types</a>               
                                    </div>
                                </div>
                                @endif
                            </nav>
                        </div>
                    </div>
                </div>