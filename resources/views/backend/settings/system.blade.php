<!-- ==================================
    System Tab
==================================== -->
<div class="tab-pane" id="system">
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('settings.update',$settings->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-12">
                    <label for="" class="text-info">Host</label>
                    <input type="text" class="form-control" placeholder="Host..." name="db_host" value="{{ $settings->db_host }}">
                </div>
                <div class="col-12 mt-3">
                    <label for="" class="text-info">Port</label>
                    <input type="text" class="form-control" placeholder="Port..." name="db_port" value="{{ $settings->db_port }}">
                </div>
                <div class="col-12 mt-3">
                    <label for="" class="text-info">DB Name</label>
                    <input type="text" class="form-control" placeholder="DB Name..." name="db_name" value="{{ $settings->db_name }}">
                </div>
                <div class="col-12 mt-3">
                    <label for="" class="text-info">DB username</label>
                    <input type="text" class="form-control" placeholder="DB Username..." name="db_username" value="{{ $settings->db_username }}">
                </div>
                <div class="col-12 mt-3">
                    <label for="" class="text-info">DB Password</label>
                    <input type="text" class="form-control" placeholder="DB Password..." name="db_password" value="{{ $settings->db_password }}">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-12">
                    <label for="" class="text-info">APP Url</label>
                    <input type="text" class="form-control" placeholder="htpps://" name="app_url" value="{{ $settings->app_url }}">
                </div>
                <div class="col-12 mt-3">
                    <label for="" class="text-info">Timezone</label>
                    <select name="timezone" id="timezone" class="form-control">
                        <option value="" selected>Choose Timezone</option>
                    </select>
                </div>
                <div class="col-12 mt-3">
                    <label for="" class="text-info">Currency Symbol</label>
                    <input type="text" class="form-control" placeholder="Currency Symbol..." name="currency_symbol" value="{{ $settings->currency_symbol }}">
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-3">
            <button type="submit" class="btn btn-success btn-block btn-round">Save</button>
        </div>
    </div>
</form>
</div>
