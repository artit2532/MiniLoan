<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function testLoanCalculate()
    {
        $loan_service = resolve('App\Services\LoanService');
        $loan = $loan_service->saveLoan(10000,1,10,1,2017);
        $principal1 = number_format($loan->repaymentSchedules[0]->principal,2);
        $principal11 = number_format($loan->repaymentSchedules[11]->principal,2);
        $this->assertEquals(795.83,$principal1);
        $this->assertEquals(871.89,$principal11);
    }
}
