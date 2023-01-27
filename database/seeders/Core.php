<?php

namespace Database\Seeders;
use App\Models\Development;

use Illuminate\Database\Seeder;

class core extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Development::create(['corename'=>'Self-Management','description'=>'
1.Sets personal goals and directions, needs and development.
2.Undertakes personal actions and behavior that are clear and
purposive and takes into account personal goals and values
congruent to that of the organization.
3.Displays emotional maturity and enthusiasm for and is challenged
by higher goals.
4.Prioritizes work tasks and schedules (through Gantt charts,
checklists, etc.) to achieve goals.
5.Sets high quality, challenging, realistic goals for self and others.



            ']);
        Development::create(['corename'=>'Professionalism and Ethics','description'=>'
1.Demonstrates the values and behavior enshrined in the Norms
and Conduct and Ethical Standards for public officials and employees
(RA 6713).
2.Practices ethical and professional behavior and conduct taking into
account the impact of his/her actions and decisions.
3.Maintains a professional image: being trustworthy, regularity of
attendance and punctuality, good grooming and communication.
4.Makes personal sacrifices to meet the organization’s needs.
5.Act with a sense of urgency and responsibility to meet the
organization’s needs, improve system and help others improve their
effectiveness.

            ']);
        Development::create(['corename'=>'Results Focus','description'=>'
1.Achieves results with optimal use of time and resources most of
the time.
2.Avoids rework, mistakes and wastage through effective work
methods by placing organizational needs before personal needs.
3.Delivers error-free outputs most of the time by conforming to
standard operating procedures correctly and consistently. Able to
produce very satisfactory quality work in terms of
usefulness/acceptability and completeness with no supervision
required.
4.Expresses a desire to do better and may express frustration at
waste or inefficiency. May focus on new or more precise ways of
meeting goals set.  
5.Makes specific changes in the system or in own work methods to
improve performance. Examples may include doing something
better, faster, at a lower cost, more efficiently, or improving quality,
customer satisfaction, morale, without setting any specific goal.   
     ']);
        Development::create(['corename'=>'Teamwork','description'=>'
1.Willingly does his/her share of responsibility.
2.Promotes collaboration and removes barrier to teamwork and goal
accomplishment across the organization.
3.Applies negotiation principles in arriving at win-win agreements.
4.Drives consensus and team ownership of decisions.
5.Works constructively and collaboratively with others and across
organizations to accomplish organization goals and objectives.


            ']);
        Development::create(['corename'=>'Service Orientation','description'=>'
1.Can explain and articulate organizational directions, issues and
problems.
2.Takes personal responsibility for dealing with and/or correcting
customer service issues and concerns.
3.Initiates activities that promote advocacy for men and women
empowerment.
4.Participates in updating office vision, mission, mandates and
strategies based on DEPED strategies and directions.
5.Develops and adopts service improvement program through
simplified procedures that will further enhance service delivery


            ']);
        Development::create(['corename'=>'Innovation','description'=>'
1.Examines the root cause of problems and suggests effective
solutions. Foster new ideas, processes and suggests better ways to
do things (cost and/ or operational efficiency).
2.Demonstrates an ability to think “beyond the box”. Continuously
focuses on improving personal productivity to create higher value
and results
3.Promotes a creative climate and inspires co-workers to develop
original ideas or solutions.
4.Translates creative thinking into tangible changes and solutions
that improve the work unit and organization.
5.Uses ingenious methods to accomplish responsibilities.
Demonstrates resourcefulness and the ability to succeed with
minimal resources.



            ']);




    }
}
