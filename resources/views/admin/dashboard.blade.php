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
                                <th scope="col">Betaald</th>
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
                                    <td style="vertical-align: middle;">
                                        @if($inProgressOrder->paid)
                                            <button type="button" class="btn-sm btn-success">Ja</button>
                                        @else
                                            <button type="button" class="btn-sm btn-danger">Nee</button>
                                        @endif
                                    </td>
                                    <td style="vertical-align: middle;"><button type="submit" class="btn-sm {{$inProgressOrder->status->button_class}}">{{$inProgressOrder->status->name}}</button></td>
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
                                <th scope="col">Betaald</th>
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
                                    <td style="vertical-align: middle;">
                                        @if($newOrder->paid)
                                            <button type="button" class="btn-sm btn-success">Ja</button>
                                        @else
                                            <button type="button" class="btn-sm btn-danger">Nee</button>
                                        @endif
                                    </td>
                                    <td style="vertical-align: middle;"><button type="submit" class="btn-sm {{$newOrder->status->button_class}}">{{$newOrder->status->name}}</button></td>
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
                                <th scope="col">Betaald</th>
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
                                    <td style="vertical-align: middle;">
                                        @if($finishedOrder->paid)
                                            <button type="button" class="btn-sm btn-success">Ja</button>
                                        @else
                                            <button type="button" class="btn-sm btn-danger">Nee</button>
                                        @endif
                                    </td>
                                    <td style="vertical-align: middle;"><button type="submit" class="btn-sm {{$finishedOrder->status->button_class}}">{{$finishedOrder->status->name}}</button></td>
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
@section('extra')
    <script>
        @if($refreshPage)
        setTimeout(function() {
            location.reload();
        }, 25000);
        @endif
    </script>
@endsection
