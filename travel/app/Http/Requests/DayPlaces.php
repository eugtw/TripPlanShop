<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class DayPlaces extends Request {

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
            //'place_title'=>'required',
            //'image'=>'required|imagename', //at least one image a day
            //'budget' => 'required|digits_between:1,999999',
            //'day_num'=> 'required|integer|min:1',
            //'experience' => 'required',
            //'day_cities' => 'required',
            //'places' => 'required',
            //'intro'=> 'required',
            //'summary' => 'required'
        ];
    }

}
