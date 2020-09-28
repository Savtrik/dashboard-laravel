<?php 
use Illuminate\Support\Facades\DB;
use App\Sensor;
use App\KonsumsiData;

if (! function_exists('getkode')) {
    function getkode()
    {
        $panjang = 55;
        $karakter       = 'kodingin.com4543534-039849kldsam][].';
        $panjangKata = strlen($karakter);
        $kode = '';
        for ($i = 0; $i < $panjang; $i++) {
            $kode .= $karakter[rand(0, $panjangKata - 1)];
        }
        return $kode;
    }
}
if (! function_exists('tanggal_indo')){
    function tanggal_indo($tanggal, $cetak_hari = false)
    {
        $hari = array ( 1 =>    'Senin',
                    'Selasa',
                    'Rabu',
                    'Kamis',
                    'Jumat',
                    'Sabtu',
                    'Minggu'
                );

        $bulan = array (1 =>   'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                );
        $split 	  = explode('-', $tanggal);
        $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];

        if ($cetak_hari) {
            $num = date('N', strtotime($tanggal));
            return $hari[$num] . ', ' . $tgl_indo;
        }
        return $tgl_indo;
    //  tanggal_indo ('2016-03-20', true); // Hasil: Minggu, 20 Maret 2016
    }
}
function find_max_daya_tools()
{
//   $ci =& get_instance();
//   $ci->load->database();
//   $result = $ci->db->order_by('DAYA','DESC')->limit(1)->get('sensor');
  $result = Sensor::orderBy('DAYA','asc')->first();
  return array($result->NAME,$result->DAYA);
}

function find_max_harian()
{
    $data=array();
    $arrayId=array();
    //   $ci =& get_instance();
    //   $ci->load->database();
    //   $result = $ci->db->order_by('IDSENSOR','DESC')->get('sensor');
    $result = Sensor::orderBy('IDSENSOR','asc')->get();
    foreach ($result as $c) {
        array_push($data, get_last_daya_oneday_tools($c->IDSENSOR));
        array_push($arrayId, $c->IDSENSOR);
    }
    $max = max($data);
    $key = array_search($max, $data);

    $id = $arrayId[$key];

    return array(find_kode_tools($id),$max);
}

function find_kode_tools($id='')
{
    // $ci =& get_instance();
    // $ci->load->database();
    // $result = $ci->db->where('IDSENSOR',$id)->order_by('IDSENSOR','DESC')->get('sensor');
    $result = Sensor::orderBy('IDSENSOR','desc')->where('IDSENSOR',$id)->first();
    
    return $result->NAME;
}

function get_last_daya_oneday_tools($id='')
{
  $dateNow = date('Y-m-d');
  $hourNow = date('H');

  $result = KonsumsiData::where('IDSENSOR',$id)->where('ONINSERT','like','%'.$dateNow.'%')->sum('POWER');

  return $hourNow == 0 ? 0 : round($result/$hourNow,2);
}