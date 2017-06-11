<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoan extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $max_loan_amount = config('constants.loan.loan_amount.max');
        $min_loan_amount = config('constants.loan.loan_amount.min');
        $max_loan_term = config('constants.loan.loan_term.max');
        $min_loan_term = config('constants.loan.loan_term.min');
        $max_interest_rate = config('constants.loan.interest_rate.max');
        $min_interest_rate = config('constants.loan.interest_rate.min');
        $max_start_year = config('constants.loan.start_year.max');
        $min_start_year = config('constants.loan.start_year.min');

        return [
            'loan_amount' => "required|integer|min:$min_loan_amount|max:$max_loan_amount",
            'loan_term' => "required|integer|min:$min_loan_term|max:$max_loan_term",
            'interest_rate' => "required|integer|min:$min_interest_rate|max:$max_interest_rate",
            'start_month' => 'required|integer|min:1|max:12',
            'start_year' => "required|integer|min:$min_start_year|max:$max_start_year",
        ];
    }
}
