@extends('admin.layouts.dashboard')

@section('content')

    <div class="card shadow w-100 mx-3">
        <div class="card-header">
            <h3>ОБАС</h3>
        </div>
        <div class="card-body">

            <table class="table table-hover table-striped text-center table-sm table-bordered">

                <thead>

                <tr class="thead-dark">
                    <th>ID</th>
                    <th>Год</th>
                    <th>МПИ</th>
                    <th>Код МПИ</th>
                    <th>ТРУ</th>
                    <th>КОСГУ</th>
                    <th>Наименование КОСГУ</th>
                    <th>ОКПД</th>
                    <th>Наименование ОКПД</th>
                    <th>Сумма, руб.</th>

                </tr>
                </thead>

                <tbody>

                @forelse($obass as $obas)
                    <tr class="searchable ">

                        <td> {{ $obas->id }} </td>
                        <td> {{ $obas->year }} </td>
                        <td> {{ $obas->getMPI->shortname }} </td>
                        <td> {{ $obas->getMPI->kod }} </td>
                        <td> {{ $obas->getTRU->name }} </td>
                        <td> {{ $obas->getKOSGU->kod }} </td>
                        <td> {{ $obas->getKOSGU->name }} </td>
                        <td> {{ $obas->getOKPD->kod }} </td>
                        <td> {{ $obas->getOKPD->name }} </td>
                        <td> {{ $obas->sum }} </td>


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