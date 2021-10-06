<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Helper
{
    public static function uploadFile($file, $folder)
    {
        $ext = $file->getClientOriginalExtension();
        if ($file->isValid()) {
            $file_name = $folder . '_' . date('YmdHis') . ".$ext";
            $file->storeAs($folder, $file_name, 'public');
            return $file_name;
        }
        return false;
    }

    public static function updateFile($data, $path, $file, $folder)
    {
        $exist = file_exists(storage_path('app/public/' . $path . '/' . $data));
        if (isset($data) && $exist) {
            Storage::delete('public/' . $path . '/' . $data);
        }
        $ext = $file->getClientOriginalExtension();
        if ($file->isValid()) {
            $file_name = $folder . '_' . date('YmdHis') . ".$ext";
            $file->storeAs($folder, $file_name, 'public');
            return $file_name;
        }
        return false;
    }

    public static function deleteFile($data, $path)
    {
        $exist = file_exists(storage_path('app/public/' . $path . '/' . $data));
        if (isset($data) && $exist) {
            Storage::delete('public/' . $path . '/' . $data);
        }
    }

    public static function autonumber($barang, $primary, $prefix)
    {
        $q = DB::table($barang)->select(DB::raw('MAX(RIGHT(' . $primary . ',5)) as kd_max'));
        $prx = $prefix;
        if ($q->count() > 0) {
            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = $prx . sprintf("%06s", $tmp);
            }
        } else {
            $kd = $prx . "000001";
        }
        return $kd;
    }

    public static function indo_date($tanggal)
    {
        $bulan = array(
            1 =>   'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }

    public static function rupiah($angka)
    {

        $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
        return $hasil_rupiah;
    }

    public static function dateDiffInDays($date1, $date2)
    {
        // Calculating the difference in timestamps
        $diff = strtotime($date2) - strtotime($date1);

        // 1 day = 24 hours
        // 24 * 60 * 60 = 86400 seconds
        return abs(round($diff / 86400));
    }
}