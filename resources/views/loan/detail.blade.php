@extends('layouts.main')

@section('title', 'Loan Detail')

@section('css')
@endsection

@section('js')
@endsection

@section('content')
<h1>Loan Detail</h1>
<div>
    <div class='row'>
        <div class="span2">ID:</div>
        <div class="span2">{{$loan->id}}</div>
    </div>
    <div class='row'>
        <div class="span2">Loan Amount:</div>
        <div class="span2">{{number_format($loan->loan_amount,2)}}</div>
    </div>
    <div class='row'>
        <div class="span2">Loan Term:</div>
        <div class="span2">{{$loan->loan_term}}</div>
    </div>
    <div class='row'>
        <div class="span2">Interest Late:</div>
        <div class="span2">{{number_format($loan->interest_rate,2)}}%</div>
    </div>
    <div class='row'>
        <div class="span2">Created at:</div>
        <div class="span2">{{$loan->created_at}}</div>
    </div>
</div>
<div>
    <a class='btn' href="{{action('LoanController@index')}}">Back</a>
</div>

<h2>Repayment Schedules</h2>
<div>
    <table class="table table-striped">
        <thead>
        	<tr>
        		<th>Payment No</th>
        		<th>Date</th>
        		<th>Payment Amount</th>
        		<th>Principal</th>
        		<th>Interest</th>
				<th>Balance</th>
        	</tr>
        </thead>
        <tbody>
        	@foreach($loan->repaymentSchedules as $schedule)
	        	<tr>
	        		<td>{{$schedule->payment_no}}</td>
	        		<td>{{date('M y', strtotime($schedule->date))}}</td>
	        		<td>{{number_format($schedule->payment_amount,2)}}</td>
	        		<td>{{number_format($schedule->principal,2)}}</td>
                    <td>{{number_format($schedule->interest,2)}}</td>
	        		<td>{{number_format($schedule->balance,2)}}</td>
	        	</tr>
        	@endforeach
        </tbody>
    </table>
</div>
<div>
    <a class='btn' href="{{action('LoanController@index')}}">Back</a>
</div>
@endsection