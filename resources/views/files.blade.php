@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-header">
				    <ul class="nav justify-content-end">
					  <li class="nav-item">
					    <a class="nav-link add-file" >{{ __('Add file') }}</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" href="#">Link</a>
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

            </div>
        </div>
    </div>
</div>
@endsection
