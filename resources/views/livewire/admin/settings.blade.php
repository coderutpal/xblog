<div>
    <div class="tab">
        <ul class="nav nav-tabs customtab" role="tablist">
            <li class="nav-item">
                <a wire:click="selectTab('general_settings')"
                    class="nav-link {{ $tab == 'general_settings' ? 'active' : '' }}" data-toggle="tab"
                    href="#general_settings" role="tab" aria-selected="false">General
                    Settings</a>
            </li>
            <li class="nav-item">
                <a wire:click="selectTab('logo_favicon')" class="nav-link {{ $tab == 'logo_favicon' ? 'active' : '' }}"
                    data-toggle="tab" href="#logo_favicon" role="tab" aria-selected="false">Logo
                    & Favicon</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade {{ $tab == 'general_settings' ? 'active show' : '' }}" id="general_settings"
                role="tabpanel">
                <div class="pd-20">
                    <form wire:submit="updateSiteInfo()">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b>Site Title</b></label>
                                    <input type="text" class="form-control" wire:model="site_title"
                                        placeholder="Enter site title">
                                    @error('site_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b>Site Email</b></label>
                                    <input type="text" class="form-control" wire:model="site_email"
                                        placeholder="Enter site email">
                                    @error('site_email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b>Site Phone Number</b><small>(Optional)</small></label>
                                    <input type="text" class="form-control" wire:model="site_phone"
                                        placeholder="Enter site phone number">
                                    @error('site_phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b>Site Meta Keywords</b><small>(Optional)</small></label>
                                    <input type="text" class="form-control" wire:model="site_meta_keywords"
                                        placeholder="Ex: Laravel, E-commerce, WordPress">
                                    @error('site_meta_keywords')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for=""><b>Site Meta Description</b><small>(Optional)</small></label>
                                    <textarea wire:model="site_meta_description" cols="4" rows="4" class="form-control"
                                        placeholder="Type site meta description"></textarea>
                                    @error('site_meta_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade {{ $tab == 'logo_favicon' ? 'active show' : '' }}" id="logo_favicon"
                role="tabpanel">
                <div class="pd-20">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Site logo</h5>
                            <div class="mb-2 mt-1" style="max-width:700px">
                                <img id="preview_site_logo"
                                    src="{{ asset('images/site') }}/{{ isset(settings()->site_logo) ? settings()->site_logo : '' }}"
                                    alt="Site Logo" class="img-thumbnail mt-2 mb-3" style="max-width: 200px;">
                                <form action="{{ route('admin.update_logo') }}" method="POST"
                                    enctype="multipart/form-data" id="updateLogoForm">
                                    @csrf
                                    <div class="mb-2">
                                        <input type="file" name="site_logo" id="site_logo" class="form-control">
                                        <span class="text-danger ml-1"></span>
                                    </div>
                                    <div id="crop-logo-container" class="mt-3"></div>
                                    <button type="submit" class="btn btn-primary mt-3" id="crop_logo_btn">Change
                                        Logo</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5>Site Favicon</h5>
                            <div class="mb-2 mt-1" style="max-width:700px">
                                <img id="preview_site_favicon"
                                    src="{{ asset('images/site') }}/{{ isset(settings()->site_favicon) ? settings()->site_favicon : '' }}"
                                    alt="Site Favicon" class="img-thumbnail mt-2 mb-3" style="max-width: 100px;">
                                <form action="{{ route('admin.update_favicon') }}" method="POST"
                                    enctype="multipart/form-data" id="updateFaviconForm">
                                    @csrf
                                    <div class="mb-2">
                                        <input type="file" name="site_favicon" id="site_favicon"
                                            class="form-control">
                                        <span class="text-danger ml-1"></span>
                                    </div>
                                    <div id="crop-favicon-container" class="mt-3"></div>
                                    <button type="submit" class="btn btn-primary mt-3" id="crop_faviocn_btn">Change
                                        Favicon</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
