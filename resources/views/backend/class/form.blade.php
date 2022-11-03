<form action="" id="form">
    <input type="hidden" id="data_id">
    <div class="row justify-content-center">
        <div class="col-4">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-info text-white border-info" id="basic-addon3"><i
                            class="fa fa-crosshairs"></i></span>
                </div>
                <input type="text" class="form-control text-white border-info" placeholder="Class Name*"
                    name="class_name">
                <span class="text-warning validate_class"></span>
            </div>
        </div>
        <div class="col-4">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-info text-white border-info" id="basic-addon3"><i
                            class="fa fa-crosshairs"></i></span>
                </div>
                <input type="number" name="class_numaric_name" class="form-control border-info" placeholder="Class Numaric*">
                <span class="text-warning validate_class_numaric"></span>
            </div>
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-success btn-round btnSave"
            onclick="storeData();">Save</button>
            <button type="button" class="btn btn-success btn-round btnUpdate"
            onclick="updateData();">Update</button>
        </div>
    </div>
</form>
