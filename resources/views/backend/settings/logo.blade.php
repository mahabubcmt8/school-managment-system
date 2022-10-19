<!-- ==================================
    Logo Tab
==================================== -->
<div class="tab-pane" id="Profile-new2">
    <form action="{{ route('settings.update',$settings->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row mt-5">
        <div class="col-md-1">
            <label for="" class="text-info">Favicon:</label>
        </div>
        <div class="col-md-6">

            <div class="custom-file">
                <input type="file" name="favicon" class="custom-file-input" id="inputGroupFile04">
                <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
            </div>
        </div>
        <div class="col-md-5">
            <img src="{{ asset('storage/images/settings/' . $settings->favicon) }}" alt="favicon" width="50px" height="50px"
                style="border: 1px solid #fff;" id="favicon">
        </div>
    </div>
    <hr>
    <div class="row mt-4">
        <div class="col-md-1">
            <label for="" class="text-info">Logo:</label>
        </div>
        <div class="col-md-6">
            <div class="custom-file">
                <input type="file" name="logo" class="custom-file-input" id="inputGroupFile04">
                <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
            </div>
        </div>
        <div class="col-md-5">
            <img src="{{ asset('storage/images/settings/' . $settings->logo) }}" alt="logo" width="150px" height="60px"
                style="border: 1px solid #fff;" id="logo">
        </div>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-3">
            <button type="submit" class="btn btn-success btn-block btn-round">Save</button>
        </div>
    </div>
    </form>
</div>
@section('script')
    @include('backend.includes.script')
    <script>

    </script>
@endsection

