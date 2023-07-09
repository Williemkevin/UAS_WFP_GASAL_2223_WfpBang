@extends('layouts.sneat')

@section('content')

    <section>
        <div class="container px-2 px-lg-2   mt-2">
            {{-- Form Edit Kategori --}}
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
                    <h4 class="fw-bold py-3 mb-4">Form Edit Kategori</h4>

                    <!-- Basic Layout -->
                        <div class="row">
                            <div class="col-xl">
                            <div class="card mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.category.update', ['category' => $category->id]) }}" method="POST">
                                        @csrf
                                        @method("PUT")
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Nama Kategori</label>
                                            <input type="text" value="{{ old('category_name', $category->category_name) }}" class="form-control" id="basic-default-fullname" name="category_name" placeholder="Parachute Jacket" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-message">Deskripsi Kategori</label>
                                            <textarea
                                                id="basic-default-message"
                                                class="form-control"
                                                placeholder="Suitable for Cold Weather!"
                                                name="description"

                                            >{{ old('description', $category->description) }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a class="btn btn-primary" href={{ route('admin.category.index') }}>Daftar Kategori</a>
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
