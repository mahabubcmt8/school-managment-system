@extends('layouts.backend.app')
@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12 ">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active">Subject</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title text-success float-left"><strong>Subject</strong></h5>
                    <button class="btn btn-success btn-round float-right text-white" data-toggle="modal"
                        data-target="#modal">
                        <i class="fa fa-plus"></i> Create New
                    </button>
                </div>
                <div class="card-body pt-5">
                    <table id="example" class="table table-bordered display text-white text-muted table-striped dataTable" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center text-info">Class</th>
                                <th class="text-center text-info">Name</th>
                                <th class="text-center text-info">Code</th>
                                <th class="text-center text-info">Type</th>
                                <th class="text-center text-info">Optional</th>
                                <th class="text-center text-info">Total Mark</th>
                                <th class="text-center text-info">Pass Mark</th>
                                <th class="text-center text-info">Action</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            <!-- Table data is loades with ajax -->
                        </tbody>
                        <tfoot class="thead-dark">
                            <tr>
                                <th class="text-center text-info">Class</th>
                                <th class="text-center text-info">Name</th>
                                <th class="text-center text-info">Code</th>
                                <th class="text-center text-info">Type</th>
                                <th class="text-center text-info">Optional</th>
                                <th class="text-center text-info">Total Mark</th>
                                <th class="text-center text-info">Pass Mark</th>
                                <th class="text-center text-info">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('backend.subject.modal')
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
            var code = $('input[name="code"]').val();
            var type = $('select[name="type"]').val();
            var total_mark = $('input[name="total_mark"]').val();
            var pass_mark = $('input[name="pass_mark"]').val();
            var optional = $('input[name="optional"]').val();
            return {
                id: id,
                class_id: class_id,
                name: name,
                code: code,
                type: type,
                total_mark: total_mark,
                pass_mark: pass_mark,
                optional: optional,
                _token: '{!! csrf_token() !!}'
            }
        }

        // --------------------- Get All Records from Database ---------------------
        function allData() {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "{{ route('getAllSubject') }}",
                success: function(data) {
                    html = '';
                    $.each(data, function(key, value) {
                        // optional Condition
                        if (value.optional == 1) {
                            var optional = "YES";
                        } else {
                            var optional = "NO";
                        }
                        html += '<tr>'
                        html += '<td>' + value.classes.class_name + '</td>'
                        html += '<td>' + value.name + '</td>'
                        html += '<td>' + value.code + '</td>'
                        html += '<td>' + value.type + '</td>'
                        html += '<td>' + optional + '</td>'
                        html += '<td>' + value.total_mark + '</td>'
                        html += '<td>' + value.pass_mark + '</td>'
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
                url: "{{ route('subject.store') }}",
                data: getInput(),
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Subject Created Successfully',
                        timer: 1500
                    });
                    success();
                },
                error: function(error) {
                    $('.validate_class_id').text(error.responseJSON.errors.class_id);
                    $('.validate_name').text(error.responseJSON.errors.name);
                    $('.validate_code').text(error.responseJSON.errors.code);
                    $('.validate_type').text(error.responseJSON.errors.type);
                    $('.validate_total_mark').text(error.responseJSON.errors.total_mark);
                    $('.validate_pass_mark').text(error.responseJSON.errors.pass_mark);
                    $('.validate_optional').text(error.responseJSON.errors.optional);
                }
            })
        }

        // -------------------- Edit Data ----------------------
        function editData(id) {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "subject/" + id + "/edit",
                success: function(data) {
                    $("#modal").modal('show');
                    $('.btnSave').hide();
                    $('.btnUpdate').show();
                    $("#data_id").val(data.id);
                    $('input[name="name"]').val(data.name);
                    $('input[name="code"]').val(data.code);
                    $('input[name="total_mark"]').val(data.total_mark);
                    $('input[name="pass_mark"]').val(data.pass_mark);
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
                url: "subject/" + id,
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
                    $('.validate_code').text(error.responseJSON.errors.code);
                    $('.validate_type').text(error.responseJSON.errors.type);
                    $('.validate_total_mark').text(error.responseJSON.errors.total_mark);
                    $('.validate_pass_mark').text(error.responseJSON.errors.pass_mark);
                    $('.validate_optional').text(error.responseJSON.errors.optional);
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
                        url: "subject/" + id,
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
