@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto flex flex-wrap justify-center">

           
    <div class="lg:w-4/5 md:w-3/5 w-full flex flex-col mb-16">
        

        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col mb-6">
                 <div class="flex flex-row items-baseline">
                    <h3 class="text-gray-600 font-semibold">Create Post</h3>
                    <button type="submit" class="ml-auto px-1  py-1 rounded-full text-white w-24 bg-blue-700 hover:bg-blue-600 font-semibold">Post</button>
                </div>
            </div>
            <div class="flex flex-col">
                
                <div class="max-w-md mb-6 flex flex-col">
                    
                    <div class="flex justify-between items-baseline border rounded border-gray-400">
                      <input id="file" type="file" class="shadow appearance-none  w-full py-2 px-3 text-gray-700 leading-tight focus:shadow-outline focus:shadow-outline" name="file" value="{{ old('file') }}" required autocomplete="file" placeholder="" autofocus>
                      <label for="file" class="mr-2 block text-white-700 text-md mb-3 font-semibold">{{ __('Choose') }}</label>
                    </div>

                    @error('file')
                        <p style="color:red;" class="mt-2 px-1 py-1  border-2 rounded" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                    @enderror
                </div>

                <div class="max-w-md mb-6">
                    <label for="category" class="block text-white-700 text-md mb-3 font-semibold">{{ __('Category') }}</label>

                    <div class="flex flex-col"> 
                        <select id="category" class="shadow appearance-none border rounded border-gray-400 w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="category">
                            @forelse($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @empty
                                <option value="">None</option>
                            @endforelse
                        </select>

                        @error('category')
                            <p style="color:red;" class="mt-2 px-1 py-1  border-2 rounded" role="alert">
                                <strong>{{ $message }}</strong>
                            </p>
                        @enderror
                    </div>
                </div>

                <div class="max-w-md mb-6">
                    <label for="caption" class="block text-white-700 text-md mb-3 font-semibold">{{ __('Caption') }}</label>

                    <div class="col-md-6">
                        <input id="caption" type="caption" class="fshadow appearance-none border rounded border-gray-400 w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="caption" value="{{ old('caption') }}" required autocomplete="caption" placeholder="Thinking About....." autofocus>

                        @error('caption')
                            <p style="color:red;" class="mt-2 px-1 py-1  border-2 rounded" role="alert">
                                <strong>{{ $message }}</strong>
                            </p>
                        @enderror
                    </div>
                </div>


            </div>

        </form>
    </div>

    <div class="lg:w-1/5 md:w-2/5 w-full lg:static md:static fixed left-0 bottom-0 lg:bg-transparent md:bg-transparent lg:p-0 md:p-0 pb-0 pt-2 bg-gray-400">
        @include('_partials.nav')
    </div>
    
</div>

@endsection
