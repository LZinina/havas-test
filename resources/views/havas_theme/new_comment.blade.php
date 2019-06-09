<li id="li-comment-{{$data['id']}}" class="comment my-3">
	<div id="comment-{{$data['id']}}" class=" card">
		<div class="card-body row">
			<div class="px-3 border-right">
			<img alt="" src="https://www.gravatar.com/avatar/{{$data['hash']}}?d=mm&s=75" class="avatar" height="75" width="75" />
			<p>{{$data['name']}}</p>                 
			</div>
		<div class="px-3 col comment-meta commentmetadata">
			<div class="intro">
				<div class="px-3 commentDate row justify-content-between text-black-50">
					{{__('message.text_just_added')}}                    
				</div>
			</div>
			<div class="comment-body">
				<p>{{ $data['text'] }}</p>
			</div>
		</div>
	</div>
	</div>
	
</li>