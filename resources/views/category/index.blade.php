@extends('layouts.sneat')

@section('content')
<section>
    <div class="container px-2 px-lg-2   mt-2">
        <div class="row">
            <div class="card">
                <div class="demo-inline-spacing">
                    <a href={{ route('admin.category.create') }} class="btn rounded-pill btn-primary">
                        <iconify-icon icon="bx:plus"></iconify-icon>&nbsp; Tambah Kategori
                        {{-- <span class="tf-icons bx bx-pie-chart-alt"></span>&nbsp; Tambah Kategori --}}
                    </a>
                    
                <div class="row">
                    <div class="col-xl-12">
                    <div class="nav-align-top mb-4">
                        <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <button
                            type="button"
                            class="nav-link active"
                            role="tab"
                            data-bs-toggle="tab"
                            data-bs-target="#navs-top-home"
                            aria-controls="navs-top-home"
                            aria-selected="true"
                            id="aktif-tab"
                            >
                            Kategori Aktif
                            </button>
                        </li>
                        <li class="nav-item">
                            <button
                            type="button"
                            class="nav-link"
                            role="tab"
                            data-bs-toggle="tab"
                            data-bs-target="#navs-top-profile"
                            aria-controls="navs-top-profile"
                            aria-selected="false"
                            id="non-aktif-tab"
                            >
                            Kategori Non Aktif
                            </button>
                        </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                                @if ($categories->count() == 0)
                                <h5 class="card-header" id="inactive-category-text">Tidak Ada Kategori Aktif</h5>
                                @else
                                <h5 class="card-header">Daftar Kategori</h5>
                                @if (session('success'))
                                    <div class="alert alert-primary" id="flash-message" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                    <div class="table-responsive text-nowrap">
                                        <table class="table">
                                            <thead class="table-light">
                                            <tr>
                                                <th>Nama</th>
                                                <th>Deskripsi</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                            @foreach ($categories as $category)
                                                <tr>
                                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $category->category_name }}</strong></td>
                                                    <td>
                                                        {{ $category->description }}
                                                    </td>
                                                    <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{ route('admin.category.edit', ['category' => $category->id]) }}"
                                                                ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                                            >
                                                            <!-- Trigger modal -->
                                                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalCenter-{{ $category->id }}"
                                                                ><i class="bx bx-trash me-1"></i> Delete</a
                                                            >
                                                        </div>
                                                    </div>
                                                    </td>
                                                </tr>
                                            <div>
                                            <div class="mt-3">
                                                <!-- Modal -->
                                                <div class="modal fade" style="z-index: 9999;" id="modalCenter-{{ $category->id }}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-danger" id="modalCenterTitle">Hapus Kategori</h5>
                                                            <button
                                                            type="button"
                                                            class="btn-close"
                                                            data-bs-dismiss="modal"
                                                            aria-label="Close"
                                                            ></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col mb-3">
                                                                    <h5>Anda yakin menghapus {{ $category->category_name }} ?</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                                Tidak
                                                            </button>
                                                            <button type="button" class="btn btn-primary" data-category-id="{{ $category->id }}">Ya</button>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                            </div>
                            @endif
                            <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                                @if ($deleted_categories->count() == 0)
                                    <h5 class="card-header" id="active-category-text">Tidak Ada Kategori Non Aktif</h5>
                                @else
                                    {{-- Ada Kategori Non Aktif --}}
                                    <h5 class="card-header">Daftar Kategori Non Aktif</h5>
                                @endif
                                    <div class="table-responsive text-nowrap">
                                        <table class="table">
                                            <thead class="table-light">
                                            <tr>
                                                <th>Nama</th>
                                                <th>Deskripsi</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                            @foreach ($deleted_categories as $category)
                                                <tr>
                                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $category->category_name }}</strong></td>
                                                    <td>
                                                        {{ $category->description }}
                                                    </td>
                                                    <td>
                                                    <a href="{{ route('admin.category.restore', ['category' => $category->id]) }}" class="btn btn-primary">
                                                        Restore
                                                    </a>
                                                    </td>
                                                </tr>
                                            <div>
                                            <div class="mt-3">
                                                <!-- Modal -->
                                                <div class="modal fade" style="z-index: 9999;" id="modalCenter-{{ $category->id }}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-danger" id="modalCenterTitle">Hapus Kategori</h5>
                                                            <button
                                                            type="button"
                                                            class="btn-close"
                                                            data-bs-dismiss="modal"
                                                            aria-label="Close"
                                                            ></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col mb-3">
                                                                    <h5>Anda yakin menghapus {{ $category->category_name }} ?</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                                Tidak
                                                            </button>
                                                            <button type="button" class="btn btn-primary" data-category-id="{{ $category->id }}">Ya</button>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            {{-- <div id="myElement">Hello, jQuery!</div> --}}
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    // Delete Button
    document.addEventListener('DOMContentLoaded', function() {
        // Get all delete buttons
        var deleteButtons = document.querySelectorAll('.modal .btn-primary');

        // Loop through delete buttons
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                
                //get the ID
                var categoryId = $(this).data('category-id');
                // console.log(categoryId);

                $.ajax({
                    url: '{{ route('admin.category.destroy', ['category' => '__categoryId__']) }}'.replace('__categoryId__', categoryId),
                    type: 'POST',
                    data: {_method:'delete'},
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    ,
                    success: function(response){
                        // alert('Kategori Berhasil Dihapus!');
                        $('#modalCenter-' + categoryId).modal('hide');
                        location.reload();
                    },
                    error:function(error){
                        alert('Terjadi Error');
                    }
                });
            });
        });
    });

    //Tab
   // Get the elements
    const inactiveCategoryText = document.getElementById('inactive-category-text');
    const activeCategoryText = document.getElementById('active-category-text');
    const activeCategory = 0;

    // Add event listener to the "non-aktif-tab"
    const nonAktifTab = document.getElementById('non-aktif-tab');
    nonAktifTab.addEventListener('click', function() {
        inactiveCategoryText.style.display = 'none'; // Hide the text
        activeCategoryText.style.display = 'block'; // Show the text
    });

    // Add event listener to the "aktif-tab"
    const aktifTab = document.getElementById('aktif-tab');
    aktifTab.addEventListener('click', function() {
    if (activeCategory === 0) {
        inactiveCategoryText.style.display = 'block'; // Show the text
        activeCategoryText.style.display = 'none'; // Hide the text

    }
    });
    



</script>

<script>
    // jQuery code block checking
    // $(document).ready(function() {
    //     // Test code: Change the background color of the element
    //     $('#myElement').css('background-color', 'yellow');
    // });
</script>
@endsection

