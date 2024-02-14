<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id', 
        'counselor_id', 
        'slot_id', 
        'link', 
        'status',
        'notes'
    ];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function counselor()
    {
        return $this->belongsTo(Counselor::class);
    }
    public function slot()
    {
        return $this->belongsTo(Slot::class);
    }

}
