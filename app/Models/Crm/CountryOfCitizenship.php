<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryOfCitizenship extends Model
{
    use HasFactory;

    public function clients()
    {
        return $this->belongsToMany(Country::class, 'country_of_citizenship_client', 'country_id', 'client_id')->withTimestamps();
    }
}
