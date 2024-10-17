<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payment extends Model
{
    protected $guarded = ['id'];

    public function paymentInstallments(): HasMany{
        return $this->hasMany(PaymentInstallment::class);
    }

    public function paymentType(): BelongsTo{
        return $this->belongsTo(PaymentType::class);
    }

    public function student(): BelongsTo {
        return $this->belongsTo(Student::class);
    }
}
