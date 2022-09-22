@extends('layouts.backend.app')

@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12 ">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active">Class</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title text-warning float-left">Class</h5>
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
    @include('backend.class.create')
@endsection
@section('script')
    @include('backend.includes.script')
    <script>
        $('.btnUpdate').hide();
        // --------------------- Get All Inputs ----------------------
        function getInput() {
            var id = $("#data_id").val();
            var class_name = $('input[name="class_name"]').val();
            var class_numaric_name = $('input[name="class_numaric_name"]').val();
            return {
                id: id,
                class_name: class_name,
                class_numaric_name: class_numaric_name,
                _token: '{!! csrf_token() !!}'
            }
        }

        // --------------------- Get All Records from Database ---------------------
        function allData() {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/getClasses",
                success: function(data) {
                    html = '';
                    $.each(data, function(key, value) {
                        html += '<div class="col-md-4">'
                        html += '<div class="card  border-info text-center text-info">'
                        html += '<div class="card-body">'
                        html += '<h5 class="social_icon bg-info mb-3">' + value.class_numaric_name +
                            '</h5>'
                        html += '<h5>' + "Class: " + value.class_name + '</h5>'
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
                url: "{{ route('class.store') }}",
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
                    $('.validate_class').text(error.responseJSON.errors.class_name);
                    $('.validate_class_numaric').text(error.responseJSON.errors.class_numaric_name);
                }
            })
        }

        // -------------------- Edit Data ----------------------
        function editData(id) {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "class/" + id + "/edit",
                success: function(data) {
                    $("#modal").modal('show');
                    $('.btnSave').hide();
                    $('.btnUpdate').show();
                    $("#data_id").val(data.id);
                    $('input[name="class_name"]').val(data.class_name);
                    $('input[name="class_numaric_name"]').val(data.class_numaric_name);
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
                url: "class/" + id,
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
                    $('.validate_class').text(error.responseJSON.errors.class_name);
                    $('.validate_class_numaric').text(error.responseJSON.errors.class_numaric_name);
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
                        url: "/class/" + id,
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
