@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-2">
            <div class="col-md-4 offset-1">
                <a href="{{route('admin.snack')}}"><button type="button" class="btn-sm btn-primary"><- Terug naar snacks</button></a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Snack</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">Gegevens</div>
                                    <form method="post" action="{{route('admin.snack.update', ['id' => $snack->id])}}">
                                        @csrf
                                        <div class="card-body">
                                            <table class="table table-borderless">
                                                <tbody>
                                                <tr>
                                                    <td style="vertical-align: middle;">Naam</td>
                                                    <td><input type="text" name="name" class="form-control" value="{{$snack->name}}"></td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: middle;">Prijs</td>
                                                    <td><input type="text" name="price" class="form-control" value="{{$snack->price}}"></td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: middle;">Actief</td>
                                                    <td>
                                                        <select name="active">
                                                            <option @if($snack->active) selected @endif value="1">Ja</option>
                                                            <option @if(!$snack->active) selected @endif value="0">Nee</option>
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
