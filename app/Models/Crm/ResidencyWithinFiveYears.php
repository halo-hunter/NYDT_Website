<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidencyWithinFiveYears extends Model
{
    use HasFactory;

    public function client() {
        return $this->belongsToMany(Client::class, 'client_residency_w_f_y', 'residency_w_f_y_id', 'client_id')->withTimestamps();
    }
}
