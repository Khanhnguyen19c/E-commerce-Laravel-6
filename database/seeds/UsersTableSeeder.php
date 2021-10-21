<?php

use Illuminate\Database\Seeder;
use App\Admin;
use App\Roles;
use Illuminate\Support\Facades\DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Admin::truncate();
       DB::table('admin_roles')->truncate();
       $adminRoles = Roles::where('name','admin')->first();
       $authorRoles = Roles::where('name','author')->first();
       $userRoles = Roles::where('name','user')->first();
       $admin = Admin::create([
            'admin_name'=> 'Khánh Nguyễn',
            'admin_email' => 'khanhlunn224@gmail.com',
            'admin_phone'=>'0772879116',
            'admin_password'=> md5('101196p0')
       ]);
       $author = Admin::create([
        'admin_name'=> 'Khánh Biên Tập',
        'admin_email' => 'khanhlunn369@gmail.com',
        'admin_phone'=>'0772879116',
        'admin_password'=> md5('101196p0')
   ]);
   $user = Admin::create([
    'admin_name'=> 'Khánh User',
    'admin_email' => 'khanhnguyen@gmail.com',
    'admin_phone'=>'0772879116',
    'admin_password'=> md5('101196p0')
]);
$admin->roles()->attach($adminRoles); // tạo admin mang quyền admin
$author->roles()->attach($authorRoles);
$user->roles()->attach($userRoles);

factory(Admin::class,20)->create();
    }
}
