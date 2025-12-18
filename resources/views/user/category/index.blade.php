@extends('layouts.user.app', ['pageTitle' => $pageTitle])
@section('content')
<div class="main-content-body">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <p class="h3">{{ $pageTitle }}</p>
                <button class="btn btn-success" id="createNewCategory">
                    <i class="fas fa-plus"></i> {{ __('messages.add') }} {{ __('messages.category') }}
                </button>
            </div>
        </div>
        <div class="card-body bg-white table-responsive">
            {!! $dataTable->table(['id' => 'categoryTable']) !!}
        </div>
    </div>
</div>

@include('user.category.category-modal')
@endsection

@push('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
{!! $dataTable->scripts() !!}

<script>
       // Open modal for Add
    let save_method = 'add';   // global
    let category_id = null;    // global

    // Open modal for Add
    $('#createNewCategory').click(function() {
        save_method = 'add';
        category_id = null;
        $('#categoryForm')[0].reset();
        $('#formMethod').val('POST');
        $('#categoryModalLabel').text("{{ __('messages.add') }} {{ __('messages.category') }}");
        $('#saveCategory').text("{{ __('messages.add') }}");
        $('#categoryModal').modal('show');
    });

    // Open modal for Edit
    $(document).on('click', '.editCategory', function() {
        save_method = 'edit';  // set to edit
        category_id = $(this).data('id');
        $('#categoryForm')[0].reset();

        $.get("{{ url('user/category/edit/') }}/" + category_id, function(data) {
            $('#name').val(data.name);
            $('#categoryModalLabel').text("{{ __('messages.update') }} {{ __('messages.category') }}");
            $('#saveCategory').text("{{ __('messages.update') }}");
            $('#categoryModal').modal('show');
        });
    });

    // Save (Add/Update) via AJAX
    

    // Delete
    $(document).on('click', '.deleteCategory', function() {
        let id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won’t be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('user/category/delete') }}/" + id,
                    data: { _token: '{{ csrf_token() }}' },
                    success: function() {
                        $('#categoryTable').DataTable().ajax.reload();
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Category deleted!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            }
        })
    });
</script>
@endpush
