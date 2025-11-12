<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentWithinLastFiveYears extends Model
{
    use HasFactory;

    public function client() {
        return $this->belongsToMany(Client::class, 'client_employment_w_l_f_y', 'employment_w_l_f_y_id', 'client_id')->withTimestamps();
    }

}
