<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Auth;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use HasRoles;
    use HasFactory,MustVerifyEmailTrait;
    use Notifiable {
        notify as protected laravelNotify;
    }
    use Traits\ActiveUserHelper;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'introduction',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function($user){
             $user->remember_token = Str::random(10);
        }); 
    }

    public function setPasswordAttribute($v)
    {
        if(strlen($v) != 60){
            $v = bcrypt($v);
        }
        $this->attributes['password'] = $v;
    }

    public function topics()
    {
        return $this->hasMany(Topic::class,'user_id','id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class,'user_id','id');
    }

    public function isAuthOf($model)
    {
        return $this->id == $model->user_id;
    }

    public function notify($instance)
    {
        // 如果要通知的人是当前用户，就不必通知了！
        if($this->id == Auth::id()){
           return;
        }
        // 只有数据库类型通知才需提醒，直接发送 Email 或者其他的都 Pass
        if(method_exists($instance, 'toDatabase')){
            $this->increment('notification_count');
        }
        $this->laravelNotify($instance);
    }

    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }
    
    public function roles()
    {
        return $this->belongsToMany(Role::class,'model_has_roles','model_id','role_id');
    }
}
