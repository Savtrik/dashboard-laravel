@extends('layouts.template')

@section('header')
    @include('layouts.header')
@endsection

@section('sidemenu')
    @include('layouts.sidemenu')
@endsection

@section('content')
  <div class="card gredient-info-bg mt-0 mb-0" style="background-image:url('{{asset('/images/Untitled-123.png')}}'); height: 100%; background-position: center; background-repeat: no-repeat; background-size: cover; ">
      <div class="card-body">
        <!-- KOTAKAN -->
        <div class="row">
            <!-- column -->
            <div class="col-sm-12 col-lg-5">
                <div class="card bg-transparent" >
                    <div class="card-body">
                      <b> <h5 class="card-title" style="color: #ffbc34;font-weight: bold;">Selamat Datang !</h5></b> <br>
                        <h3 style="color:white"><strong>Monitor Data Harian</strong></h3>
                        <h5 class="card-subtitle text-white">{{ tanggal_indo(date('Y-m-d'),true) }}</h5>
                    </div>
                </div>
            </div>
            <!-- column -->
            <div class="col-sm-12 col-lg-3">
              <div class="card" style="background-color: rgba(0, 0, 0, 0.23);border-radius:10px;">
                <div class="card-body">
                  <div class="info d-flex align-items-center">
                    <div class="mr-4">
                        <i class="fas fa-plug fa-3x" style="color:white"></i>
                    </div>
                    <div>
                        <h3 class="text-white mb-0" id="sum1"> {{$kons_total}} KWh</h3>
                        <span style="color:white"> Konsumsi hari ini </span>
                        <h6>    </h6>
                        <button type="button" class="btn waves-effect waves-light btn-warning">Lihat Lebih</button>
                        <br>
                    </div>
                </div>
                </div>
              </div>
            </div>
              <!-- column -->
              <div class="col-sm-12 col-lg-3">
                <div class="card" style="background-color: rgba(0, 0, 0, 0.23);border-radius:10px;">
                <div class="card-body">
                  <div class="info d-flex align-items-center">
                      <div class="mr-4">
                          <i class="fas fa-solar-panel fa-3x" style="color:white"></i>
                      </div>
                      <div>
                          <h3 class="text-white mb-0" id="sum2"> {{$prod_total}} KWh</h3>
                          <span style="color:white"> Produksi hari ini </span>
                          <h6>    </h6>
                          <button type="button" class="btn waves-effect waves-light btn-warning">Lihat Lebih</button>
                      </div>
                  </div>
                </div>
                </div>
              </div>
            </div>
      </div>
  </div>
  <div class="container-fluid">
      <!-- ============================================================== -->
      <!-- Sales chart -->
      <!-- ============================================================== -->
      <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-body">
                    <h2>Realtime Monitoring</h2>
                      <div class="d-md-flex align-items-center">
                              <div class="col-3">
                                  <h4 class="card-title" style="color: blue" id="kons"></h4>
                                  <span><h5 class="card-subtitle" id="kons_time">-</h5></span>
                              </div>
                              <div class="col-3">
                                  <h4 class="card-title" style="color: orange" id="prod"></h4>
                                  <h5 class="card-subtitle" id="prod_time">-</h5>
                              </div> <br>
                      </div>
                      <div class="row">
                        <canvas id="myOwnChart" height="100"></canvas>
                      </div>
                      <hr style="margin-top: unset;">
                      <div class="ml-auto d-flex no-block align-items-center">
                              <ul class="list-inline font-15 dl mr-3 mb-0">
                                  <li class="list-inline-item text-info"><i class="fas fa-check-square"></i> Konsumsi</li>
                                  <li class="list-inline-item text-primary"><i class="fas fa-check-square" style="color: orange"></i> Produksi</li>
                              </ul>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-md-12">
        <div class="card">
          <!--end .card-body -->
        </div>
      </div>
      <!-- ============================================================== -->
      <!-- Daya baterai, performa hari ini -->
      <!-- ============================================================== -->
      <div class="row">
          <!-- column -->
          <div class="col-sm-12 col-lg-4">
              <div class="card bg-white">
              <div class="card-body">
                      <div class="row">
                          <div class="col-6">
                              <img src="{{asset('/images/dayabaterai.png')}}" alt="performa hari ini" height="115" width="110">
                          </div>
                          <div class="col-6">
                              <br>
                              <h3>80%</h3>
                              <h6 class="card-title text-black">Daya Baterai</h6>
                              <button type="button" class="btn waves-effect waves-light btn-info">Lihat Lebih</button>
                          </div>
                      </div>
                      </div>
              </div>
          </div>
          <!-- column -->
          <div class="col-sm-12 col-lg-4">
              <div class="card bg-white">
              <div class="card-body">
                      <div class="row">
                          <div class="col-6">
                              <img src="{{asset('/images/penghematan.png')}}" alt="performa hari ini" height="115" width="110">
                          </div>
                          <div class="col-6">
                              <br>
                              <h3>Rp 134.000</h3>
                              <h6 class="card-title text-black">Penghematan Hari Ini</h6>
                              <button type="button" class="btn waves-effect waves-light btn-info">Lihat Lebih</button>
                          </div>
                      </div>
                      </div>
              </div>
          </div>
          <!-- column -->
          <div class="col-sm-12 col-lg-4">
              <div class="card bg-white">
              <div class="card-body">
                      <div class="row">
                          <div class="col-6">
                              <img src="{{asset('/images/performa.png')}}" alt="performa hari ini" height="115" width="110">
                          </div>
                          <div class="col-6">
                              <br>
                              <h3>80%</h3>
                              <h6 class="card-title text-black">Performa Hari Ini</h6>
                              <button type="button" class="btn waves-effect waves-light btn-info">Lihat Lebih</button>
                          </div>
                      </div>
                      </div>
              </div>
          </div>
        </div>

  </div>

  @include('layouts.chartjs1')

  <!-- <script type="text/javascript">
    $(document).ready(function(){
      callGraph();
      // setTimeout(function () {
      //   callGraph();
      //   $( window ).resize(function() {
      //       // graphData.configure({
      //       //   height: $('#rickshawGraph').height(),
      //       //   width: $('#rickshawGraph').closest('#aa').width()
      //       // // });
      //       // callGraph();
      //   });
      //   console.log("tick");
      // }, 5000);
    });
  </script> -->
  

  <script type="text/javascript">
  $(function() {
    // grafikData();
    counter = 0;
    setInterval(function () {
      
      console.log(counter++);
      callGraph();
  
    }, 5000);
  })
  
  // function realtime_konsProd() {
  //   $.get("{{url('/dashboard')}}/realtime_konsProd", function(data, status){
  
  //      alert("Data: " + data + "\nStatus: " + status);
  //    });
  // }
  </script>
@endsection

