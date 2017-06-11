@extends('layouts.main')

@section('title', !isset($loan)?'Create Loan':'Edit Loan')

@section('css')
    <link rel="stylesheet" href="{{asset('css/views/loan/form.css')}}">
@endsection

@section('js')
@endsection

@section('content')
<h1>{{(!isset($loan)?'Create Loan':'Edit Loan')}}</h1>

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form class="form-horizontal" action="{{(!isset($loan)?action('LoanController@store'):action('LoanController@update',[$loan->id]))}}" method="POST">
    {{ csrf_field() }}
    @isset($loan)
        <input type="hidden" name="_method" value="PATCH">
    @endisset
  <div class="control-group">
    <label class="control-label" for="inputLoanAmount">Loan Amount:</label>
    <div class="controls">
        <div class="input-append input-container">
            <input type="text" id="inputLoanAmount" name='loan_amount' value="{{old('loan_amount',(isset($loan)?$loan->loan_amount:''))}}">
            <span class="add-on">฿</span>
        </div>
      
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputLoanTerm">Loan Term:</label>
    <div class="controls">
        <div class="input-append input-container">
            <input type="text" id="inputLoanTerm" name='loan_term' value="{{old('loan_term',(isset($loan)?$loan->loan_term:''))}}">
            <span class="add-on">Years</span>
        </div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputInterestRate">Interest Rate:</label>
    <div class="controls">
        <div class="input-append input-container">
            <input type="text" id="inputInterestRate" name='interest_rate' value="{{old('interest_rate',(isset($loan)?$loan->interest_rate:''))}}">
            <span class="add-on">%</span>
        </div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label">Start Date:</label>
    <div class="controls input-container">
        <div class="row-fluid">
            <div class="span6">
                <select id='selectStartMonth' name='start_month'>
                    @foreach(getAllMonth() as $i => $month)
                        <option value='{{$i}}' 
                            @if(old('start_month',(isset($loan)?$loan->start_month:getCurrentMonth())) == $i) selected @endif
                        >{{$month}}</option>
                    @endforeach
                </select> 
            </div>
            <div class="span6">
                <select id='selectStartYear' name='start_year'>
                        @for($year=config('constants.loan.start_year.min') ; $year<=config('constants.loan.start_year.max') ; $year++)
                            <option value='{{$year}}'
                                @if(old('start_year',(isset($loan)?$loan->start_year:getCurrentYear())) == $i) selected @endif
                                >
                                {{$year}}
                            </option>
                        @endfor
                </select> 
            </div>
        </div>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn btn-primary">Create</button>
      <a type="button" class="btn" href="{{action('LoanController@index')}}">Back</a>
    </div>
  </div>
</form>
@endsection