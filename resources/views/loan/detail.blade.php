@extends('layouts.main')

@section('title', 'Loan Detail')

@section('css')
@endsection

@section('js')
@endsection

@section('content')
<div class="alert alert-info">
  {{$status or ''}}
</div>
<h1>Loan Detail</h1>
<div>
    <div class='row'>
        <div class="span2">ID:</div>
        <div class="span2">{{$loan->id}}</div>
    </div>
    <div class='row'>
        <div class="span2">Loan Amount:</div>
        <div class="span2">{{$loan->loan_amount}}</div>
    </div>
    <div class='row'>
        <div class="span2">Loan Term:</div>
        <div class="span2">{{$loan->loan_term}}</div>
    </div>
    <div class='row'>
        <div class="span2">Interest Late:</div>
        <div class="span2">{{$loan->interest_rate}}</div>
    </div>
    <div class='row'>
        <div class="span2">Created at:</div>
        <div class="span2">{{$loan->created_at}}</div>
    </div>
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
	        		<td>{{$schedules->payment_no}}</td>
	        		<td>{{$schedules->date}}</td>
	        		<td>{{$schedules->payment_amount}}</td>
	        		<td>{{$schedules->principal}}</td>
                    <td>{{$schedules->interest}}</td>
	        		<td>{{$schedules->balance}}</td>
	        	</tr>
        	@endforeach
        </tbody>
    </table>
</div>
<div>
    <a class='btn' href="{{action('LoanController@index')}}">Back</a>
</div>
@endsection