<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('backend/assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{!! csrf_token() !!}'
        }
    });
    // ------------------ When store and update data this function can call -------------------
    function success() {
        $('#data-table').DataTable().ajax.reload();
        $("#modal").modal('hide');
        $('#form').trigger("reset");
        $('.btnSave').show();
        $('.btnUpdate').hide();
    }
</script>
