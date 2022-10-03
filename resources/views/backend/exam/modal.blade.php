 <!-- Class Create Modal -->
 <div class="modal" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content bg-dark text-white">
             <div class="modal-header text-success">
                 <h5 class="modal-title" id="modal"><strong>Exam</strong></h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true" class="text-white">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                <form action="" id="form">
                    <input type="hidden" id="data_id">
                     <div class="row">
                         <div class="col-md-12">
                             <label for="">Exam <span class="text-danger">*</span></label>
                             <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3"><i class="fa fa-crosshairs"></i></span>
                                </div>
                                <input type="text" class="form-control text-white" placeholder="Final Exam..." name="name">
                            </div>
                            <span class="text-warning validate_name"></span>
                         </div>
                         <div class="col-md-6">
                            <label for="">Start Date <span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                               <div class="input-group-prepend">
                                   <span class="input-group-text" id="basic-addon3"><i class="fa fa-crosshairs"></i></span>
                               </div>
                               <input type="text" class="form-control text-white" placeholder="dd/mm/yyyy" name="start_date" id="start_date">
                           </div>
                           <span class="text-warning validate_start_date"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="">End Date <span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                               <div class="input-group-prepend">
                                   <span class="input-group-text" id="basic-addon3"><i class="fa fa-crosshairs"></i></span>
                               </div>
                               <input type="text" class="form-control text-white" placeholder="dd/mm/yyyy" name="end_date" id="end_date">
                           </div>
                           <span class="text-warning validate_end_date"></span>
                        </div>
                        <div class="col-md-12">
                            <label for="">Note <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="note" aria-label="With textarea" placeholder="Note Something...." name="note"></textarea>
                            <span class="text-warning validate_note"></span>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="col-md-6">
                                <label for="">Complete: <span class="text-danger">*</span></label><br>
                                <select class="form-select form-control" name="status" id="">
                                    <option class="bg-dark text-white" value="1">YES</option>
                                    <option class="bg-dark text-white" value="0">NO</option>
                                </select>
                            </div>
                        </div>
                     </div>
                     <button type="button" class="btn btn-success btn-round btnSave mt-4 float-right" onclick="storeData();">Save</button>
                     <button type="button" class="btn btn-success btn-round btnUpdate mt-4 float-right" onclick="updateData();">Update</button>

                </form>
            </div>
         </div>
     </div>
 </div>
