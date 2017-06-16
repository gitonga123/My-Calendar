@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<span>{{ $article->title}}</span>
					<span class="pull-right">
						{{$article->created_at->diffForHumans()}}
					</span>
				</div>

				<div class="panel-body"> 
					{{ $article->content}}
				</div>
			</div>
		</div>
	</div>
@endsection