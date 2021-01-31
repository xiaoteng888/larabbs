<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
	use HasDateTimeFormatter;    
    public $timestamps = false;
    protected $fillable = ['name','email','seo_key','seo_description'];
}
