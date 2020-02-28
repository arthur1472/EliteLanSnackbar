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
{{--                            <div class="col-md-6 mb-3">--}}
{{--                                <div class="card">--}}
{{--                                    <div class="card-header">Snacks</div>--}}

{{--                                    <div class="card-body">--}}
{{--                                        <ul class="list-group">--}}
{{--                                            @foreach($order->snack as $snack)--}}
{{--                                                <li class="list-group-item d-flex justify-content-between align-items-center">--}}
{{--                                                    {{$snack->name}}--}}
{{--                                                    <span class="badge badge-primary badge-pill p-2 pl-4 pr-4" style="font-size: 90%;">{{$snack->pivot->amount}}</span>--}}
{{--                                                </li>--}}
{{--                                            @endforeach--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
