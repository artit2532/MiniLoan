@extends('layouts.main')

@section('title', 'list')

@section('css')
@endsection

@section('js')
@endsection

@section('content')
<h1>All Loan</h1>
<div><a class="btn btn-primary" type="button" href="{{action('LoanController@create')}}">Add New Loan</a></div>
<div>
    <table class="table table-striped">
        <thead>
        	<tr>
        		<th>ID</th>
        		<th>Loan Amount</th>
        		<th>Loan Term</th>
        		<th>Interest Rate</th>
        		<th>Created at</th>
				<th>Edit</th>
        	</tr>
        </thead>
        <tbody>
        	@foreach($loans as $loan)
	        	<tr>
	        		<th>{{$loan->id}}</th>
	        		<th>{{$loan->loan_amount}}</th>
	        		<th>{{$loan->loan_term}}</th>
	        		<th>{{$loan->interest_rate}}</th>
	        		<th>{{$loan->Created_at}}</th>
					<th>
						<button class="btn btn-info" type="button">View</button>
						<button class="btn btn-success" type="button">Edit</button>
						<button class="btn btn-danger" type="button">Delete</button>
					</th>
	        	</tr>
        	@endforeach
        </tbody>
    </table>
</div>
@endsection