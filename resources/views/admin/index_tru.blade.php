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

            <table class="table table-hover table-striped text-center table-sm table-bordered">

                <thead>

                <tr class="thead-dark">
                    <th>ID</th>
                    <th>Наименование</th>
                    <th>МПИ</th>
                </tr>
                </thead>

                <tbody>

                @forelse($trus as $tru)
                    <tr class="searchable ">

                        <td> {{ $tru->id }} </td>
                        <td> {{ $tru->name }} </td>
                        <td> {{ $tru->getMPIfromTRU->shortname }} </td>


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