@extends('customer.layout.main')
@section('title','Messages')
@section('content')
<div class="site-content">
  <div class="content-area py-1">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="card mb-0">
					<ul class="nav nav-tabs nav-tabs-2 profile-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#stream" role="tab">Receive</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#receive" role="tab">Send</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#compose" role="tab">Compose</a>
						</li>
					</ul>
					<div class="site" id="user_data">
						@include('customer.message.message_data')
					</div>
				</div>
			</div>
		</div>
	</div>
  </div>
</div>
@stop