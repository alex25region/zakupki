@extends('admin.layouts.dashboard')

@section('content')
    {{--    <div id="app">--}}
    {{--        <h1>Hello, admin!</h1>--}}
    {{--    </div>--}}

    <div class="card shadow w-100 ml-0">
        <div class="card-header">
            <h3>КОСГУ</h3>
        </div>
        <div class="card-body">

            <table class="table table-hover table-striped table-sm table-bordered">

                <thead>

                <tr class="thead-dark">
                    <th>ID</th>
                    <th>Код расходов</th>
                    <th>Код КОСГУ</th>
                    <th>Наименование КОСГУ</th>
                </tr>
                </thead>

                <tbody>

                @forelse($kosgus as $kosgu)
                    <tr class="searchable ">

                        <td> {{ $kosgu->id }} </td>
                        <td> {{ $kosgu->getKODrashodov->kod }} </td>
                        <td> {{ $kosgu->kod }} </td>
                        <td> {{ $kosgu->name}} </td>


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