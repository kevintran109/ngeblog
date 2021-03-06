@extends('ngeblog::admin.layout')

@section('button-title')
	{!! Form::open(['method' => 'GET']) !!}
		{!! Form::text('keyword', null, ['class' => 'input', 'placeholder' => 'search title, or category', 'style' => 'width: 200px;']) !!}
		<button type="submit" class="button is-info">Search</button>
	{!! Form::close() !!}
	&nbsp;&nbsp;&nbsp;
	<a href="{{ route('ngeblog.blog.create') }}" class="button is-primary">
		<span class="icon">
			<i class="ion-plus"></i>
		</span>
		<span>Create</span>
	</a>
@stop

@section('content')
	@if ($blogs->isEmpty())
		<article class="message">
			<div class="message-body">
				There is no data yet. <a href="{{ route('ngeblog.blog.create') }}" class="">Create new</a>
			</div>
		</article>
	@else
		<table class="table is-bordered is-fullwidth">
			<thead>
				<tr>
					<th style="width: 5%;">No</th>
					<th style="width: 50%;">Title</th>
					<th>Category</th>
					<th>Status</th>
					<th style="width: 20%;">Action</th>
				</tr>
			</thead>
			<tbody>
				@php
				$no = $blogs->firstItem();
				@endphp
				@foreach ($blogs as $b)
					<tr>
						<td>{{ $no++ }}</td>
						<td>{{ $b['title'] }}</td>
						<td>{{ $b['category']['title'] }}</td>
						<td>
							@if ($b['status'] == 'publish')
								<span class="tag is-primary">published</span>
							@else
								<span class="tag is-dark">{{ $b['status'] }}</span>
							@endif
						</td>
						<td>
							<a href="{{ route('ngeblog.blog.edit', $b['id']) }}" class="button is-small">
								<span class="icon"><i class="ion-edit"></i></span>
								<span>Edit</span>
							</a>
							<a href="{{ route('ngeblog.blog.destroy', $b['id']) }}"
							class="button is-danger is-small"
							data-method="delete"
							data-confirm="Are you sure prend?">
								<span class="icon"><i class="ion-ios-trash-outline"></i></span>
								<span>Delete</span>
							</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		{!! $blogs->links('ngeblog::pagination-bulma') !!}
	@endif
@stop
