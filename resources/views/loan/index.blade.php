@extends('layouts.main')

@section('title', 'list')

@section('css')
@endsection

@section('js')
@endsection

@section('content')
<h1>All Loans</h1>
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
	        		<td>{{$loan->id}}</td>
	        		<td>{{$loan->loan_amount}}</td>
	        		<td>{{$loan->loan_term}}</td>
	        		<td>{{$loan->interest_rate}}</td>
	        		<td>{{$loan->created_at}}</td>
					<td>
						<button class="btn btn-info" type="button">View</button>
						<button class="btn btn-success" type="button">Edit</button>
						<button class="btn btn-danger" type="button">Delete</button>
					</td>
	        	</tr>
        	@endforeach
        </tbody>
    </table>
</div>
<div class="pagination">
    <ul>
        @if($page<=1)
            <li class='disabled'><a href="javascript:"><<</a></li>
        @else
            <li><a href="{{action('LoanController@index',['page'=>$page-1])}}"><<</a></li>
        @endif

        @for($i=1 ; $total_loan - ($per_page * $i) > -$per_page  ; $i++)
            <li class='{{($i==$page)?"active":""}}'><a href="{{action('LoanController@index',['page'=>$i])}}">{{$i}}</a></li>
        @endfor

        @if($i-1==$page)
            <li class='disabled'><a href="javascript:">>></a></li>
        @else
            <li><a href="{{action('LoanController@index',['page'=>$page+1])}}">>></a></li>
        @endif
    </ul>
</div>
@endsection