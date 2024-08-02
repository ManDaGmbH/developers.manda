<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
  
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           ['name' => 'user-list','page'=>'Users','title'=>'List'],
           ['name' => 'user-create','page'=>'Users','title'=>'Create'],
           ['name' => 'user-edit','page'=>'Users','title'=>'Edit'],
           ['name' => 'user-delete','page'=>'Users','title'=>'Delete'],
           ['name' => 'role-list','page'=>'Roles','title'=>'List'],
           ['name' => 'role-create','page'=>'Roles','title'=>'Create'],
           ['name' => 'role-edit','page'=>'Roles','title'=>'Edit'],
           ['name' => 'role-delete','page'=>'Roles','title'=>'Delete'],
        ];
       
     
        foreach ($permissions as $permission) {
             Permission::create($permission);
        }
    }
}