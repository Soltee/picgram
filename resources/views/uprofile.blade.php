@extends('layouts.app')

@section('content')

<div class="w-full flex-1 mb-24">

    <!-- User About, Status and Links-->
    <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="flex flex-col mb-6">
            <div class="flex flex-row items-baseline">
                <h3 class="text-blue-light font-semibold">1. Profile</h3>
                <button type="submit" class="ml-auto px-1  py-1 rounded-lg text-white w-24 bg-blue-light hover:bg-blue-dark font-semibold">Save</button>
            </div>
        </div>

        <div class="flex flex-col">
            <input type="hidden" name="type" value="profile">

            <div class="mb-6 flex flex-col">
        
                <div class="flex justify-between items-baseline border rounded shadow-lg">
                  <input id="avatar" type="file" class="shadow appearance-none  w-full py-2 px-3 text-blue-light leading-tight focus:shadow-outline focus:shadow-outline" name="avatar" value="{{ old('avatar') }}" required autocomplete="file" placeholder="" autofocus>
                  <label for="avatar" class="mr-2 block text-blue-light text-xs mb-3 font-semibold">{{ __('Choose') }}</label>
                </div>

                @error('avatar')
                    <p style="color:red;" class="mt-2 px-1 py-1  border-2 rounded" role="alert">
                        <strong>{{ $message }}</strong>
                    </p>
                @enderror
            </div>
            

            
            <div class="mb-6">
                <label for="about" class="block text-blue-light text-xs mb-3 font-semibold">{{ __('About') }}</label>

                <div class="col-md-6">
                    <textarea id="about" type="about" class="fshadow appearance-none border rounded shadow-lg w-full py-2 px-3 text-blue-light leading-tight focus:outline-none focus:shadow-outline" name="about" value=""  autocomplete="about" placeholder="........" autofocus>
                        {{ old('about') ? old('about') : $profile->about }}
                    </textarea>

                    @error('about')
                        <p style="color:red;" class="mt-2 px-1 py-1  border-2 rounded" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="url" class="block text-blue-light text-xs mb-3 font-semibold">{{ __('Website') }}</label>

                <div class="col-md-6">
                    <input id="url" type="text" class="shadow appearance-none border rounded shadow-lg w-full py-2 px-3 text-blue-light leading-tight focus:outline-none focus:shadow-outline" name="url" value="{{ old('url') ??  $profile->url }}" autocomplete="url" placeholder="http://www.picgram.com" autofocus>

                    @error('url')
                        <p style="color:red;" class="mt-2 px-1 py-1  border-2 rounded" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                    @enderror
                </div>
            </div>

        </div>
    </form>

    <!-- User Email and Password -->
    <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="flex flex-col mb-6">
            <div class="flex flex-row items-baseline">
                <h3 class="text-blue-light font-semibold">2. Info</h3>
                <button type="submit" class="ml-auto px-1  py-1 rounded-lg text-white w-24 bg-blue-light hover:bg-blue-dark font-semibold">Save</button>
            </div>
        </div>

        <div class="flex flex-col">
                
            <input type="hidden" name="type" value="info">
            <div >
                <div class="mb-4">
                  <label class="block text-white text-xs mb-2 font-semibold   " for="name">
                    Name
                  </label>
                  <input class=" shadow appearance-none border rounded shadow-lg w-full py-2 px-3 text-blue-light leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" autocomplete="name" autofocus value="{{  old('name') ?? $user->name }}" placeholder="Hari ....">
                       
                    @error('name')
                        <p style="color:red;" class="mt-2 px-1 py-1  border-2 rounded" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                    @enderror
                </div>

                <div class="mb-4">
                  <label class="block text-white text-xs mb-2 font-semibold   " for="email">
                    E-Mail 
                </label>
                  <input class="shadow appearance-none border rounded shadow-lg w-full py-2 px-3 text-blue-light leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" name="email" value="{{old('email') ?? $user->email}}"  autocomplete="email" autofocus placeholder="*******@gmail.com">
                    
                    @error('email')
                        <p style="color:red;" class="mt-2 px-1 py-1  border-2 rounded" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                    @enderror
                </div>

            
                <div class="mb-4">
                  <label class="block text-white text-xs font-semibold mb-2    " for="password">
                    Password
                  </label>
                  <input class="shadow appearance-none border rounded shadow-lg w-full py-2 px-3 text-blue-light leading-tight focus:outline-none focus:shadow-outline"  id="password" type="password"  name="password"   autocomplete="password" autofocus placeholder="**********">
                   @error('password')
                        <p style="color:red;" class="mt-2 px-1 py-1  border-2 rounded" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                    @enderror
        
                </div>


                <div class="mb-4">
                  <label class="block text-white text-xs font-semibold mb-2    " for="password-confirm">
                    Confirm Password
                  </label>
                  <input class="shadow appearance-none border rounded shadow-lg w-full py-2 px-3 text-blue-light leading-tight focus:outline-none focus:shadow-outline"  id="password-confirm" type="password" name="password_confirmation" autocomplete="new-password" autofocus placeholder="**********">

                </div>

               

            </div>
           

        </div>

    </form>
        
</div>

@endsection
