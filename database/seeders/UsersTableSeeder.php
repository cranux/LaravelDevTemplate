<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\Models\User::class,6)->create();
        DB::table('users')->truncate();
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('123456'),
                'remember_token' => Str::random(10),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' =>  \Carbon\Carbon::now(),
            ],
            [
                'name' => 'test',
                'email' => 'test@test.com',
                'password' => bcrypt('123456'),
                'remember_token' => Str::random(10),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' =>  \Carbon\Carbon::now(),
            ],
        ]);
    }
}
