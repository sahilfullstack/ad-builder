<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session", "token"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'passport',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\User::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expire time is the number of minutes that the reset token should be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Roles
    |--------------------------------------------------------------------------
     */
    'roles' => [
        'guest' => [
            'name' => 'Guest',
            'priority' => 0,
            'permissions' => []
        ],
        'advertiser' => [
            'name' => 'Advertiser',
            'priority' => 20,
            'permissions' => [
                
            ]
        ],
        'analyst' => [
            'name' => 'Analyst',
            'priority' => 20,
            'permissions' => [
                
            ]
        ],
        'admin' => [
            'name' => 'Administrator',
            'priority' => 100,
            'permissions' => [
                // Temlates
                'template.manage',
                'layout.manage',
                'unit.manage',
                'unit.approve',
                'user.manage',

                // Personal Access Tokens
                'personal-access-token.manage',

                // User Subscriptions
                'subscription.manage',
            ]
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Permissions
    |--------------------------------------------------------------------------
     */
    'permissions' => [
        'template.manage' => [
            'name' => 'Create/update/delete a template.',
        ], 
        'layout.manage' => [
            'name' => 'Create/update/delete a layout.',
        ],        
        'unit.approve' => [
            'name' => 'Approve/Reject a unit.',
        ],
        'user.manage' => [
            'name' => 'Approve/Reject a user.',
        ],
        'unit.manage' => [
            'name' => 'View/Create/update/delete any unit.',
        ],
        'personal-access-token.manage' => [
            'name' => 'Create/delete a personal access token.',
        ],
        'subscription.manage' => [
            'name' => 'Create/delete/Update a user\'s Subscription.',
        ],
    ],
];
