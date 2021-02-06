<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cache;

class Link extends Model
{
    use HasFactory;
    protected $fillable = ['title','link'];
    public $cache_key = 'smbbs_links';
    protected $cache_times = 1440 * 60;

    public function getAllCached()
    {
    	return Cache::remember($this->cache_key,$this->cache_times,function(){
    		return $this->all();
    	});
    }
}
