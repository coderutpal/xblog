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
    <!-- croppieImageUploader JS FOR START -->
    <!-- NOTE: croppieImageUploader will crop image before upload. Then send the croped image to Controller as "Base64 String" data. So in the Controller method, have to decode the Base64 string and save it using `file_put_contents()  -->
    <script>
        function initCroppieUploader(config) {
            let croppieInstance = null;

            const {
                fileInputSelector,
                cropContainerSelector,
                previewSelector,
                formSelector,
                ajaxUrl,
                csrfToken,
                croppedImageFieldName,
                viewport,
                boundary,
                size,
                imageType = 'png',
                globalUpdateClass = '',
                enableResize = true,
                enableOrientation = true
            } = config;

            $(fileInputSelector).on('change', function() {
                const file = this.files[0];
                if (!file) {
                    toastr.error('Please select an image.');
                    return;
                }

                const ext = file.name.split('.').pop().toLowerCase();
                if ($.inArray(ext, ['jpg', 'jpeg', 'png']) === -1) {
                    toastr.error('Only JPG/PNG allowed.');
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    if (croppieInstance) croppieInstance.destroy();

                    croppieInstance = new Croppie(document.querySelector(cropContainerSelector), {
                        viewport,
                        boundary,
                        enableResize,
                        enableOrientation
                    });

                    croppieInstance.bind({
                        url: e.target.result
                    });
                };
                reader.readAsDataURL(file);
            });

            $(formSelector).on('submit', function(e) {
                e.preventDefault();

                if (!croppieInstance) {
                    toastr.error('Please select and crop an image first.');
                    return;
                }

                croppieInstance.result({
                    type: 'base64',
                    format: imageType,
                    size: size
                }).then(function(base64) {
                    const postData = {
                        _token: csrfToken
                    };
                    postData[croppedImageFieldName] = base64;

                    $.ajax({
                        url: ajaxUrl,
                        method: 'POST',
                        data: postData,
                        success: function(response) {
                            if (response.status === 1) {
                                toastr.success(response.message);
                                $(formSelector)[0].reset();
                                croppieInstance.destroy();
                                croppieInstance = null;
                                $(cropContainerSelector).empty();
                                $(fileInputSelector).val('');

                                if (previewSelector) {
                                    $(previewSelector).attr('src', response.path + '?' +
                                        new Date().getTime());
                                }

                                if (globalUpdateClass) {
                                    $('img.' + globalUpdateClass + ', link.' +
                                        globalUpdateClass).each(function() {
                                        $(this).attr('href', response.path + '?' +
                                            new Date().getTime());
                                    });
                                }
                                if (globalUpdateClass) {
                                    $('img.' + globalUpdateClass + ', link.' +
                                        globalUpdateClass).each(function() {
                                        const tagName = $(this)[0].tagName
                                            .toLowerCase();
                                        if (tagName === 'img') {
                                            $(this).attr('src', response.path + '?' +
                                                new Date().getTime());
                                        } else if (tagName === 'link') {
                                            $(this).attr('href', response.path + '?' +
                                                new Date().getTime());
                                        }
                                    });
                                }
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
        }

        // === Logo Upload Init Start ===
        initCroppieUploader({
            fileInputSelector: '#site_logo',
            cropContainerSelector: '#crop-logo-container',
            previewSelector: '#preview_site_logo',
            formSelector: '#updateLogoForm',
            ajaxUrl: '{{ route('admin.update_logo') }}',
            csrfToken: document.querySelector('meta[name="csrf-token"]')?.content || '',
            croppedImageFieldName: 'cropped_logo',
            viewport: {
                width: 300,
                height: 150,
                type: 'square'
            },
            boundary: {
                width: 400,
                height: 300
            },
            size: {
                width: 514,
                height: 200
            },
            globalUpdateClass: 'site_logo'
        });
        // === Logo Upload Init End ===

        // === Favicon Upload Init ===
        initCroppieUploader({
            fileInputSelector: '#site_favicon',
            cropContainerSelector: '#crop-favicon-container',
            previewSelector: '#preview_site_favicon',
            formSelector: '#updateFaviconForm',
            ajaxUrl: '{{ route('admin.update_favicon') }}',
            csrfToken: document.querySelector('meta[name="csrf-token"]')?.content || '',
            croppedImageFieldName: 'cropped_favicon',
            viewport: {
                width: 120,
                height: 120,
                type: 'square'
            },
            boundary: {
                width: 200,
                height: 200
            },
            size: {
                width: 96,
                height: 96
            },
            globalUpdateClass: 'site_favicon'
        });
        // === Favicon Upload Init End ===
    </script>
    <!-- croppieImageUploader JS END-->
@endpush
