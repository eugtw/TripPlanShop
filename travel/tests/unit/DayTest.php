<?php

use App\ItiDay;
use \Laracasts\Integrated\Services\Laravel\DatabaseTransactions as DatabaseTransactions;

class DayTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function itiDay_has_5_things()
    {
        $faker = \Faker\Factory::create();

        $itinerary =\App\Itinerary::all()->first();

        $newDay = ItiDay::create([
           'iti_id' => $itinerary->id,
            'day_num' => 2,//$itinerary->days()->count()+1,
            'title' => $faker->title,
            'map' => $faker->text(200)

        ]);

        $this->assertEquals($itinerary->id, $newDay->iti_id);
        //iti_id
        //day_num
        //intro
        //title
        //map
    }
}