<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu"
                @if(config('adminlte.sidebar_nav_animation_speed') != 300)
                    data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}"
                @endif
                @if(!config('adminlte.sidebar_nav_accordion'))
                    data-accordion="false"
                @endif>
                {{-- Configured sidebar links --}}
                @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item')


                <li class="nav-item has-treeview">

    
    <a class="nav-link  " href="">

        <i class="fas fa-fw fa-share "></i>

        <p>
            Multi Level
            <i class="fas fa-angle-left right"></i>

                    </p>

    </a>

    
    <ul class="nav nav-treeview" style="display: none;">
        <li class="nav-item">

    <a class="nav-link  " href="#">

        <i class="far fa-fw fa-circle "></i>

        <p>
            Ranjeey 1

                    </p>

    </a>

</li>

<li class="nav-item has-treeview ">

    
    <a class="nav-link  " href="">

        <i class="far fa-fw fa-circle "></i>

        <p>
            Ranjeey 1
            <i class="fas fa-angle-left right"></i>

                    </p>

    </a>

    
    <ul class="nav nav-treeview">
        <li class="nav-item">

    <a class="nav-link  " href="#">

        <i class="far fa-fw fa-circle "></i>

        <p>
            Ranjeey 2

                    </p>

    </a>

</li>

<li class="nav-item has-treeview ">

    
    <a class="nav-link  " href="">

        <i class="far fa-fw fa-circle "></i>

        <p>
            Ranjeey 2
            <i class="fas fa-angle-left right"></i>

                    </p>

    </a>

    
    <ul class="nav nav-treeview">
        <li class="nav-item">

    <a class="nav-link  " href="#">

        <i class="far fa-fw fa-circle "></i>

        <p>
            Ranjeey 3

                    </p>

    </a>

</li>

<li class="nav-item">

    <a class="nav-link  " href="#">

        <i class="far fa-fw fa-circle "></i>

        <p>
            Ranjeey 3

                    </p>

    </a>

</li>

    </ul>

</li>

    </ul>

</li>

<li class="nav-item">

    <a class="nav-link  " href="#">

        <i class="far fa-fw fa-circle "></i>

        <p>
            Ranjeey 1

                    </p>

    </a>

</li>

    </ul>

</li>
            </ul>

        </nav>
    </div>

</aside>
