@if(session('success'))
	<div class="p-2 border-2 rounded border-green-800 mb-2">
		{{ session('success') }}
	</div>
@endif

@if(session('error'))
	<div class="p-2 border-2 rounded border-red-800 mb-2">
		{{ session('error') }}
	</div>
@endif

@if(session('status'))
	<div class="p-2 border-2 rounded border-blue-800 mb-2">
		{{ session('status') }}
	</div>
@endif