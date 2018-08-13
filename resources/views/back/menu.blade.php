<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link brand-text font-weight-light">
        <img src="../library/dist/img/ava.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"style="opacity: .8">
        <span class="brand-text font-weight-light">Blogs</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                    <a href="/admin" class="nav-link active">
                        <i class="nav-icon fa fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="{{ route('topics.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-bar-chart"></i>
                        <p>
                            Topics
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fa fa-file-text"></i>
                        <p>
                            Posts
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('posts.index') }}" class="nav-link">
                                <i class="fa fa-list nav-icon"></i>
                                <p>List Posts</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('posts.create') }}" class="nav-link">
                                <i class="fa fa-plus-square nav-icon"></i>
                                <p>Create Posts</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-header">USERS</li>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Users
                             <span class="right badge badge-danger"  style="margin-right: 10px;"><i class="fa fa-star"></i></span>   
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link">
                                <i class="fa fa-list nav-icon"></i>
                                <p>List Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/forms/advanced.html" class="nav-link">
                                <i class="fa fa-user-plus nav-icon"></i>
                                <p>Create Users</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="nav-item has-treeview">
                    <a href="{{ route('comments.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-commenting"></i>
                        <p>
                            Comments
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
