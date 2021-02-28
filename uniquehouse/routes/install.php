<?php
namespace App\Models;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Route;

Route::get('/roles', function (){
    Role::truncate();

    Role::create(['name' => 'super-admin', 'display_name' => 'Super Admin']);
    Role::create(['name' => 'admin', 'display_name' => 'Administrators']);
    Role::create(['name' => 'editor', 'display_name' => 'Editor']);

    echo 'Roles created!';
});

Route::get('/super-admin', function (){
    $superAdminRoles = User::role('super-admin')->get();
    if ($superAdminRoles->count() == 0) {
        $superAdminUser = User::create([
            'name' => 'Super Admin',
            'email' => 'dung.hoang@innotech.vn',
            'password' => bcrypt('123456')
        ]);
        $superAdminUser->assignRole('super-admin');
        echo 'Super Admin created!';
    } else {
        User::role('super-admin')->delete();

        $superAdminUser = User::create([
            'name' => 'Super Admin',
            'email' => 'dung.hoang@innotech.vn',
            'password' => bcrypt('123456')
        ]);
        $superAdminUser->assignRole('super-admin');
        echo 'Super Admin created!';
    }
});
