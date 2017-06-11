<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    public function repaymentSchedules()
    {
        return $this->hasMany('App\Models\RepaymentSchedule');
    }
}
