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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title text-success float-left"><strong>Expense Management</strong></h5>
                    <button class="btn btn-success btn-round float-right text-white" data-toggle="modal"
                        data-target="#modal">
                        <i class="fa fa-plus"></i> Create New
                    </button>
                </div>
                <div class="card-body mt-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                            <table class="table table-bordered data-table table-responsive-sm yajra-datatable" id="data-table">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center">S.N</th>
                                        <th class="text-center">Expense Type</th>
                                        <th class="text-center">Amount</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Details</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-white text-center">
                                </tbody>
                                <tfoot class="table-dark">
                                    <tr>
                                        <th class="text-center">S.N</th>
                                        <th class="text-center">Expense Type</th>
                                        <th class="text-center">Amount</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Details</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.expense.modal')
    @include('backend.expense.description')
@endsection
@section('script')
    @include('backend.includes.script')
    <script src="{{ asset('backend/assets/vendor/jquery-inputmask/jquery.inputmask.bundle.js') }}"></script><!-- Input Mask Plugin Js -->
    <script>
        // $('#date').inputmask('dd/mm/yyyy', {
        //     placeholder: '__/__/____'
        // });
        $('.btnUpdate').hide();
        /* ============================ All Data ============================ */
        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                ajax: "{{ route('getExpense') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'expense_type',
                        name: 'expense_type'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
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



        // -------------------- Create a new Record -----------------------
        function storeData() {
            $.ajax({
                type: "POST",
                url: "{{ route('expense.store') }}",
                data: getInput(),
                success: function(data) {
                    success();
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Expense Creation Successfully!!',
                        showConfirmButton: false,
                        timer: 2000
                    })
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
                    console.log(data);
                    $('.saveBtn').hide();
                    $('.btnUpdate').show();
                    $("#modal").modal('show');
                    $('.from-title').text('Edit Expense Type');
                    $("#data_id").val(data.id);
                    $("#expense_type_id").val(data.expense_type_id).attr('selected','selected');
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
                    success();
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Expense Updated Successfully!!',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    $('.from-title').text('Expense');
                    $("#data_id").val('');
                },
                error: function(error) {
                    $('.expense_type_validation').text(error.responseJSON.errors.expense_type_id);
                    $('.amount_validation').text(error.responseJSON.errors.amount);
                    $('.date_validation').text(error.responseJSON.errors.date);
                    $('.description_validation').text(error.responseJSON.errors.description);
                }
            });
        }
        // description
        function description(id){
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "expense/" + id,
                success: function(data) {
                    $('.desc').html(data.description);
                    $("#descriptionmodal").modal('show');
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
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                title: 'Expense Deleted!!',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    });
                }
            });
        }
    </script>
@endsection
