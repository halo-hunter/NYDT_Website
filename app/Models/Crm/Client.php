<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = true;

    public function cases() {
        return $this->belongsToMany(CaseModel::class, 'client_case', 'client_id', 'case_id')->withTimestamps();
    }

    public function family_members() {
        return $this->belongsToMany(FamilyMember::class, 'client_family_members', 'client_id', 'family_member_id')->withTimestamps();
    }

    public function country_of_citizenship()
    {
        return $this->belongsToMany(Country::class, 'country_of_citizenship_client', 'client_id', 'country_id')->withTimestamps();
    }

    public function country_of_lawful_status()
    {
        return $this->belongsToMany(Country::class, 'countries_of_lawful_status_client', 'client_id', 'country_id')->withTimestamps();
    }

    public function relations() {
        return $this->belongsToMany(Relation::class, 'client_relation', 'client_id', 'relation_id')->withTimestamps();
    }

    public function riders() {
        return $this->belongsToMany(Rider::class, 'client_rider', 'client_id', 'rider_id')->withTimestamps();
    }

    public function employment_within_last_five_years() {
        return $this->belongsToMany(EmploymentWithinLastFiveYears::class, 'client_employment_w_l_f_y', 'client_id', 'employment_w_l_f_y_id')->withTimestamps();
    }

    public function residency_within_five_years() {
        return $this->belongsToMany(ResidencyWithinFiveYears::class, 'client_residency_w_f_y', 'client_id', 'residency_w_f_y_id')->withTimestamps();
    }
}
