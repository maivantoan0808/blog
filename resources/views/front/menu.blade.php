<style>
    #sidebar-overlay{
        z-index: 1;
    }
</style>
<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-1 sidebar-light-primary" style="margin-top: 60px; z-index: 2;">
    <a href="index3.html" class="brand-link">
        <img src="../library/dist/img/w.png" alt="WokShop Logo" class="brand-image img-circle elevation-1" style="opacity: .8">
        <span class="brand-text font-weight-light"><b>Blog<span class="right badge badge-info" style="margin-left: 15px;"><i class="fa fa-signal"></i></span></b></span>
    </a>
    <!-- Sidebar -->
    <div class="menu-right">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                @foreach ($topics as $topic)
                    <li class="nav-item">
                        <a href="{{ route('topic', [$topic->slug_topic ]) }}" class="nav-link">
                          <i class="nav-icon fa fa-pie-chart"></i>
                          <p>{{ $topic->name_topic }}</p>
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>