
@extends('layouts.app')
{{-- @section('title', __('lang_v1.login')) --}}

<style>
    .logo {
    height: 100px;
    width: 50px;
    position: absolute;
    top: 10px;
    right: 10px;
}
.custom-tab {
    background-color: #6FA84F; /* Green shade */
    color: #0F2B46; /* Dark text color */
    font-weight: bold;
    padding: 0px 20px;
    border-radius: 0px 20px 0px 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    text-align: center;
    width: 150px;
    height: 60px;
    text-decoration: none;
}

.custom-tab.active-tab {
    background-color: #0F2B46; /* Darker shade for active */
    color: white; /* Highlight text */
}

th {
  background-color: #a6b3d6 !important; /* Light green */
}


</style>

<!-- Include Handsontable CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.css">
<!-- Include SweetAlert2 CSS (if needed) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@section('content')
<div class="p-3 mb-5 col-md-12">
    @include('nav.top-bar')
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            confirmButtonText: 'Ok'
        });
    </script>
    @endif
    <!-- Success message container -->
    <div id="success-message" class="alert alert-success d-none mt-4">
        Changes saved successfully!
    </div>
    <!-- Error message container -->
    <div id="error-message" class="alert alert-danger d-none mt-4">
        Failed to save changes.
    </div>
    <div id="excel-grid" class="p-3 mb-5 col-md-12 mt-4"></div>
</div>


@endsection
<!-- Include SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const excelData = @json($excelData); // Pass PHP data to JavaScript

        const container = document.getElementById('excel-grid');
        if (container) {
            const hot = new Handsontable(container, {
                data: excelData,
                rowHeaders: true,
                colHeaders: true,
                contextMenu: true,
                stretchH: 'all',
                height: 'auto',
                licenseKey: 'non-commercial-and-evaluation', // Get a license for production
                afterChange: (changes, source) => {
                    if (source === 'edit') {
                        saveChanges();
                    }
                }
            });

            function saveChanges() {
                const updatedData = hot.getData(); // Get all data from the grid

                fetch('{{ route("save.brief") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ data: updatedData })
                }).then(response => response.json())
                  .then(data => {
                    const successMessage = document.getElementById('success-message');
                    const errorMessage = document.getElementById('error-message');
                      if (data.success) {
                        successMessage.textContent = 'Changes saved successfully!';
                        successMessage.classList.remove('d-none'); // Show the message
                        setTimeout(() => {
                            successMessage.classList.add('d-none'); // Hide the message after 3 seconds
                        }, 3000);
                      } else {
                        errorMessage.textContent = 'Failed to save changes.';
                              errorMessage.classList.remove('d-none'); // Show error message
                              successMessage.classList.add('d-none'); // Hide success message
                              setTimeout(() => {
                                  errorMessage.classList.add('d-none'); // Hide error message after 3 seconds
                              }, 3000);
                      }
                  });
            }
        } else {
            console.error('Container element not found');
        }
    });
</script>

