<?php namespace App\Http\Controllers;

use App\Experience;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDayCreateRequest;
use Illuminate\Support\Facades\Crypt;
use App\Itinerary;
use App\ItiDay;
use Illuminate\Database\Eloquent;

class ItiDayController extends Controller {


	public function edit(ItiDay $day)
	{
		$exp = Experience::all()->sortBy('experience')->lists('experience','id');

		return view('itineraryDay.dayEdit')
			->withExp($exp)
			->withDay($day);
	}

	public function update(StoreDayCreateRequest $request,ItiDay $day)
	{
		$itinerary = Itinerary::find($day->itinerary->id);

		$day->day_of_itinerary = $request->input('day_of_itinerary');
		//$day->title = $request->title;
		$day->image = preg_replace('|\\\|', '/', $request->input('image'));
		$day->budget = $request->budget;
		$day->day_cities = $request->day_cities;
		$day->places= $request->places;
		$day->top_exp = implode(',', $request->experience); //stores experience_ids from experience table
		$day->intro=$request->intro;
		$day->summary = $request->summary;


		//updating belongsTo relationship
		$day->itinerary()->associate($itinerary);
		$day->save();

		return redirect()->route('itinerary.show', [$itinerary]);
	}

	public function create(Request $request)
	{
		//passed from hidden input
		$iti_id = Crypt::decrypt($request->input('iti_id'));
		$itinerary = Itinerary::find($iti_id);
		$exp = Experience::all()->sortBy('experience')->lists('experience','id');

		return view('itineraryDay.dayCreate')
			->withExp($exp)
			->withItinerary($itinerary);

	}

	public function store(StoreDayCreateRequest $request)
	{
		//passed from hidden input
		$iti_id = Crypt::decrypt($request->input('iti_id'));
		$itinerary = Itinerary::find($iti_id);

		$day = new ItiDay([
			'day_of_itinerary' => $itinerary->days()->count() + 1,
			//'title' => $request->title,
			'image'=>preg_replace('|\\\|', '/', $request->input('image')),
			'budget' => $request->budget,
			'day_cities' => $request->day_cities,
			'places'=> $request->places,
			'top_exp' => implode(',', $request->experience), //stores experience_ids from experience table
			'intro'=>$request->intro,
			'summary' => $request->summary
		]);
		$itinerary->days()->save($day);

		return redirect()->route('itinerary.show', [$itinerary]);
	}


	/**get itinerary day create view
	 * @param $id
	 * @return \Illuminate\View\View
	 */
	public function getItinerary_day_create($id)
	{
		$itinerary = Itinerary::find($id);
		return view('itineraryDay.itineraryDayCreate')
			->withItinerary($itinerary);
	}

	/**
	 * @param Request $request
	 * @param $id, itinerary_id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postItinerary_day_create(StoreDayCreateRequest $request, $id)
	{

		//validation checked in FormRequest class

		$itinerary = Itinerary::find($id);

		$day = new ItiDay([
			'day_of_itinerary' => $itinerary->days()->count() + 1,
			'title' => $request->title,
			'budget' => $request->budget,
			'locations'=> $request->locations,
			'transportation'=>$request->transportation,
			'intro'=>$request->intro,
			'summary' => $request->summary
		]);

		$itinerary->days()->save($day);

		$crypted_id = Crypt::encrypt($id);
		return redirect()->intended("itinerary/$crypted_id");
	}

}
