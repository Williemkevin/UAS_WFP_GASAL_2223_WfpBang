@extends('layouts.sneat')

@section('content')

    <section>
        <div class="container px-2 px-lg-2   mt-2">


            {{-- Form Tambah Kategori --}}
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
                    <h4 class="fw-bold py-3 mb-4">Form Edit Tipe</h4>

                    <!-- Basic Layout -->
                        <div class="row">
                            <div class="col-xl">
                            <div class="card mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.type.update', ['type' => $type->id]) }}" method="POST">
                                        @csrf
                                        @method("PUT")
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Nama Tipe</label>
                                            <input type="text" class="form-control" id="basic-default-fullname" name="type_name" placeholder="Anak-anak" value="{{ $type->type_name }}" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-message">Deskripsi Tipe</label>
                                            <textarea
                                                id="basic-default-message"
                                                class="form-control"
                                                placeholder="Suitable for Cold Weather!"
                                                name="description"
                                            >{{ $type->description }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a class="btn btn-primary" href={{ route('admin.type.index') }}>Daftar Tipe</a>
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
