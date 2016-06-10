<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ItiDayPhoto extends Model {

	protected $table = 'itiday_photos';

    protected $fillable = ['photo_path', 'name'];

    protected $baseDir = 'images/itineraries';

    public function itiday()
    {
        return $this->belongsTo('App\ItiDay');
    }

    public static function makePhoto($size,UploadedFile $file, $folderName, $namePrefix = '')
    {
        $photo = new static;

        $iti_dir = $photo->baseDir . '/' . $folderName  ;

        if(!is_dir($iti_dir))
        {
            if(!mkdir($iti_dir))
            {
                return "We are having technical difficulties. Please contact admin.";
            }
        }

        $full_name = preg_replace('/ /', '_', $namePrefix . time() .'.'. $file->getClientOriginalExtension());

        $file->move($iti_dir, $full_name);

        $photo->photo_path = $iti_dir . '/' . $full_name;
        $photo->name = $file->getClientOriginalName();


        $newPhoto = Image::make($photo->photo_path)->resize($size, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $newPhoto->save($photo->photo_path);

        return $photo;

    }
}
