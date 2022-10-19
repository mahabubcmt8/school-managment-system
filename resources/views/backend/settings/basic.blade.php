<!-- ==================================
    Basic Tab
 ==================================== -->
                         <div class="tab-pane show active" id="Home-new2">
                            <form action="{{ route('settings.update',$settings->id) }}" method="post">
                            @csrf
                            @method('PUT')
                                <div class="row mt-5">
                                    <!-- ==================== School Name ==================== -->
                                    <div class="col-md-6">
                                        <label for="" class="text-info">System Name: <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-institution (alias)"></i></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="System Name..." name="system_name"
                                                value="{{ $settings->system_name }}">
                                        </div>
                                        @error('system_name')
                                            <small class="text-warning"><strong>{{ $message }}</strong></small>
                                        @enderror
                                    </div>
                                    <!-- ==================== School Name ==================== -->
                                    <div class="col-md-6">
                                        <label for="" class="text-info">System Title: <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-institution (alias)"></i></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="System Title..." name="system_title"
                                                value="{{ $settings->system_title }}">
                                        </div>
                                        @error('system_title')
                                            <small class="text-warning"><strong>{{ $message }}</strong></small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <!-- ==================== Email ==================== -->
                                    <div class="col-md-6">
                                        <label for="" class="text-info">Email: <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon-envelope"></i></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Email..." name="email"
                                                value="{{ $settings->email }}">
                                        </div>
                                        @error('email')
                                            <small class="text-warning"><strong>{{ $message }}</strong></small>
                                        @enderror
                                    </div>
                                    <!-- ==================== Phone ==================== -->
                                    <div class="col-md-6">
                                        <label for="" class="text-info">Phone: <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon-call-in"></i></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Phone..." name="phone"
                                                value="{{ $settings->phone }}">
                                        </div>
                                        @error('phone')
                                            <small class="text-warning"><strong>{{ $message }}</strong></small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <!-- ==================== Address ==================== -->
                                    <div class="col-md-6">
                                        <label for="" class="text-info">Address: <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-location-arrow"></i></span>
                                            </div>
                                            <textarea name="address" class="form-control" placeholder="System Address">{{ $settings->address }}</textarea>
                                        </div>
                                        @error('address')
                                            <small class="text-warning"><strong>{{ $message }}</strong></small>
                                        @enderror
                                    </div>
                                    <!-- ==================== Phone ==================== -->
                                    <div class="col-md-6">
                                        <label for="" class="text-info">Description: <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-sort-amount-desc"></i></span>
                                            </div>
                                            <textarea name="system_description" class="form-control" placeholder="Description">{{ $settings->system_description }}</textarea>
                                        </div>
                                        @error('system_description')
                                            <small class="text-warning"><strong>{{ $message }}</strong></small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row justify-content-center mt-4">
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-success btn-block btn-round">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
