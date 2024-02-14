<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counselor extends Model
{

    use HasFactory;
    protected $fillable = ['user_id','name', 'phone', 'email'];

    public function slots()
    {
        return $this->hasMany(Slot::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
