<?php

return [
	/*
    |--------------------------------------------------------------------------
    | config of loan
    |--------------------------------------------------------------------------
    |
    */
    'loan' => [
    	'loan_amount' => ['min'=>1,'max'=>100000000],
    	'loan_term' => ['min'=>1,'max'=>50],
    	'interest_rate' => ['min'=>1,'max'=>36],//percent
    	'start_year' => ['min'=>2017,'max'=>2050],
        'per_page' => 15,
    ]

];