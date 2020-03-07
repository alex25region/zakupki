@extends('admin.layouts.dashboard')

@section('content')
    {{--    <div id="app">--}}
    {{--        <h1>Hello, admin!</h1>--}}
    {{--    </div>--}}

    <div class="card shadow w-100 ml-0">
        <div class="card-header">
            <h3>ТРУ</h3>
        </div>
        <div class="card-body">
            <div class="row mb-3 justify-content-end">
                <button class="btn btn-primary mr-3">
                    Добавить ТРУ
                </button>
            </div>
            <table class="table table-hover table-striped text-center table-sm">

                <thead>

                <tr class="thead-dark">
                    <th>ID</th>
                    <th>Наименование ТРУ</th>
                    <th>МПИ</th>
                    <th>Действия</th>

                </tr>
                </thead>

                <tbody>

                @forelse($trus as $tru)
                    <tr class="searchable ">
                        <td> {{ $tru->id }} </td>
                        <td> {{ $tru->name }} </td>
                        <td> {{ $tru->getMPIfromTRU->shortname }} </td>
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