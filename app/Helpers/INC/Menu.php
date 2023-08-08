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
            ],
            [
                'title'         => 'Terms and Conditions',
                'url'           => route('app.settings.terms_and_conditions'),
                'permission'    => 'terms_and_conditions'
            ]
        ]
    ],
    [
        'title'         => 'Common Questions',
        'icon'          => 'grid',
        'order'         => 2,
        'permission'    => 'common_questions',
        'items'         => [
            [
                'title'         => 'All Common Questions',
                'url'           => route('app.common_questions.index'),
                'permission'    => 'view'
            ],
            [
                'title'         => 'Add New Common Question',
                'url'           => route('app.common_questions.create'),
                'permission'    => 'create'
            ]
        ]
    ],
    [
        'title'         => 'Help Center',
        'icon'          => 'grid',
        'order'         => 3,
        'permission'    => 'help_center',
        'items'         => [
            [
                'title'         => 'All Help Center',
                'url'           => route('app.help_center.index'),
                'permission'    => 'view'
            ],
            [
                'title'         => 'Add',
                'url'           => route('app.help_center.create'),
                'permission'    => 'create'
            ]
        ]
    ],
    [
        'title'         => 'Roles',
        'icon'          => 'grid',
        'order'         => 4,
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
        'order'         => 5,
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
        'order'         => 6,
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
        'title'         => 'Categories',
        'icon'          => 'grid',
        'order'         => 7,
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
        'order'         => 8,
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
        'order'         => 9,
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
            ],
            [
                'title'         => 'Add Quantity',
                'url'           => route('app.products.add_quantity'),
                'permission'    => 'add_quantity'
            ]
        ]
    ],
    [
        'title'         => 'Banners',
        'icon'          => 'grid',
        'order'         => 10,
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
        'title'         => 'Emails',
        'icon'          => 'grid',
        'order'         => 11,
        'permission'    => 'emails',
        'items'         => [
            [
                'title'         => 'All Emails',
                'url'           => route('app.emails.index'),
                'permission'    => 'view'
            ],
            [
                'title'         => 'Send Email',
                'url'           => route('app.emails.send'),
                'permission'    => 'send'
            ]
        ]
    ],
    [
        'title'         => 'Coupons',
        'icon'          => 'grid',
        'order'         => 12,
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
        'order'         => 13,
        'permission'    => 'orders',
        'items'         => [
            [
                'title'         => 'All Orders',
                'url'           => route('app.orders.index'),
                'permission'    => 'view'
            ],
        ]
    ],
    [
        'title'         => 'Claims',
        'icon'          => 'grid',
        'order'         => 14,
        'permission'    => 'claims',
        'items'         => [
            [
                'title'         => 'All Claims',
                'url'           => route('app.claims.index'),
                'permission'    => 'view'
            ]
        ]
    ],
    [
        'title'         => 'ContactUs',
        'icon'          => 'grid',
        'order'         => 15,
        'permission'    => 'contact_us',
        'items'         => [
            [
                'title'         => 'All ContactUs',
                'url'           => route('app.contactus.index'),
                'permission'    => 'view'
            ]
        ]
    ],
    [
        'title'         => 'Cities',
        'icon'          => 'grid',
        'order'         => 16,
        'permission'    => 'cities',
        'items'         => [
            [
                'title'         => 'All Cities',
                'url'           => route('app.cities.index'),
                'permission'    => 'view'
            ],
            [
                'title'         => 'Add New City',
                'url'           => route('app.cities.create'),
                'permission'    => 'create'
            ]
        ]
    ],
    [
        'title'         => 'Districts',
        'icon'          => 'grid',
        'order'         => 17,
        'permission'    => 'districts',
        'items'         => [
            [
                'title'         => 'All Districts',
                'url'           => route('app.districts.index'),
                'permission'    => 'view'
            ],
            [
                'title'         => 'Add New District',
                'url'           => route('app.districts.create'),
                'permission'    => 'create'
            ]
        ]
    ],
    [
        'title'         => 'Newsletters',
        'icon'          => 'grid',
        'order'         => 18,
        'permission'    => 'newsletters',
        'items'         => [
            [
                'title'         => 'Newsletters',
                'url'           => route('app.newsletters.index'),
                'permission'    => 'view'
            ]
        ]
    ],
    [
        'title'         => 'Payment Methods Images',
        'icon'          => 'grid',
        'order'         => 19,
        'permission'    => 'payment_methods_images',
        'items'         => [
            [
                'title'         => 'All Payment Methods Images',
                'url'           => route('app.payment_methods_images.index'),
                'permission'    => 'view'
            ],
            [
                'title'         => 'Add New Payment Methods Image',
                'url'           => route('app.payment_methods_images.create'),
                'permission'    => 'create'
            ]
        ]
    ],
    [
        'title'         => 'Offer Prices',
        'icon'          => 'grid',
        'order'         => 19,
        'permission'    => 'offer_prices',
        'items'         => [
            [
                'title'         => 'All Offer Prices',
                'url'           => route('app.offer_prices.index'),
                'permission'    => 'view'
            ]
        ]
    ],
];
return $data;
