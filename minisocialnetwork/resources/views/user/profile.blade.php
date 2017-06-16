@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel-body text-center">
				<img src="https://www.tm-town.com/assets/default_male600x600-79218392a28f78af249216e097aaf683.png" class="profile-img"/>
				<h1>{{ $user->name }} </h1>
				<h5>{{ $user->email}} </h5>
				<h5>{{ $user->dob->format('l j F Y') }} ({{ $user->dob->age}}) Years Old</h5>

				<button class="btn btn-success">Follow</button>
			</div>
		</div>
	</div>
@endsection