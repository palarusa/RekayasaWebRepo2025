<?php

namespace App\Main;

class SideMenu
{
    /**
     * List of side menu items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function menu()
    {
        return [
            'dashboard' => [
                'icon' => 'home',
                'title' => 'Dashboard',
                'sub_menu' => [
                    'dashboardindex' => [
                        'icon' => '',
                        'route_name' => 'dashboardindex',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Data Buku'
                    ],
                ],
            ]
        ];
    }
}
