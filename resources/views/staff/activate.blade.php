@extends('layouts.sneat')

@section('content')
    <section>
        <div class="container px-2 px-lg-2   mt-2">
            <div class="row">
            {{-- Form Daftar Akun --}}
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                {{-- Content Goes Here! --}}
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                    @if (session('msg'))
                        <div class="alert alert-primary" role="alert">
                            {{ session('msg') }}
                        </div>
                    @elseif (session('success'))
                        <div class="alert alert-primary" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <h4 class="fw-bold py-3 mb-4">Form Data Diri Staff {{ $id }}</h4>
                    <!-- Basic Layout -->
                        <div class="row">
                            <div class="col-xl">
                            <div class="card mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('owner.staff.verified') }}" method="POST">
                                        @csrf
                                        {{-- Latest ID --}}
                                        <input type="hidden" name="user_id" value="{{ $id }}">
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">No Handphone</label>
                                            <input type="text" class="form-control" id="basic-default-fullname" name="phone" placeholder="0812-4431-2215" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Alamat</label>
                                            <input type="text" class="form-control" id="basic-default-fullname" name="address" placeholder="Jln Tunjungan No 99 Surabaya" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Tgl Lahir</label>
                                            <input type="date" class="form-control" id="basic-default-fullname" name="birthdate" placeholder="johndoe@yahoo.com" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Tgl Rekrut</label>
                                            <input type="date" class="form-control" id="basic-default-fullname" name="hired" placeholder="johndoe@yahoo.com" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Jenis Kelamin</label>
                                            <select class="form-select" aria-label="Default select example" name="gender" id="type">
                                                <option>-- Pilih Jenis Kelamin --</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Status</label>
                                            <select class="form-select" aria-label="Default select example" name="status" id="type">
                                                <option>-- Pilih Status --</option>
                                                <option value="1">1</option>
                                                <option value="0">0</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a class="btn btn-primary" href={{ route('admin.staff.index') }}>Daftar Staff</a>
                                    </form>
                                </div>
                            </div>
                            </div>
                            <div class="col-xl">
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->
                    <div class="content-backdrop fade"></div>
                </div>
                </div>
        </div>
    </section>
@endsection
