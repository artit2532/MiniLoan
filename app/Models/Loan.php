<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{

	protected $fillable = [
		'loan_amount',
		'loan_term',
		'interest_rate',
	];

	public static function page($page,$per_page){
		$loans = Loan::skip(($page-1)*$per_page)
						->take($per_page)
						->orderBy('id','desc')
						->get();

		// $loans->start_month = date('m',strtotime(time));
		return $loans;
	}

    public function repaymentSchedules()
    {
        return $this->hasMany('App\Models\RepaymentSchedule');
    }
}
