@extends('admin.layouts.dashboard')

@section('content')

    <div class="card shadow w-100 ml-0">
        <div class="card-header">
            <h3>МПИ</h3>
        </div>
        <div class="card-body">
            <div class="row mb-3 justify-content-end">
{{--                <button class="btn btn-success mr-3" id="create" data-toggle="modal" data-target="#ModalCreate">Добавить МПИ </button>--}}
                <a href="javascript:void(0)" class="btn btn-success mr-3" id="create-new-mpi">
                    Добавить МПИ
                </a>
            </div>
            <table class="table table-hover table-striped text-center table-sm ">
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
                @forelse($mpis as $mpi)
                    <tr id="mpi_id_{{$mpi->id}}" class="searchable">
                        <td> {{ $mpi->id }} </td>
                        <td> {{ $mpi->year }} </td>
                        <td> <b>{{ $mpi->shortname }}</b> </td>
                        <td> {{ $mpi->name }} </td>
                        <td> {{ $mpi->kod }} </td>
                        <td>
                            <div class="btn-group btn-group-sm px-2" role="group" aria-label="Basic example">
{{--                                <button type="button" class="btn btn-primary" id="edit" data-id="{{ $mpi->id }}" data-toggle="modal" data-target="#ModalEdit"><i class="fa fa-pencil-alt"></i></button>--}}
{{--                                <button type="button" class="btn btn-danger" id="delete" data-id="{{ $mpi->id }}"><i class="fa fa-trash"></i></button>--}}
                                <a href="javascript:void(0)" class="btn btn-primary"  id="edit-mpi" data-id="{{ $mpi->id }}"><i class="fa fa-pencil-alt"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger delete-mpi" id="delete-mpi" data-id="{{ $mpi->id }}"><i class="fa fa-trash"></i></a>

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

    {{--Модальное окно Create--}}
    <div class="modal fade" id="ModalMPI" tabindex="-1" role="dialog" aria-labelledby="label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalMPIlabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="FormMPI" name="FormMPI" >
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btn-save" value="create">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    {{--Модальное окно Edit--}}
    <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="label">Редактирование МПИ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Редактирование
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });

            // create
            $('#create-new-mpi').click(function () {
                $('#btn-save').val("create-mpi");           // присвоение значение для обработки запроса в ajax (ниже по скрипту)
                $('#FormMPI').trigger("reset");       // очистка формы
                $('#ModalMPIlabel').html("Создание МПИ");   // изменение заголовка модального окна
                $('#ModalMPI').modal('show');               // открыть модальное окно
            });

            // edit


            // $('body').on('click', '#edit-mpi', function () {
            $('body').on('click', '#edit-mpi', function () {
                var mpi_id = $(this).data('id');
                console.log($(this).data('shortname'));
                //console.log('http://127.0.0.1:8000/mpi' + '/' + mpi_id +'/edit');
                $.get('{{ url('mpi')}}' + '/' + mpi_id +'/edit', function (data) {
                // $.get('http://127.0.0.1:8000/mpi' + '/' + mpi_id +'/edit', function (data) {

                    $('#ModalMPIlabel').html("Редактирование МПИ");
                    $('#btn-save').val("edit-mpi");
                    $('#ModalMPI').modal('show');
                    $('#id').val(data.id);
                    $('#year').val(data.year);
                    $('#shortname').val(data.shortname);
                    $('#name').val(data.name);
                    $('#kod').val(data.kod);
                })

            });



            // delete
            $('body').on('click', '.delete-mpi', function () {
                var mpi_id = $(this).data("id");
                //console.log(mpi_id);
                if(confirm("Are You sure want to delete!")) {
                    //console.log(mpi_id);
                    $.ajax({
                        type: "DELETE",

                        // тут указать корректный роут:
                        url: "{{ url('mpi')}}"+'/'+mpi_id,
                        success: function (data) {
                            $("#mpi_id_" + mpi_id).remove();
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }
            });

        });




    </script>




@endsection