@extends('master')

@section('content')

@if($message = Session::get('success'))

<div class="alert alert-success">
	{{ $message }}
</div>

@endif

<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col col-md-6"><b>Student Data</b></div>
			<div class="col col-md-6">
				<a href="{{ route('students.create') }}" class="btn btn-success btn-sm float-end">Add</a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<table class="table table-bordered">
			<tr>
				<th>Image</th>
				<th>Name</th>
				<th>Email</th>
				<th>Gender</th>
				<th>Action</th>
			</tr>
			@if(count($data) > 0)

				@foreach($data as $row)

					<tr>
						<td><img src="{{ asset('images/' . $row->student_image) }}" width="75" /></td>
						<td>{{ $row->student_name }}</td>
						<td>{{ $row->student_email }}</td>
						<td>{{ $row->student_gender }}</td>
						<td>
							<a href="{{ route('students.show', $row->id) }}" class="btn btn-primary btn-sm">View</a>
						</td>
					</tr>

				@endforeach

			@else
				<tr>
					<td colspan="5" class="text-center">No Data Found</td>
				</tr>
			@endif
		</table>
		{!! $data->links() !!}
	</div>
</div>

@endsection