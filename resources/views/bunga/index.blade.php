@extends('layouts/app', ['title' => 'Data Bunga'])

@section('content')
    @include('sweetalert::alert')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-car icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>PINJAMAN
                        <div class="page-title-subheading">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                                <li class="active breadcrumb-item" aria-current="page">Bunga</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-card mb-3 card">
            <div class="card-header">
                <h5 class="card-title">Data Bunga>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="mb-0 table table-striped table-hover table-bordered table-sm" id="data-table">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="text-center" width="3%">No</th>
                                <th class="text-center">Suku Bunga %</th>
                                <th class="text-center" width="3%"><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-styles')
    <link rel="stylesheet" href="{{ asset('template') }}/plugins/datatables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('template') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

    <link rel="stylesheet" href="{{ asset('template') }}/plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('template') }}/plugins/toastr/toastr.min.css">
@endsection

@section('custom-scripts')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('template') }}/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('template') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

    <script src="{{ asset('template') }}/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{ asset('template') }}/plugins/toastr/toastr.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function() {
            let table = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,

                ajax: "{{ route('bunga.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'dt-body-center'
                    },
                    {
                        data: 'suku_bunga',
                        name: 'suku_bunga',
                        className: 'dt-body-right'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'dt-body-center'
                    },
                ],
            });

            $('body').on('click', '#editData', function() {
                var bunga_id = $(this).data('id');
                $.get("{{ route('bunga.index') }}" + '/' + bunga_id + '/edit', function(data) {
                    console.log(data);
                    $('#editModal').modal('show');
                    setTimeout(function() {
                        $('#suku_bunga').focus();
                    }, 500);
                    $('#modal-title').html("Edit Bunga");
                    $('#saveBtn').removeAttr('disabled');
                    $('#saveBtn').html("Simpan");
                    $('#bunga_id').val(data.id);
                    $('#suku_bunga').val(data.suku_bunga);
                })
            })

            $('#saveBtn').click(function(e) {
                e.preventDefault();
                var formData = new FormData($('#itemForm')[0]);
                $.ajax({
                    data: formData,
                    url: "{{ route('bunga.store') }}",
                    contentType: false,
                    processData: false,
                    type: "POST",
                    success: function(data) {
                        $('#saveBtn').attr('disabled', 'disabled');
                        $('#saveBtn').html('Simpan ...');
                        $('#itemForm').trigger("reset");
                        $('#editModal').modal('hide');
                        toastr.success('Data berhasil disimpan');
                        table.draw();
                    },
                    error: function(data) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Coba kembali isi data dengan benar!',
                        });
                    }
                });
            });
        });
    </script>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal">Edit Bunga</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="post" id="itemForm" name="itemForm">
                    @csrf
                    <input type="hidden" id="bunga_id" name="bunga_id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="suku_bunga">Suku Bunga</label>
                            <input type="number" class="form-control form-control-sm" name="suku_bunga" id="suku_bunga">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveBtn">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
