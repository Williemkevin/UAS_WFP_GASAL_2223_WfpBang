@extends('layouts.sneat')

@section('content')
<section>
    <div class="container px-2 px-lg-2   mt-2">
            <div class="card">
                <div class="demo-inline-spacing">
                    @if(str_contains(Auth::user()->role, 'staff')|| str_contains(Auth::user()->role, 'owner'))
                    <a href={{ route('admin.type.create') }} class="btn rounded-pill btn-primary">
                        <iconify-icon icon="bx:plus"></iconify-icon>&nbsp; Tambah Tipe
                        {{-- <span class="tf-icons bx bx-pie-chart-alt"></span>&nbsp; Tambah Kategori --}}
                    </a>
                    @endif
                <div class="row">
                    <div class="col-xl-12">
                    <div class="nav-align-top mb-4">
                        @if(str_contains(Auth::user()->role, 'staff')|| str_contains(Auth::user()->role, 'owner'))

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
                            Tipe Aktif
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
                            Tipe Non Aktif
                            </button>
                        </li>
                        </ul>
                        @endif
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                                @if ($types->count() == 0)
                                <h5 class="card-header" id="inactive-type-text">Tidak Ada Tipe Aktif</h5>
                                @else
                                <h5 class="card-header">Daftar Tipe</h5>
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
                                                @if(str_contains(Auth::user()->role, 'staff')|| str_contains(Auth::user()->role, 'owner'))
                                                <th>Actions</th>
                                                @endif
                                            </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                            @foreach ($types as $type)
                                                <tr>
                                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $type->type_name }}</strong></td>
                                                    <td>
                                                        {{ $type->description }}
                                                    </td>
                                                    <td>
                                                    @if(str_contains(Auth::user()->role, 'staff')|| str_contains(Auth::user()->role, 'owner'))
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{ route('admin.type.edit', ['type' => $type->id]) }}"
                                                                ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                                            >
                                                            <!-- Trigger modal -->
                                                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalCenter-{{ $type->id }}"
                                                                ><i class="bx bx-trash me-1"></i> Delete</a
                                                            >
                                                        </div>
                                                    </div>
                                                    @endif
                                                    </td>
                                                </tr>
                                            <div>
                                            <div class="mt-3">
                                                <!-- Modal -->
                                                <div class="modal fade" style="z-index: 9999;" id="modalCenter-{{ $type->id }}" tabindex="-1" aria-hidden="true">
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
                                                                    <h5>Anda yakin menghapus {{ $type->type_name }} ?</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                                Tidak
                                                            </button>
                                                            <button type="button" class="btn btn-primary" data-type-id="{{ $type->id }}">Ya</button>
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
                                @if ($deleted_types->count() == 0)
                                    <h5 class="card-header" id="active-type-text">Tidak Ada Tipe Non Aktif</h5>
                                @else
                                    {{-- Ada Kategori Non Aktif --}}
                                    <h5 class="card-header">Daftar Tipe Non Aktif</h5>
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
                                            @foreach ($deleted_types as $type)
                                                <tr>
                                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $type->type_name }}</strong></td>
                                                    <td>
                                                        {{ $type->description }}
                                                    </td>
                                                    <td>
                                                    <a href="{{ route('admin.type.restore', ['type' => $type->id]) }}" class="btn btn-primary">
                                                        Restore
                                                    </a>
                                                    </td>
                                                </tr>
                                            <div>
                                            <div class="mt-3">
                                                <!-- Modal -->
                                                <div class="modal fade" style="z-index: 9999;" id="modalCenter-{{ $type->id }}" tabindex="-1" aria-hidden="true">
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
                                                                    <h5>Anda yakin menghapus {{ $type->type_name }} ?</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                                Tidak
                                                            </button>
                                                            <button type="button" class="btn btn-primary" data-type-id="{{ $type->id }}">Ya</button>
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
                var typeId = $(this).data('type-id');

                $.ajax({
                    url: '{{ route('admin.type.destroy', ['type' => '__typeId__']) }}'.replace('__typeId__', typeId),
                    type: 'POST',
                    data: {_method:'delete'},
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    ,
                    success: function(response){
                        // alert('Kategori Berhasil Dihapus!');
                        $('#modalCenter-' + typeId).modal('hide');
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
    const inactiveTypeText = document.getElementById('inactive-type-text');
    const activeTypeText = document.getElementById('active-type-text');
    const activeType = 0;

    // Add event listener to the "non-aktif-tab"
    const nonAktifTab = document.getElementById('non-aktif-tab');
    nonAktifTab.addEventListener('click', function() {
        inactiveTypeText.style.display = 'none'; // Hide the text
        activeTypeText.style.display = 'block'; // Show the text
    });

    // Add event listener to the "aktif-tab"
    const aktifTab = document.getElementById('aktif-tab');
    aktifTab.addEventListener('click', function() {
    if (activeType === 0) {
        inactiveTypeText.style.display = 'block'; // Show the text
        activeTypeText.style.display = 'none'; // Hide the text

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

