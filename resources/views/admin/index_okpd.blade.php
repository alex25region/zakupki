@extends('admin.layouts.dashboard')

@section('content')

    <div class="card shadow w-100 ml-0">
        <div class="card-header">
            <h3>ОКПД2</h3>
        </div>
        <div class="card-body">
            <div class="row mb-3 justify-content-end">
                <button class="btn btn-primary mr-3">
                    Добавить ОКПД
                </button>
            </div>
            <table class="table table-hover table-striped text-center table-sm">

                <thead>

                <tr class="thead-dark">
                    <th>ID</th>
                    <th>Код расходов</th>
                    <th>Код ОКПД</th>
                    <th>Наименование ОКПД</th>
                    <th>Действия</th>
                </tr>
                </thead>

                <tbody>

                @forelse($okpds as $okpd)
                    <tr class="searchable ">
                        <td> {{ $okpd->id }} </td>
                        <td> {{ $okpd->getKODrashodov->kod }} </td>
                        <td><b>{{ $okpd->kod }}</b></td>
                        <td> {{ $okpd->name}} </td>
                        <td>
                            <div class="btn-group btn-group-sm px-2" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-success"><i class="fa fa-pencil-alt"></i></button>
                                <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="searchable">
                        <td>No Data</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection