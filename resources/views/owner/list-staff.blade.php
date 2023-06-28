@extends('layouts.sneat')

@section('content')
@extends('layouts.navbar')
<section>
    list staff
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

