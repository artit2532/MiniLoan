<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepaymentSchedule extends Model
{

	protected $fillable = [
		'payment_no',
		'date',
		'payment_amount',
		'principal',
		'interest',
		'balance',
	];

    public function loan()
    {
        return $this->belongsTo('App\Models\Loan');
    }

    public function scopeLoanId($builder,$loan_id){
    	return $builder->where('loan_id',$loan_id);
    }
}
