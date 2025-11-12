<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountriesOfLawfulStatus extends Model
{
    use HasFactory;

    public function clients()
    {
        return $this->belongsToMany(Country::class, 'countries_of_lawful_status_client', 'country_id', 'client_id')->withTimestamps();
    }
}
