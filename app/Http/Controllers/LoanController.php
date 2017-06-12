<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\RepaymentSchedule;
use App\Http\Requests\StoreLoan;
use App\Services\LoanService;
use Carbon\Carbon;

class LoanController extends Controller
{
    public function index(Request $request){
        $page = $request->get('page','1');
  
        if (!ctype_digit($page) || $page <= 0) {
            // not a positive numeric character
            dd($page);
            abort(404,'Page is not positive integer.');
        }
        $per_page = config('constants.loan.per_page');
        $loans = Loan::page($page,$per_page);
        $total_loan = Loan::count();

        return view('loan.index',[
            'loans'=>$loans,
            'total_loan'=>$total_loan,
            'per_page'=>$per_page,
            'page'=>$page,
        ]);
    }

    public function create(LoanService $loan_service){
        return view('loan.form');
    }

    public function store(StoreLoan $request,LoanService $loan_service){
        $loan = $loan_service->saveLoan($request->loan_amount,
                                        $request->loan_term,
                                        $request->interest_rate,
                                        $request->start_month,
                                        $request->start_year);
        return redirect()->action(
            'LoanController@show', ['id' => $loan->id]
        )->with('status',"The Loan #{$loan->id} has been created succesfull");

    }

    public function edit($id){
        $loan = Loan::findOrFail($id);
        $schedule = RepaymentSchedule::loanId($id)->first();
        $dt = Carbon::parse($schedule->date);
        $loan->start_month = $dt->month;
        $loan->start_year = $dt->year;

        return view('loan.form',['loan'=>$loan]);
    }

    public function update(StoreLoan $request,LoanService $loan_service,$id){
        $loan = Loan::findOrFail($id);
        $loan = $loan_service->saveLoan($request->loan_amount,
                                        $request->loan_term,
                                        $request->interest_rate,
                                        $request->start_month,
                                        $request->start_year,
                                        $loan);
        return redirect()->action(
            'LoanController@show', ['id' => $loan->id]
        )->with('status',"The Loan #{$loan->id} has been updated succesfull");

    }


    public function show($id){
        $loan = Loan::findOrFail($id);
        return view('loan.detail',['loan'=>$loan,'some status']);
    }

    public function destroy(LoanService $loan_service,$id)
    {
        $loan = Loan::findOrFail($id);
        $loan_service->deleteLoan($loan);
        return redirect()->action(
            'LoanController@index', ['id' => $loan->id]
        )->with('status',"The Loan #{$loan->id} has been deleted succesfull");

    }
}
