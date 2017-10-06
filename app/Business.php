<?php

namespace all4one;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class Business extends Authenticatable
{
    use Notifiable;
    protected $table = 'BUSINESS';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'businessID', 'businessName', 'category', 'busDescr',
        'businessEmail', 'phone',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

}
