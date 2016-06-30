<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    // Accesor para que no sea necesario escribir /images/ en ningún mometno que llamemos al modelo photo->file
    protected $uploads = '/images/';
    protected $fillable = ['file'];

    public function getFileAttribute($photo) {
        return $this->uploads . $photo;
    }
}
