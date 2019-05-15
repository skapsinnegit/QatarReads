<?php


use App\Children;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ChildrenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

            Children::create([
                "name" => "John",
                "parent_id" => 2,
                "dob" => "2019-05-29",
                "school" => "vins",
                "gender" => "Male",
                "institution" => "AU Management",
                "terms" => 1,
                "status" => 1,
            ]);

        Model::reguard();
    }
}
