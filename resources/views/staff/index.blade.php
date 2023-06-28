@extends('layouts.sneat')

@section('content')
@php
    // dd($user_staffs);
@endphp
<section>
    <div class="container px-2 px-lg-2   mt-2">
            <div class="card">
                <div class="demo-inline-spacing">
                    <a href={{ route('admin.staff.create') }} class="btn rounded-pill btn-primary">
                        <iconify-icon icon="bx:plus"></iconify-icon>&nbsp; Tambah Staff
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
                            Staff Aktif
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
                            Staff Non Aktif
                            </button>
                        </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                                @if ($user_staffs->count() == 0)
                                <h5 class="card-header" id="inactive-type-text">Tidak Ada Staff Aktif</h5>
                                @else
                                <h5 class="card-header">Daftar Staff Aktif</h5>
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
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>No Handphone</th>
                                                <th>Alamat</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                            @foreach ($user_staffs as $staff)
                                                <tr>
                                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $staff->name }}</strong></td>
                                                    <td>
                                                        {{ $staff->username }}
                                                    </td>
                                                    <td>
                                                        {{ $staff->email }}
                                                    </td>
                                                    <td>
                                                        {{ $staff->phone }}
                                                    </td>
                                                    <td>
                                                        {{ $staff->address }}
                                                    </td>
                                                    <td>
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
                                                    </td>
                                                </tr>
                                            <div>
                                            <div class="mt-3">
                                                <!-- Modal -->
                                                <div class="modal fade" style="z-index: 9999;" id="modalCenter-{{ $staff->id }}" tabindex="-1" aria-hidden="true">
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
                                                            <button type="button" class="btn btn-primary" data-type-id="{{ $staff->id }}">Ya</button>
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
                                @if ($deleted_staffs->count() == 0)
                                    <h5 class="card-header" id="active-type-text">Tidak Ada Staff Non Aktif</h5>
                                @else
                                    {{-- Ada Kategori Non Aktif --}}
                                    <h5 class="card-header">Daftar Staff Non Aktif</h5>
                                @endif
                                    <div class="table-responsive text-nowrap">
                                        <table class="table">
                                            <thead class="table-light">
                                            <tr>
                                                <th>Nama</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>No Handphone</th>
                                                <th>Alamat</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                            @foreach ($deleted_staffs as $staff)
                                                <tr>
                                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $staff->name }}</strong></td>
                                                    <td>
                                                        {{ $staff->username }}
                                                    </td>
                                                    <td>
                                                        {{ $staff->email }}
                                                    </td>
                                                    <td>
                                                        {{ $staff->phone }}
                                                    </td>
                                                    <td>
                                                        {{ $staff->address }}
                                                    </td>
                                                    <td>
                                                    <a href="{{ route('admin.staff.restore', ['staff' => $staff->id]) }}" class="btn btn-primary">
                                                        Restore
                                                    </a>
                                                    </td>
                                                </tr>
                                            <div>
                                            <div class="mt-3">
                                                <!-- Modal -->
                                                <div class="modal fade" style="z-index: 9999;" id="modalCenter-{{ $staff->id }}" tabindex="-1" aria-hidden="true">
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
                                                            <button type="button" class="btn btn-primary" data-type-id="{{ $staff->id }}">Ya</button>
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
@endsection
