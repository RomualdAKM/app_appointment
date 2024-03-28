<?php

namespace App\Models;

use App\Models\User;
use App\Models\People;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    public function people():HasMany
    {
        return $this->hasMany(People::class);

    }
    
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);

    }


}
