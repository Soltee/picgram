@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex flex-row">
        
        <div class="col-md-2">
            @include('_partials.nav')
        </div>


        <div class="col-md-10">
            <div class="flex">
                <h3>Update Profile</h3>
            </div>

            <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="flex flex-col">
                    
                    <button type="submit" class="ml-auto btn btn-primary">Update</button>
                    
                    <div class="form-group mt-2 mb-4">
                        <label for="avatar" class="col-md-4 col-form-label">{{ __('Profile Image') }}</label>

                        <div class="col-md-6">
                            <input id="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" value="{{ old('avatar') }}"  autocomplete="avatar" placeholder="" autofocus>

                            @error('avatar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mt-2 mb-4">
                        <label for="caption" class="col-md-4 col-form-label">{{ __('Caption') }}</label>

                        <div class="col-md-6">
                            <input id="caption" type="caption" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') ??  $profile->caption }}"  autocomplete="caption" placeholder="Thinking About....." autofocus>

                            @error('caption')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mt-2 mb-4">
                        <label for="description" class="col-md-4 col-form-label">{{ __('About') }}</label>

                        <div class="col-md-6">
                            <textarea id="about" type="about" class="form-control @error('about') is-invalid @enderror" name="about" value=""  autocomplete="about" placeholder="........" autofocus>
                                {{ old('about') ? old('about') : $profile->about }}
                            </textarea>

                            @error('about')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mt-2 mb-4">
                        <label for="url" class="col-md-4 col-form-label">{{ __('Website') }}</label>

                        <div class="col-md-6">
                            <input id="url" type="url" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url') ? old('url') : $profile->url }}"  autocomplete="url" placeholder="http://www.picgram.com" autofocus>

                            @error('url')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                </div>

            </form>
            
        </div>
    </div>
</div>
@endsection
