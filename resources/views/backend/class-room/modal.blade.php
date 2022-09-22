 <!-- Class Create Modal -->
 <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content bg-dark text-white">
             <div class="modal-header text-warning">
                 <h5 class="modal-title" id="modal">Class Room</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true" class="text-white">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form action="" method="post" id="form">
                     <input type="hidden" id="data_id">
                     <div class="row">
                         <div class="col-md-12">
                             <label for="">Class Name: <span class="text-danger">*</span></label>
                             <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3">Class Name:</span>
                                </div>
                                <input type="text" class="form-control text-white" placeholder="Auditorium" name="name">
                            </div>
                             <span class="text-warning validate_class_name"></span>
                         </div>
                         <div class="col-md-12">
                             <label for="">Room No: <span class="text-danger">*</span></label>
                             <div class="input-group mb-3">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text" id="basic-addon3">Room No:</span>
                                 </div>
                                 <input type="text" class="form-control text-white" placeholder="1001" name="room_no">
                             </div>
                             <span class="text-warning validate_room_no"></span>
                         </div>
                         <div class="col-md-12">
                             <label for="">Capacity <span class="text-danger">*</span></label>
                             <div class="input-group mb-3">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text" id="basic-addon3">Capacity:</span>
                                 </div>
                                 <input type="number" class="form-control" placeholder="30" name="capacity">
                             </div>
                             <span class="text-warning validate_capacity"></span>
                         </div>
                     </div>
                     <button type="button" class="btn btn-success btn-round btnSave mt-4 float-right"
                         onclick="storeData();">Save</button>
                     <button type="button" class="btn btn-success btn-round btnUpdate mt-4 float-right"
                         onclick="updateData();">Update</button>
                 </form>
             </div>
         </div>
     </div>
 </div>
