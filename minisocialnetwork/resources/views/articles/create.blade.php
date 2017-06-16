@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					Create Your First Article Hear
				</div>

				<div class="panel-body"> 
					<form method="post" action="/articles" class="form">
						{{csrf_field()}}
						<input type="hidden" name="user_id" value="{{Auth::user()->id }}">

						<div class="form-group">
							<label for="content">Title</label>
							<input type="text" name="title" class="form-control" />
						</div>
						<div class="form-group">
							<label for="content">Content</label>
							<textarea name="content" class="form-control"></textarea>
						</div>

						<div class="checkbox">
							<label>
								<input type="checkbox" name="live"> Live
							</label>
						</div>

						<div class="form-group">
							<label for="poston">
								Post on
							</label>
							<input type="datetime-local" name="poston" class="form-control">
						</div>
						<input type="submit" name="Submit" class="btn btn-success pull-right" >
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection