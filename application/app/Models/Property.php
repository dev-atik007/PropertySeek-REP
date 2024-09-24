<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    public function type(){
        return $this->belongsTo(PropertyType::class, 'ptype_id', 'id');
    }

    protected $guarded = [];
    
    public function agent(){
        return $this->belongsTo(User::class, 'agent_id', 'id');
    }
}
