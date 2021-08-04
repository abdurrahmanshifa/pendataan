<?php
namespace App\Helpers;
// use Carbon\Carbon;
class DateHelper
{
    public static function hari($day)
    {
        $en = ['Sun'=>'Minggu','Mon'=>'Senin','Tue'=>'Selasa','Wed'=>'Rabu','Thu'=>'Kamis','Fri'=>'Jumat','Sat'=>'Sabtu'];
        return $en[$day];
    }

    public static function bulanInd($n)
    {
        $bulan = [
                    1 => 'Januari', 2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',
                    7 => 'Juli', 8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'
                ];

        return $bulan[$n];
    }
    public static function bulanSingkatInd($n)
    {
        $n = (int)$n;
        $bulan = [
                    1 => 'Jan', 2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',
                    7 => 'Jul', 8=>'Ags',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des'
                ];

        return $bulan[$n];
    }

    public static function tglIndSingkat($date)
    {
        $date = strtok($date, ' ');
        list($th, $bl, $tg) = explode('-', $date);
        return $tg.' '.self::bulanSingkatInd((int)$bl).' '.$th;
    }
    public static function tglInd($date)
    {
        $date = strtok($date, ' ');
        list($th, $bl, $tg) = explode('-', $date);
        return $tg.' '.self::bulanInd((int)$bl).' '.$th;
    }
    
    public static function tglIndTime($date)
    {
        list($tgl, $wkt) = explode(' ', $date);
        list($th, $bl, $tg) = explode('-', $tgl);
        return $tg.' '.self::bulanInd((int)$bl).' '.$th.' '.$wkt;
    }
    
    public static function tglIndTimeIcon($date)
    {
        list($tgl, $wkt) = explode(' ', $date);
        list($th, $bl, $tg) = explode('-', $tgl);
        return '<i class="fa fa-calendar"></i>&nbsp;&nbsp;'.$tg.' '.self::bulanInd((int)$bl).' '.$th.',&nbsp;&nbsp;<i class="fa fa-clock-o"></i>&nbsp;&nbsp;'.$wkt;
    }
    public static function tglDayIndTimeIcon($date)
    {
        list($tgl, $wkt) = explode(' ', $date);
        list($th, $bl, $tg) = explode('-', $tgl);
        $hari = date('D', strtotime($date));
        return '<i class="fa fa-calendar"></i>&nbsp;&nbsp;'.self::hari($hari).',&nbsp;'.$tg.' '.self::bulanInd((int)$bl).' '.$th.',&nbsp;&nbsp;<i class="fa fa-clock-o"></i>&nbsp;&nbsp;'.$wkt;
    }

    public static function selisihTanggal($date)
    {
        // $date = Carbon::parse($date);
        // $now = Carbon::now();

        $diff = $date->diffInDays($now);
        return $diff;
    }
}