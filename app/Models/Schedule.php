<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{

    protected $casts = [
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
    ];
   protected $guarded = ['id'];


   public function getStartTimeAttribute($value)
    {
        return \Carbon\Carbon::createFromFormat('H:i:s', $value)->format('H:i');
    }

    public function getEndTimeAttribute($value)
    {
        return \Carbon\Carbon::createFromFormat('H:i:s', $value)->format('H:i');
    }

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = \Carbon\Carbon::createFromFormat('H:i', $value)->format('H:i:s');
    }

    public function setEndTimeAttribute($value)
    {
        $this->attributes['end_time'] = \Carbon\Carbon::createFromFormat('H:i', $value)->format('H:i:s');
    }

   public function group(): BelongsTo{
    return $this->belongsTo(Group::class);
   }



   public function subject(): BelongsTo{
    return $this->belongsTo(Subject::class);
   }

   public function teacher(): BelongsTo{
    return $this->belongsTo(Teacher::class);
   }
}
