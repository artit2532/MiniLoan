<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function testCalculatePMT()
    {
        $loan_service = resolve('App\Services\LoanService');
        $pmt = $loan_service->calculatePMT(10000,1,10);

        $this->assertEquals(879.16,$pmt);
    }
}
