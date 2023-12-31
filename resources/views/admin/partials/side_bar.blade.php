<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
        <img src="{{asset('admin/images/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Panel</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('admin/images/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Admin</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('category.index')}}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Category
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('sub_category.index')}}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Sub Category
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('brand.index')}}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Brand Name
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('product.index')}}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            products
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
