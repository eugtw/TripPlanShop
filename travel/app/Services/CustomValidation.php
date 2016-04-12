<?php namespace App\Services;
/**
 * Created by PhpStorm.
 * User: Eugene
 * Date: 04/02/2016
 * Time: 10:07 PM
 */

use Illuminate\Support\Facades\File;
use Illuminate\Validation\Validator;

class CustomValidation extends Validator
{

    public function validateFoldername($attribute, $value, $parameters)
    {

        if(!File::isDirectory('./files/' . $value))
        {
            return false;
        }
        return true;
        //$pattern = "/^[A-Za-z0-9][\w-]*$/";

        //return preg_match($pattern, $value);
    }

    public function validateImagename($attribute, $value, $parameters)
    {
        $pattern = "/(\.jpg|\.png)/";  //^.*(\.jpg|\.png)?$

        return preg_match($pattern, $value);
    }

    public function validateUsername($attribute, $value, $parameters)
    {
        $pattern = "/^[a-zA-Z0-9]+(?:[_-][a-z0-9]+)*$/";

        return preg_match($pattern ,$value);
    }
}