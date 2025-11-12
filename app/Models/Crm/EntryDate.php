<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntryDate extends Model
{
    use HasFactory;

    public function case() {
        return $this->belongsToMany(CaseModel::class, 'case_entry_date', 'entry_date_id', 'case_id')->withTimestamps();
    }
}
