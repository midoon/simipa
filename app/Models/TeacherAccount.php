<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeacherAccount extends Model
{
    //
    protected $guarded = ['id'];

    public function teacher(): BelongsTo{
        return $this->belongsTo(Teacher::class);
    }

}
