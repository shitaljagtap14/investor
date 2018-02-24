<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ @$user->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>

                
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="active menu-open">
                <a href="{{ url('home') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                   <i class="fa fa-pie-chart"></i>
                    <span>User</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('user/add') }}"><i class="fa fa-circle-o"></i>New User</a></li>
                    <li><a href="{{ url('user') }}"><i class="fa fa-circle-o"></i>View User</a></li>

                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>Role</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('role/add') }}"><i class="fa fa-circle-o"></i>Add Role</a></li>
                    <li><a href="{{ url('role') }}"><i class="fa fa-circle-o"></i>View Role</a></li>

                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>Subscription</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('subscription/add') }}"><i class="fa fa-circle-o"></i>Add</a></li>
                    <li><a href="{{ url('subscription') }}"><i class="fa fa-circle-o"></i>View</a></li>
                </ul>
            </li>




            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>Sweepstakes</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('sweepstakes/add') }}"><i class="fa fa-circle-o"></i>Add</a></li>
                    <li><a href="{{ url('sweepstakes') }}"><i class="fa fa-circle-o"></i>View</a></li>
                     <li><a href="{{ url('sweeptakesjoin/add') }}"><i class="fa fa-circle-o"></i>Add Join Sweeptake</a></li>
                    <li><a href="{{ url('sweeptakesjoin') }}"><i class="fa fa-circle-o"></i>View Join Sweeptake</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i><span>Purchase</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('purchase/add') }}"><i class="fa fa-circle-o"></i> Add</a></li>
                    <li><a href="{{ url('purchase') }}"><i class="fa fa-circle-o"></i> View</a></li>
                    <li><a href="{{ url('extrasweeptake/add') }}"><i class="fa fa-circle-o"></i> Add Extra Sweeptake</a></li>
                    <li><a href="{{ url('extrasweeptake') }}"><i class="fa fa-circle-o"></i> View Extra Sweeptake</a></li>

                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>Winner</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('participate/sweeptake/user') }}"><i class="fa fa-circle-o"></i>Show SweeptakeJoinUser</a></li>

                </ul>
            </li>
        
            <!-- <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>Plan</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('participate/user') }}"><i class="fa fa-circle-o"></i>Show User</a></li>

                </ul>
            </li> -->

        </ul>
    </section>
</aside>