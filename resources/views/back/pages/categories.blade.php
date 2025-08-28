@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@section('content')
    @livewire('admin.categories')
@endsection
@push('scripts')
    <script>
        window.addEventListener('showParentCategoryModalForm', function() {
            $('#pcategoryModal').modal('show');
        });

        window.addEventListener('hideParentCategoryModalForm', function() {
            $('#pcategoryModal').modal('hide');
        });

        // Sort parent category
        $('table tbody#sortable_parent_categories').sortable({
            cursor: "move",
            update: function(event, ui) {
                $(this).children().each(function(index) {
                    if ($(this).attr('data-ordering') != (index + 1)) {
                        $(this).attr('data-ordering', (index + 1)).addClass('updated');
                    }
                });

                var positions = [];
                $('.updated').each(function() {
                    positions.push([
                        $(this).attr('data-index'),
                        $(this).attr('data-ordering')
                    ]);
                    $(this).removeClass('updated');
                });

                Livewire.dispatch('updateCategoryOrdering', [positions]);
            }
        });

        window.addEventListener('deleteParentCategory', function(event) {
            var id = event.detail[0].id;

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('confirmDeleteParentCategory', [id]);
                }
            });
        });
    </script>
@endpush
