<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';

    protected $guarded = [];


    public function company(){
    	return $this->hasOne('App\Company', 'id', 'company_id');
    }
}
