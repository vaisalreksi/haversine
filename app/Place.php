<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Place extends Model
{
	protected $table = "place";
	public $timestamps = true;
	protected $primaryKey = 'id';

	protected $fillable = [
       'type',
       'name',
       'keyword',
       'address',
       'website',
       'phone',
       'email',
       'description',
       'latitude',
       'longitude',
       'image',
       'facebook',
       'twitter',
       'youtube',
       'instagram',
       'whatsapp'
  ];

}
