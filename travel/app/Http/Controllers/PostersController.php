<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PostersController extends Controller {


	/**
	 * displays users' admin page
	 * @param $id
	 * @return \Illuminate\View\View
	 */
	public function getAdminPage($id)
	{
		//$user = User::find($id);
		$itineraries = Itinerary::where('user_id','=',$id)->get();
		return view('users.adminPage')
			//->withUser($user)
			->withItineraries($itineraries);
	}

}
