@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-bordered table-striped col-md-11">
            @foreach ($impact as $data)
                <tr>
                    <th class="align-top">Impact:</th>
                    <td>{{ $data->impact_name }}</td>
                    <td><a class="btn btn-sm btn-success" href="/impacts" title="Return"><font-awesome-icon icon="backward" /></a></td>
                </tr>
            @endforeach
        </table>
    </div>
    <outcomes-list ref="list" outcomes-list="{{ $outcomes }}"></outcomes-list>
@endsection