<?php


use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        
        $admins = [
            [
                'fname' => 'Prejith',
                'lname' => 'Sajeevan',
                'email' => 'prejith@vistasglobal.com'
            ],
            [
                'fname' => 'Suresh',
                'lname' => 'Moment',
                'email' => 'suresh@momentaglobal.com'
            ],
            [
                'fname' => 'Fmaal',
                'lname' => 'Malik',
                'email' => 'fmaalmalki@qf.org.qa'
            ],
            
        ];
        
        foreach($admins as $admin){
            $user = User::where("email", $admin['email'])->count();

            if ($user == 0){
                User::create([
                    "first_name" => $admin['fname'],
                    "last_name" => $admin['lname'],
                    "password" => Hash::make("abc@123"),
                    "email" => $admin['email'],
                    "status" => 1,
                    "verified" => 1,
                    "roll" => 1
                ]);
            }
        }
    
        
        Model::reguard();
    }
}
