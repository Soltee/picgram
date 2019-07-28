@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex flex-row">
        
        <div class="col-md-2">
            @include('_partials.nav')
        </div>


        <div class="col-md-10">
            <div class="flex">
                <h3>Create Post</h3>
            </div>

            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="flex flex-col">
                    
                    <button type="submit" class="ml-auto btn btn-primary">Post</button>
                    
                    <div class="form-group mt-2 mb-4">
                        <label for="file" class="col-md-4 col-form-label">{{ __('File') }}</label>

                        <div class="col-md-6">
                            <input id="file" type="file" class="form-control @error('file') is-invalid @enderror" name="file" value="{{ old('file') }}" required autocomplete="file" placeholder="" autofocus>

                            @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mt-2 mb-4">
                        <label for="category" class="col-md-4 col-form-label">{{ __('Category') }}</label>

                        <div class="col-md-6"> 
                            <select id="category" class="form-control" name="category">
                                @forelse($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @empty
                                    <option value="">None</option>
                                @endforelse
                            </select>

                            @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mt-2 mb-4">
                        <label for="caption" class="col-md-4 col-form-label">{{ __('Caption') }}</label>

                        <div class="col-md-6">
                            <input id="caption" type="caption" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}" required autocomplete="caption" placeholder="Thinking About....." autofocus>

                            @error('caption')
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
