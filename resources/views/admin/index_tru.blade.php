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
                <button class="btn btn-success mr-3">
                    Добавить ТРУ
                </button>
            </div>
            <table id="dataTable" class="table table-hover table-bordered table-striped">

                <thead>

                <tr class="thead-dark">
                    <th>ID</th>
                    <th>Наименование ТРУ</th>
                    <th>МПИ</th>
                    <th>Действия</th>

                </tr>
                </thead>

                <tbody>

                {{--@forelse($trus as $tru)
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
                @endforelse--}}
                </tbody>
            </table>
        </div>
    </div>
    {{-- create/update book modal--}}
    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="bookForm" name="bookForm" class="form-horizontal">
                        <input type="hidden" name="book_id" id="book_id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Наименование ТРУ</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"
                                       value="" maxlength="50" required="" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">МПИ</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="author" name="author"
                                       placeholder="Enter author name"
                                       value="" maxlength="50" required="" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // datatable
        var table = $('#dataTable').DataTable({
            paging:   false,
            processing: true,
            serverSide: true,
            ajax: "{{ url('tru') }}",
            columns: [
                {data: 'id',},
                {data: 'name'},
                {data: 'mpi_id'},
                {data: 'action',
                    orderable: false,
                    searchable: false,
/*                    "defaultContent": '<div class="btn-group btn-group-sm px-2" role="group">' +
                        '<button type="button" class="btn btn-primary"><i class="fa fa-pencil-alt"></i></button>' +
                        '<button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>' +
                        '</div>',*/
                },
            ]
        });
    </script>
@endsection
