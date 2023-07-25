<?php

return [
    [
        'title'         => __('Roles'),
        'icon'          => 'fa fa-bar-chart-o',
        'color'         => 'blue',
        'url'           => route('app.roles.index'),
        'permission'    => 'roles',
        'count'         => \Spatie\Permission\Models\Role::where('guard_name', 'admin')->where('id', '<>', 1)->count()
    ],
    [
        'title'         => __('Admins'),
        'icon'          => 'fa fa-bar-chart-o',
        'color'         => 'blue',
        'url'           => route('app.admins.index'),
        'permission'    => 'admins',
        'count'         => \App\Models\User::where('type', 'admin')->where('id', '<>', 1)->where('is_active', 1)->count()
    ],
    [
        'title'         => __('Clients'),
        'icon'          => 'fa fa-bar-chart-o',
        'color'         => 'blue',
        'url'           => route('app.clients.index'),
        'permission'    => 'clients',
        'count'         => \App\Models\User::where('type', 'client')->where('is_active', 1)->count()
    ],
    [
        'title'         => __('Companies'),
        'icon'          => 'fa fa-bar-chart-o',
        'color'         => 'blue',
        'url'           => route('app.companies.index'),
        'permission'    => 'companies',
        'count'         => \App\Models\User::where('type', 'company')->where('is_active', 1)->count()
    ],
    [
        'title'         => __('Categories'),
        'icon'          => 'fa fa-bar-chart-o',
        'color'         => 'blue',
        'url'           => route('app.categories.index'),
        'permission'    => 'categories',
        'count'         => \App\Models\Categories\Category::where('is_active', 1)->count()
    ],
    [
        'title'         => __('Brands'),
        'icon'          => 'fa fa-bar-chart-o',
        'color'         => 'blue',
        'url'           => route('app.brands.index'),
        'permission'    => 'brands',
        'count'         => \App\Models\Brands\Brand::where('is_active', 1)->count()
    ],
    [
        'title'         => __('Products'),
        'icon'          => 'fa fa-bar-chart-o',
        'color'         => 'blue',
        'url'           => route('app.products.index'),
        'permission'    => 'products',
        'count'         => \App\Models\Products\Product::where('is_active', 1)->count()
    ],
    [
        'title'         => __('Banners'),
        'icon'          => 'fa fa-bar-chart-o',
        'color'         => 'blue',
        'url'           => route('app.banners.index'),
        'permission'    => 'banners',
        'count'         => \App\Models\Banners\Banner::where('is_active', 1)->count()
    ],
    [
        'title'         => __('Shipping Companies'),
        'icon'          => 'fa fa-bar-chart-o',
        'color'         => 'blue',
        'url'           => route('app.shipping_companies.index'),
        'permission'    => 'shipping_companies',
        'count'         => \App\Models\ShippingCompanies\ShippingCompany::where('is_active', 1)->count()
    ],
    [
        'title'         => __('Coupons'),
        'icon'          => 'fa fa-bar-chart-o',
        'color'         => 'blue',
        'url'           => route('app.coupons.index'),
        'permission'    => 'coupons',
        'count'         => \App\Models\Coupons\Coupon::where('is_active', 1)->count()
    ],
    [
        'title'         => __('Orders'),
        'icon'          => 'fa fa-bar-chart-o',
        'color'         => 'blue',
        'url'           => route('app.orders.index'),
        'permission'    => 'orders',
        'count'         => \App\Models\Orders\Order::count()
    ],
    [
        'title'         => __('Banks'),
        'icon'          => 'fa fa-bar-chart-o',
        'color'         => 'blue',
        'url'           => route('app.banks.index'),
        'permission'    => 'banks',
        'count'         => \App\Models\Banks\Bank::where('is_active', 1)->count()
    ],
];
