<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Http\Requests\StoreLoan;

class LoanController extends Controller
{
    public function index(){
        $loans = Loan::all();
        return view('loan.index')->with('loans',$loans);
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
