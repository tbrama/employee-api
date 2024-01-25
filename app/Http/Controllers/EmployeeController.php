<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

        $qnip = mysqli_query($this->getconn(), "SELECT getnip('A') AS nip");
        while ($rnip = mysqli_fetch_array($qnip)) {
            $nip = $rnip['nip'];
        }
        $pass = Hash::make($nip);
        $qadd = mysqli_query($this->getconn(), "INSERT INTO m_employee (nip, nmlengkap, tgllahir, tmplahir, jnskelamin, alamat, telepon, tglbekerja, tglakhirkontrak, status, dept, jabatan, email, agama, statusmenikah, addby, addat, lastupdateby, updateat, password) SELECT '" . $nip . "', '" . $nmlengkap . "', '" . $tgllahir . "', '" . $tmplahir . "', '" . $jnskelamin . "', '" . $alamat . "', '" . $telepon . "', '" . $tglbekerja . "', NULLIF('" . $tglakhirkontrak . "',''), '" . $status . "', '" . $dept . "', '" . $jabatan . "', '" . $email . "', '" . $agama . "', '" . $statusmenikah . "', '" . $addby . "', NOW(), '" . $addby . "', NOW(), '" . $pass . "'");
        $response['add'] = $qadd;

        $qlog = mysqli_query($this->getconn(), "INSERT INTO log_employee (idactivity, nip, timelog, ket) VALUES ('LA001', '" . $addby . "', NOW(), '" . $nip . "')");
        return response()->json($response);
    }

    public function listemp()
    {
        $response['ls_employee'] = array();
        $qls = mysqli_query($this->getconn(), "SELECT a.nip, a.nmlengkap, a.tgllahir, a.tmplahir, a.jnskelamin, a.alamat, a.telepon, a.tglbekerja, " .
            "a.tglakhirkontrak, b.namastatus, c.namadept, d.namajabatan, a.email, a.agama, a.statusmenikah, " .
            "e.nmlengkap AS addby, a.addat, f.nmlengkap AS lastupdateby, a.updateat FROM m_employee a " .
            "INNER JOIN m_status b ON b.idstatus = a.status " .
            "INNER JOIN m_departemen c ON c.id_dept = a.dept " .
            "INNER JOIN m_jabatan d ON d.idjabatan = a.jabatan " .
            "LEFT JOIN (SELECT nmlengkap, nip FROM m_employee) e ON e.nip = a.addby " .
            "LEFT JOIN (SELECT nmlengkap, nip FROM m_employee) f ON f.nip = a.lastupdateby ");
        while ($rls = mysqli_fetch_array($qls)) {
            $ls = [];
            $ls['nmlengkap'] = $rls['nmlengkap'];
            $ls['tgllahir'] = $rls['tgllahir'];
            $ls['tmplahir'] = $rls['tmplahir'];
            $ls['jnskelamin'] = $rls['jnskelamin'];
            $ls['alamat'] = $rls['alamat'];
            $ls['telepon'] = $rls['telepon'];
            $ls['tglbekerja'] = $rls['tglbekerja'];
            $ls['tglakhirkontrak'] = $rls['tglakhirkontrak'];
            $ls['namastatus'] = $rls['namastatus'];
            $ls['namadept'] = $rls['namadept'];
            $ls['namajabatan'] = $rls['namajabatan'];
            $ls['email'] = $rls['email'];
            $ls['agama'] = $rls['agama'];
            $ls['statusmenikah'] = $rls['statusmenikah'];
            $ls['addby'] = $rls['addby'];
            $ls['addat'] = $rls['addat'];
            $ls['lastupdateby'] = $rls['lastupdateby'];
            $ls['updateat'] = $rls['updateat'];
            array_push($response['ls_employee'], $ls);
        }

        return response()->json($response);
    }

    public function updateemp(Request $request)
    {
        $nip = $request->input('nip');
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
        $updateby = $request->input('updateby');

        $qupdate = mysqli_query($this->getconn(), "UPDATE m_employee SET nmlengkap = '" . $nmlengkap . "', tgllahir = '" . $tgllahir . "', " .
            " tmplahir = '" . $tmplahir . "', jnskelamin = '" . $jnskelamin . "', alamat = '" . $alamat . "', telepon = '" . $telepon . "', " .
            " tglbekerja = NULLIF('" . $tglbekerja . "',''), tglakhirkontrak = NULLIF('" . $tglakhirkontrak . "',''), status = '" . $status . "', dept = '" . $dept . "', " .
            " jabatan = '" . $jabatan . "', email = '" . $email . "', agama = '" . $agama . "', statusmenikah = '" . $statusmenikah . "', " .
            " lastupdateby = '" . $updateby . "', updateat = NOW() WHERE nip = '" . $nip . "'");
        $response['update'] = $qupdate;

        $qlog = mysqli_query($this->getconn(), "INSERT INTO log_employee (idactivity, nip, timelog, ket) VALUES ('LA002', '" . $updateby . "', NOW(), '" . $nip . "')");
        return response()->json($response);
    }

    public function listdeptstat()
    {
        $response['lsdept'] = array();
        $qls = mysqli_query($this->getconn(), "SELECT * FROM m_departemen");
        while ($rdp = mysqli_fetch_array($qls)) {
            array_push($response['lsdept'], ['text' => $rdp['namadept'], 'valOpt' => $rdp['id_dept']]);
        }

        $response['lsstatus'] = array();
        $qls = mysqli_query($this->getconn(), "SELECT * FROM m_status");
        while ($rdp = mysqli_fetch_array($qls)) {
            array_push($response['lsstatus'], ['text' => $rdp['namastatus'], 'valOpt' => $rdp['idstatus']]);
        }

        return response()->json($response);
    }

    public function listjabatan(Request $request)
    {
        $iddept = $request->route('iddept');
        $response['lsjab'] = array();
        $qls = mysqli_query($this->getconn(), "SELECT idjabatan, namajabatan FROM m_jabatan WHERE iddept = '" . $iddept . "'");
        while ($rdp = mysqli_fetch_array($qls)) {
            array_push($response['lsjab'], ['text' => $rdp['namajabatan'], 'valOpt' => $rdp['idjabatan']]);
        }

        return response()->json($response);
    }

    public function deleteemp(Request $request)
    {
        $nip = $request->input('nip');
        $updateby = $request->input('updateby');

        $qdelete = mysqli_query($this->getconn(), "DELETE FROM m_employee WHERE nip = '" . $nip . "'");

        $response['delete'] = $qdelete;

        $qlog = mysqli_query($this->getconn(), "INSERT INTO log_employee (idactivity, nip, timelog, ket) VALUES ('LA003', '" . $updateby . "', NOW(), '" . $nip . "')");
        return response()->json($response);
    }

    public function login(Request $request)
    {
        $nip = $request->input('nip');
        $pass = $request->input('pass');

        $checkUser = User::where([['nip', $nip], ['password', $pass]])->first();

        if (is_null($checkUser)) {
            $response = ['data' => null, 'msg' => 'NIP atau Password tidak ditemukan', 'token' => null];
        } else {
            $token = $checkUser->createToken('auth-token')->plainTextToken;
            $qlog = mysqli_query($this->getconn(), "INSERT INTO log_employee (idactivity, nip, timelog, ket) VALUES ('LA004', '" . $nip . "', NOW(), '')");
            $response = ['data' => $checkUser, 'msg' => '', 'token' => $token];
        }

        return response()->json($response);
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();
        $res = [
            'logout' => 'T',
        ];
        return response()->json($res);
    }
}
