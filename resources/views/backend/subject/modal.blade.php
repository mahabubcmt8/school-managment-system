 <!-- Class Create Modal -->
 <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content bg-dark text-white">
             <div class="modal-header text-warning">
                 <h5 class="modal-title" id="modal">Section</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true" class="text-white">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form action="" method="post" id="form">
                     <input type="hidden" id="data_id">
                     <div class="row">
                         <div class="col-md-12">
                             <label for="">Class: <span class="text-danger">*</span></label>
                             <div class="input-group mb-3">
                                 <div class="input-group-prepend">
                                     <button class="btn btn-outline-secondary" type="button">Class: </button>
                                 </div>
                                 <select class="custom-select" name="class_id" id="inputGroupSelect03">
                                     <option value="" selected>-- select class --</option>
                                     @foreach ($class as $item)
                                         <option value="{{ $item->id }}">
                                             {{ $item->class_name . ' (' . $item->class_numaric_name . ') ' }}</option>
                                     @endforeach
                                 </select>
                             </div>
                             <span class="text-warning validate_class_id"></span>
                         </div>
                         <div class="col-md-12">
                             <label for="">Section Name <span class="text-danger">*</span></label>
                             <div class="input-group mb-3">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text" id="basic-addon3">Section:</span>
                                 </div>
                                 <input type="text" class="form-control text-white" placeholder="A" name="name">
                             </div>
                             <span class="text-warning validate_name"></span>
                         </div>
                         <div class="col-md-12">
                             <label for="">Capacity <span class="text-danger">*</span></label>
                             <div class="input-group mb-3">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text" id="basic-addon3">Capacity:</span>
                                 </div>
                                 <input type="number" name="capacity" class="form-control" placeholder="30">
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
