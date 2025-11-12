<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    use HasFactory;

    public function riders() {
        return $this->belongsToMany(Rider::class, 'relation_rider', 'relation_id', 'rider_id')->withTimestamps();
    }

    public function client() {
        return $this->belongsToMany(Client::class, 'client_relation', 'relation_id', 'client_id')->withTimestamps();
    }

}
