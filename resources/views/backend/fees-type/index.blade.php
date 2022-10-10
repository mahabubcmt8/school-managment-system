@extends('layouts.backend.app')
@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12 ">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active">Fees Type</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row mt-5 dataList">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="from-title text-success"><strong>Fees Type</strong></h5>
                </div>
                <div class="card-body">
                    <input type="hidden" id="data_id">
                    <label for="" class="text-info">Name: <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-crosshairs"></i></span>
                        </div>
                        <input type="text" class="form-control inputname" placeholder="Name..." name="name">
                    </div>
                    <small class="name_validation text-warning"></small><br>
                    <div class="text-center">
                        <button class="saveBtn btn-block btn btn-primary btn-round mt-2" onclick="storeData();">Save</button>
                        <button class="updateBtn btn-block btn btn-primary btn-round mt-2" onclick="updateData();">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('backend.includes.script')
    <script>
        $('.updateBtn').hide();
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
                url: "{{ route('getFeesType') }}",
                success: function(data) {
                    html = '';
                    if(data.length != 0){
                        $.each(data, function(key, value) {
                        html += '<div class="col-md-4">'
                        html += '<div class="card  border-success text-center text-success">'
                        html += '<div class="card-body">'
                        html += '<h5><strong>' + value.name + '</strong></h5>'
                        html += '<button type="button" class="btn text-warning" onclick="editData(' +
                            value.id + ')"><i class="fa fa-edit (alias)"></i></button>'
                        html += '<button type="button" class="btn text-warning" onclick="deleteData(' +
                            value.id + ')"><i class="fa fa-trash-o"></i></button>'
                        html += '</div>'
                        html += '</div>'
                        html += '</div>'
                    });
                    }else{
                        html += '<p class="m-auto">No data available to show</p>';
                    }

                    $('.dataList').html(html);
                }
            });
        }
        allData();

        // -------------------- Create a new Record -----------------------
        function storeData() {
            $.ajax({
                type: "POST",
                url: "{{ route('fees-type.store') }}",
                data: getInput(),
                success: function(data) {
                    allData();
                    $('input[name=name').val('');
                },
                error: function(error) {
                    $('.name_validation').text(error.responseJSON.errors.name);
                }
            })
        }

        // -------------------- Edit Data ----------------------
        function editData(id) {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "fees-type/" + id + "/edit",
                success: function(data) {
                    $('.saveBtn').hide();
                    $('.updateBtn').show();
                    $('.from-title').text('Edit Fees Type');
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
                url: "fees-type/" + id,
                success: function(data) {
                    allData();
                    $('.saveBtn').show();
                    $('.updateBtn').hide();
                    $('.from-title').text('Fees Type');
                    $('input[name=name').val('');
                },
                error: function(error) {
                    $('.name_validation').text(error.responseJSON.errors.name);
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
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        data: getInput(),
                        url: "fees-type/" + id,
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
