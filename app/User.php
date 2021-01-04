<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    public static $rootPath = '/images/photos/';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'ref', 'sponsor', 'status_id', 'profile', 'phone', 'photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function getPhotoAttribute($value)
    {
        return self::$rootPath . $value;
    }

    public static function members($members, $generation)
    {
        $new_generation = [];
        foreach ($generation as $member) {
            $status_id = $member->status_id;
            $ref = $member->ref;

            if ($status_id < 3) {
                $team = self::whereSponsor($ref)->where('status_id', '<', $status_id)->get();
                $new_generation = array_merge($new_generation, $team);
                $members = array_merge($members, $team);
            }
        }

        if (count($generation) === 0) return $members;
        else return self::members($members, $new_generation);
    }

    public function team()
    {
        $status_id = $this->status_id;
        $ref = $this->ref;

        $team = self::whereSponsor($ref)->where('status_id', '<', $status_id)->get();

        return self::members([], $team);
    }
}
