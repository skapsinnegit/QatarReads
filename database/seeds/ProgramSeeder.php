<?php


use App\Program;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();


            Program::create([
                "name" => "Family Reading Program",
                "cost" => 350,
                "recurring_cost" => 350,
                "start_age" => 9,
                "end_age" => 13,
                "max_subscription" => 50,
                "status" => 1,
            ]);

        Model::reguard();
    }
}
