<!--**********************************
        Sidebar start
    ***********************************-->
<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label">Dashboard</li>
            <li class="mega-menu mega-menu-lg active">
                <a class="has-arrow" href="/home" aria-expanded="false">
                    <i class="mdi mdi-view-dashboard"></i><span class="nav-text">Dashboard</span><span class="badge bg-dpink text-white nav-badge"></span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="/home">All Models
                            @include('new.countall')</a>
                    </li>
                    <li><a href="/newmodels">New Models
                            @include('new.count')</a>
                    </li>
                </ul>

            </li>
            @if ( Auth::user()->superadmin )
                <li class="mega-menu mega-menu-lg">
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="mdi mdi-television-guide"></i>
                        <span class="nav-text">SuperAdmin</span>
                        <span class="badge bg-dpink text-white nav-badge"></span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('analytics', 'date') }}">Traffic Stats</a></li>
                        <li><a href="/twitterstats">Twitter Stats</a></li>
                        <li><a href="/modelsmanagement">Models Management</a></li>
                        <li><a href="/users">Users</a></li>
                    </ul>
                </li>
                </li>
                    @endif
            <li class="mega-menu mega-menu-sm"><a class="has-arrow" href="{{ url('/logout') }}" aria-expanded="false">
                    <i class="mdi mdi-page-layout-body"></i><span class="nav-text">Logout</span><span class="badge badge-success nav-badge"></span></a>

            </li>


        </ul>
    </div>
</div>
<!--**********************************
    Sidebar end
***********************************-->