@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-2">
            <div class="col-md-2 offset-1">
                <a href="{{route('admin.dashboard')}}"><button type="button" class="btn-sm btn-primary"><- Terug naar dashboard</button></a>
            </div>
            <div class="col-md-2 offset-6">
                <a href="{{route('admin.snack.create')}}"><button type="button" class="btn-sm btn-success">Nieuwe snack</button></a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Snacks</div>

                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Naam</th>
                                <th scope="col">Prijs</th>
                                <th scope="col">Actief</th>
                                <th scope="col">Acties</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($snacks as $snack)
                                <tr>
                                    <td style="vertical-align: middle;">{{$snack->name}}</td>
                                    <td style="vertical-align: middle;">{{$snack->price}}</td>
                                    <td style="vertical-align: middle;">
                                        @if($snack->active)
                                            <button type="button" class="btn-sm btn-success">Ja</button>
                                        @else
                                            <button type="button" class="btn-sm btn-danger">Nee</button>
                                        @endif
                                    </td>
                                    <td><a href="{{route('admin.snack.show', ['id' => $snack->id])}}"><button type="button" class="btn-sm btn-info text-white">Aanpassen</button></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
