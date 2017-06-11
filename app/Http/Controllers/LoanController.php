<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Http\Requests\StoreLoan;

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

    public function create(){
        return view('loan.form');
    }

    public function store(StoreLoan $request){

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
