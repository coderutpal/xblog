@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>Profile</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Profile
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    @livewire('admin.profile')
@endsection
@push('scripts')
    <script>
        const cropper = new Kropify('#profilePictureFile', {
            aspectRatio: 1,
            viewMode: 1,
            preview: 'img#profilePicturePreview',
            processURL: '{{ route('admin.update_profile_picture') }}',
            maxSize: 2 * 1024 * 1024, // 2MB
            allowedExtensions: ['jpg', 'jpeg', 'png'],
            showLoader: true,
            animationClass: 'pulse',
            cancelButtonText: 'Cancel',
            resetButtonText: 'Reset',
            cropButtonText: 'Crop & Upload',
            maxWoH: 500,
            onError: function(msg) {
                toastr.error(msg); // Toastr Error Notification
            },
            onDone: function(response) {
                if (response.status == 1) {
                    // Change profile picture preview instantly
                    Livewire.dispatch('updateUserInfo', []);
                    Livewire.dispatch('updateProfile', []);

                    // Show Toastr Success Notification
                    toastr.success(response.message);

                } else {
                    toastr.error(response.message);
                }
            }
        });
    </script>
@endpush
