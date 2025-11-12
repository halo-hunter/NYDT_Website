<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FamilyMember extends Model
{
    use HasFactory, SoftDeletes;

    public function client() {
        return $this->belongsToMany(Client::class, 'client_family_members', 'family_member_id', 'client_id')->withTimestamps();
    }
}
