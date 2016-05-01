@extends('layouts.default')
@section('header')
</div>
<div class="gray-box">
	<div class="container">
		@if(isset($project) && !empty($project))
			<h1>{{{$project->title}}}</h1>
			@if(isset($edit) && $edit == true)
				<a href="{{{url('project/edit/'.$project->id)}}}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Засах</a> 
			@endif
			<div class="row">
				<div class="col-md-8">
					@if(isset($video))
						<div class="videoWrapper">
							@if($video['type']=='youtube')
								<iframe width="560" height="315" src="https://www.youtube.com/embed/{{{$video['id']}}}" frameborder="0" allowfullscreen></iframe>
							@endif
						</div>
					@endif
				</div>
				<div class="col-md-4">
					<div class="padding-lg">
						<div>
							<b>{{{count($project->payment)}}}</b>
							<br>
							Дэмжигчид
						</div>
						<div>
							<b>{{{number_format($project->totalpayment)}}} ₮</b>
							<br>
							Нийт төсөв: {{{number_format($project->totalgoal)}}} ₮
						</div>
						<div>
							<b>{{{$project->daysleft}}}</b>
							<br>
							Хоног үлдсэн
						</div>
					</div>
				</div>
			</div>
		@endif
	</div>
</div>
<div class="container">
@endsection

@section('content')
	@include('errors.errors')
	
	<div class="row">
		<div class="col-md-8">
			<div>
				# @include('modules.categories.list',['categories'=>$project->categories])
			</div>
			<p>
				{{{$project->intro}}}
			</p>
			<div class="share">
				Түгээх
				@foreach($project->shares as $s)
					<a href="{{{$s['href']}}}" data-action="share" data-href="{{{$s['href']}}}" class="btn btn-default btn-share btn-{{{$s['class']}}}">{{{$s['class']}}}</a>
				@endforeach
			</div>
		</div>
		<div class="col-md-4">
			<div class="padding">
				<div class="project-leader">Төслийн удирдагч: @include('modules.user.list',['users'=>[$project->leader],'contact'=>true])</div>
				<div class="project-teammembers">Төслийн гишүүд: @include('modules.user.list',['users'=>$project->team,'contact'=>true])</div>
			</div>
		</div>
	</div>

	</div>

	  <!-- Nav tabs -->
	  <div>
		  <div class="container">
			  <ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#description" aria-controls="description" role="tab" data-toggle="tab">Төсөл</a></li>
				<li role="presentation"><a href="#comment" aria-controls="comment" role="tab" data-toggle="tab">Сэтгэгдлүүд</a></li>
			  </ul>
		  </div>
	  </div>

	<div class="container">

	<div class="row">
	  <!-- Tab panes -->
	  <div class="col-md-8">
		  <div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="description">
				<h2>Төслийн тухай</h2>
				<img src="{{{asset('images/project/large/'.$project->image)}}}"/>
				<h3>Зардлын задаргаа</h3>
					<table class="table">
						<thead>
							<th>
								Үе шат
							</th>
							<th>
								Хийх ажил
							</th>
							<th>
								Зардал
							</th>
							<th>
								Огноо
							</th>
						</thead>
						<tbody>
							@foreach($project->goal as $g)
								<tr>
									<td>
									{{{$g->phase}}}
									</td>
									<td>
									{{{$g->title}}}
									</td>
									<td>
									{{{number_format($g->goal)}}} ₮
									</td>
									<td>
									{{{$g->start}}} - {{{$g->end}}}
									</td>
								</tr>
							@endforeach
						<tbody>
					</table>
				<div>
					{!!$project->detail!!}
				</div>
			</div>
			<div role="tabpanel" class="tab-pane" id="comment">...</div>
		  </div>
	  </div>
	  <div class="col-md-4">
			
			<div class="padding">
				
				@foreach($project->reward as $r)
					<div class="gray-box padding-sm">
						<h4>{{{$r->title}}}</h4>
						@if($r->image)
							<img src="{{{asset('images/reward/medium/'.$r->image)}}}" alt="{{{$r->title}}}" />
						@endif
						<b>Үнэлэмж: {{{number_format($r->value)}}} ₮</b>
						<br>
						<b>Нийт: {{{$r->amount}}}</b>
						<br>
						<b>Үлдсэн: {{{$r->amountleft}}}</b>
						<br>
						{{{$r->description}}}
						{!! Form::open(array('url'=>'/','method'=>'post','class'=>'preventSubmit')) !!}
							{!! Form::submit('Авах',['class'=>'btn btn-default','data-action'=>'claimReward','data-rewardid'=>$r->id]) !!}
						{!! Form::close()!!}
					</div>
					<div class="padding-sm">
					</div>
				@endforeach
			</div>
		</div>
	</div>

	</div>
@endsection