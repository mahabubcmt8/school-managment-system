@extends('layouts.backend.app')
@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12 ">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active">Expense Management</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-success"><strong>All Expenses</strong></h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">


                        <table id="example" class="table table-bordered display text-white text-muted table-striped"
                        style="width:100%;">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-info">SL</th>
                                <th class="text-info">Expense Type</th>
                                <th class="text-info">Amount</th>
                                <th class="text-info">Description</th>
                                <th class="text-info">Action</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">

                        </tbody>
                        <tfoot class="thead-dark text-white">
                            <tr>
                                <th class="text-info">SL</th>
                                <th class="text-info">Expense Type</th>
                                <th class="text-info">Amount</th>
                                <th class="text-info">Description</th>
                                <th class="text-info">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">

                <div class="card-body">
                    <h5 class="from-title text-success mb-2"><strong>Expense</strong></h5>
                    <input type="hidden" id="data_id">
                    <div class="row">
                        <div class="col-12">
                            <label for="" class="text-info">Expense Type <span class="text-danger">*</span></label>
                            <select class="form-select form-control" name="expense_type_id" id="">
                                <option class="bg-dark text-white" value="" selected>Choose...</option>
                                @foreach ($expenseType as $item)
                                    <option class="bg-dark text-white" value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <small class="expense_type_validation text-warning"></small><br>
                        </div>
                        <div class="col-12 mt-3">
                            <label for="" class="text-info">Amount: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control inputname" placeholder="Amount..." name="amount">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                            <small class="amount_validation text-warning"></small><br>
                        </div>
                        <div class="col-12">
                            <label for="" class="text-info">Date: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-calendar"></i></span>
                                </div>
                                <input type="text" class="form-control inputname" placeholder="dd/mm/yyyy" name="date" id="date">
                            </div>
                            <small class="date_validation text-warning"></small><br>
                        </div>
                        <div class="col-12">
                            <label for="" class="text-info">Note:</label>
                            <div class="input-group">
                                <textarea class="form-control" name="description" placeholder="Note..."></textarea>
                            </div>
                            <small class="description_validation text-warning"></small><br>
                        </div>
                    </div>



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
    <script src="{{ asset('backend/assets/vendor/jquery-inputmask/jquery.inputmask.bundle.js') }}"></script><!-- Input Mask Plugin Js -->
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
        $('#date').inputmask('dd/mm/yyyy', {
            placeholder: '__/__/____'
        });
        $('.updateBtn').hide();
        // --------------------- Get All Inputs ----------------------
        function getInput() {
            var id = $("#data_id").val();
            var expense_type_id = $('select[name="expense_type_id"]').val();
            var amount = $('input[name="amount"]').val();
            var date = $('input[name="date"]').val();
            var description = $('textarea[name="description"]').val();
            return {
                id: id,
                expense_type_id: expense_type_id,
                amount: amount,
                date: date,
                description: description,
                _token: '{!! csrf_token() !!}'
            }
        }

        // --------------------- Get All Records from Database ---------------------
        function allData() {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "{{ route('getExpense') }}",
                success: function(data) {
                    html = '';
                    var i = 1;
                    if(data.length != 0){
                        $.each(data, function(key, value) {
                        html += '<tr>';
                        html += '<td>'+(i++)+'</d>';
                        html += '<td>'+value.get_expense_type.name+'</d>';
                        html += '<td>'+value.amount+'</d>';
                        html += '<td>'+value.description+'</d>';
                        html += '<td>';
                        html += '<button type="button" class="btn text-warning" onclick="editData(' +
                            value.id + ')"><i class="fa fa-edit (alias)"></i></button>';
                        html += '<button type="button" class="btn text-danger" onclick="deleteData(' +
                            value.id + ')"><i class="fa fa-trash-o"></i></button>';
                        html += '</td>';
                        html += '</tr>';
                    });
                    }else{
                        html += '<tr><td colspan="5"><p class="text-center">No data available to show</p></td></tr>';
                    }

                    $('#dataList').html(html);
                }
            });
        }
        allData();

        // -------------------- Create a new Record -----------------------
        function storeData() {
            $.ajax({
                type: "POST",
                url: "{{ route('expense.store') }}",
                data: getInput(),
                success: function(data) {
                    allData();
                    $("#data_id").val('');
                    $('input[name="amount"]').val('');
                    $('input[name="date"]').val('');
                    $('textarea[name="description"]').val('');
                },
                error: function(error) {
                    $('.expense_type_validation').text(error.responseJSON.errors.expense_type_id);
                    $('.amount_validation').text(error.responseJSON.errors.amount);
                    $('.date_validation').text(error.responseJSON.errors.date);
                    $('.description_validation').text(error.responseJSON.errors.description);
                }
            })
        }

        // -------------------- Edit Data ----------------------
        function editData(id) {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "expense/" + id + "/edit",
                success: function(data) {
                    $('.saveBtn').hide();
                    $('.updateBtn').show();
                    $('.from-title').text('Edit Expense Type');
                    $("#data_id").val(data.id);
                    $('input[name="amount"]').val(data.amount);
                    $('input[name="date"]').val(data.date);
                    $('textarea[name="description"]').val(data.description);
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
                url: "expense/" + id,
                success: function(data) {
                    allData();
                    $('.saveBtn').show();
                    $('.updateBtn').hide();
                    $('.from-title').text('Expense');
                    $("#data_id").val('');
                    $('input[name="amount"]').val('');
                    $('input[name="date"]').val('');
                    $('textarea[name="description"]').val('');
                },
                error: function(error) {
                    $('.expense_type_validation').text(error.responseJSON.errors.expense_type_id);
                    $('.amount_validation').text(error.responseJSON.errors.amount);
                    $('.date_validation').text(error.responseJSON.errors.date);
                    $('.description_validation').text(error.responseJSON.errors.description);
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
                        url: "expense/" + id,
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
