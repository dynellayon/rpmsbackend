<?php

namespace Database\Seeders;
use App\Models\Role;
use App\Models\Evaluator;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name'=>'admin']);
        Role::create(['name'=>'evaluator']);
        Role::create(['name'=>'employee']);



         Position::create(['name'=>'Teacher I','type'=>'proficient']);
        Position::create(['name'=>'Teacher II','type'=>'proficient']);
        Position::create(['name'=>'Teacher III','type'=>'proficient']);
        Position::create(['name'=>'SPET I','type'=>'proficient']);
        Position::create(['name'=>'SPET II','type'=>'proficient']);
        Position::create(['name'=>'SPET III','type'=>'proficient']);
        Position::create(['name'=>'SPET IV','type'=>'proficient']);
        Position::create(['name'=>'SPET V','type'=>'proficient']);
        Position::create(['name'=>'Instructor I','type'=>'proficient']);
        Position::create(['name'=>'Instructor II','type'=>'proficient']);
        Position::create(['name'=>'Special Science Teacher I','type'=>'proficient']);
        Position::create(['name'=>'Special Science Teacher II','type'=>'proficient']);
        Position::create(['name'=>'Special Science Teacher III','type'=>'proficient']);
        Position::create(['name'=>'Special Science Teacher IV','type'=>'proficient']);
        Position::create(['name'=>'Special Science Teacher V','type'=>'proficient']);
          Position::create(['name'=>'Master Teacher I','type'=>'High proficient']);
          Position::create(['name'=>'Master Teacher II','type'=>'High proficient']);
          Position::create(['name'=>'Master Teacher III','type'=>'High proficient']);
          Position::create(['name'=>'Master Teacher IV','type'=>'High proficient']);
          Position::create(['name'=>'Superintendent','type'=>'High proficient']);
          Position::create(['name'=>'Supervisor','type'=>'High proficient']);
          Evaluator::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role_id' => 1,

        ]);
    }
}
