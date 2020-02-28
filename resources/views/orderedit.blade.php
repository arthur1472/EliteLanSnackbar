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
                                    <div class="card-header">Beschikbare snacks</div>

                                    <div class="card-body">
                                        <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                    <td>Naam</td>
                                                    <td>Prijs</td>
                                                    <td></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($activeSnacks as $snack)
                                                    <tr>
                                                        <td style="width: 40%;">{{$snack->name}}</td>
                                                        <td>{{$snack->price}}</td>
                                                        <td>
                                                            <form method="post" action="{{route('order.update', ['id' => $order->id])}}" >
                                                                @csrf
                                                                <input type="hidden" name="addSnack" value="{{$snack->id}}">
                                                                <button type="submit" class="btn-sm btn-primary">Toevoegen</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card">
                                    <div class="card-header">Snacks in bestelling</div>

                                    <div class="card-body">
                                        <table class="table table-borderless">
                                            <thead>
                                            <tr>
                                                <td>Naam</td>
                                                <td>Hoeveelheid</td>
                                                <td></td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($order->snack as $snack)
                                                    <tr class="align-middle">
                                                        <td>{{$snack->name}}</td>
                                                        <td><span class="badge badge-primary badge-pill p-2 pl-4 pr-4" style="font-size: 90%;">{{$snack->pivot->amount}}</span></td>
                                                        <td>
                                                            <form method="post" action="{{route('order.update', ['id' => $order->id])}}" >
                                                                @csrf
                                                                <input type="hidden" name="removeSnack" value="{{$snack->id}}">
                                                                <button type="submit" class="btn-sm btn-danger">1 verwijderen</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card">
                                    <div class="card-header">Extra gegevens</div>

                                    <div class="card-body">
                                        <form method="post" action="{{route('order.update', ['id' => $order->id])}}">
                                            @csrf
                                            <table class="table table-borderless mb-3">
                                                <tbody>
                                                <tr>
                                                    <td>Gebruiker notitie</td>
                                                    <td>
                                                        <textarea name="user_note" class="form-control" rows="2">{{$order->user_note}}</textarea>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <button name="save" type="submit" value="1" class="btn-sm btn-primary">Opslaan</button>
                                                </div>
                                                <div class="col-md-4 offset-4">
                                                    <button name="complete" type="submit" value="1" class="btn-sm ml btn-success">Afronden</button>
                                                </div>
                                            </div>
                                        </form>
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
