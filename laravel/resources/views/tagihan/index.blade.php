@extends('layouts.app')

@section('content')
<div class="container-fluid">
    
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{$title}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">{{$title}}</a></li>
                        <li class="breadcrumb-item active">{{$title}}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-end mb-2">
                        <div class="col-md-2">
                            <a href="{{ route($route.'.create') }}" class="btn btn-primary col-md-12"><i class="mdi mdi-plus"></i> Tambah</a>
                        </div>
                    </div>
                    {{-- <h4 class="card-title">Pengguna</h4> --}}
                    {{-- <p class="card-title-desc">DataTables has most features enabled by
                        default, so all you need to do to use it with your own tables is to call
                        the construction function: <code>$().DataTable();</code>.
                    </p> --}}
                    <table id="datatable" class="table table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>No Tagihan</th>
                            <th>Nama Perusahaan</th>
                            <th>Penggunaan (m³)</th>
                            <th>Tagihan</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Status</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Gambar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="modal_gambar" class="modal-body">
                    
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

</div>

@push('scripts')
    <!-- Required datatable js -->
    <script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Buttons examples -->
    <script src="{{asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/libs/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
    <!-- Responsive examples -->
    <script src="{{asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

@endpush

@push('scripts')
    <script src="{{asset('assets/js/pages/modal.init.js')}}"></script>
    <script>
        var table = $('#datatable').DataTable({
            responsive:false,
            processing: true,
            serverSide: true,
            order: [[ 0, "desc" ]],
            ajax: {
                'url': '{{ route("datatable.tagihan") }}',
                'type': 'GET',
                'beforeSend': function (request) {
                    request.setRequestHeader("X-CSRFToken", '{{ csrf_token() }}');
                }
            },
            columns: [
                {data:'id_tagihan',name:'id_tagihan'},
                {data:'name',name:'pelanggans.name'},
                {data:'meter_penggunaan',name:'meter_penggunaan'},
                {data:'jumlah_pembayaran', name:'tagihans.jumlah_pembayaran'},
                {data:'tanggal',name:'tanggal'},
                {data:'tahun',name:'tahun'},
                {data:'status',name:'status'},
                {data:'show_image',name:'show_image'},
                {data:'action',name:'action' , searchable: false},

            ],
        });

    </script>
@endpush
@endsection