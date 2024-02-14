<?php

// app/Models/Slot.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;

    protected $fillable = [
      'counselor_id',
        'day',
        'start_time', 
        'end_time'
        
    ];

    public function counselor()
    {
      return $this->belongsTo(Counselor::class);
    }
}

