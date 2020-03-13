@extends('admin.layouts.dashboard')

@section('content')
    <div class="card shadow w-100 ml-0">
        <div class="card-header">
            <h3>КОСГУ</h3>
        </div>
        <div class="card-body">
            <div class="row mb-3 justify-content-end">
                <a href="javascript:void(0)" class="btn btn-success mr-3" id="create-new-kosgu">
                    Добавить КОСГУ
                </a>
            </div>
            <table  id="dataTable" class="table table-hover table-bordered table-striped table-sm ">

                <thead>

                <tr class="thead-dark">
                    <th>ID</th>
                    <th>Код КОСГУ</th>
                    <th>Наименование КОСГУ</th>
                    <th>Код расходов</th>
                    <th>Действия</th>
                </tr>
                </thead>

                <tbody>

                {{--
                    @forelse($kosgus as $kosgu)
                        <tr class="searchable ">
                            <td> {{ $kosgu->id }} </td>
                            <td> {{ $kosgu->getKODrashodov->kod }} </td>
                            <td> <b>{{ $kosgu->kod }} </b></td>
                            <td> {{ $kosgu->name}} </td>
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
                --}}
                </tbody>
            </table>
        </div>
    </div>

{{--Модальное окно--}}
    <div class="modal fade" id="ajaxModal" tabindex="-1" role="dialog" aria-labelledby="label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalHeader"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="kosguForm" name="kosguForm" >
                    <div class="modal-body">
                        <input type="hidden" name="kosgu_id" id="kosgu_id"> {{--скрытый input со значением id--}}
                        <div class="form-group">
                            <label for="kod" class="control-label">Код КОСГУ</label>
                            <input type="text" class="form-control" id="kod" name="kod" value="" required="">
                        </div>
                        <div class="form-group">
                            <label for="name" class="control-label">Наименование КОСГУ</label>
                            <input type="text" class="form-control" id="name" name="name" value="" required="">
                        </div>
                        <div class="form-group">
                            <label for="kod_rashodov_id" class="control-label">Код расходов</label>
                            <select class="form-control" id="kod_rashodov_id" name="kod_rashodov_id">


                                @foreach($kodrashodov as $item)
                                    <option value="{{ $item->id }}">{{ $item->kod }}</option>
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
                    <button type="button" class="btn btn-primary" id="btn-save" value="create-kosgu">Save changes</button>
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
                paging: false,
                processing: true,
                serverSide: true,
                ajax: "{{ url('kosgu') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'kod', name: 'kod', className:"bolded"},
                    {data: 'name', name: 'name'},
                    {data: 'kod_rashodov_id', name: 'kod_rashodov_id'},
                    {
                        data: 'action', name:'action',
                        orderable: false,
                        searchable: false,
                    },
                ]
            });

            // create
            $('#create-new-kosgu').click(function () {
                $('#btn-save').html("Создать");
                $('#kosgu_id').val('');
                $('#kosguForm').trigger("reset");
                $('#ModalHeader').html("Создание КОСГУ");
                $('#ajaxModal').modal('show');
            });

            // update or create
            $('#btn-save').click(function (e) {
                e.preventDefault();
                $(this).html('Сохранение...');

                $.ajax({
                    data: $('#kosguForm').serialize(),
                    url: "{{ url('kosgu') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#kosguForm').trigger("reset");
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
                        Swal.fire(
                            'Failed!',
                            'Что-то пошло не так!',
                            'error'
                        );
                    }
                });
            });

            //edit
            $('body').on('click', '#edit-kosgu', function () {
                var kosgu_id = $(this).data('id');
                $.get("{{ url('kosgu') }}" + '/' + kosgu_id + '/edit', function (data) {
                    $('#ModalHeader').html("Редактирование КОСГУ");
                    $('#btn-save').html('Обновить');
                    $('#ajaxModal').modal('show');
                    $('#kosgu_id').val(data.id);
                    $('#kod_rashodov_id').val(data.kod_rashodov_id);
                    $('#kod').val(data.kod);
                    $('#name').val(data.name);
                })
            });

            // delete
            $('body').on('click', '#delete-kosgu', function () {
                var kosgu_id = $(this).data("id");
                if(confirm("Are You sure want to delete!")){
                    $.ajax({
                        type: "DELETE",
                        url: "{{ url('kosgu') }}" + '/' + kosgu_id,
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