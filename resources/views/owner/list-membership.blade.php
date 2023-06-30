@extends('layouts.sneat')
@section('content')
<section>
    <div class="container px-2 px-lg-2   mt-2">
        <div class="row">
            <div class="card">
                <div class="demo-inline-spacing">
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
                                data-bs-target="#membership-content"
                                aria-controls="navs-top-home"
                                aria-selected="true"
                                id="membership-tab"
                                >
                                Membership
                                </button>
                            </li>
                            <li class="nav-item">
                                <button
                                type="button"
                                class="nav-link"
                                role="tab"
                                data-bs-toggle="tab"
                                data-bs-target="#non-membership-content"
                                aria-controls="navs-top-profile"
                                aria-selected="false"
                                id="non-membership-tab"
                                >
                                Non Membership
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="membership-content" role="tabpanel">
                                @if ($members->count() == 0)
                                    <h5 class="card-header" id="inactive-category-text">Tidak Ada Membership</h5>
                                @else
                                    <h5 class="card-header">Daftar Membership</h5>
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
                                                    <th>Point</th>
                                                    @if (Auth::user()->role == 'owner' )
                                                        <th>Status</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                @foreach ($members as $member)
                                                    <tr>
                                                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $member->name }}</strong></td>
                                                        <td>{{ $member->username }}</td>
                                                        <td>{{ $member->email }}</td>
                                                        <td>{{ $member->point }}</td>
                                                        @if (Auth::user()->role == 'owner')
                                                            @if ($member->membership == 1)
                                                                <td>
                                                                    <a data-bs-toggle="modal" data-bs-target="#modalCenter-{{ $member->id }}" class="btn btn-danger text-white">
                                                                        Hapus Member
                                                                    </a>
                                                                </td>
                                                            @else
                                                                <td>
                                                                    <a href="/" class="btn btn-success ">
                                                                        Tambah Member
                                                                    </a>
                                                                </td>
                                                            @endif
                                                        @endif
                                                    </tr>
                                                    {{-- Modal --}}
                                                    <div class="mt-3">
                                                        <div class="modal fade" style="z-index: 9999;" id="modalCenter-{{ $member->id }}" tabindex="-1" aria-hidden="true">
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
                                                                            <h5>Anda yakin menghapus {{ $member->username }} dari member?</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                                        Tidak
                                                                    </button>
                                                                    <button type="button" class="btn btn-primary" data-membership-id="{{ $member->id }}" data-command-member="REMOVE-MEMBER">
                                                                        Ya
                                                                    </button>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="non-membership-content" role="tabpanel">
                                @if ($nonMembers->count() == 0)
                                    <h5 class="card-header" id="active-category-text">Tidak Ada Non Membership</h5>
                                @else
                                    <h5 class="card-header">Daftar Non Membership</h5>
                                    <div class="table-responsive text-nowrap">
                                        <table class="table" id="non-membership-table">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Username</th>
                                                    <th>Email</th>
                                                    <th>Point</th>
                                                    @if (Auth::user()->role == 'owner')
                                                        <th>Status</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                @foreach ($nonMembers as $nonMember)
                                                    <tr>
                                                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $nonMember->name }}</strong></td>
                                                        <td>{{ $nonMember->username }}</td>
                                                        <td>{{ $nonMember->email }}</td>
                                                        <td>{{ $nonMember->point }}</td>
                                                        @if (Auth::user()->role == 'owner')
                                                            @if ($nonMember->membership == 0)
                                                                <td>
                                                                    <a data-bs-toggle="modal" data-bs-target="#modalCenter-{{ $nonMember->id }}" class="btn btn-success text-dark">
                                                                        Tambah Member
                                                                    </a>
                                                                </td>
                                                            @else
                                                                <td>
                                                                    <a href="/" class="btn btn-success">
                                                                        Hapus Member
                                                                    </a>
                                                                </td>
                                                            @endif
                                                        @endif
                                                        {{-- <td>{{ $nonMember->membership }}</td> --}}
                                                    </tr>
                                                    {{-- Modal --}}
                                                    <div class="mt-3">
                                                        <div class="modal fade" style="z-index: 9999;" id="modalCenter-{{ $nonMember->id }}" tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title text-danger" id="modalCenterTitle">Menambahakan Member</h5>
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
                                                                            <h5>Anda yakin menambahkan {{ $nonMember->username }} sebagai member?</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                                        Tidak
                                                                    </button>
                                                                    <button type="button" class="btn btn-primary" data-membership-id="{{ $nonMember->id }}" data-command-member="ADD-MEMBER">Ya</button>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                </div>
            </div>
            {{-- <div id="myElement">Hello, jQuery!</div> --}}
    </div>

    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Membership updated successfully.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    //Remove Member
    $(document).ready(function() {
        $('body').on('click', 'button[data-command-member]', function() {
            var memberId = $(this).data('membership-id');
            var command = $(this).data('command-member');
            // console.log(memberId);

            $.ajax({
                url: '{{ route("admin.member.updatemembership") }}',
                type: 'POST',
                data: {
                    memberId: memberId,
                    command: command
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    // alert('Berhasil');
                    $('.modal').modal('hide');
                    $('#successModal').modal('show');

                    setTimeout(function() {
                        location.reload(); 
                    }, 2000); 
                },
                error: function(xhr, status, error) {
                    alert(error);
                }
            });
        });
    });

    //Tab
   // Get the elements
    const inactiveCategoryText = document.getElementById('inactive-category-text');
    const activeCategoryText = document.getElementById('active-category-text');
    const activeCategory = 0;

    // Add event listener to the "non-aktif-tab"
    const nonAktifTab = document.getElementById('non-membership-tab');
    nonAktifTab.addEventListener('click', function() {
        inactiveCategoryText.style.display = 'none'; // Hide the text
        activeCategoryText.style.display = 'block'; // Show the text
    });

    // Add event listener to the "aktif-tab"
    const aktifTab = document.getElementById('membership-tab');
    aktifTab.addEventListener('click', function() {
    if (activeCategory === 0) {
        inactiveCategoryText.style.display = 'block'; // Show the text
        activeCategoryText.style.display = 'none'; // Hide the text

    }
    });

</script>

@endsection