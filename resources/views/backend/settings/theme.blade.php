<!-- ==================================
    Theme Tab
==================================== -->
<div class="tab-pane" id="theme">
    <form action="{{ route('settings.update',$settings->id) }}" method="post">
    @csrf
    @method('PUT')
    
    <div class="row mt-5">
        <div class="col-md-6">
            <label for="" class="text-info">Side Bar Background Color</label><br>
            <input type="color" id="favcolor" name="side_bg_color" value="{{ $settings->side_bg_color }}">
        </div>
        <div class="col-md-6">
            <label for="" class="text-info">Side Bar Text Color</label><br>
            <input type="color" id="favcolor" name="side_text_color" value="{{ $settings->side_text_color }}">
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6">
            <label for="" class="text-info">Navbar Background Color</label><br>
            <input type="color" id="favcolor" name="nav_bg_color" value="{{ $settings->nav_bg_color }}">
        </div>
        <div class="col-md-6">
            <label for="" class="text-info">Navar Text Color</label><br>
            <input type="color" id="favcolor" name="nav_text_color" value="{{ $settings->nav_text_color }}">
        </div>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-3">
            <button type="submit" class="btn btn-success btn-block btn-round">Save</button>
        </div>
    </div>
    </form>
</div>
