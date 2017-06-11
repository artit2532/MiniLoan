<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
class LoanController extends Controller
{
    //
    public function index(){
        $loans = Loan::all();
        return view('loan.index')->with('loans',$loans);
    }

    public function create(){
        return view('loan.form');
    }
}
