 <!-- Class Create Modal -->
 <div class="modal" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content bg-dark text-white p-2">
            <div class="modal-header text-success">
                <h5 class="from-title text-success mb-2"><strong>Expense</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form">
                    <input type="hidden" id="data_id">
                    <div class="row">
                        <div class="col-12">
                            <label for="" class="text-info">Expense Type <span class="text-danger">*</span></label>
                            <select class="form-select form-control" name="expense_type_id" id="expense_type_id">
                                <option class="bg-dark text-white" value="" selected>Choose...</option>
                                @foreach ($expenseType as $item)
                                    <option class="bg-dark text-white" value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <small class="expense_type_validation text-warning"></small><br>
                        </div>
                        <div class="col-12">
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
                                <input type="text" class="form-control inputname" placeholder="dd/mm/yyyy" name="date"
                                    id="date">
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
                        <button type="button" class="saveBtn btn-block btn btn-primary btn-round mt-2"
                            onclick="storeData();">Save</button>
                        <button type="button" class="btnUpdate btn-block btn btn-primary btn-round mt-2"
                            onclick="updateData();">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
