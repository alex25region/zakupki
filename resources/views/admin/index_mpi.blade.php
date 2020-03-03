@extends('admin.layouts.dashboard')

@section('content')
    {{--    <div id="app">--}}
    {{--        <h1>Hello, admin!</h1>--}}
    {{--    </div>--}}

    <div class="card shadow w-100 ml-0">
        <div class="card-header">
            <h3>МПИ</h3>
        </div>
        <div class="card-body">

            <table class="table table-hover table-striped text-center table-sm table-bordered">

                <thead>

                <tr class="thead-dark">
                    <th>ID</th>
                    <th>Год</th>
                    <th>Наименование</th>
                    <th>Полное Наименование</th>
                    <th>Код</th>
                </tr>
                </thead>

                <tbody>

                @forelse($mpis as $mpi)
                    <tr class="searchable ">

                        <td> {{ $mpi->id }} </td>
                        <td> {{ $mpi->year }} </td>
                        <td> {{ $mpi->shortname }} </td>
                        <td> {{ $mpi->name }} </td>
                        <td> {{ $mpi->kod }} </td>


                        {{--                        <td class="align-middle">--}}
                        {{--                            <a href="{{route('admin.protokols.show', $protokol->KodProtokol)}}">--}}
                        {{--                                <button type="button" class="btn btn-sm btn-primary shadow">Перейти к протоколу</button>--}}
                        {{--                            </a>--}}
                        {{--                        </td>--}}
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