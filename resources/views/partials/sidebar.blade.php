<nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            @can("is_admin")
                <div class="sb-sidenav-menu-heading">Administrator</div>
                <a class="nav-link" href="/home">
                    <div class="sb-nav-link-icon"><i class="fas fa-fw fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link" href="/transaction">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-fw fa-dollar-sign"></i></div>
                    History Admin
                </a>
                <a class="nav-link" href="/product">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-fw fa-dumpster"></i></div>
                    Add Product
                </a>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-fw fa-columns"></i></div>
                    Order
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-fw fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="/order/order_data">Order Data</a>
                        <a class="nav-link" href="/order/order_history">Order History</a>
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">Customer</div>
                <a class="nav-link" href="/home/customers">
                    <div class="sb-nav-link-icon"><i class="fas fa-fw fa-solid fa-users"></i></div>
                    Customers
                </a>
                <a class="nav-link" href="/transaction">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-fw fa-dollar-sign"></i></div>
                    Transaksi
                </a>
                <div class="sb-sidenav-menu-heading">Supplier</div>
                <a class="nav-link" href="{{ route('admin.suppliers') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-truck"></i></div>
                    Suppliers
                </a>
                <a class="nav-link" href="{{ route('admin.addSupplierForm') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user-plus"></i></div>
                    Add Suppliers
                </a>
                

            @elsecan("is_supplier")
                <div class="sb-sidenav-menu-heading">Supplier</div>
                <a class="nav-link" href="/home/suppliers">
                    <div class="sb-nav-link-icon"><i class="fas fa-fw fa-home-alt"></i></i></div>
                    Dashboard
                </a>
                <a class="nav-link" href="{{ route('supplier.createProduct') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-plus"></i></div>
                    Add Items
                </a>
                <a class="nav-link" href="/product">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-clock-rotate-left"></i></div>
                    History
                </a>
            @else
                <div class="sb-sidenav-menu-heading">Customer</div>
                <a class="nav-link" href="/home">
                    <div class="sb-nav-link-icon"><i class="fas fa-fw fa-home-alt"></i></i></div>
                    Home
                </a>
                <a class="nav-link" href="/point/user_point">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-fw fa-paw"></i></div>
                    My Point
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link" href="/product">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-fw fa-dumpster"></i></div>
                    Product
                </a>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-fw fa-columns"></i></div>
                    Order
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-fw fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="/order/order_data">Order Data</a>
                        <a class="nav-link" href="/order/order_history">Order History</a>
                    </nav>
                </div>
            @endcan
            
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Currently logged in as:</div>
        {{ auth()->user()->role->role_name }}
    </div>
</nav>