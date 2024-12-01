<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
   protected $guarded = ['id'];

   public function fees(): HasMany{
    return $this->hasMany(Fee::class);
   }

   public function group(): BelongsTo{
    return $this->belongsTo(Group::class);
   }

   public function payments(): HasMany{
    return $this->hasMany(Payment::class);
   }


}
