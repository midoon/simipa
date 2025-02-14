<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $guarded = ['id'];

    public function student(): BelongsTo{
        return $this->belongsTo(Student::class);
    }

    public function fee(): BelongsTo{
        return $this->belongsTo(Fee::class);
    }
}
