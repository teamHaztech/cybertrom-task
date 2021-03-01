<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $guarded = [];
    /**
     * Get the user that owns the Resource
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function user(){
        return $this->belongsTo("App\Models\User","user_id");
    }
    
}
