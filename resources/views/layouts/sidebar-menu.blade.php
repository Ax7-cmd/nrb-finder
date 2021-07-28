<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <router-link to="/dashboard" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt blue"></i>
                <p>
                    Dashboard
                </p>
            </router-link>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-folder blue"></i>
                <p>
                    Direktorat
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <router-link to="/nrb" class="nav-link">
                        <i class="nav-icon fas fa-arrow-alt-circle-right green"></i>
                        <p>
                            NRB
                        </p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/rma" class="nav-link">
                        <i class="nav-icon fas fa-arrow-alt-circle-right green"></i>
                        <p>
                            RMA
                        </p>
                    </router-link>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <router-link to="/transportation" class="nav-link">
                <i class="fa fa-truck nav-icon orange"></i>
                <p>Transportation</p>
            </router-link>
        </li>

        <li class="nav-item">
            <router-link to="/warehouse" class="nav-link">
                <i class="fa fa-warehouse nav-icon green"></i>
                <p>Warehouse</p>
            </router-link>
        </li>

        <li class="nav-item">
            <router-link to="/accounting" class="nav-link">
                <i class="fa fa-file-alt nav-icon yellow"></i>
                <p>Accounting</p>
            </router-link>
        </li>

        <li class="nav-item">
            <router-link to="/finance" class="nav-link">
                <i class="fa fa-file-invoice nav-icon yellow"></i>
                <p>Finance</p>
            </router-link>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-power-off red"></i>
                <p>
                    {{ __('Logout') }}
                </p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>
