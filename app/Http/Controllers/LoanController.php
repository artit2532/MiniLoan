<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
class LoanController extends Controller
{
    public function index(){
        $loans = Loan::all();
        return view('loan.index')->with('loans',$loans);
    }

    public function create(){
        return view('loan.form');
    }

    public function store(Request $request){
    	$max_loan_amount = config('constants.loan.loan_amount.max');
    	$min_loan_amount = config('constants.loan.loan_amount.min');
    	$max_loan_term = config('constants.loan.loan_term.max');
    	$min_loan_term = config('constants.loan.loan_term.min');
    	$max_interest_rate = config('constants.loan.interest_rate.max');
    	$min_interest_rate = config('constants.loan.interest_rate.min');
    	$max_start_year = config('constants.loan.start_year.max');
    	$min_start_year = config('constants.loan.start_year.min');
    	
        $this->validate($request, [
		    'loan_amount' => "required|integer|min:$min_loan_amount|max:$max_loan_amount",
		    'loan_term' => "required|integer|min:$min_loan_term|max:$max_loan_term",
		    'interest_rate' => "required|integer|min:$min_interest_rate|max:$max_interest_rate",
		    'start_month' => 'required|integer|min:1|max:12',
		    'start_year' => "required|integer|min:$min_start_year|max:$max_start_year",
		]);
    }

    public function edit($id){
        $loan = Loan::findOrFail($id);
        return view('loan.form',['loan'=>$loan]);
    }

    public function show($id){
        $loan = Loan::findOrFail($id);
        return view('loan.detail',['loan'=>$loan,'some status']);
    }
}
