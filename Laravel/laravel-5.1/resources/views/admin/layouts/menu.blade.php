<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/"><i class="fa fa-circle-o"></i> Dashboard</a></li>

                </ul>
            </li>


            <li class="treeview
@if ($MENU_ELEMENT == true)
                    active
                    @endif
">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Elements</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li @if ($active == 'carousels') class="active" @endif ><a href="/admin/carousel/index"><i class="fa fa-circle-o"></i>Carousel</a></li>
                    <li @if ($active == 'articles') class="active" @endif><a href="/admin/articles/index"><i class="fa fa-circle-o"></i>Article</a></li>
                    <li @if ($active == 'albums') class="active" @endif><a href="/admin/albums/index"><i class="fa fa-circle-o"></i>Album</a></li>
                    <li @if ($active == 'photos') class="active" @endif><a href="/admin/photos/index"><i class="fa fa-circle-o"></i>Photo</a></li>
                    <li @if ($active == 'softwares') class="active" @endif><a href="/admin/softwares/index"><i class="fa fa-circle-o"></i>Software</a></li>

                </ul>
            </li>

            <li>
                <a href="/admin/calendar/index">
                    <i class="fa fa-calendar"></i> <span>Calendar</span>
                    <span class="pull-right-container">
            </span>
                </a>
            </li>

            <li @if ($active == 'links') class="active" @endif><a href="/admin/links/index"><i class="fa fa-book"></i> <span>Links</span></a></li>
            <li @if ($active == 'profile') class="active" @endif><a href="/admin/profile/index"><i class="fa fa-book"></i> <span>Profile</span></a></li>



            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>