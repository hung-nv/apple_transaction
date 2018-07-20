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
            ['label' => 'Id Apple', 'icon' => 'icon-handbag', 'route' => 'apple', 'sort' => 0, 'show' => '1,2'],
            ['label' => 'Insert Multi Id Apple', 'icon' => 'icon-plus', 'route' => 'apple.create', 'parent_id' => 1, 'sort' => 1, 'show' => '1,2'],
            ['label' => 'All', 'icon' => 'icon-list', 'route' => 'apple.index', 'parent_id' => 1, 'sort' => 2, 'show' => '1,2'],

            ['label' => 'Credit Card', 'icon' => 'icon-handbag', 'route' => 'creditCard', 'sort' => 1, 'show' => '1,2'],
            ['label' => 'Insert Multi Credit Card', 'icon' => 'icon-plus', 'route' => 'creditCard.create', 'parent_id' => 4, 'sort' => 1, 'show' => '1,2'],
            ['label' => 'All', 'icon' => 'icon-list', 'route' => 'creditCard.index', 'parent_id' => 4, 'sort' => 2, 'show' => '1,2'],

            ['label' => 'Serial', 'icon' => 'icon-handbag', 'route' => 'serial', 'sort' => 2, 'show' => '1,2'],
            ['label' => 'Insert Multi Serial', 'icon' => 'icon-plus', 'route' => 'serial.create', 'parent_id' => 7, 'sort' => 1, 'show' => '1,2'],
            ['label' => 'All', 'icon' => 'icon-list', 'route' => 'serial.index', 'parent_id' => 7, 'sort' => 2, 'show' => '1,2'],

            ['label' => 'iPhone Information', 'icon' => 'icon-handbag', 'route' => 'iphoneInformation', 'sort' => 3, 'show' => '1,2'],
            ['label' => 'Insert iPhone Information', 'icon' => 'icon-plus', 'route' => 'iphoneInformation.create', 'parent_id' => 10, 'sort' => 1, 'show' => '1,2'],
            ['label' => 'All', 'icon' => 'icon-list', 'route' => 'iphoneInformation.index', 'parent_id' => 10, 'sort' => 2, 'show' => '1,2'],

            ['label' => 'Id purchase', 'icon' => 'icon-handbag', 'route' => 'idPurchase', 'sort' => 4, 'show' => '1,2'],

            ['label' => 'Transaction', 'icon' => 'icon-list', 'route' => 'transaction', 'sort' => 5, 'show' => '1,2'],

            ['label' => 'Users', 'icon' => 'icon-user', 'route' => 'user', 'sort' => 6, 'show' => '1'],
            ['label' => 'Create User', 'icon' => 'icon-user-follow', 'route' => 'user.create', 'parent_id' => 15, 'sort' => 1, 'show' => '1'],
            ['label' => 'All', 'icon' => 'icon-users', 'route' => 'user.index', 'parent_id' => 15, 'sort' => 2, 'show' => '1'],
        ]);
    }
}
