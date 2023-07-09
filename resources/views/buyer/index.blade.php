@extends('layouts.sneat')

@section('content')
<div class="portlet-title">
    <div style="display: inline-block; margin: 15px; font-size: 25px; font-weight: bold;">
        List Buyer
    </div>
</div>

{{-- @dd($nonmember); --}}
@if (session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif
<section>
    <div class="container px-2 px-lg-2   mt-2">
        <div class="card">
            <div class="demo-inline-spacing">
                @if (Auth::user()->hasRole('owner'))
                    <a href={{ route('buyer.create') }} class="btn rounded-pill btn-primary">
                        <iconify-icon icon="bx:plus"></iconify-icon>&nbsp; Tambah Buyer
                    </a>
                @endif
            <div class="row">
                <div class="col-xl-12">
                <div class="nav-align-top mb-4">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home"
                            aria-controls="navs-top-home" aria-selected="true" id="aktif-tab">Member</button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-profile"
                            aria-controls="navs-top-profile" aria-selected="false" id="non-aktif-tab">Non Member</button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                            @if ($members->count() == 0)
                                <h5 class="card-header" id="inactive-staff-text">Tidak Ada Member yang terdata</h5>
                            @else
                            <h5 class="card-header">Daftar Member</h5>
                            @if (session('success'))
                                <div class="alert alert-primary" id="flash-message" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Birthdate</th>
                                            <th>No Handphone</th>
                                            <th>Gender</th>
                                            <th>Point</th>
                                            <th>Alamat</th>
                                            @if (Auth::user()->hasRole('owner'))
                                                <th>Action</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                        @foreach ($members as $member)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $member->name }}</strong></td>
                                                <td>{{ $member->username }}</td>
                                                <td>{{ $member->email }}</td>
                                                <td>{{ $member->birthdate }}</td>
                                                <td>{{ $member->phone }}</td>
                                                <td>{{ $member->gender }}</td>
                                                <td>{{ $member->point }}</td>
                                                <td>{{ $member->address }}<td>
                                                    {{-- @if (Auth::user()->hasRole('owner'))
                                                        <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="{{ route('admin.staff.edit', ['staff' => $staff->id]) }}"
                                                                    ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                                                >
                                                                <!-- Trigger modal -->
                                                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalCenter-{{ $staff->id }}"
                                                                    ><i class="bx bx-trash me-1"></i> Delete</a
                                                                >
                                                            </div>
                                                        </div>
                                                    @endif --}}
                                                </td>
                                            </tr>
                                        <div>
                                        <div class="mt-3">
                                            <!-- Modal -->
                                            <div class="modal fade" style="z-index: 9999;" id="modalCenter-{{ $member->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-danger" id="modalCenterTitle">Hapus Member</h5>
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
                                                                <h5>Anda yakin menghapus {{ $member->name }} ?</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                            Tidak
                                                        </button>
                                                        <button type="button" class="btn btn-primary" data-member-id="{{ $member->id }}">Ya</button>
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
                            @if ($nonmembers->count() == 0)
                                <h5 class="card-header" id="active-staff-text">Tidak Ada data non member</h5>
                            @else
                                <h5 class="card-header">Daftar Non member</h5>
                            @endif
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Birthdate</th>
                                                <th>No Handphone</th>
                                                <th>Gender</th>
                                                <th>Point</th>
                                                <th>Alamat</th>
                                                @if (Auth::user()->hasRole('owner'))
                                                    <th>Action</th>
                                                @endif
                                            </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                            @foreach ($nonmembers as $nonmember)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $nonmember->name }}</strong></td>
                                                    <td>{{ $nonmember->username }}</td>
                                                    <td>{{ $nonmember->email }}</td>
                                                    <td>{{ $nonmember->birthdate }}</td>
                                                    <td>{{ $nonmember->phone }}</td>
                                                    <td>{{ $nonmember->gender }}</td>
                                                    <td>{{ $nonmember->point }}</td>
                                                    <td>{{ $nonmember->address }}<td>
                                                        {{-- @if (Auth::user()->hasRole('owner'))
                                                            <div class="dropdown">
                                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="{{ route('admin.staff.edit', ['staff' => $staff->id]) }}"
                                                                        ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                                                    >
                                                                    <!-- Trigger modal -->
                                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalCenter-{{ $staff->id }}"
                                                                        ><i class="bx bx-trash me-1"></i> Delete</a
                                                                    >
                                                                </div>
                                                            </div>
                                                        @endif --}}
                                                    </td>
                                                </tr>
                                            <div>
                                            <div class="mt-3">
                                                <!-- Modal -->
                                                {{-- <div class="modal fade" style="z-index: 9999;" id="modalCenter-{{ $staff->id }}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-danger" id="modalCenterTitle">Hapus Staff</h5>
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
                                                                    <h5>Anda yakin menghapus {{ $staff->name }} ?</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                                Tidak
                                                            </button>
                                                            <button type="button" class="btn btn-primary" data-staff-id="{{ $staff->id }}">Ya</button>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div> --}}
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
@endsection


@section('script')
<script>
    function nonaktifkan(id) {
        $.ajax({
            type: 'POST',
            url: "{{ route('product.nonaktifkan') }}",
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'id': id,
            },
            success: function (data) {
                if (data['status'] == 'success') {
                    window.location.reload(true);
                }
            }
        });
    }

    function aktifkan(id) {
        $.ajax({
            type: 'POST',
            url: "{{ route('product.aktifkan')}}",
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'id': id,
            },
            success: function (data) {
                if (data['status'] == 'success') {
                    window.location.reload(true);
                }
            }
        });
    }

    function addWishlist(id) {
        $.ajax({
            type: 'POST',
            url: "{{ route('product.addWishlist')}}",
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'id': id,
            },
            success: function (data) {
                if (data['status'] == 'success') {
                    window.location.reload(true);
                }
            }
        });
    }

    function removeWishlist(id) {
        $.ajax({
            type: 'POST',
            url: "{{ route('product.removeWishlist')}}",
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'id': id,
            },
            success: function (data) {
                if (data['status'] == 'success') {
                    window.location.reload(true);
                }
            }
        });
    }
</script>
@endsection

