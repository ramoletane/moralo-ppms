@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-bordered table-striped col-md-11">
            @foreach ($outcome as $data)
                <tr>
                    <th class="align-top">Impact:</th>
                    <td>{{ $data->impact_name }}</td>
                    <td><a class="btn btn-sm btn-success" href="/impacts" title="Return"><font-awesome-icon icon="backward" /></a></td>
                </tr>
                <tr>
                    <th class="align-top">Outcome:</th>
                    <td>{{ $data->outcome_name }}</td>
                    <td><a class="btn btn-sm btn-success" href="/outcomes/{{ $data->impact_id }}" title="Return"><font-awesome-icon icon="backward" /></a></td>
                </tr>
            @endforeach
        </table>
    </div>
    <outputs-list ref="list" outputs-list="{{ $outputs }}"></outputs-list>
@endsection