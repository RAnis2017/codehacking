<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Mass Asignment
    protected $fillable = [
        'category_id',
        'photo_id',
        'title',
        'body',
    ];

    // Relación ManyToOne Posts-Users
    public function user() {
        return $this->belongsTo('App\User');
    }

    // Relación OneToOne Posts-Photos
    public function photo() {
        return $this->belongsTo('App\Photo');
    }
    
    // Relación Categories.
    public function category() {
        return $this->belongsTo('App\Category');
    }
    
    // Relación OneToMany Comments
    public function comments() {
        return $this->hasMany('App\Post');
    }
}
