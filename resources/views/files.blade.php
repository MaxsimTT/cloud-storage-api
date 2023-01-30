@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">

			@if (session('message'))
			    <div class="alert alert-success">
			        {{ session('message') }}
			    </div>
			@endif

            <div class="card">

                <div class="card-header">
				    <ul class="nav justify-content-end">
					  <li class="nav-item">
					    <a class="nav-link add-file" >{{ __('Add file') }}</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link create-folder" >{{ __('Create folder') }}</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link disabled">Disabled</a>
					  </li>
					</ul>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    @foreach ($files as $file)
                    	@if ($file)
                    		<div>
                    			<a href="{{ $file->file_path }}">{{ $file->file_description->file_name }}</a>                  		
                    		</div>
                    	@endif
                    @endforeach

                </div>

                <div class="modal">
                	<div class="modal-content">
                		<span class="close">&times;</span>
						<div class="mb-3">
						<form enctype="multipart/form-data" method="POST" action="{{ route('add_file', ['dir_id' => 22 ]) }}">
							@csrf
						  	<input class="form-control" type="file" id="formFile" name="files[]" multiple>
						  	<button type="submit" class="btn btn-primary mt-4">{{ __('Send') }}</button>
						</form>
						</div>
					</div>
				</div>

				<div class="modal-2">
                	<div class="modal-content">
                		<span class="close">&times;</span>
						<div class="mb-3">
							<form method="POST" action="{{ route('create_folder') }}">
								@csrf
								<div class="mb-3">
									<label for="create-folder" class="form-label">{{ __('Name folder') }}</label>
									<input type="text" class="form-control" id="create-folder" aria-describedby="emailHelp" name="create-folde">
									<div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
								</div>
								<button type="submit" class="btn btn-primary">Submit</button>
							</form>
						</div>
					</div>
				</div>

            </div>
        </div>
    </div>
</div>
@endsection
