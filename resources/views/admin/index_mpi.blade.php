@extends('admin.layouts.dashboard')

@section('content')

    <div class="card shadow w-100 ml-0">
        <div class="card-header">
            <h3>МПИ</h3>
        </div>
        <div class="card-body">
            <div class="row mb-3 justify-content-end">
                <a href="javascript:void(0)" class="btn btn-success mr-3" id="create-new-mpi">
                    Добавить МПИ
                </a>
            </div>
            <table id="dataTable" class="table table-hover table-striped text-center table-sm ">
                <thead>
                <tr class="thead-dark">
                    <th>ID</th>
                    <th>Год</th>
                    <th>Наименование</th>
                    <th>Полное Наименование</th>
                    <th>Код</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
               {{-- @forelse($mpis as $mpi)
                    <tr id="mpi_id_{{$mpi->id}}">
                        <td> {{ $mpi->id }} </td>
                        <td> {{ $mpi->year }} </td>
                        <td> <b>{{ $mpi->shortname }}</b> </td>
                        <td> {{ $mpi->name }} </td>
                        <td> {{ $mpi->kod }} </td>
                        <td>
                            <div class="btn-group btn-group-sm px-2" role="group">
                                <a href="javascript:void(0)" class="btn btn-primary"  id="edit-mpi" data-id="{{ $mpi->id }}"><i class="fa fa-pencil-alt"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger delete-mpi" id="delete-mpi" data-id="{{ $mpi->id }}"><i class="fa fa-trash"></i></a>
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

    {{--Модальное окно Create--}}
    <div class="modal fade" id="ajaxModal" tabindex="-1" role="dialog" aria-labelledby="label">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalHeader"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="mpiForm" name="mpiForm" >
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id"> {{--скрытый input со значением id--}}

                        <div class="form-group">
                            <label for="year" class="control-label">Год</label>
                                <input type="text" class="form-control" id="year" name="year" value="" maxlength="4" required="">
                        </div>
                        <div class="form-group">
                            <label for="shortname" class="control-label">МПИ</label>
                            <input type="text" class="form-control" id="shortname" name="shortname" value="" required="">
                        </div>
                        <div class="form-group">
                            <label for="name" class="control-label">Полное наименование МПИ</label>
                            <input type="text" class="form-control" id="name" name="name" value="" required="">

                        </div>
                        <div class="form-group">
                            <label for="kod" class="control-label">Код МПИ</label>
                                <input type="text" class="form-control" id="kod" name="kod" value="" required="">
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-save" value="">Сохранить</button>
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
                ajax: "{{ url('mpi') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'year', name: 'year'},
                    {data: 'shortname', name: 'shortname', class:'bolded'},
                    {data: 'name', name: 'name'},
                    {data: 'kod', name: 'kod'},
                    {data: 'action',
                        orderable: false,
                        searchable: false,
                    },
                ]
            });

            // create
            $('#create-new-mpi').click(function () {
                $('#btn-save').html("Создать");
                $('#mpi_id').val('');
                $('#mpiForm').trigger("reset");
                $('#ModalHeader').html("Создание МПИ");
                $('#ajaxModal').modal('show');
            });

            // create or update
            $('#btn-save').click(function (e) {
                e.preventDefault();
                $(this).html('Сохранение...');

                $.ajax({
                    data: $('#mpiForm').serialize(),
                    url: "{{ url('mpi') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#mpiForm').trigger("reset");
                        $('#ajaxModal').modal('hide');
                        table.draw();
                        Swal.fire(
                            'Good job!',
                            'Позиция успешно создана или обновлена!',
                            'success'
                        );
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#btn-save').html('Сохранить');
                    }
                });
            });


            // edit
            $('body').on('click', '#edit-mpi', function () {
                var mpi_id = $(this).data('id');
                $.get("{{ url('mpi') }}" + '/' + mpi_id + '/edit', function (data) {
                    $('#ModalHeader').html("Редактирование МПИ");
                    $('#btn-save').html('Обновить');
                    $('#ajaxModal').modal('show');
                    $('#id').val(data.id);
                    $('#year').val(data.year);
                    $('#shortname').val(data.shortname);
                    $('#name').val(data.name);
                    $('#kod').val(data.kod);
                })
            });

            // delete
            $('body').on('click', '#delete-mpi', function () {
                var mpi_id = $(this).data("id");
                if(confirm("Are You sure want to delete!")){
                    $.ajax({
                        type: "DELETE",
                        url: "{{ url('mpi') }}" + '/' + mpi_id,
                        success: function (data) {
                            Swal.fire(
                                'Good job!',
                                'Позиция успешно удалена!',
                                'success'
                            );
                            table.draw();

                        },
                        error: function (data) {
                            console.log('Error:', data);
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            })
                        }
                    });
                }
            });


        });
    </script>




@endsection
