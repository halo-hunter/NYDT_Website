<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{
    use HasFactory;

    public function relations() {
        return $this->belongsToMany(Relation::class, 'relation_rider', 'rider_id', 'relation_id')->withTimestamps();
    }

    public function client() {
        return $this->belongsToMany(Client::class, 'client_rider', 'rider_id', 'client_id')->withTimestamps();
    }

}
