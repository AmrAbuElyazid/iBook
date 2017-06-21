@extends('layouts.app')

@section('content')
	@foreach ($problems as $problem)
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<div class="panel-heading">
				<center>
					{{$problem->book->book_name}} - {{$problem->book->book_date}}
				</center>
			</div>
			<div class="panel-body">
				<p style="direction: RTL">اسم صحاب الشكوي: {{$problem->user->name}}</p>
				<p style="direction: RTL">البريد الالكتروني: {{$problem->user->email}}</p>
				<p style="direction: RTL">الشكوي: 
					<center>
						{{$problem->body}}
					</center>
				</p>
			</div>
		
			<!-- Table -->
			<table class="table">
				<thead>
					<tr>
						<th>
							<center>
								<p><a style="color: grey !important" target="_blank" href="{{$problem->book->book_url}}">فتح الكتاب</a></p>
							</center>
						</th>
					</tr>
				</thead>
			</table>
		</div>
	@endforeach
@stop