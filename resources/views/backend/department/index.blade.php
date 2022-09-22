@extends('layouts.backend.app')

@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12 ">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active">Department</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title text-warning float-left">Department</h5>
                    <button class="btn btn-warning btn-round float-right text-white" data-toggle="modal"
                        data-target="#modal">
                        <i class="fa fa-plus"></i> Create New
                    </button>
                </div>
                <div class="card-body ">
                    <div class="row mt-5 dataList">

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.department.modal')
@endsection
@section('script')
    @include('backend.includes.script')
    <script>
        $('.btnUpdate').hide();

        // --------------------- Get All Inputs ----------------------
        function getInput() {
            var id = $("#data_id").val();
            var name = $('input[name="name"]').val();
            return {
                id: id,
                name: name,
                _token: '{!! csrf_token() !!}'
            }
        }

        // --------------------- Get All Records from Database ---------------------
        function allData() {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/get/department",
                success: function(data) {
                    html = '';
                    $.each(data, function(key, value) {
                        html += '<div class="col-md-3">'
                        html += '<div class="card  border-success text-center text-success">'
                        html += '<div class="card-body">'
                        html += '<h5>' + value.name + '</h5>'
                        html += '<button type="button" class="btn text-warning" onclick="editData(' +
                            value.id + ')"><i class="fa fa-edit (alias)"></i></button>'
                        html += '<button type="button" class="btn text-warning" onclick="deleteData(' +
                            value.id + ')"><i class="fa fa-trash-o"></i></button>'
                        html += '</div>'
                        html += '</div>'
                        html += '</div>'
                    });
                    $('.dataList').html(html);
                }
            });
        }
        allData();

        // -------------------- Create a new Record -----------------------
        function storeData() {
            $.ajax({
                type: "POST",
                url: "{{ route('department.store') }}",
                data: getInput(),
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Department Created Successfully',
                        timer: 1500
                    });
                    success();
                },
                error: function(error) {
                    $('.validate_name').text(error.responseJSON.errors.name);
                }
            })
        }

        // -------------------- Edit Data ----------------------
        function editData(id) {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "department/" + id + "/edit",
                success: function(data) {
                    $("#modal").modal('show');
                    $('.btnSave').hide();
                    $('.btnUpdate').show();
                    $("#data_id").val(data.id);
                    $('input[name="name"]').val(data.name);
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
                url: "department/" + id,
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
                    $('.validate_name').text(error.responseJSON.errors.name);
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
                        url: "/department/" + id,
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
