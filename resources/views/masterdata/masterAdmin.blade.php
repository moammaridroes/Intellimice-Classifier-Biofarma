<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Home</title>
  <!-- plugins:css -->
  
  <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('vendors/select2/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
  <!-- Inject:css -->
  <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
  <!-- End inject -->
  <link rel="shortcut icon" href="{{ asset('images/logobiofarmakecil.png') }}" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
  <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>
<style>
    .custom-swal-icon {
        margin-top: 20px; /* Adjust this to move the icon down */
    }
    .custom-swal-popup {
        padding-top: 40px; /* Adjust to increase spacing between title and icon */
    }
</style> 


<body>
    <div class="container-scroller">
        @include('partials.navbarAdmin')
        @include('partials.sidebarMaster')
        
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="card">
                    <div class="card-body">
                        <div class="container mt-4">
                            <h4>Data Admin</h4>
                            <button type="button" class="btn" style="background-color: #4B49AC; border-color: #4B49AC; color: #fff; margin: 5px 0;" data-bs-toggle="modal" data-bs-target="#addAdminModal">
                                <i class="fas fa-plus"></i> Add Admin
                            </button>
                            <div class="table-responsive">
                                <table class="table table-striped yajra-datatable">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>NAME</th>
                                            <th>EMAIL</th>
                                            <th>ROLE</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data akan diisi oleh DataTables -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>             
            @include('partials.footer')
        </div>
    </div>

    <!-- Edit Admin Modal -->
    <div class="modal fade" id="editAdminModal" tabindex="-1" aria-labelledby="editAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAdminModalLabel">Edit Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editAdminForm">
                    <div class="modal-body">
                        <input type="hidden" id="adminId" name="id">
                        <div class="mb-3">
                            <label for="editName" class="form-label">Username</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="editPassword" class="form-label">New Password (Optional)</label>
                            <input type="password" class="form-control" id="editPassword" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="editRole" class="form-label">Role</label>
                            <select class="form-select" id="editRole" name="role" required>
                                <option value="admin">Admin</option>
                                {{-- <option value="user">User</option> --}}
                                <option value="master_data">Master Data</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Admin -->
    <div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAdminModalLabel">Add New Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addAdminForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="addName" class="form-label">Username</label>
                            <input type="text" class="form-control" id="addName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="addEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="addEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="addPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="addPassword" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="addRole" class="form-label">Role</label>
                            <select class="form-select" id="addRole" name="role" required>
                                <option value="admin">Admin</option>
                                {{-- <option value="user">User</option> --}}
                                <option value="master_data">Master Data</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Admin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('js/off-canvas.js') }}"></script>
  <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('js/template.js') }}"></script>
  <script src="{{ asset('js/settings.js') }}"></script>
  <script src="{{ asset('js/todolist.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
  <!-- Chart.js Script -->
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


  <script>
    $(document).ready(function() {
        // Setup CSRF Token untuk Ajax
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Inisialisasi DataTable
        $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.index') }}", // Route ke controller
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'role', name: 'role' },
                {
                    data: null,
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row) {
                        return `
                            <button class="btn btn-primary edit-btn" data-id="${row.id}">Edit</button>
                            <button class="btn btn-danger delete-btn" data-id="${row.id}">Delete</button>
                        `;
                    }
                }
            ],
        });

        // Handler Edit Button
        $(document).on('click', '.edit-btn', function() {
            var adminId = $(this).data('id');
            
            $.ajax({
                url: `/admin/${adminId}/edit`,
                type: 'GET',
                success: function(data) {
                    $('#adminId').val(data.id);
                    $('#editName').val(data.name);
                    $('#editEmail').val(data.email);
                    $('#editRole').val(data.role);
                    $('#editPassword').val(''); // Reset password field

                    var myModal = new bootstrap.Modal(document.getElementById('editAdminModal'));
                    myModal.show();
                },
                error: function() {
                    alert('Error fetching admin data');
                }
            });
        });

        // Handler Form Submit
        $('#editAdminForm').on('submit', function(e) {
            e.preventDefault();
            var adminId = $('#adminId').val();
            var formData = $(this).serialize();

            $.ajax({
                url: `/admin/${adminId}`,
                type: 'PATCH',
                data: formData,
                success: function(response) {
                    $('#editAdminModal').modal('hide');
                    $('.yajra-datatable').DataTable().ajax.reload();
                    
                    // Sweet Alert atau Toastr bisa digunakan untuk notifikasi
                    alert(response.message);
                },
                error: function(xhr) {
                    // Tangani error
                    var errors = xhr.responseJSON.errors;
                    var errorMessage = '';
                    
                    // Loop through errors
                    $.each(errors, function(field, messages) {
                        errorMessage += messages.join('\n') + '\n';
                    });
                    
                    alert('Error saving data:\n' + errorMessage);
                }
            });
        });
    });

    $('#editAdminForm').on('submit', function (e) {
    e.preventDefault(); // Mencegah form submit default
    var adminId = $('#adminId').val();
    var formData = $(this).serialize(); // Ambil data dari form

    $.ajax({
        url: `/admin/${adminId}`, // URL API untuk update admin
        type: 'PATCH', // Metode HTTP PATCH untuk update
        data: formData,
        success: function (response) {
            // Tampilkan SweetAlert saat sukses
            Swal.fire({
                title: 'Berhasil!',
                text: response.message || 'Data berhasil diperbarui.',
                icon: 'success',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'custom-swal-popup', // Apply this class to the entire popup for layout adjustments
                    icon: 'custom-swal-icon' // Adjust the icon specifically
                },
            }).then(() => {
                $('#editAdminModal').modal('hide'); // Tutup modal
                $('.yajra-datatable').DataTable().ajax.reload(); // Reload DataTables
            });
        },
        error: function (xhr) {
            // Tampilkan error dengan SweetAlert
            var errors = xhr.responseJSON.errors;
            var errorMessage = 'Terjadi kesalahan saat menyimpan data.';

            if (errors) {
                errorMessage = '';
                $.each(errors, function (field, messages) {
                    errorMessage += messages.join('\n') + '\n';
                });
            }

            Swal.fire({
                title: 'Gagal!',
                text: errorMessage,
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    });
});



    $(document).on('click', '.delete-btn', function(e) {
    e.preventDefault();
        var adminId = $(this).data('id');
        var token = $('meta[name="csrf-token"]').attr('content');

            // SweetAlert2 Konfirmasi
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'custom-swal-popup', // Apply this class to the entire popup for layout adjustments
                    icon: 'custom-swal-icon' // Adjust the icon specifically
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kirim permintaan DELETE melalui Ajax
                    $.ajax({
                        url: `/admin/delete/${adminId}`,
                        type: 'DELETE',
                        data: {
                            "_token": token,
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Data admin berhasil dihapus.',
                                'success'
                            );
                            $('.yajra-datatable').DataTable().ajax.reload();
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Error!',
                                'Terjadi kesalahan saat menghapus data.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>