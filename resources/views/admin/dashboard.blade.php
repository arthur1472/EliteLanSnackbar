@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Nieuwe bestellingen</div>

                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Naam</th>
                                <th scope="col">Snacks</th>
                                <th scope="col">Status</th>
                                <th scope="col">Acties</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($unfinishedOrders as $unfinishedOrder)
                                <tr>
                                    <td style="vertical-align: middle;">{{$unfinishedOrder->user->name}}</td>
                                    <td style="vertical-align: middle;">5</td>
                                    <td style="vertical-align: middle;">{{$unfinishedOrder->status->name}}</td>
                                    <td><button type="button" class="btn-sm btn-info text-white">Aanpassen</button></td>
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
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
