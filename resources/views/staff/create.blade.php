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
                    @endif
                    <h4 class="fw-bold py-3 mb-4">Form Daftar Akun Staff</h4>

                    <!-- Basic Layout -->
                        <div class="row">
                            <div class="col-xl">
                            <div class="card mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('owner.staff.registeraccount') }}" method="POST">
                                        @csrf

                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Nama</label>
                                            <input type="text" class="form-control" id="basic-default-fullname" name="name" placeholder="John Doe" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Username</label>
                                            <input type="text" class="form-control" id="basic-default-fullname" name="username" placeholder="johndoe" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Email</label>
                                            <input type="email" class="form-control" id="basic-default-fullname" name="email" placeholder="johndoe@yahoo.com" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Password</label>
                                            <input type="password" class="form-control" id="basic-default-fullname" name="password" placeholder="********" />
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
