@if(session('success'))
	<div class="alert alert-success">
		{{ session('success') }}
	</div>
@endif

@if(session('error'))
	<div class="alert alert-error">
		{{ session('error') }}
	</div>
@endif

@if(session('status'))
	<div class="alert alert-status">
		{{ session('status') }}
	</div>
@endif