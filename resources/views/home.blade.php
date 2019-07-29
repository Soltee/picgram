@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex flex-row">
        <div class="col-md-2">
            @include('_partials.nav')
        </div>

        <div class="col-md-10">

        	<home-posts></home-posts>
          
        </div>
    </div>
</div>
@endsection
