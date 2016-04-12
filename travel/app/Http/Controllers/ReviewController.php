<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Review;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\Itinerary;
use Illuminate\Http\Request;

class ReviewController extends Controller {

	/**
	 * @param ReviewRepository $reviews
	 * @return ReviewRepository
	 */
	public function __contruct(ReviewRepository $reviews)
	{
		return $this->reviews = $reviews;
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
		$this->Validate($request, [
			'rating' => 'required',
			'comment' => 'required'
		]);

		$itinerary = Itinerary::find(Crypt::decrypt($request->get('itinerary_id')));
		$review = new Review([
			'comment' => $request->get('comment'),
			'user_id' => Auth::user()->id,
			'rating' => $request->get('rating')
		]);
		//$this->comment = $request->get('comment');
		//$this->user->id = Auth::user()->id;
		//$this->rating = $request->get('rating');;
		$itinerary->reviews()->save($review);

		return back();
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
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
