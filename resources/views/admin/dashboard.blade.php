@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Bestelling in behandeling</div>

                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Naam</th>
                                <th scope="col">Snacks</th>
                                <th scope="col">Prijs</th>
                                <th scope="col">Status</th>
                                <th scope="col">Acties</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($inProgressOrders as $inProgressOrder)
                                <tr>
                                    <td style="vertical-align: middle;">{{$inProgressOrder->user->name}}</td>
                                    <td style="vertical-align: middle;">{{$inProgressOrder->snacksInfo['total_snacks']}}</td>
                                    <td style="vertical-align: middle;">{{$inProgressOrder->snacksInfo['total_price']}}</td>
                                    <td style="vertical-align: middle;">{{$inProgressOrder->status->name}}</td>
                                    <td><a href="{{route('admin.order.show', ['id' => $inProgressOrder->id])}}"><button type="button" class="btn-sm btn-info text-white">Aanpassen</button></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-10 mt-5">
                <div class="card">
                    <div class="card-header">Nieuwe bestellingen</div>

                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Naam</th>
                                <th scope="col">Snacks</th>
                                <th scope="col">Prijs</th>
                                <th scope="col">Status</th>
                                <th scope="col">Acties</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($newOrders as $newOrder)
                                <tr>
                                    <td style="vertical-align: middle;">{{$newOrder->user->name}}</td>
                                    <td style="vertical-align: middle;">{{$newOrder->snacksInfo['total_snacks']}}</td>
                                    <td style="vertical-align: middle;">{{$newOrder->snacksInfo['total_price']}}</td>
                                    <td style="vertical-align: middle;">{{$newOrder->status->name}}</td>
                                    <td><a href="{{route('admin.order.show', ['id' => $newOrder->id])}}"><button type="button" class="btn-sm btn-info text-white">Aanpassen</button></a></td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-10 mt-5">
                <div class="card">
                    <div class="card-header">Afgeronde bestellingen</div>

                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Naam</th>
                                <th scope="col">Snacks</th>
                                <th scope="col">Prijs</th>
                                <th scope="col">Status</th>
                                <th scope="col">Acties</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($finishedOrders as $finishedOrder)
                                <tr>
                                    <td style="vertical-align: middle;">{{$finishedOrder->user->name}}</td>
                                    <td style="vertical-align: middle;">{{$finishedOrder->snacksInfo['total_snacks']}}</td>
                                    <td style="vertical-align: middle;">{{$finishedOrder->snacksInfo['total_price']}}</td>
                                    <td style="vertical-align: middle;">{{$finishedOrder->status->name}}</td>
                                    <td><a href="{{route('admin.order.show', ['id' => $finishedOrder->id])}}"><button type="button" class="btn-sm btn-info text-white">Aanpassen</button></a></td>
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
