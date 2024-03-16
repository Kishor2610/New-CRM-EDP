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
                <li><a class="treeview-item " href="{{route('invoice.create')}}" ><i class="icon fa fa-plus"></i>Create Invoice </a></li>
                <li><a class="treeview-item" href="{{route('invoice.index')}}"><i class="icon fa fa-edit"></i> Manage Invoice</a></li>

            </ul>
        </li>

        <li class="treeview "><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-quote-left"></i><span class="app-menu__label">Quatation</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item " href="#" ><i class="icon fa fa-plus"></i>Create Quatation </a></li>
                <li><a class="treeview-item" href="#"><i class="icon fa fa-edit"></i> Manage Quatation</a></li>
            </ul>
        </li>

        {{-- customer --}}
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Customer</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{route('customer.create')}}"><i class="icon fa fa-plus"></i> Add Customer</a></li>
                <li><a class="treeview-item" href="{{route('customer.index')}}"><i class="icon fa fa-edit"></i> Manage Customer</a></li>
            </ul>
        </li>

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-briefcase"></i><span class="app-menu__label">Product</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{route('product.create')}}"><i class="icon fa fa-plus"></i> New Product</a></li>
                <li><a class="treeview-item" href="{{route('product.index')}}"><i class="icon fa fa-edit"></i>Manage Products</a></li>
            </ul>
        </li>


        <li class="treeview "><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-industry"></i><span class="app-menu__label">Category</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item " href="{{route('category.create')}}"><i class="icon fa fa-plus"></i>Create Category</a></li>
                <li><a class="treeview-item" href="{{route('category.index')}}"><i class="icon fa fa-edit"></i>Manage Category</a></li>
            </ul>
        </li>

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-object-group"></i><span class="app-menu__label">Tax</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{route('tax.create')}}"><i class="icon fa fa-plus"></i> Add Tax</a></li>
                <li><a class="treeview-item" href="{{route('tax.index')}}"><i class="icon fa fa-edit"></i> Manage Taxs</a></li>
             </ul>
        </li>

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-handshake-o"></i><span class="app-menu__label">Supplier</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{route('supplier.create')}}"><i class="icon fa fa-plus"></i> Add Supplier</a></li>
                <li><a class="treeview-item" href="{{route('supplier.index')}}"><i class="icon fa fa-edit"></i> Manage Suppliers</a></li>
                <li><a class="treeview-item" href="{{route('raw_material.create')}}"><i class="icon fa fa-plus"></i> Add Raw Material</a></li>
                <li><a class="treeview-item" href="{{route('raw_material.index')}}"><i class="icon fa fa-edit"></i> Manage Raw Material</a></li>
            </ul>
        </li>

      





    </ul>

</aside>









