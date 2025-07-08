// === Logo Upload Init Start ===
initCroppieUploader({
    fileInputSelector: '#site_logo',
    cropContainerSelector: '#crop-logo-container',
    previewSelector: '#preview_site_logo',
    formSelector: '#updateLogoForm',
    ajaxUrl: '/admin/update-logo',
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
    ajaxUrl: '/admin/update-favicon',
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