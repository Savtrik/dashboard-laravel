@extends('layouts.template')

@section('header')
    @include('layouts.header')
@endsection

@section('sidemenu')
    @include('layouts.sidemenu')
@endsection    

@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- =========== Penjadwalan Peralatan ============================ -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card bg-transparent">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-1">
                                <img src="{{asset('images/Jadwal.png')}}" alt="Produksi" height="65" width="65">
                            </div>
                            <div class="col-4">
                                <br>
                                <h3> Penjadwalan Peralatan</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Sales chart -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title"><Strong>Monitoring Beban</Strong></h4>
                            </div>
                        </div>
                        <div class="row">
                            <!-- column -->
                            <div class="col-lg-12">
                                <canvas id="penjadwalan-chart" height="80"></canvas>
                            </div>
                            <!-- column -->
                        </div>
                        <div class="ml-auto d-flex no-block align-items-center">
                                <ul class="list-inline font-12 dl mr-3 mb-0">
                                    <li class="list-inline-item text-info"><i class="fas fa-check-square" style="color: #cc0000"></i> Beban A</li>
                                    <li class="list-inline-item text-primary"><i class="fas fa-check-square" style="color: #00cc00"></i> Beban B</li>
                                    <li class="list-inline-item text-primary"><i class="fas fa-check-square" style="color: #8A2BE2"></i> Beban C</li>
                                    <li class="list-inline-item text-primary"><i class="fas fa-check-square" style="color: #2962FF"></i> Beban Total</li>
                                </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- List Peralatan -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Projects of the month -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Table -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-md-flex align-items-center mb-2">
                            <div>
                                <h4 class="card-title"><strong>List Peralatan</strong></h4>
                            </div>
                            <div class="ml-auto">
                            <button class="btn btn-primary btn-circle float-right" onclick="tambah()"> <i class="fa fa-plus"></i> </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table no-wrap v-middle" id="dataTables">
                                <thead>
                                    <tr class="border-0">
                                        <th class="border-0"><Strong>No</Strong></th>
                                        {{-- <th class="border-0"><Strong>Kode</Strong></th> --}}
                                        <th class="border-0"><Strong>Nama Peralatan</Strong></th>
                                        <th class="border-0"><Strong>Daya</Strong></th>
                                        <th class="border-0"><Strong>Konsumsi Hari Ini</Strong></th>
                                        <th class="border-0"><Strong>Status</Strong></th>
                                        <th class="border-0"><Strong>Aksi</Strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($data as $d)
                                    <tr>
                                        <td>
                                            <div class="d-flex no-block align-items-center">
                                                    <h5 class="mb-0 font-16 font-medium">{{$loop->iteration}}</h5>
                                            </div>
                                        </td>
                                        {{-- <td>{{$d->KODE}}</td> --}}
                                        <td>{{$d->NAME}}</td>
                                        <td>{{$d->DAYA}} Kw</td>
                                        <td>{{get_last_daya_oneday_tools($d->IDSENSOR)}} Kwh </td>
                                        <td>
                                            <input type="checkbox" data-id="{{ $d->IDSENSOR }}" name="status" class="js-switch" {{ $d->ISACTIVE == 1 ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                        <button class="btn btn-info btn-circle" onclick="edit({{$d->IDSENSOR}})"> <i class="fa fa-pencil"></i> </button>
                                        <button class="btn btn-danger btn-circle" onclick="hapus({{$d->IDSENSOR}})"> <i class="fa fa-trash"></i> </button>
                                        </td>
                                    </tr>    
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Peralatan Daya Terbesar, Terboros dan Total Peralatan -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- column -->
            <div class="col-sm-12 col-lg-4">
                <div class="card bg-white">
                        <div class="card-body">
                                <br>
                                <h5><strong>Peralatan Daya Terbesar</strong></h5>
                                <div class="row">
                                    <div class="col-sm-6">
                                        {{-- <h6 style="color: blue"><strong>{{find_max_daya_tools()[0]}}</strong></h6> --}}
                                        <h6 style="color: blue"><strong>AC</strong></h6>
                                    </div>
                                    <div class="col-sm-6">
                                        {{-- <h6 style="color: blue">{{find_max_daya_tools()[1]}} Kwh</h6> --}}
                                        <h6 style="color: blue">540 watt</h6>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>

            <!-- column -->
            <div class="col-sm-12 col-lg-4">
                <div class="card bg-white">
                <div class="card-body">
                        <br>
                                <h5><strong>Peralatan Daya Terboros</strong></h5>
                                <?php $max_harian = find_max_harian() ?>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h6 style="color: blue"><strong>{{$max_harian[0]}}</strong></h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <h6 style="color: blue">{{$max_harian[1]}} Kwh</h6>
                                    </div>
                                </div>
                        </div>
                </div>
            </div>
            <!-- column -->
            <div class="col-sm-12 col-lg-4">
                <div class="card bg-white">
                <div class="card-body">
                        <br>
                                <h5><strong>Total Peralatan</strong></h5>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h6 style="color: blue"><strong>{{$data->count()}} Peralatan</strong></h6>
                                    </div>
                                </div>
                        </div>
                </div>
            </div>
        </div>



    <!-- modal -->
    <div class="modal fade" id="modalTools" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formModal" action="/dashboard/penjadwalan" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel"><i class="ti-marker-alt m-r-10"></i> Tambah Peralatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                    <label>Kode</label>
                    <input type="text" name="KODE" class="form-control" required>
                    </div>
                    <div class="form-group">
                    <label>Nama Peralatan</label>
                    <input type="text" name="NAME" class="form-control" required>
                    </div>
                    <div class="form-group">
                    <label>Daya</label>
                    <input type="number" name="DAYA" class="form-control" required>
                    </div>
                    <div class="form-group">
                    <label>Control</label>
                    <select class="form-control" name="CONTROL" required>
                        <option value="1">On</option>
                        <option value="0">Off</option>
                    </select>
                    </div>
                    <input type="hidden" name="IDSENSOR" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success"><i class="ti-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
    </div>

    <script>
        let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    
        elems.forEach(function(html) {
        let switchery = new Switchery(html,  { size: 'small' });
        });

        $(document).ready(function(){
            $('.js-switch').change(function () {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let userId = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('sensor.update.status') }}',
                    data: {'status': status, 'user_id': userId},
                    success: function (data) {
                        console.log(data.message);
                        toastr.options.closeButton = true;
                        toastr.options.closeMethod = 'fadeOut';
                        toastr.options.closeDuration = 100;
                        toastr.success(data.message);
                    }
                });
            });
        });
    </script>

    {{-- <script type="text/javascript">
    var table;
        $(document).ready(function() {
            //datatables
            var table = $('#dataTables').DataTable({
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": " {{asset('/extensions/TableTools/swf/copy_csv_xls_pdf.swf') }} "
            },
            });

        });
    // function controlCheck(id,cs) {
    //     var checker = $('#customSwitch'+cs).is(':checked');
    //     var value;
    //     if (checker) {
    //     value =1;
    //     }else {
    //     value =0;
    //     }

    //     $.ajax(
    //         {
    //         type: "GET",
    //         url: "{{url('User/controlSensor')}}/"+id+"/"+value,
    //         dataType:"JSON"
    //         }
    //     ).done(function( data )
    //     {
    //         if (data=='1') {
    //         toastr.success("Success update control.", "Success!");
    //         }else {
    //         toastr.error("Gagal update control.", "Gagal!");
    //         }
    //     });
    // }

    function tambah() {
        $('#formModal')[0].reset();
        $("#formModal").removeAttr("action");
        $("#formModal").attr('action',"{{url('User/newTools/') }}");
        $('#modalTools').modal('show');
    }

    function edit(id) {
        $.ajax(
        {
        type: "GET",
        url: "{{url('User/editTools')}}/"+id,
        dataType:"JSON"
        }
    ).done(function( data )
    {
        $('#createModalLabel').text('Edit Data Peralatan');
        $('#formModal')[0].reset();
        $('[name="KODE"]').val(data.KODE);
        $('[name="NAME"]').val(data.NAME);
        $('[name="DAYA"]').val(data.DAYA);
        $('[name="CONTROL"]').val(data.CONTROL);
        $('[name="IDSENSOR"]').val(data.IDSENSOR);
        $("#formModal").removeAttr("action");
        $("#formModal").attr('action',"{{url('User/updateTools/') }}");
        $("#modalTools").modal("show");
    });
    }

    function hapus(id) {
        toastr.error('Anda akan menghapus data ini?<br /><a href="{{url('User/hapusTools/') }}'+id+'" class="btn btn-secondary clear">Yes</a>', 'Anda yakin?',{ "progressBar": true });
    }
    </script> --}}
@endsection

@section('script')
<script src="{{asset('/dist/js/pages/dashboards/dashboardpenjadwalan.js')}}"></script>
@endsection
