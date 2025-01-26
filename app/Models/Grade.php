<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grade extends Model
{
    protected $guarded = ['id'];

    use HasFactory;

    public function groups(): HasMany{
        return $this->hasMany(Group::class);
    }

    public function subjects(): HasMany{
        return $this->hasMany(Subject::class);
    }

    public function gradeFees(): HasMany{
        return $this->hasMany(GradeFee::class);
    }
}
