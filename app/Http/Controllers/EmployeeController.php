<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use mysqli;

class EmployeeController extends Controller
{
    private function myCrypt($val)
    {
        $key = "0D77K4ZE312301262B0564CCD7A1ADC9"; // 32 bytes
        $iv = "383FK4Z315684722"; // 16 bytes
        $encrypted_data = openssl_encrypt($val, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);

        // $encrypted = myCrypt($valTxt, $key, $vector);

        return base64_encode($encrypted_data);
    }

    private function myDecrypt($val)
    {
        $key = "0D77K4ZE312301262B0564CCD7A1ADC9"; // 32 bytes
        $iv = "383FK4Z315684722"; // 16 bytes
        $value = base64_decode($val);
        $data = openssl_decrypt($value, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        // $encrypted = myCrypt($valTxt, $key, $vector);

        return json_decode($data, true);
    }

    private function getconn()
    {
        $db_host = "127.0.0.1";
        $db_name = "tes_kazee";
        $db_user = "root";
        $db_pass = "";

        $koneksi = new mysqli($db_host, $db_user, $db_pass, $db_name);
        if ($koneksi->connect_error) {
            die('Koneksi Gagal Localhost: ' . $koneksi->connect_error) . '';
        }
        return $koneksi;
    }

    public function addemp(Request $request)
    {
        $nmlengkap = $request->input('nmlengkap');
        $tgllahir = $request->input('tgllahir');
        $tmplahir = $request->input('tmplahir');
        $jnskelamin = $request->input('jnskelamin');
        $alamat = $request->input('alamat');
        $telepon = $request->input('telepon');
        $tglbekerja = $request->input('tglbekerja');
        $tglakhirkontrak = $request->input('tglakhirkontrak');
        $status = $request->input('status');
        $dept = $request->input('dept');
        $jabatan = $request->input('jabatan');
        $email = $request->input('email');
        $agama = $request->input('agama');
        $statusmenikah = $request->input('statusmenikah');
        $addby = $request->input('addby');
        $lastupdateby = $request->input('lastupdateby');
        $qnip = mysqli_query($this->getconn(), "SELECT getnip('A') AS nip");
        while ($rnip = mysqli_fetch_array($qnip)) {
            $nip = $rnip['nip'];
        }
        $qadd = mysqli_query($this->getconn(), "INSERT INTO m_employee (nip, nmlengkap, tgllahir, tmplahir, jnskelamin, alamat, telepon, tglbekerja, tglakhirkontrak, status, dept, jabatan, email, agama, statusmenikah, addby, addat, lastupdateby, updateat) VALUES ('" . $nip . "', '" . $nmlengkap . "', '" . $tgllahir . "', '" . $tmplahir . "', '" . $jnskelamin . "', '" . $alamat . "', '" . $telepon . "', '" . $tglbekerja . "', '" . $tglakhirkontrak . "', '" . $status . "', '" . $dept . "', '" . $jabatan . "', '" . $email . "', '" . $agama . "', '" . $statusmenikah . "', '" . $addby . "', NOW(), '" . $lastupdateby . "', NOW()) ");
        $response['add'] = $qadd;
        return response()->json($response);
    }
}
