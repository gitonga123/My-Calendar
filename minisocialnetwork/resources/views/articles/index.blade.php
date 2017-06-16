@extends('layouts.app')

@section('content')
	<div class="row">
		@forelse($articles as $article)
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						<span>{{$article->title}}</span>
						<span class="pull-right">
							{{ $article->created_at}}
						</span>
					</div>

					<div class="panel-body"> 
						{{$article->shortContent}}

						<a href="/articles/{{$article->id}}"> (Read more)</a>
					</div>

					<div class="panel-footer clearfix" style="background-color: white">
						@if($article->user_id == Auth::id())
							<form action="articles/{{ $article->id}}" method="post" class="pull-left">
								{{ csrf_field() }}
								{{method_field('DELETE')}}
								<button class="btn btn-danger btn-sm">Delete</button>
							</form>
						@endif
						<i class="fa fa-heart pull-right"></i>
					</div>
				</div>
			</div>
		@empty
			<h1>No Articles</h1>
		@endforelse
	</div>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			{{$articles->links()}}
		</div>
	</div>
@endsection