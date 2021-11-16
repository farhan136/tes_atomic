<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dompet extends Model
{
    use HasFactory;

    public function status()
    {
    	return $this->belongsTo(DompetStatus::class, 'status_id', 'id');
    }
}
