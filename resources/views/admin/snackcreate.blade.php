@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Snack aanmaken</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">Gegevens</div>
                                    <form method="post" action="{{route('admin.snack.store')}}">
                                        @csrf
                                        <div class="card-body">
                                            <table class="table table-borderless">
                                                <tbody>
                                                <tr>
                                                    <td style="vertical-align: middle;">Naam</td>
                                                    <td><input type="text" name="name" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: middle;">Prijs</td>
                                                    <td><input type="text" name="price" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: middle;">Actief</td>
                                                    <td>
                                                        <select name="active">
                                                            <option value="1">Ja</option>
                                                            <option value="0">Nee</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <button type="submit" class="btn-sm btn-primary mt-3">Opslaan</button>
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
@endsection
