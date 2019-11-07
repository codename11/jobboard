<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Job extends Model
{
    protected $fillable = [
        "title", "description", "email"
    ];

    public function user(){
        return $this->belongsTo("App\User","user_id");
    }

}
