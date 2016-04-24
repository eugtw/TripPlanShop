<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\DayPlaces;
use App\Http\Controllers\Controller;
use App\ItiDayPhoto;
use App\ItiDay;
use App\ItiDayPlace;
use App\Itinerary;

use Illuminate\Http\Request;

class ItiDayPlaceController extends Controller {


	public function storePlaceImage(Request $request)
	{
		$this->validate($request, [
			'place_image' => 'required|mimes:jpg,jpeg,png'
		]);

		$itiDay = ItiDay::find($request->day_id);
		$itinerary = Itinerary::find($itiDay->itinerary_id);

		$photo = ItiDayPhoto::makePhoto($request->file('place_image'), $itinerary->getRouteKey(), 'place_');

		if($request->place_id == 'new')
		{
			$itiDay->places()->create([
				'image_path' => $photo->photo_path,
				'image_desc' => $photo->name
			]);
		}else{

			if($this->deletePlaceImage($request->place_id))
			{
				ItiDayPlace::find($request->place_id)->update([
					'image_path' => $photo->photo_path,
					'image_desc' => $photo->name
				]);
			}else{

			}


		}
	}

	public function deletePlaceImage($place_id)
	{
		$place = ItiDayPlace::find($place_id);

		if(\File::delete($place->image_path))
		{
			$place->image_path = '';
			$place->save();

			return redirect()->back();
		}else{
			return "error";
		}


	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$day = ItiDay::find($request->day_id);
		$day->places()->create([]);
		return redirect()->back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, ItiDayPlace $place)
	{
		$data = $request->all();
		$data['experiences'] = implode(',', $request->experiences);

		ItiDayPlace::find($place->id)->update($data);

		//return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(ItiDayPlace $place){
		$place->delete();

		//return redirect()->back();
	}

}
