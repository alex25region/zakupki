@extends('admin.layouts.dashboard')

@section('content')

    <div class="card shadow w-100 ml-0">
        <div class="card-header">
            <h3>ТРУ</h3>
        </div>
        <div class="card-body">
            <div class="row mb-3 justify-content-end">
                <a href="javascript:void(0)" class="btn btn-success mr-3" id="create-new-tru">
                    Добавить ТРУ
                </a>
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

    {{-- create/update modal--}}
        <div class="modal fade" id="ajaxModal" tabindex="-1" role="dialog" aria-labelledby="label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalHeader"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <span id="form_result"></span>
                    <form id="truForm" name="truForm" >
                        <div class="modal-body">
                            <input type="hidden" name="tru_id" id="tru_id"> {{--скрытый input со значением id--}}
                            <div class="form-group">
                                <label for="name" class="control-label">Наименование ТРУ</label>
                                <input type="text" class="form-control" id="name" name="name" value="" required="">
                            </div>
                            <div class="form-group">
                                <label for="mpi_id" class="control-label">МПИ</label>
                                <select class="form-control" id="mpi_id" name="mpi_id">


                                @foreach($mpis as $mpi)
                                    <option value="{{ $mpi->id }}">{{ $mpi->name }}</option>
                                @endforeach
                                {{--                                @foreach($mpis as $mpi)

                                                                @if( $mpi->id == $tru->getMPIfromTRU->id )
                                                                    <option value="{{ $mpi->id }}" selected="selected"> {{ $mpi->name}}</option>
                                                                @else
                                                                    <option value="{{ $mpi->id }}"> {{ $mpi->name }}</option>
                                                                @endif
                                                                @endforeach--}}
                                </select>
{{--                                <label for="mpi_id" class="control-label">МПИ</label>--}}
{{--                                <input type="text" class="form-control" id="mpi_id" name="mpi_id" value="" required="">--}}
                            </div>

                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btn-save" value="create-tru">Save changes</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Отмена</button>
                    </div>
                </div>
            </div>
        </div>

    <script type="text/javascript">

    $(document).ready(function () {
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
                },
            ]
        });

        // create
        $('#create-new-tru').click(function () {
            $('#btn-save').html("Создать");
            $('#tru_id').val('');
            $('#truForm').trigger("reset");
            $('#ModalHeader').html("Создание ТРУ");
            $('#ajaxModal').modal('show');
        });

        // create or update
        $('#btn-save').click(function (e) {
            e.preventDefault();
            $(this).html('Сохранение...');

            $.ajax({
                data: $('#truForm').serialize(),
                url: "{{ url('tru') }}",
                type: "POST",
                dataType: 'json',
/*                success: function (data) {
                    $('#truForm').trigger("reset");
                    $('#ajaxModal').modal('hide');
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#btn-save').html('Сохранить');
                }*/
                success:function(data)
                {
                    var html = '';
                    if(data.errors)
                    {
                        html = '<div class="alert alert-danger">';
                        for(var count = 0; count < data.errors.length; count++)
                        {
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                    }
                    if(data.success) {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $('#truForm').trigger("reset");
                        $('#ajaxModal').modal('hide');
                        table.draw();

                    }
                    $('#form_result').html(html);
                }


            });
        });


        // edit
        $('body').on('click', '#edit-tru', function () {
            var tru_id = $(this).data('id');
            $.get("{{ url('tru') }}" + '/' + tru_id + '/edit', function (data) {
                $('#ModalHeader').html("Редактирование ТРУ");
                $('#btn-save').html('Обновить');
                $('#ajaxModal').modal('show');
                $('#tru_id').val(data.id);
                $('#name').val(data.name);
                $('#mpi_id').val(data.mpi_id);
            })
        });

        // delete
       $('body').on('click', '#delete-tru', function () {
            var tru_id = $(this).data("id");
            confirm("Are You sure want to delete!");

            $.ajax({
                type: "DELETE",
                url: "{{ url('tru') }}" + '/' + tru_id,
                success: function (data) {
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });


        });
    </script>
@endsection
