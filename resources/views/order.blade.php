@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-2">
            <div class="col-md-4 offset-1">
                <a href="{{route('home')}}"><button type="button" class="btn-sm btn-primary"><- Terug naar overzicht</button></a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Bestelling</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="card">
                                    <div class="card-header">Gegevens</div>

                                    <div class="card-body">
                                        <form method="post" action="">
                                            @csrf
                                            <table class="table table-borderless">
                                                <tbody>
                                                <tr>
                                                    <td>Snacks</td>
                                                    <td>{{$order->snacksInfo['total_snacks']}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Prijs</td>
                                                    <td>{{$order->snacksInfo['total_price']}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Betaald</td>
                                                    <td>
                                                        @if($order->paid)
                                                            <button type="button" class="btn-sm btn-success">Ja</button>
                                                        @else
                                                            <button type="button" class="btn-sm btn-danger">Nee</button>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Status</td>
                                                    <td>
                                                        <button type="button" class="btn-sm {{$order->status->button_class}}">{{$order->status->name}}</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Gebruiker notitie</td>
                                                    <td>
                                                        <textarea readonly class="form-control" rows="2">{{$order->user_note}}</textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Admin notitie</td>
                                                    <td>
                                                        <textarea readonly class="form-control" rows="2" name="admin_note">{{$order->admin_note}}</textarea>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
{{--                                            <button type="submit" class="btn-sm btn-primary">Opslaan</button>--}}
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card">
                                    <div class="card-header">Snacks</div>

                                    <div class="card-body">
                                        <ul class="list-group">
                                            @foreach($order->snack as $snack)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    {{$snack->name}}
                                                    <span class="badge badge-primary badge-pill p-2 pl-4 pr-4" style="font-size: 90%;">{{$snack->pivot->amount}}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
