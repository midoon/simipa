<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentType extends Model
{
     protected $guarded = ['id'];

     public function fees(): HasMany{
        return $this->hasMany(Fee::class);
     }

     public function payments(): HasMany{
        return $this->hasMany(Payment::class);
     }

        public function gradeFees(): HasMany{
            return $this->hasMany(GradeFee::class);
        }
}
