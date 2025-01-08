<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GradeFee extends Model
{
    protected $guarded = ['id'];

    public function paymentType(): BelongsTo{
        return $this->belongsTo(PaymentType::class);
    }

    public function grade(): BelongsTo{
        return $this->belongsTo(Grade::class);
    }
}
