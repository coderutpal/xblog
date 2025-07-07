@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>Settings</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Settings
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="pd-20 card-box mb-4">
        @livewire('admin.settings')
    </div>
@endsection


@push('scripts')
    <!-- Croppie JS FOR LOGO UPLOAD START [Method ONE]-->
    <!-- NOTE: Croppie will crop image before upload. Then send the croped image to Controller as "Base64 String" data. So in the Controller method, have to decode the Base64 string and save it using `file_put_contents()  -->
    <script>
        let logoCroppieInstance;

        $('#site_logo').on('change', function() {
            let file = this.files[0];
            if (!file) {
                toastr.error('Please select an image.');
                return;
            }

            let fileExtension = file.name.split('.').pop().toLowerCase();
            if ($.inArray(fileExtension, ['jpg', 'jpeg', 'png']) == -1) {
                toastr.error('Invalid image type. Please upload JPG or PNG file.');
                return;
            }

            let reader = new FileReader();
            reader.onload = function(e) {
                if (logoCroppieInstance) logoCroppieInstance.destroy();

                logoCroppieInstance = new Croppie(document.getElementById('crop-logo-container'), {
                    viewport: {
                        width: 300,
                        height: 150,
                        type: 'square'
                    },
                    boundary: {
                        width: 400,
                        height: 300
                    },
                    enableOrientation: true
                });

                logoCroppieInstance.bind({
                    url: e.target.result
                });
            }
            reader.readAsDataURL(file);
        });

        $('#updateLogoForm').on('submit', function(e) {
            e.preventDefault();

            if (!logoCroppieInstance) {
                toastr.error('Please select and crop an image first.');
                return;
            }

            logoCroppieInstance.result({
                type: 'base64',
                format: 'png',
                size: {
                    width: 514,
                    height: 200
                }
            }).then(function(base64) {
                let form = $('#updateLogoForm');
                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: {
                        cropped_logo: base64, // Base64 image path controller e cropped_logo name e jabe
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status == 1) {
                            toastr.success(response.message);
                            form[0].reset();
                            logoCroppieInstance.destroy();
                            logoCroppieInstance = null;

                            // Image preview update
                            $('#preview_site_logo').attr('src', response.path + '?' + new Date()
                                .getTime());

                            // All site logos update (header, sidebar etc jekane jekane update korte chaw sudu site_logo class ta add korte hobe sekane)
                            $('img.site_logo').each(function() {
                                $(this).attr('src', response.path + '?' + new Date()
                                    .getTime());
                            });

                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function() {
                        toastr.error('Something went wrong.');
                    }
                });
            });
        });
    </script>
    <!-- Croppie JS FOR LOGO UPLOAD END [Method ONE]-->

    <!-- Croppie JS FOR LOGO UPLOAD START [Method TWO]-->
    {{-- <script>
        let logoCroppieInstance;

        $('#site_logo').on('change', function() {
            let file = this.files[0];
            if (!file) {
                toastr.error('Please select an image.');
                return;
            }

            let fileExtension = file.name.split('.').pop().toLowerCase();
            if ($.inArray(fileExtension, ['jpg', 'jpeg', 'png']) == -1) {
                toastr.error('Invalid image type. Please upload JPG or PNG file.');
                return;
            }

            let reader = new FileReader();
            reader.onload = function(e) {
                if (logoCroppieInstance) logoCroppieInstance.destroy();

                logoCroppieInstance = new Croppie(document.getElementById('crop-logo-container'), {
                    viewport: {
                        width: 300,
                        height: 150,
                        type: 'square'
                    },
                    boundary: {
                        width: 400,
                        height: 300
                    },
                    enableOrientation: true
                });

                logoCroppieInstance.bind({
                    url: e.target.result
                });
            }
            reader.readAsDataURL(file);
        });

        $('#updateLogoForm').on('submit', function(e) {
            e.preventDefault();

            if (!logoCroppieInstance) {
                toastr.error('Please select and crop an image first.');
                return;
            }

            logoCroppieInstance.result({
                type: 'blob', // ⚙️ Send as blob to get actual file object
                format: 'png',
                size: {
                    width: 600,
                    height: 300
                }
            }).then(function(blob) {
                let formData = new FormData();
                formData.append('site_logo', blob,
                    'cropped_logo.png'); // Send the cropped file as site_logo
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    url: $('#updateLogoForm').attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 1) {
                            toastr.success(response.message);
                            $('#updateLogoForm')[0].reset();
                            logoCroppieInstance.destroy();
                            logoCroppieInstance = null;

                            $('#preview_site_logo').attr('src', response.path + '?' + new Date()
                                .getTime());

                            $('img.site_logo').each(function() {
                                $(this).attr('src', response.path + '?' + new Date()
                                    .getTime());
                            });

                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function() {
                        toastr.error('Something went wrong.');
                    }
                });
            });
        });
    </script> --}}
    <!-- Croppie JS FOR LOGO UPLOAD END [Method TWO]-->

    <!-- Croppie JS FOR FABICON UPLOAD START [Method ONE]-->
    <!-- NOTE: Croppie will crop image before upload. Then send the croped image to Controller as "Base64 String" data. So in the Controller method, have to decode the Base64 string and save it using `file_put_contents()  -->
    <script>
        let faviconCroppieInstance;

        $('#site_favicon').on('change', function() {
            let file = this.files[0];
            if (!file) {
                toastr.error('Please select an image.');
                return;
            }

            let fileExtension = file.name.split('.').pop().toLowerCase();
            if ($.inArray(fileExtension, ['jpg', 'jpeg', 'png']) == -1) {
                toastr.error('Invalid image type. Please upload JPG or PNG file.');
                return;
            }

            let reader = new FileReader();
            reader.onload = function(e) {
                if (faviconCroppieInstance) faviconCroppieInstance.destroy();

                faviconCroppieInstance = new Croppie(document.getElementById('crop-favicon-container'), {
                    viewport: {
                        width: 120,
                        height: 120,
                        type: 'square'
                    },
                    boundary: {
                        width: 200,
                        height: 200
                    },
                    enableOrientation: true
                });

                faviconCroppieInstance.bind({
                    url: e.target.result
                });
            }
            reader.readAsDataURL(file);
        });

        $('#updateFaviconForm').on('submit', function(e) {
            e.preventDefault();

            if (!faviconCroppieInstance) {
                toastr.error('Please select and crop an image first.');
                return;
            }

            faviconCroppieInstance.result({
                type: 'base64',
                format: 'png',
                size: {
                    width: 96,
                    height: 96
                }
            }).then(function(base64) {
                let form = $('#updateFaviconForm');
                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: {
                        cropped_favicon: base64,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status == 1) {
                            toastr.success(response.message);
                            form[0].reset();
                            faviconCroppieInstance.destroy();
                            faviconCroppieInstance = null;

                            // Image preview update
                            $('#preview_site_favicon').attr('src', response.path + '?' +
                                new Date().getTime());

                            // All site Favicon update (image tags with class site_favicon)
                            $('img.site_favicon').each(function() {
                                $(this).attr('src', response.path + '?' + new Date()
                                    .getTime());
                            });

                            // ✅ Instant favicon update
                            document.querySelector('link[rel="icon"]').setAttribute('href',
                                response.path + '?' + new Date().getTime());

                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function() {
                        toastr.error('Something went wrong.');
                    }
                });
            });
        });
    </script>
    <!-- Croppie JS FOR FABICON UPLOAD END [Method ONE]-->
@endpush
