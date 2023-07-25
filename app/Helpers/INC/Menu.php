<?php
$data = [
    [
        'title'         => 'Settings',
        'icon'          => 'grid',
        'order'         => 1,
        'permission'    => 'settings',
        'items'         => [
            [
                'title'         => 'General Settings',
                'url'           => route('app.settings.config'),
                'permission'    => 'config'
            ],
            [
                'title'         => 'Socials Settings',
                'url'           => route('app.settings.social'),
                'permission'    => 'social'
            ],
            [
                'title'         => 'Maintenance Mode',
                'url'           => route('app.settings.maintenance'),
                'permission'    => 'maintenance'
            ]
        ]
    ],
    [
        'title'         => 'Roles',
        'icon'          => 'grid',
        'order'         => 2,
        'permission'    => 'roles',
        'items'         => [
            [
                'title'         => 'All Roles',
                'url'           => route('app.roles.index'),
                'permission'    => 'view'
            ],
            [
                'title'         => 'Add New Role',
                'url'           => route('app.roles.create'),
                'permission'    => 'create'
            ]
        ],
    ],
    [
        'title'         => 'Admins',
        'icon'          => 'grid',
        'order'         => 3,
        'permission'    => 'admins',
        'items'         => [
            [
                'title'         => 'All Admins',
                'url'           => route('app.admins.index'),
                'permission'    => 'view'
            ],
            [
                'title'         => 'Activations',
                'url'           => route('app.admins.index').'?type=active',
                'permission'    => 'view'
            ],
            [
                'title'         => 'Un Activations',
                'url'           => route('app.admins.index').'?type=unactive',
                'permission'    => 'view'
            ],
            [
                'title'         => 'Deleted',
                'url'           => route('app.admins.index').'?type=deleted',
                'permission'    => 'view'
            ],
            [
                'title'         => 'Add New Admin',
                'url'           => route('app.admins.create'),
                'permission'    => 'create'
            ]
        ]
    ],
    [
        'title'         => 'Clients',
        'icon'          => 'grid',
        'order'         => 4,
        'permission'    => 'clients',
        'items'         => [
            [
                'title'         => 'All Clients',
                'url'           => route('app.clients.index'),
                'permission'    => 'view'
            ],
            [
                'title'         => 'Activations',
                'url'           => route('app.clients.index').'?type=active',
                'permission'    => 'view'
            ],
            [
                'title'         => 'Un Activations',
                'url'           => route('app.clients.index').'?type=unactive',
                'permission'    => 'view'
            ],
            [
                'title'         => 'Deleted',
                'url'           => route('app.clients.index').'?type=deleted',
                'permission'    => 'view'
            ],
            [
                'title'         => 'Add New Client',
                'url'           => route('app.clients.create'),
                'permission'    => 'create'
            ]
        ]
    ],
    [
        'title'         => 'Companies',
        'icon'          => 'grid',
        'order'         => 5,
        'permission'    => 'companies',
        'items'         => [
            [
                'title'         => 'All Companies',
                'url'           => route('app.companies.index'),
                'permission'    => 'view'
            ],
            [
                'title'         => 'Activations',
                'url'           => route('app.companies.index').'?type=active',
                'permission'    => 'view'
            ],
            [
                'title'         => 'Un Activations',
                'url'           => route('app.companies.index').'?type=unactive',
                'permission'    => 'view'
            ],
            [
                'title'         => 'Deleted',
                'url'           => route('app.companies.index').'?type=deleted',
                'permission'    => 'view'
            ],
            [
                'title'         => 'Add New Company',
                'url'           => route('app.companies.create'),
                'permission'    => 'create'
            ]
        ]
    ],
    [
        'title'         => 'Categories',
        'icon'          => 'grid',
        'order'         => 6,
        'permission'    => 'categories',
        'items'         => [
            [
                'title'         => 'All Categories',
                'url'           => route('app.categories.index'),
                'permission'    => 'view'
            ],
            [
                'title'         => 'Add New Category',
                'url'           => route('app.categories.create'),
                'permission'    => 'create'
            ]
        ]
    ],
    [
        'title'         => 'Brands',
        'icon'          => 'grid',
        'order'         => 7,
        'permission'    => 'brands',
        'items'         => [
            [
                'title'         => 'All Brands',
                'url'           => route('app.brands.index'),
                'permission'    => 'view'
            ],
            [
                'title'         => 'Add New Brand',
                'url'           => route('app.brands.create'),
                'permission'    => 'create'
            ]
        ]
    ],
    [
        'title'         => 'Products',
        'icon'          => 'grid',
        'order'         => 8,
        'permission'    => 'products',
        'items'         => [
            [
                'title'         => 'All Products',
                'url'           => route('app.products.index'),
                'permission'    => 'view'
            ],
            [
                'title'         => 'Add New Product',
                'url'           => route('app.products.create'),
                'permission'    => 'create'
            ]
        ]
    ],
    [
        'title'         => 'Banners',
        'icon'          => 'grid',
        'order'         => 9,
        'permission'    => 'banners',
        'items'         => [
            [
                'title'         => 'All Banners',
                'url'           => route('app.banners.index'),
                'permission'    => 'view'
            ],
            [
                'title'         => 'Add New Banner',
                'url'           => route('app.banners.create'),
                'permission'    => 'create'
            ]
        ]
    ],
    [
        'title'         => 'Shipping Companies',
        'icon'          => 'grid',
        'order'         => 10,
        'permission'    => 'shipping_companies',
        'items'         => [
            [
                'title'         => 'All Shipping Companies',
                'url'           => route('app.shipping_companies.index'),
                'permission'    => 'view'
            ],
            [
                'title'         => 'Add New Shipping Company',
                'url'           => route('app.shipping_companies.create'),
                'permission'    => 'create'
            ]
        ]
    ],
    [
        'title'         => 'Coupons',
        'icon'          => 'grid',
        'order'         => 11,
        'permission'    => 'coupons',
        'items'         => [
            [
                'title'         => 'All Coupons',
                'url'           => route('app.coupons.index'),
                'permission'    => 'view'
            ],
            [
                'title'         => 'Add New Coupon',
                'url'           => route('app.coupons.create'),
                'permission'    => 'create'
            ]
        ]
    ],
    [
        'title'         => 'Orders',
        'icon'          => 'grid',
        'order'         => 12,
        'permission'    => 'orders',
        'items'         => [
            [
                'title'         => 'All Orders',
                'url'           => route('app.orders.index'),
                'permission'    => 'view'
            ],
            // [
            //     'title'         => 'All Orders',
            //     'url'           => route('app.orders.index'),
            //     'permission'    => 'view'
            // ]
        ]
    ],
    [
        'title'         => 'Banks',
        'icon'          => 'grid',
        'order'         => 13,
        'permission'    => 'banks',
        'items'         => [
            [
                'title'         => 'All Banks',
                'url'           => route('app.banks.index'),
                'permission'    => 'view'
            ],
            [
                'title'         => 'Add New Bank',
                'url'           => route('app.banks.create'),
                'permission'    => 'create'
            ]
        ]
    ],
];
return $data;
