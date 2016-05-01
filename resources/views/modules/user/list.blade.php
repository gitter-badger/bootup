@if(isset($users) && !empty($users))
	<ul class="project-team-list">
	@foreach ($users as $u)
		@if($u)
		<li>
			<img src="{{{asset('images/avatar/thumbnail/'.$u->avatar)}}}" class="thumbnail" />
			<a href="{{{$u->url}}}">{{{$u->fullname}}}</a>
			@if(isset($contact) && $contact == true)
			{!! Form::open(array('url'=>'/','method'=>'post','class'=>'preventSubmit')) !!}
				<div>
					<a href="#" class="btn" data-action="contactUserModal" data-userid="{{{$u->id}}}">Холбогдох</a>
				</div>
			{!! Form::close() !!}
			@endif
			@if(isset($remove) && $remove == true && $u->leader != true)
				<button type="button" class="btn btn-default" data-action="removeTeamMember" data-userid="{{{$u->id}}}">
					<span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Хасах
				</button>
			@endif
			@if(isset($add) && $add == true && $u->leader != true)
				<button type="button" class="btn btn-default" data-action="addTeamMember" data-userid="{{{$u->id}}}">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Нэмэх
				</button>
			@endif
		</li>
		@endif
	@endforeach 
	</ul>
@endif