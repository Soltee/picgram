@extends('layouts.app')


@section('content')

<div class="relative flex flex-row justify-around min-h-screen overflow-hidden bg-gray-900 lg:bg-gray-300 ">
      <div class="hidden md:block min-h-screen overflow-hidden flex-1 bg-gray-800 py-6 z-20"  style="background: url('/img/bk.jpg'); background-size: cover; background-position: center center;">
      </div>
    <welcome-view :errors="{{ $errors }}"></welcome-view>
</div>
  
@endsection
