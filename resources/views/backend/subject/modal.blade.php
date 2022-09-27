 <!-- subject Modal -->
 <div class="modal" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
         <div class="modal-content bg-dark text-white">
             <div class="modal-header text-success">
                 <h5 class="modal-title" id="modal"><strong>Subject</strong></h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true" class="text-white">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                <form action="" id="form">
                     <input type="hidden" id="data_id">
                     <div class="row">
                         <div class="col-md-6">
                             <label for="">Class: <span class="text-danger">*</span></label>
                             <div class="input-group">
                                 <div class="input-group-prepend">
                                     <label class="input-group-text"><i class="fa fa-crosshairs"></i></label>
                                 </div>
                                 <select class="custom-select form-control" name="class_id">
                                     <option class="bg-dark text-white" selected="" value="">Choose Class...
                                     </option>
                                     @foreach ($class as $item)
                                         <option value="{{ $item->id }}" class="bg-dark text-white">
                                             {{ $item->class_name . ' (' . $item->class_numaric_name . ') ' }}</option>
                                     @endforeach
                                 </select>
                             </div>
                             <span class="text-warning validate_class_id"></span>
                         </div>

                         <div class="col-md-6">
                             <label for="">Subject type <span class="text-danger">*</span></label>
                             <div class="input-group">
                                 <div class="input-group-prepend">
                                     <label class="input-group-text"><i class="fa fa-crosshairs"></i></label>
                                 </div>
                                 <select class="custom-select form-control" name="type">
                                     <option class="bg-dark text-white" value="" selected>Subject type...</option>
                                     <option class="bg-dark text-white" value="Theory">Theory</option>
                                     <option class="bg-dark text-white" value="Practical">Practical</option>
                                     <option class="bg-dark text-white" value="Theory &s Practical">Theory &s Practical
                                     </option>
                                 </select>
                             </div>
                             <span class="text-warning validate_type"></span>
                         </div>
                     </div>
                     <div class="row mt-4">
                         <div class="col-md-6">
                             <label for="">Subject Name: <span class="text-danger">*</span></label>
                             <div class="input-group">
                                 <div class="input-group-prepend ">
                                     <span class="input-group-text" id="basic-addon3"><i
                                             class="fa fa-crosshairs"></i></span>
                                 </div>
                                 <input type="text" class="form-control text-white" placeholder="Bangla..."
                                     name="name">
                             </div>
                             <span class="text-warning validate_name"></span>
                         </div>

                         <div class="col-md-6">
                             <label for="">Subject code <span class="text-danger">*</span></label>
                             <div class="input-group">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text" id="basic-addon3"><i
                                             class="fa fa-crosshairs"></i></span>
                                 </div>
                                 <input type="text" name="code" class="form-control" placeholder="103">
                             </div>
                             <span class="text-warning validate_code"></span>
                         </div>
                     </div>
                     <div class="row mt-4">
                         <div class="col-md-6">
                             <label for="">Total Mark <span class="text-danger">*</span></label>
                             <div class="input-group">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text" id="basic-addon3"><i
                                             class="fa fa-crosshairs"></i></span>
                                 </div>
                                 <input type="number" name="total_mark" class="form-control" placeholder="100">
                             </div>
                             <span class="text-warning validate_total_mark"></span>
                         </div>
                         <div class="col-md-6">
                             <label for="">Pass Mark <span class="text-danger">*</span></label>
                             <div class="input-group">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text" id="basic-addon3"><i
                                             class="fa fa-crosshairs"></i></span>
                                 </div>
                                 <input type="number" name="pass_mark" class="form-control" placeholder="40">
                             </div>
                             <span class="text-warning validate_pass_mark"></span>
                         </div>
                     </div>
                     <div class="row mt-4">
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
