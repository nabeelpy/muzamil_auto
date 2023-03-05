<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CompanyModel extends Model
{
    use LogsActivity;

    protected $table = "company_info";
    use HasFactory;
    protected $primaryKey='com_id';
    public $timestamps = false;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['com_name','com_ceo','com_number','com_services','com_address','com_instructions','com_complain']);
    }}
