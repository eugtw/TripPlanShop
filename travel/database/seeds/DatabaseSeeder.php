<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Itinerary;
use App\User;
use App\Profile;
use App\TravelStyle;
use App\ItiDay;
use App\City;
use App\Country;
use App\ItineraryStyle;
use App\CityItinerary;
use App\Region;
use App\ItiItem;
use App\Experience;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('ExperienceTableSeeder');
		$this->call('StylesTableSeeder');
		$this->call('ItiItemTableSeeder');

		$this->call('UserTableSeeder');
		$this->call('ProfileTableSeeder');

		$this->call('CountryTableSeeder');
		$this->call('CityTableSeeder');


		$this->call('LocationTableSeeder');

		$this->call('RegionTableSeeder');
		$this->call('ItineraryTableSeeder');
		$this->call('DayTableSeeder');


		$this->call('ItineraryStyleTableSeeder');
		$this->call('CityItineraryTableSeeder');



	}

}
class ExperienceTableSeeder extends Seeder
{
	public function run()
	{
		DB::table('experiences')->delete();

		Experience::create([
			'experience' => 'Cruise'
		]);
		Experience::create([
			'experience' => 'Rail'
		]);
		Experience::create([
			'experience' => 'Spa'
		]);


		Experience::create([
			'experience' => 'Food'
		]);
		Experience::create([
			'experience' => 'Extreme Sports'
		]);
		Experience::create([
			'experience' => 'Water Sports'
		]);
		Experience::create([
			'experience' => 'Winter Sports'
		]);
		Experience::create([
			'experience' => 'Golfing'
		]);
		Experience::create([
			'experience' => 'Hiking'
		]);
		Experience::create([
			'experience' => 'Fishing'
		]);
		Experience::create([
			'experience' => 'Outdoor Activity'
		]);
		Experience::create([
			'experience' => 'Art, Culture, & History'
		]);
		Experience::create([
		'experience' => 'Market, Wine, & Food'
		]);
		Experience::create([
			'experience' => 'Beach'
		]);
		Experience::create([
		'experience' => 'Park & Garden'
		]);
		Experience::create([
		'experience' => 'Mountain'
		]);
		Experience::create([
		'experience' => 'Camping'
		]);
		Experience::create([
		'experience' => 'Concert & Show'
		]);
		Experience::create([
		'experience' => 'Festival & Event'
		]);
		Experience::create([
			'experience' => 'Casino'
		]);
		Experience::create([
			'experience' => 'Sports Game'
		]);
		Experience::create([
			'experience' => 'Night Life & Party'
		]);
		Experience::create([
			'experience' => 'Zoo & Aquarium'
		]);
		Experience::create([
			'experience' => 'Amusement Park'
		]);

		Experience::create([
			'experience' => 'Sightseeing'
		]);
		Experience::create([
			'experience' => 'Shopping'
		]);
		Experience::create([
			'experience' => 'Entertainment'
		]);
	}
}
class ItiItemTableSeeder extends Seeder
{
	public function run()
	{
		DB::table('iti_items')->delete();

		ItiItem::create([
			'item' => 'Personal Experience of Author'
		]);
		ItiItem::create([
			'item' => 'Map'
		]);
		ItiItem::create([
			'item' => 'Detailed Daily Schedule'
		]);
		ItiItem::create([
			'item' => 'Budget Breakdown'
		]);
		ItiItem::create([
			'item' => 'Useful Links'
		]);
		ItiItem::create([
			'item' => 'Food & Restaurants'
		]);
		ItiItem::create([
			'item' => 'Area to Stay'
		]);
		ItiItem::create([
			'item' => 'Shopping'
		]);
		ItiItem::create([
			'item' => 'Tour Services'
		]);

		ItiItem::create([
			'item' => 'Introduction'
		]);
		ItiItem::create([
			'item' => 'What to Do'
		]);
		ItiItem::create([
			'item' => 'Approximate Stay-duration'
		]);
		ItiItem::create([
			'item' => 'Address'
		]);
		ItiItem::create([
			'item' => 'Transportation Details'
		]);
		ItiItem::create([
			'item' => 'Open Hours & Admissions'
		]);
		ItiItem::create([
			'item' => "Visitor's Tips"
		]);


	}
}
class RegionTableSeeder extends Seeder
{
	public function run()
	{
		DB::table('regions')->delete();

		Region::create([
			'region'=>'USA & Canada'
		]);
		Region::create([
			'region'=>'Europe'
		]);
		Region::create([
			'region'=>'Mexico / C. & S. America'
		]);
		Region::create([
			'region'=>'Asia'
		]);
		Region::create([
			'region'=>'Austrailia, NewZealand & The Pacific'
		]);
		Region::create([
			'region'=>'Africa / The Middle East'
		]);
		Region::create([
			'region'=>'Polar Regions'
		]);
	}
}


class CityItineraryTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('city_itinerary')->delete();

		CityItinerary::create([
			'itinerary_id' => Itinerary::first()->id,
			'city_id' => City::first()->id
		]);
		CityItinerary::create([
			'itinerary_id' => Itinerary::first()->id+1,
			'city_id' => City::first()->id+3
		]);
		CityItinerary::create([
			'itinerary_id' => Itinerary::first()->id+2,
			'city_id' => City::first()->id+1
		]);
		CityItinerary::create([
			'itinerary_id' => Itinerary::first()->id+3,
			'city_id' => City::first()->id+2
		]);
	}

}

class ItineraryStyleTableSeeder extends Seeder
{
	public function run()
	{
		DB::table('itinerary_style')->delete();

		ItineraryStyle::create([
			'itinerary_id' => Itinerary::first()->id,
			'style_id' => TravelStyle::first()->id
		]);
		ItineraryStyle::create([
			'itinerary_id' => Itinerary::first()->id,
			'style_id' => TravelStyle::first()->id + 1
		]);
		ItineraryStyle::create([
			'itinerary_id' => Itinerary::first()->id,
			'style_id' => TravelStyle::first()->id+2
		]);


		ItineraryStyle::create([
			'itinerary_id' => Itinerary::first()->id + 1,
			'style_id' => TravelStyle::first()->id
		]);
		ItineraryStyle::create([
			'itinerary_id' => Itinerary::first()->id + 1,
			'style_id' => TravelStyle::first()->id + 3
		]);
		ItineraryStyle::create([
			'itinerary_id' => Itinerary::first()->id + 1,
			'style_id' => TravelStyle::first()->id + 4
		]);
		ItineraryStyle::create([
			'itinerary_id' => Itinerary::first()->id + 1,
			'style_id' => TravelStyle::first()->id+5
		]);


		ItineraryStyle::create([
			'itinerary_id' => Itinerary::first()->id + 2,
			'style_id' => TravelStyle::first()->id
		]);
		ItineraryStyle::create([
			'itinerary_id' => Itinerary::first()->id + 2,
			'style_id' => TravelStyle::first()->id + 6
		]);
		ItineraryStyle::create([
			'itinerary_id' => Itinerary::first()->id + 2,
			'style_id' => TravelStyle::first()->id + 7
		]);
		ItineraryStyle::create([
			'itinerary_id' => Itinerary::first()->id + 2,
			'style_id' => TravelStyle::first()->id+8
		]);


		ItineraryStyle::create([
			'itinerary_id' => Itinerary::first()->id + 3,
			'style_id' => TravelStyle::first()->id +10
		]);
		ItineraryStyle::create([
			'itinerary_id' => Itinerary::first()->id + 3,
			'style_id' => TravelStyle::first()->id +11
		]);
		ItineraryStyle::create([
			'itinerary_id' => Itinerary::first()->id + 3,
			'style_id' => TravelStyle::first()->id +12
		]);
	}
}
class CityTableSeeder extends Seeder
{
	public function run()
	{
		DB::table('cities')->delete();

		City::create([
			'city' => 'Vancouver',
			'state' => 'BC',
			'country_id' => Country::first()->id
		]);
		City::create([
			'city' => 'Toronto',
			'state' => 'BC',
			'country_id' => Country::first()->id
		]);
		City::create([
			'city' => 'Montreal',
			'state' => 'BC',
			'country_id' => Country::first()->id
		]);
		City::create([
			'city' => 'Quebec',
			'state' => 'BC',
			'country_id' => Country::first()->id
		]);

	}
}

class CountryTableSeeder extends Seeder
{
	public function run()
	{
		DB::table('countries')->delete();

		Country::create([
			'country' => 'Canada'
		]);
		Country::create([
			'country' => 'United States'
		]);

	}
}
class LocationTableSeeder extends Seeder
{
	public function run()
	{
		/*
		DB::table('locations')->delete();

		Location::create([
			'city_id' => City::first()->id,
			'country_id' => Country::first()->id,
			'name' => 'Stanley Park'
		]);
		Location::create([
			'city_id' => City::first()->id,
			'country_id' => Country::first()->id,
			'name' => 'Granvill Island'
		]);
		Location::create([
			'city_id' => City::first()->id,
			'country_id' => Country::first()->id,
			'name' => 'Gas Town'
		]);
*/
	}
}

class DayTableSeeder extends Seeder
{
	public function run()
	{
		DB::table('itidays', 'id')->delete();

		ItiDay::create([
			'day_num' => 1,
			'itinerary_id' => Itinerary::first()->id,
			'title' => 'Sed velit mauris, vestibulum et orci vel',
			'intro' => 'Sed velit mauris, vestibulum et orci vel, eleifend luctus ex.
						Ut at orci condimentum, interdum est a, laoreet metus. Maecenas rutrum,
						ligula nec tincidunt suscipit, tellus ante luctus turpis,
						vitae placerat libero arcu congue sapien. Nam tincidunt in nisi ut scelerisque.',

		]);
		ItiDay::create([
			'day_num' => 2,
			'itinerary_id' => Itinerary::first()->id,
			'title' => 'Sed velit mauris, vestibulum et orci vel',
			'intro' => 'Sed velit mauris, vestibulum et orci vel, eleifend luctus ex.
						Ut at orci condimentum, interdum est a, laoreet metus. Maecenas rutrum,
						ligula nec tincidunt suscipit, tellus ante luctus turpis,
						vitae placerat libero arcu congue sapien. Nam tincidunt in nisi ut scelerisque.',

		]);
		ItiDay::create([
			'day_num' => 3,
			'itinerary_id' => Itinerary::first()->id,
			'title' => 'Sed velit mauris, vestibulum et orci vel',
			'intro' => 'Sed velit mauris, vestibulum et orci vel, eleifend luctus ex.
						Ut at orci condimentum, interdum est a, laoreet metus. Maecenas rutrum,
						ligula nec tincidunt suscipit, tellus ante luctus turpis,
						vitae placerat libero arcu congue sapien. Nam tincidunt in nisi ut scelerisque.',

		]);
		ItiDay::create([
			'day_num' => 1,
			'itinerary_id' => Itinerary::first()->id + 1,
			'title' => 'Sed velit mauris, vestibulum et orci vel',
			'intro' => 'Sed velit mauris, vestibulum et orci vel, eleifend luctus ex.
						Ut at orci condimentum, interdum est a, laoreet metus. Maecenas rutrum,
						ligula nec tincidunt suscipit, tellus ante luctus turpis,
						vitae placerat libero arcu congue sapien. Nam tincidunt in nisi ut scelerisque.',

		]);
		ItiDay::create([
			'day_num' => 2,
			'itinerary_id' => Itinerary::first()->id + 1,
			'title' => 'Sed velit mauris, vestibulum et orci vel',
			'intro' => 'Sed velit mauris, vestibulum et orci vel, eleifend luctus ex.
						Ut at orci condimentum, interdum est a, laoreet metus. Maecenas rutrum,
						ligula nec tincidunt suscipit, tellus ante luctus turpis,
						vitae placerat libero arcu congue sapien. Nam tincidunt in nisi ut scelerisque.',

		]);
		ItiDay::create([
			'day_num' => 1,
			'itinerary_id' => Itinerary::first()->id + 2,
			'title' => 'Sed velit mauris, vestibulum et orci vel',
			'intro' => 'Sed velit mauris, vestibulum et orci vel, eleifend luctus ex.
						Ut at orci condimentum, interdum est a, laoreet metus. Maecenas rutrum,
						ligula nec tincidunt suscipit, tellus ante luctus turpis,
						vitae placerat libero arcu congue sapien. Nam tincidunt in nisi ut scelerisque.',

		]);
		ItiDay::create([
			'day_num' => 1,
			'itinerary_id' => Itinerary::first()->id + 3,
			'title' => 'Sed velit mauris, vestibulum et orci vel',
			'intro' => 'Sed velit mauris, vestibulum et orci vel, eleifend luctus ex.
						Ut at orci condimentum, interdum est a, laoreet metus. Maecenas rutrum,
						ligula nec tincidunt suscipit, tellus ante luctus turpis,
						vitae placerat libero arcu congue sapien. Nam tincidunt in nisi ut scelerisque.',

		]);

	}
}

class ProfileTableSeeder extends Seeder
{
	public function run()
	{
		/*
		DB::table('profiles')->delete();
		Profile::create([
			'avatar' => ''
		]);*/
	}
}

class UserTableSeeder extends Seeder
{
	public function run()
	{
		DB::table('users')->delete();
		$user1 = User::create([
			'name' => 'Eugene',
			'email'=> 'eugene.hu55@gmail.com',
			'password'=> \Illuminate\Support\Facades\Hash::make('123456'),
			'active'=>1
			//'profile_id' => Profile::first()->id
		]);
		Profile::create(['user_id'=>$user1->id]);

		$user2 = User::create([
			'name' => 'omg',
			'email'=> 's901236@gmail.com',
			'password'=> \Illuminate\Support\Facades\Hash::make('123456'),
			'active'=>1,
			'stripe_active' => 1
			//'profile_id' => Profile::first()->id
		]);
		Profile::create(['user_id'=>$user2->id]);

		$user3 = User::create([
			'name' => 'shaw',
			'email'=> 'eugene.hu@sjrb.ca',
			'password'=> \Illuminate\Support\Facades\Hash::make('123456'),
			'active'=>1
			//'profile_id' => Profile::first()->id
		]);
		Profile::create(['user_id'=>$user3->id]);
	}
}


class ItineraryTableSeeder extends Seeder {

	public function run()
	{
		DB::table('itineraries')->delete();

		Itinerary::create([
			'user_id' => User::first()->id+1,
			'region_id' => Region::first()->id,
			'price'=> 5.9,
			'top_places' => "Eiffel Tower, Louvre's Museum, Notre-Dame, 'Jordan Ann Frand House",
			'title' => 'Great 5 day Canada Trip',
			'best_season' => 'March-September',
			'summary' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.
							Cras eget lectus porttitor, tincidunt odio quis, porta augue. Duis sodales arcu arcu,
							eu mollis felis consequat sagittis. ',

		]);
		Itinerary::create([
			'user_id' => User::first()->id+1,
			'region_id' => Region::first()->id+1,
			'price'=> 8.9,
			'top_places' => "Eiffel Tower, Louvre's Museum, Notre-Dame, 'Jordan Ann Frand House",
			'title' => 'Romantic Hawaii Honeymoon',
			'best_season' => 'March-September',
			'summary' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.
							Cras eget lectus porttitor, tincidunt odio quis, porta augue. Duis sodales arcu arcu,
							eu mollis felis consequat sagittis. Ut porta congue tortor sit amet ultricies.
							Etiam ut hendrerit justo. Curabitur congue, dui et finibus ultrices,
							ipsum dui interdum tortor, quis volutpat erat erat vel velit.',

		]);

		Itinerary::create([
			'user_id' => User::first()->id+1,
			'region_id' => Region::first()->id+2,
			'price'=> 10.0,
			'top_places' => "Eiffel Tower, Louvre's Museum, Notre-Dame, 'Jordan Ann Frand House",
			'title' => 'test 3 itinerary',
			'best_season' => 'March-September',
			'summary' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.
							Cras eget lectus porttitor, tincidunt odio quis, porta augue. Duis sodales arcu arcu,
							eu mollis felis consequat sagittis. ',

		]);
		Itinerary::create([
			'user_id' => User::first()->id+1,
			'region_id' => Region::first()->id+3,
			'price'=> 29.9,
			'top_places' => "Eiffel Tower, Louvre's Museum, Notre-Dame, 'Jordan Ann Frand House",
			'title' => 'test 4 itinerary',
			'best_season' => 'March-September',
			'summary' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.
							Cras eget lectus porttitor, tincidunt odio quis, porta augue. Duis sodales arcu arcu,
							eu mollis felis consequat sagittis. Ut porta congue tortor sit amet ultricies.
							Etiam ut hendrerit justo. Curabitur congue, dui et finibus ultrices,
							ipsum dui interdum tortor, quis volutpat erat erat vel velit.',

		]);

		Itinerary::create([
			'user_id' => User::first()->id+1,
			'region_id' => Region::first()->id+3,
			'price'=> 29.9,
			'top_places' => "Emprie State Building,
							New York Public Library,
							Broadway, Central Park,
							The Metropolitan Museum of Art,
							Lincoln Center for the Performing Arts Museum,
							Statue of Liberty,
							Brooklyn Bridge
",
			'title' => '3 Days in New York City ',
			'best_season' => 'all year',
			'summary' => 'Duis vitae orci vulputate, euismod massa bibendum, bibendum erat.
						Aenean tristique, lorem nec laoreet posuere, erat dolor ultricies risus,
						quis scelerisque mauris dui in tellus. Praesent rutrum tristique augue,
						eget convallis mi dignissim sed. Donec non sollicitudin sem. Cras at
						ultrices erat. Pellentesque porttitor dui sit amet mattis pharetra.
						Praesent pharetra in felis in consectetur.',

		]);

	}
}

class StylesTableSeeder extends Seeder
{
	protected $table = 's';
	public function run()
	{
		DB::table('travelstyles')->delete();

		TravelStyle::create([
		'style' => 'Adventurous',
		'popular' => '0'
		]);
		TravelStyle::create([
			'style' => 'Budget Backpacker',
			'popular' => '0'
		]);
		TravelStyle::create([
			'style' => 'Classic',
			'popular' => '0'
		]);
		TravelStyle::create([
			'style' => 'Easy Pace',
			'popular' => '0'
		]);
		TravelStyle::create([
			'style' => 'Extreme',
			'popular' => '0'
		]);
		TravelStyle::create([
			'style' => 'High Energy',
			'popular' => '0'
		]);
		TravelStyle::create([
			'style' => 'Like Locals',
			'popular' => '0'
		]);
		TravelStyle::create([
			'style' => 'Off the beaten path',
			'popular' => '0'
		]);
		TravelStyle::create([
			'style' => 'Marine',
			'popular' => '0'
		]);
		TravelStyle::create([
			'style' => 'Mountaineer',
			'popular' => '0'
		]);
		TravelStyle::create([
			'style' => 'Photography',
			'popular' => '0'
		]);
		TravelStyle::create([
			'style' => 'Serene',
			'popular' => '0'
		]);
		TravelStyle::create([
			'style' => 'Rail',
			'popular' => '0'
		]);
		TravelStyle::create([
			'style' => 'Cruise',
			'popular' => '0'
		]);




		TravelStyle::create([
			'style' => 'Couple & Romantic',
			'popular' => '1'
		]);
		TravelStyle::create([
			'style' => 'Family',
			'popular' => '1'
		]);
		TravelStyle::create([
			'style' => 'Friends & Party',
			'popular' => '1'
		]);
		TravelStyle::create([
			'style' => 'Urban Life',
			'popular' => '1'
		]);
		TravelStyle::create([
			'style' => 'Nature',
			'popular' => '1'
		]);
		TravelStyle::create([
			'style' => 'Intellectual',
			'popular' => '1'
		]);




		TravelStyle::create([
			'style' => 'Luxury',
			'popular' => '0'
		]);
		TravelStyle::create([
			'style' => 'Spa',
			'popular' => '0'
		]);



		TravelStyle::create([
			'style' => 'Honeymoon',
			'popular' => '0'
		]);

		TravelStyle::create([
			'style' => 'Shopping & Food',
			'popular' => '0'
		]);
		TravelStyle::create([
			'style' => 'Wkd Getaway',
			'popular' => '0'
		]);
		TravelStyle::create([
			'style' => 'Kid Friendly',
			'popular' => '0'
		]);
		TravelStyle::create([
			'style' => 'Senior',
			'popular' => '0'
		]);
		TravelStyle::create([
			'style' => 'Festival & Event',
			'popular' => '0'
		]);
		TravelStyle::create([
			'style' => 'Sports',
			'popular' => '0'
		]);
		TravelStyle::create([
			'style' => 'Events Plan',
			'popular' => '0'
		]);
	}
}


