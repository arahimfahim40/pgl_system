<style type="text/css">
	.hideen{
		display: none !important;
	}
	#success{
		padding: 5px;
	}
</style>
<div class="tab-content">
	<div class="tab-pane active" id="stream" role="tabpanel">
		<?php $id=1; ?>
		@foreach($receive_messages as $mes)
		<div class="media stream-item">
			<div class="media-left">
				<div class="avatar box-32">
					<!-- <img class="b-a-radius-circle" src="img/avatars/5.jpg" alt=""> -->
					<div class='mi-icon bg-warning b-a-radius-circle' style="text-align:center;"><b>{{$id++}}</b></div>
				</div>
			</div>
			<div class="media-body">
				<h6 class="media-heading">
					<a class="text-black" href="#">{{$mes->username}} </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<span class="font-90 text-muted">{{ Carbon\Carbon::parse($mes->created_at)->diffForHumans()}}</span>
				</h6>
				<span class="font-100 stream-meta">{{$mes->subject}}</span>
				<div class="stream-body">
					<p><?=$mes->content?></p>
				</div>
			</div>
		</div>
		@endforeach
	</div>
	<!-- received message section -->
	<div class="tab-pane" id="receive" role="tabpanel">
		<?php $id=1; ?>
		@foreach($send_messages as $mes)
		<div class="media stream-item">
			<div class="media-left">
				<div class="avatar box-32">
					<!-- <img class="b-a-radius-circle" src="img/avatars/5.jpg" alt=""> -->
					<div class='mi-icon bg-success b-a-radius-circle' style="text-align:center;"><b>{{$id++}}</b></div>
				</div>
			</div>
			<div class="media-body">
				<h6 class="media-heading">
					<a class="text-black" href="#">{{$mes->username}} </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<span class="font-90 text-muted">{{ Carbon\Carbon::parse($mes->created_at)->diffForHumans()}}</span>
				</h6>
				<span class="font-100 stream-meta">{{$mes->subject}}</span>
				<div class="stream-body">
					<p><?=$mes->content?></p>
				</div>
			</div>
		</div>
		@endforeach
	</div>
	<!-- compose message -->
	<div class="tab-pane" id="compose" role="tabpanel" >
		<div class="media stream-item">
			<div class="col-md-5">
				<div class="box-block b-b">
					<div style='position: fixed; margin-top:8%; margin-left:10%;' class="hideen">
						<img width='70px' src='img/loading.gif' alt='<b>Loading ...</b>'>
					</div>
					<h5 class="mb-1">Send Message</h5>
					<form>
						<div class="form-group">
							<input type="text" class="form-control subject" id="subject" placeholder="Subject">
						</div>
						<div class="form-group">
							<select class="form-control" id="receiver">
								@foreach($users as $user)
								<option value="{{$user->id}}">{{$user->username}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<textarea class="form-control" id="content" placeholder="Message" rows="10"></textarea>
						</div>
						<div id="success">
							
						</div>
						<div class="form-group">
							<button id="sendMessage" class="btn btn-danger btn-rounded">Send</button>
						</div>
					</form>
				</div>
			</div>
	   </div>
	</div>
</div>
@section('js')
<script type="text/javascript">
	$(document).ready(function(){
		$('#sendMessage').click(function(e){
			e.preventDefault();
       		 $('.hidden').removeClass("hidden");
       		 var request = $.ajax({
	              url: "{{route('compose_message_customer')}}",
	              method: "GET",
	              data: {subject:$('#subject').val(),receiver:$('#receiver').val(),content:$('#content').val()},
	            }); 
	            request.done(function( msg ) {
	            	$('form')[0].reset();
	            	$('.hidden').addClass("hidden");
	                $('#success').html("<span class='tag tag-success'>Message  send successfully </span>");
	            });
	            request.fail(function( jqXHR, textStatus ) {
	            	$('.hidden').addClass("hidden");
	            	$('#success').html("<span class='tag tag-warning'>Message not send </span>");
	          });
       });
	});
</script>
@stop