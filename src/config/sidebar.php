<?php
$id = 1;

return [
    [
        'id'   => $id++,
        'title' => 'dashboard',
        'icon' => 'ph-duotone ph-gauge',
        'roles' => ['*'],
        'route' => null,                            // top-level link (null == '#!')
        // 'submenu' => [
        //     ['title' => 'Profile','route' => 'dashboard'],

        // ],
    ],
    // add more menu groups here…
];
