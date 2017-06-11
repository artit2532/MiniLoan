<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{

	public static function page($page,$per_page){
		return Loan::skip(($page-1)*$per_page)->take($per_page)->orderBy('id','desc')->get();
	}

    public function repaymentSchedules()
    {
        return $this->hasMany('App\Models\RepaymentSchedule');
    }
}
