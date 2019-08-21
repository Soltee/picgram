@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto flex flex-wrap justify-center">
     
    <div class="lg:w-4/5 md:w-3/5 w-full mb-16 flex flex-col">
        <div class="m-0 p-0 flex flex-row  mb-4">
            <div class="block  lg:mr-2 md:mr-2 mr-2"> 

                <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="flex flex-col mb-6">
                         <div class="flex flex-row items-baseline">
                            <h3 class="text-gray-600 font-semibold">Update Profile</h3>
                            <button type="submit" class="ml-auto px-1  py-1 rounded-full text-white w-24 bg-blue-700 hover:bg-blue-600 font-semibold">Save</button>
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <div class="max-w-md mb-6 flex flex-col">
                    
                            <div class="flex justify-between items-baseline border rounded border-gray-400">
                              <input id="avatar" type="file" class="shadow appearance-none  w-full py-2 px-3 text-gray-700 leading-tight focus:shadow-outline focus:shadow-outline" name="avatar" value="{{ old('avatar') }}" required autocomplete="file" placeholder="" autofocus>
                              <label for="avatar" class="mr-2 block text-white-700 text-md mb-3 font-semibold">{{ __('Choose') }}</label>
                            </div>

                            @error('avatar')
                                <p style="color:red;" class="mt-2 px-1 py-1  border-2 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </p>
                            @enderror
                        </div>
                            

                        <div class="max-w-md mb-6">
                            <label for="caption" class="block text-white-700 text-md mb-3 font-semibold">{{ __('Caption') }}</label>

                            <div class="col-md-6">
                                <input id="caption" type="text" class="fshadow appearance-none border rounded border-gray-400 w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="caption" value="{{ old('caption') ??  $profile->caption }}" required autocomplete="caption" placeholder="Thinking About....." autofocus>

                                @error('caption')
                                    <p style="color:red;" class="mt-2 px-1 py-1  border-2 rounded" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </p>
                                @enderror
                            </div>
                        </div>


                        
                        <div class="max-w-md mb-6">
                            <label for="about" class="block text-white-700 text-md mb-3 font-semibold">{{ __('About') }}</label>

                            <div class="col-md-6">
                                <textarea id="about" type="about" class="fshadow appearance-none border rounded border-gray-400 w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="about" value=""  autocomplete="about" placeholder="........" autofocus>
                                    {{ old('about') ? old('about') : $profile->about }}
                                </textarea>

                                @error('about')
                                    <p style="color:red;" class="mt-2 px-1 py-1  border-2 rounded" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div class="max-w-md mb-6">
                            <label for="url" class="block text-white-700 text-md mb-3 font-semibold">{{ __('Website') }}</label>

                            <div class="col-md-6">
                                <input id="url" type="text" class="fshadow appearance-none border rounded border-gray-400 w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="url" value="{{ old('url') ??  $profile->url }}" autocomplete="url" placeholder="http://www.picgram.com" autofocus>

                                @error('url')
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
