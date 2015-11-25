@extends('layouts.app')

@section('content')
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">{{ trans('reservation.menu') }}</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Acties <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{!! route('reservation.remove_csv') !!}">{{ trans('reservation.remove_csv') }}</a></li>
                        <li><a href="{!! route('reservation.download_csv') !!}">{{ trans('reservation.download_csv') }}</a></li>

                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <h1>Overzicht registraties</h1>
    @if(isset($entries))
    	<div class="row">
    		<div class="col-md-12">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            @foreach($headers as $header)
                                <th>
                                    {{ $header }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($entries as $entry)
                            <tr>
                                @foreach($entry as $value)
                                    <td> {{ $value }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
    <div class="row">
        <div class="col-md-12">
            <p>{{ trans('reservation.no_results') }}</p>
        </div>
    </div>
    @endif
</div>
@stop
