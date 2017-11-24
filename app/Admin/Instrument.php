<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Instrument extends Model
{
    protected $table='instrument';
    public  $timestamps = false;
    protected $fillable = ['brands','serial_number','model_number','status','share_time','day_rent',
                            'security_deposit','line','power','picture','adaptation_scope'];
}
