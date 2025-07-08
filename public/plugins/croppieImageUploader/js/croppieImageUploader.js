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

    $(fileInputSelector).on('change', function () {
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
        reader.onload = function (e) {
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

    $(formSelector).on('submit', function (e) {
        e.preventDefault();

        if (!croppieInstance) {
            toastr.error('Please select and crop an image first.');
            return;
        }

        croppieInstance.result({
            type: 'base64',
            format: imageType,
            size: size
        }).then(function (base64) {
            const postData = {
                _token: csrfToken
            };
            postData[croppedImageFieldName] = base64;

            $.ajax({
                url: ajaxUrl,
                method: 'POST',
                data: postData,
                success: function (response) {
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
                                globalUpdateClass).each(function () {
                                    $(this).attr('href', response.path + '?' +
                                        new Date().getTime());
                                });
                        }
                        if (globalUpdateClass) {
                            $('img.' + globalUpdateClass + ', link.' +
                                globalUpdateClass).each(function () {
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
                error: function () {
                    toastr.error('Something went wrong.');
                }
            });
        });
    });
}