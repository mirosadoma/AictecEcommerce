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
        'title'         => __('Claims'),
        'icon'          => 'fa fa-bar-chart-o',
        'color'         => 'blue',
        'url'           => route('app.claims.index'),
        'permission'    => 'claims',
        'count'         => \App\Models\Claims\Claim::count()
    ],
    [
        'title'         => __('ContactUs'),
        'icon'          => 'fa fa-bar-chart-o',
        'color'         => 'blue',
        'url'           => route('app.contactus.index'),
        'permission'    => 'contact_us',
        'count'         => \App\Models\ContactUs\ContactUs::count()
    ],
    [
        'title'         => __('Cities'),
        'icon'          => 'fa fa-bar-chart-o',
        'color'         => 'blue',
        'url'           => route('app.cities.index'),
        'permission'    => 'cities',
        'count'         => \App\Models\Cities\City::count()
    ],
    [
        'title'         => __('Newsletters'),
        'icon'          => 'fa fa-bar-chart-o',
        'color'         => 'blue',
        'url'           => route('app.newsletters.index'),
        'permission'    => 'newsletters',
        'count'         => \App\Models\Newsletters\Newsletter::count()
    ],
];
