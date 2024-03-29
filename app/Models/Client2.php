<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client2 extends Model
{
    use HasFactory;
 protected $table = 'clients';
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'regNo'

    ];
    public function appointment()
    {
        return  $this->hasMany(Appointment::class);
    }
     public function user()
    {
        return $this->belongsTo(User::class);
    }
     
}
