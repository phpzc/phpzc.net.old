<div id="sidebar" class="">
    <div class="scrollbar">
        <div class="track">
            <div class="thumb">
                <div class="end"></div>
            </div>
        </div>
    </div>
    <div class="viewport ">
        <div class="overview collapse">
            <div class="search row-fluid container">
                <h2>Search</h2>
                <form class="form-search">
                    <div class="input-append">
                        <input type="text" class=" search-query" placeholder="">
                        <button class="btn_search color_4">Search</button>
                    </div>
                </form>
            </div>
            <ul id="sidebar_menu" class="navbar nav nav-list container full">
                <li class="accordion-group active color_4"> <a class="dashboard " href="/"><img src="{{ WIN8('img/menu_icons/dashboard.png') }}"><span>Dashboard</span></a> </li>
                <li class="accordion-group color_7"> <a class="accordion-toggle widgets collapsed " data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse1"> <img src="{{ WIN8('img/menu_icons/forms.png') }}"><span>Elements</span></a>
                    <ul id="collapse1" class="accordion-body collapse">
                        <li><a href="/admin/articles/index">Article</a></li>
                        <li><a href="">Album</a></li>
                        <li><a href="">Photo</a></li>
                        <li><a href="">Software</a></li>
                    </ul>
                </li>
                <!--<li class="accordion-group color_3"> <a class="accordion-toggle widgets collapsed" data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse2"> <img src="{{ WIN8('img/menu_icons/widgets.png') }}"><span>UI Widgets</span></a>
                    <ul id="collapse2" class="accordion-body collapse">
                        <li><a href="ui_buttons.html">Buttons</a></li>
                        <li><a href="ui_dialogs.html">Dialogs</a></li>
                        <li><a href="ui_icons.html">Icons</a></li>
                        <li><a href="ui_tabs.html">Tabs</a></li>
                        <li><a href="ui_accordion.html">Accordion</a></li>
                    </ul>
                </li>-->
                <li class="color_13"> <a class="widgets" href="calendar2.html"> <img src="{{ WIN8('img/menu_icons/calendar.png') }}"><span>Calendar</span></a> </li>
                <!--<li class="color_10"> <a class="widgets"data-parent="#sidebar_menu" href="maps.html"> <img src="{{ WIN8('img/menu_icons/maps.png') }}"><span>Maps</span></a> </li>-->
                <li class="accordion-group color_12"> <a class="accordion-toggle widgets collapsed" data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse3"> <img src="{{ WIN8('img/menu_icons/tables.png') }}"><span>Tables</span></a>
                    <ul id="collapse3" class="accordion-body collapse">
                        <li><a href="tables_static.html">Static</a></li>
                        <li><a href="tables_dynamic.html">Dynamics</a></li>
                    </ul>
                </li>
                <li class="accordion-group color_19"> <a class="accordion-toggle widgets collapsed" data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse4"> <img src="{{ WIN8('img/menu_icons/statistics.png') }}"><span>Charts</span></a>
                    <ul id="collapse4" class="accordion-body collapse">
                        <li><a href="statistics.html">Statistics Elements</a></li>
                        <li><a href="charts.html">Charts</a></li>
                    </ul>
                </li>
                <!--<li class="color_24"> <a class="widgets"data-parent="#sidebar_menu" href="grid.html"> <img src="{{ WIN8('img/menu_icons/grid.png') }}"><span>Grid</span></a> </li>-->
                <li class="color_8"> <a class="widgets"data-parent="#sidebar_menu" href="media.html"> <img src="{{ WIN8('img/menu_icons/gallery.png') }}"><span>Media</span></a> </li>
                <!--<li class="color_4"> <a class="widgets"data-parent="#sidebar_menu" href="file_explorer.html"> <img src="{{ WIN8('img/menu_icons/explorer.png') }}"><span>File Explorer</span>  </a> </li>-->
                <li class="accordion-group color_25"> <a class="accordion-toggle widgets collapsed" data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse5"> <img src="{{ WIN8('img/menu_icons/others.png') }}"><span>Specific Pages</span></a>
                    <ul id="collapse5" class="accordion-body collapse">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="search.html">Search</a></li>
                        <li><a href="index2.html">Login</a></li>
                        <li><a href="404.html">404 Error</a></li>
                        <li ><a href="blog.html">Blog</a></li>
                    </ul>
                </li>
            </ul>
            <div class="menu_states row-fluid container ">
                <h2 class="pull-left">Menu Settings</h2>
                <div class="options pull-right">
                    <button id="menu_state_1" class="color_4" rel="tooltip" data-state ="sidebar_icons" data-placement="top" data-original-title="Icon Menu">1</button>
                    <button id="menu_state_2" class="color_4 active" rel="tooltip" data-state ="sidebar_default" data-placement="top" data-original-title="Fixed Menu">2</button>
                    <button id="menu_state_3" class="color_4" rel="tooltip" data-placement="top" data-state ="sidebar_hover" data-original-title="Floating on Hover Menu">3</button>
                </div>
            </div>
            <!-- End sidebar_box -->

        </div>
    </div>
</div>