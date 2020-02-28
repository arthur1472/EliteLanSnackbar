@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(count($unfinishedOrders) > 0)
            <div class="col-md-10 mb-4">
                <div class="card">
                    <div class="card-header">Onfageronde bestellingen</div>

                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Naam</th>
                                <th scope="col">Snacks</th>
                                <th scope="col">Betaald</th>
                                <th scope="col">Status</th>
                                <th scope="col">Acties</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($unfinishedOrders as $unfinishedOrder)
                                <tr>
                                    <td style="vertical-align: middle;">{{$unfinishedOrder->user->name}}</td>
                                    <td style="vertical-align: middle;">{{$unfinishedOrder->snacksInfo['total_snacks']}}</td>
                                    <td style="vertical-align: middle;">
                                        @if($unfinishedOrder->paid)
                                            <button type="button" class="btn-sm btn-success">Ja</button>
                                        @else
                                            <button type="button" class="btn-sm btn-danger">Nee</button>
                                        @endif
                                    </td>
                                    <td style="vertical-align: middle;"><button type="submit" class="btn-sm {{$unfinishedOrder->status->button_class}}">{{$unfinishedOrder->status->name}}</button></td>
                                    <td>
                                        <a href="{{route('order.show', ['id' => $unfinishedOrder->id])}}">
                                            <button type="button" class="btn-sm btn-info text-white">Aanpassen</button>
                                            @if($unfinishedOrder->admin_note)
                                                <button type="button" class="btn-sm btn-warning ml-2" data-toggle="tooltip" data-placement="top" title="Er is een notitie">Attentie, bekijk bestelling!</button>
                                            @endif
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        @if(count($newOrders) > 0)
            <div class="col-md-10 mb-4">
                <div class="card">
                    <div class="card-header">Nieuwe bestellingen</div>

                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Naam</th>
                                <th scope="col">Snacks</th>
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
                                    <td style="vertical-align: middle;">
                                        @if($newOrder->paid)
                                            <button type="button" class="btn-sm btn-success">Ja</button>
                                        @else
                                            <button type="button" class="btn-sm btn-danger">Nee</button>
                                        @endif
                                    </td>
                                    <td style="vertical-align: middle;"><button type="submit" class="btn-sm {{$newOrder->status->button_class}}">{{$newOrder->status->name}}</button></td>
                                    <td>
                                        <a href="{{route('order.show', ['id' => $newOrder->id])}}">
                                            <button type="button" class="btn-sm btn-info text-white">Bekijk</button>
                                            @if($newOrder->admin_note)
                                                <button type="button" class="btn-sm btn-warning ml-2" data-toggle="tooltip" data-placement="top" title="Er is een notitie">Attentie, bekijk bestelling!</button>
                                            @endif
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        @if(count($inProgressOrders) > 0)
            <div class="col-md-10 mb-4">
                <div class="card">
                    <div class="card-header">Bestelling in behandeling</div>

                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Naam</th>
                                <th scope="col">Snacks</th>
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
                                    <td style="vertical-align: middle;">
                                        @if($inProgressOrder->paid)
                                            <button type="button" class="btn-sm btn-success">Ja</button>
                                        @else
                                            <button type="button" class="btn-sm btn-danger">Nee</button>
                                        @endif
                                    </td>
                                    <td style="vertical-align: middle;"><button type="submit" class="btn-sm {{$inProgressOrder->status->button_class}}">{{$inProgressOrder->status->name}}</button></td>
                                    <td>
                                        <a href="{{route('order.show', ['id' => $inProgressOrder->id])}}">
                                            <button type="button" class="btn-sm btn-info text-white">Bekijk</button>
                                            @if($inProgressOrder->admin_note)
                                                <button type="button" class="btn-sm btn-warning ml-2" data-toggle="tooltip" data-placement="top" title="Er is een notitie">Attentie, bekijk bestelling!</button>
                                            @endif
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endsection
