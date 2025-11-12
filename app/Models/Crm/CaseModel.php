<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CaseModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'cases';

    public function client() {
        return $this->belongsToMany(Client::class, 'client_case', 'case_id', 'client_id')->withTimestamps();
    }

    public function entry_dates() {
        return $this->belongsToMany(EntryDate::class, 'case_entry_date', 'case_id', 'entry_date_id')->withTimestamps();
    }

}
