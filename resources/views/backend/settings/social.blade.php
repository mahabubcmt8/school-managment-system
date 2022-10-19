<!-- ==================================
     Social Tab
==================================== -->
<div class="tab-pane" id="social">
    <form action="{{ route('settings.update',$settings->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="row mt-5">
        <div class="col-md-6">
            <label for="" class="text-info"><strong>Facebook</strong></label>
            <input type="text" class="form-control" name="facebook" placeholder="Facebook Url..." value="{{ $settings->facebook }}">
        </div>
        <div class="col-md-6">
            <label for="" class="text-info"><strong>Twitter</strong></label>
            <input type="text" class="form-control" name="twitter" placeholder="Twitter Url..." value="{{ $settings->twitter }}">
        </div>
        <div class="col-md-6 mt-3">
            <label for="" class="text-info"><strong>Youtube</strong></label>
            <input type="text" class="form-control" name="youtube" placeholder="Youtube Url..." value="{{ $settings->youtube }}">
        </div>
        <div class="col-md-6 mt-3">
            <label for="" class="text-info"><strong>Linkedin</strong></label>
            <input type="text" class="form-control" name="linkedin" placeholder="Linkedin Url..." value="{{ $settings->linkedin }}">
        </div>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-3">
            <button type="submit" class="btn btn-success btn-block btn-round">Save</button>
        </div>
    </div>
</form>

</div>
