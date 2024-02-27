<div class="app-sidebar__overlay" data-toggle="sidebar"></div>

<aside class="app-sidebar">
    
    <div class="app-sidebar__user"><img width="40 px" class="app-sidebar__user-avatar" src="{{ asset('images/user/'.Auth::user()->image) }}" alt="User Image">

        <div>
            <p class="app-sidebar__user-name">{{ Auth::user()->fullname }}</p>
            <p class="app-sidebar__user-designation">Admin</p>
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item active" href="/"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        

        {{-- Invoice  --}}
        <li class="treeview "><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-indent"></i><span class="app-menu__label">Invoice</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item " href="#" ><i class="icon fa fa-plus"></i>Create Invoice </a></li>
            </ul>
        </li>

        {{-- customer --}}
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Customer</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{route('customer.create')}}"><i class="icon fa fa-circle-o"></i> Add Customer</a></li>
            </ul>
        </li>


    </ul>

</aside>