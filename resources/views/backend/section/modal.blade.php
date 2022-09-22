 <!-- Class Create Modal -->
 <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
         <div class="modal-content bg-dark text-white">
             <div class="modal-header text-warning">
                 <h5 class="modal-title" id="modal">Subject</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true" class="text-white">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form action="" method="post" id="form">
                     <input type="hidden" id="data_id">
                     <div class="row">
                         <div class="col-md-6">
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

                         <div class="col-md-6">
                             <label for="">Subject type <span class="text-danger">*</span></label>
                             <div class="input-group mb-3">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text" id="basic-addon3">Type:</span>
                                 </div>
                                 <select class="custom-select bg-dark text-white b-0" name="type"
                                     id="inputGroupSelect03">
                                     <option value="" selected>-- select subject type --</option>
                                     <option value="Theory">Theory</option>
                                     <option value="Practical">Practical</option>
                                     <option value="Theory &s Practical">Theory &s Practical</option>
                                 </select>
                             </div>
                             <span class="text-warning validate_type"></span>
                         </div>

                         <div class="col-md-6">
                             <label for="">Subject Name: <span class="text-danger">*</span></label>
                             <div class="input-group mb-3">
                                 <div class="input-group-prepend ">
                                     <span class="input-group-text border-info text-white" id="basic-addon3">Subject
                                         Name:</span>
                                 </div>
                                 <input type="text" class="form-control text-white border-info" placeholder="Bangla"
                                     name="name">
                             </div>
                             <span class="text-warning validate_name"></span>
                         </div>

                         <div class="col-md-6">
                             <label for="">Subject code <span class="text-danger">*</span></label>
                             <div class="input-group mb-3">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text" id="basic-addon3">Code:</span>
                                 </div>
                                 <input type="text" name="code" class="form-control" placeholder="103">
                             </div>
                             <span class="text-warning validate_code"></span>
                         </div>
                         <div class="col-md-6">
                             <label for="">Total Mark <span class="text-danger">*</span></label>
                             <div class="input-group mb-3">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text" id="basic-addon3">Total Mark:</span>
                                 </div>
                                 <input type="number" name="total_mark" class="form-control" placeholder="100">
                             </div>
                             <span class="text-warning validate_total_mark"></span>
                         </div>
                         <div class="col-md-6">
                             <label for="">Pass Mark <span class="text-danger">*</span></label>
                             <div class="input-group mb-3">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text" id="basic-addon3">Pass Mark:</span>
                                 </div>
                                 <input type="number" name="pass_mark" class="form-control" placeholder="40">
                             </div>
                             <span class="text-warning validate_pass_mark"></span>
                         </div>
                         <div class="col-md-6">
                             <label for="">Optional: <span class="text-danger">*</span></label><br>
                             <label class="fancy-radio custom-color-green">
                                 <input name="optional" value="1" type="radio"
                                     checked=""><span><i></i>Yes</span>
                             </label>
                             <label class="fancy-radio custom-color-green">
                                 <input name="optional" value="0" type="radio"
                                     checked=""><span><i></i>No</span>
                             </label>
                             <span class="text-warning validate_optional"></span>

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
