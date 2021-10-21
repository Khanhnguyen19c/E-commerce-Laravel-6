<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Admin;
use App\Roles;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'admin_name' => $faker->name,
        'admin_email' => $faker->unique()->safeEmail,
        'admin_phone' => $faker->name,
        'admin_password' => 'c8c67466399f17b38e2311517e470c91', // password
     
    ];
});
$factory->afterCreating(Admin::class,function($admin,$faker){
    $roles =Roles::Where('name','user')->get();
    $admin->roles()->sync($roles->pluck('id_roles')->toArray()); //dong bo id role
});
