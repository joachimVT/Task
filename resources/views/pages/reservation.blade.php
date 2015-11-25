@extends('layouts.app')

@section('content')
<div class="container">
	<h1>{{ trans('reservation.make_reservation') }}</h1>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('reservation.reservation_title') }}</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Sorry!</strong> {{ trans('reservation.input_error') }}.<br><br>
						</div>
					@endif

					{!! Form::open(['class' => 'form-horizontal']) !!}

						<div class='form-group {{ $errors->has("last_name") ? ' has-error' : '' }}'>
							<label class="col-md-4 control-label" for="last_name">{{ trans('reservation.last_name') }}</label>
							<div class="col-md-6">
								{!! Form::text("last_name", old("last_name"), ['required','class' => "form-control",'id'=> 'last_name']) !!}
							</div>
							{!! $errors->first("last_name", '<span class="help-block">:message</span>','achternaam') !!}
						</div>

						<div class='form-group {{ $errors->has("first_name") ? ' has-error' : '' }}'>
							<label class="col-md-4 control-label" for="first_name">{{ trans('reservation.first_name') }}</label>
							<div class="col-md-6">
								{!! Form::text("first_name", old("first_name"), ['required','class' => "form-control",'id'=> 'first_name']) !!}
							</div>
							{!! $errors->first("first_name", '<span class="help-block">:message</span>') !!}
						</div>

						<div class='form-group {{ $errors->has("email") ? ' has-error' : '' }}'>
							<label class="col-md-4 control-label" for="email">{{ trans('reservation.email') }}</label>
							<div class="col-md-6">
								{!! Form::email("email", old("email"), ['required','class' => "form-control",'id'=> 'email']) !!}
							</div>
							{!! $errors->first("email", '<span class="help-block">:message</span>') !!}
						</div>

						<div class='form-group {{ $errors->has("message") ? ' has-error' : '' }}'>
							<label class="col-md-4 control-label" for="message">{{ trans('reservation.message') }}</label>
							<div class="col-md-6">
								{!! Form::textarea("message", old("message"), ['required','class' => "form-control",'id'=> 'message']) !!}
							</div>
							{!! $errors->first("message", '<span class="help-block">:message</span>') !!}
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									{{ trans('reservation.send') }}
								</button>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
