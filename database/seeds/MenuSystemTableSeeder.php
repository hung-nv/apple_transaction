<?php

use Illuminate\Database\Seeder;

class MenuSystemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_system')->insert([
            ['label' => 'Id Apple', 'icon' => 'icon-handbag', 'route' => 'apple', 'parent_id' => null, 'sort' => 0, 'show' => '1,2'],
            ['label' => 'Insert', 'icon' => 'icon-plus', 'route' => 'apple.create', 'parent_id' => 1, 'sort' => 1, 'show' => '1,2'],
            ['label' => 'All', 'icon' => 'icon-list', 'route' => 'apple.index', 'parent_id' => 1, 'sort' => 2, 'show' => '1,2'],

            ['label' => 'Credit Card', 'icon' => 'icon-credit-card', 'route' => 'creditCard', 'parent_id' => null, 'sort' => 1, 'show' => '1,2'],
            ['label' => 'Insert', 'icon' => 'icon-plus', 'route' => 'creditCard.create', 'parent_id' => 4, 'sort' => 1, 'show' => '1,2'],
            ['label' => 'All', 'icon' => 'icon-list', 'route' => 'creditCard.index', 'parent_id' => 4, 'sort' => 2, 'show' => '1,2'],

            ['label' => 'Serial', 'icon' => 'icon-wallet', 'route' => 'serial', 'parent_id' => null, 'sort' => 2, 'show' => '1,2'],
            ['label' => 'Insert', 'icon' => 'icon-plus', 'route' => 'serial.create', 'parent_id' => 7, 'sort' => 1, 'show' => '1,2'],
            ['label' => 'All', 'icon' => 'icon-list', 'route' => 'serial.index', 'parent_id' => 7, 'sort' => 2, 'show' => '1,2'],

            ['label' => 'iPhone Information', 'icon' => 'icon-info', 'route' => 'iphoneInformation', 'parent_id' => null, 'sort' => 3, 'show' => '1,2'],
            ['label' => 'Insert', 'icon' => 'icon-plus', 'route' => 'iphoneInformation.create', 'parent_id' => 10, 'sort' => 1, 'show' => '1,2'],
            ['label' => 'All', 'icon' => 'icon-list', 'route' => 'iphoneInformation.index', 'parent_id' => 10, 'sort' => 2, 'show' => '1,2'],

            ['label' => 'Id purchase', 'icon' => 'icon-diamond ', 'route' => 'idPurchase.index', 'parent_id' => null, 'sort' => 4, 'show' => '1,2'],

            ['label' => 'Transaction', 'icon' => 'icon-list', 'route' => 'idTransaction.index', 'parent_id' => null, 'sort' => 6, 'show' => '1,2'],

            ['label' => 'Users', 'icon' => 'icon-user', 'route' => 'user', 'parent_id' => null, 'sort' => 7, 'show' => '1'],
            ['label' => 'Create User', 'icon' => 'icon-user-follow', 'route' => 'user.create', 'parent_id' => 15, 'sort' => 1, 'show' => '1'],
            ['label' => 'All', 'icon' => 'icon-users', 'route' => 'user.index', 'parent_id' => 15, 'sort' => 2, 'show' => '1'],

            ['label' => 'Statistic', 'icon' => 'icon-graph ', 'route' => 'idTransaction.statistic', 'parent_id' => null, 'sort' => 5, 'show' => '1,2'],
        ]);
    }
}
