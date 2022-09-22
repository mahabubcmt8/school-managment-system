@extends('layouts.backend.app')
@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12 ">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active">Section</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title text-warning float-left">Section</h5>
                    <button class="btn btn-warning btn-round float-right text-white" data-toggle="modal"
                        data-target="#modal">
                        <i class="fa fa-plus"></i> Create New
                    </button>
                </div>
                <div class="card-body pt-5">
                    <table id="example" class="display text-info text-center" style="width:100%">
                        <thead class="bg-success text-white">
                            <tr>
                                <th class="text-center">Class</th>
                                <th class="text-center">Section</th>
                                <th class="text-center">Capacity</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">

                        </tbody>
                        <tfoot class="bg-success text-white">
                            <tr>
                                <th class="text-center">Class</th>
                                <th class="text-center">Section</th>
                                <th class="text-center">Capacity</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('backend.section.modal')
@endsection
@section('script')
    @include('backend.includes.script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
        $('.btnUpdate').hide();
        // --------------------- Get All Inputs ----------------------
        function getInput() {
            var id = $("#data_id").val();
            var class_id = $('select[name="class_id"]').val();
            var name = $('input[name="name"]').val();
            var capacity = $('input[name="capacity"]').val();
            return {
                id: id,
                class_id: class_id,
                name: name,
                capacity: capacity,
                _token: '{!! csrf_token() !!}'
            }
        }

        // --------------------- Get All Records from Database ---------------------
        function allData() {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/get/sections",
                success: function(data) {
                    html = '';
                    $.each(data, function(key, value) {
                        html += '<tr>'
                        html += '<td>'+ value.classes.class_name + '</td>'
                        html += '<td>' + value.name + '</td>'
                        html += '<td>' + value.capacity + '</td>'
                        html += '<td>'
                        html += '<button type="button" class="btn text-warning" onclick="editData(' +
                            value.id + ')"><h5><i class="fa fa-edit (alias)"></i></h5></button>';
                        html += '<button type="button" class="btn text-danger" onclick="deleteData(' +
                            value.id + ')"><h5><i class="fa fa-trash-o"></i></h5></button>';
                        html += '</td>'
                        html += '</tr>'
                    });
                    $('.tbody').html(html);
                }
            });
        }
        allData();

        // -------------------- Create a new Record -----------------------
        function storeData() {
            $.ajax({
                type: "POST",
                url: "{{ route('section.store') }}",
                data: getInput(),
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Class Created Successfully',
                        timer: 1500
                    });
                    success();
                },
                error: function(error) {
                    $('.validate_class_id').text(error.responseJSON.errors.class_id);
                    $('.validate_name').text(error.responseJSON.errors.name);
                    $('.validate_capacity').text(error.responseJSON.errors.capacity);
                }
            })
        }

        // -------------------- Edit Data ----------------------
        function editData(id) {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "section/" + id + "/edit",
                success: function(data) {
                    $("#modal").modal('show');
                    $('.btnSave').hide();
                    $('.btnUpdate').show();
                    $("#data_id").val(data.id);
                    $('input[name="name"]').val(data.name);
                    $('input[name="capacity"]').val(data.capacity);
                }
            });
        }

        // --------------------- Update Data ------------------------
        function updateData() {
            var id = $("#data_id").val();

            $.ajax({
                type: "PUT",
                dataType: 'json',
                data: getInput(),
                url: "section/" + id,
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Updated Successfull',
                        timer: 1500
                    });
                    success();
                    $('.btnSave').show();
                    $('.btnUpdate').hide();
                },
                error: function(error) {
                    $('.validate_class_id').text(error.responseJSON.errors.class_id);
                    $('.validate_name').text(error.responseJSON.errors.name);
                    $('.validate_capacity').text(error.responseJSON.errors.capacity);
                }
            });
        }

        // --------------------- Data Delete ---------------------
        function deleteData(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Delete This Item!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        data: getInput(),
                        url: "/section/" + id,
                        success: function(data) {
                            success();
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        }
                    });
                }
            });
        }
    </script>
@endsection