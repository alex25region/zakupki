@extends('admin.layouts.dashboard')

@section('content')

    <div class="card shadow w-100 ml-0">
        <div class="card-header">
            <h3>ОКПД2</h3>
        </div>
        <div class="card-body">

            <table class="table table-hover table-striped text-center table-sm table-bordered">

                <thead>

                <tr class="thead-dark">
                    <th>ID</th>
                    <th>Код расходов</th>
                    <th>Код КОСГУ</th>
                    <th>Наименование КОСГУ</th>
                </tr>
                </thead>

                <tbody>

                @forelse($okpds as $okpd)
                    <tr class="searchable ">

                        <td> {{ $okpd->id }} </td>
                        <td> {{ $okpd->getKODrashodov->kod }} </td>
                        <td> {{ $okpd->kod }} </td>
                        <td> {{ $okpd->name}} </td>


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