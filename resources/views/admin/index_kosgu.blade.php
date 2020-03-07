@extends('admin.layouts.dashboard')

@section('content')
    <div class="card shadow w-100 ml-0">
        <div class="card-header">
            <h3>КОСГУ</h3>
        </div>
        <div class="card-body">
            <div class="row mb-3 justify-content-end">
                <button class="btn btn-primary mr-3">
                    Добавить КОСГУ
                </button>
            </div>
            <table class="table table-hover table-striped table-sm ">

                <thead>

                <tr class="thead-dark">
                    <th>ID</th>
                    <th>Код расходов</th>
                    <th>Код КОСГУ</th>
                    <th>Наименование КОСГУ</th>
                    <th>Действия</th>
                </tr>
                </thead>

                <tbody>

                @forelse($kosgus as $kosgu)
                    <tr class="searchable ">

                        <td> {{ $kosgu->id }} </td>
                        <td> {{ $kosgu->getKODrashodov->kod }} </td>
                        <td> <b>{{ $kosgu->kod }} </b></td>
                        <td> {{ $kosgu->name}} </td>
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