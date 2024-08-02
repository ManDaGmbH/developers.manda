<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
  
class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name'=>'Cyber',
                'last_name'=>'User',
                'email'=>'zuber@cyberclouds.com',
                'password'=> 'cyber@2020',
                'status' => 1
        ]);
        
        //User::factory()->times(50)->create();
        
        $role = Role::create(['name'=>'Admin']);
     
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);
    }
}