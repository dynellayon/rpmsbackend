<?php

namespace Database\Seeders;
use App\Models\kra;
use Illuminate\Database\Seeder;

class akras extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        kra::create(['name'=>'Content Knowledge and Pedagogy (PPST Domain 1)
']);
        kra::create(['name'=>'Learning Environment (PPST Domain 2)']);
        kra::create(['name'=>'. Learning Environment (PPST Domain 2) - continuation
']);
        kra::create(['name'=>'Diversity of Learners, Curriculum and Planning, & Assessment and Reporting
(PPST Domains 3, 4, and 5)
']);
        kra::create(['name'=>'. Community Linkages and Professional Engagement & Personal Growth and
Professional Development (PPST Domains 6 & 7)
']);
        kra::create(['name'=>'Plus Factor
']);
    }
}
