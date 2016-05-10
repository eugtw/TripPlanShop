<?php namespace App\Http\Requests;

use App\Http\Requests\Request;


class StoreItineraryEditRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{


		return [
				'title' => 'required|min:10|max:100',
				'region' => 'required',
				//'top-place'=>'required',
				'price' => 'required|numeric|min: '.env('ITI_MIN_PRICE').'|max:'.env('ITI_MAX_PRICE'),
				//'best_season' => 'required',
				'styles_list' => 'required|max:5',
				'cities_list'=> 'required|max:'.env('ITI_MAX_CITY'),
				'items_list'=>	'required',
				//'gallery_folder_name' => 'required|foldername',
				//'image' => 'required|imagename',
				'summary' => 'required'
		];
	}

}
