<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
   protected $guarded = ['id'];

   public function group(): BelongsTo{
    return $this->belongsTo(Group::class);
   }

   public function room(): BelongsTo{
    return $this->belongsTo(Room::class);
   }

   public function subject(): BelongsTo{
    return $this->belongsTo(Subject::class);
   }

   public function teacher(): BelongsTo{
    return $this->belongsTo(Teacher::class);
   }
}
