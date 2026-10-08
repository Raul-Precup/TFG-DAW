<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'room_id',
        'name',
        'email',
        'phone',
        'start_date',
        'end_date'
    ];

    public function room(){
        return $this->belongsTo(Room::class);
        return $this->hasOne('App\Models\Room','id','room_id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
