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
        $status = $request->input('namastatus');
        $dept = $request->input('namadept');
        $jabatan = $request->input('namajabatan');
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
            "LEFT JOIN (SELECT nmlengkap, nip FROM m_employee) f ON f.nip = a.lastupdateby ORDER BY a.addat DESC");
        while ($rls = mysqli_fetch_array($qls)) {
            $ls = [];
            $ls['nip'] = $rls['nip'];
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

        $response['lsdept'] = array();
        $qls = mysqli_query($this->getconn(), "SELECT * FROM m_departemen");
        while ($rdp = mysqli_fetch_array($qls)) {
            array_push($response['lsdept'], ['text' => $rdp['namadept'], 'valOpt' => $rdp['id_dept']]);
        }
        array_unshift($response['lsdept'], ['text' => 'Pilih Departemen', 'valOpt' => 'X']);

        $response['lsstatus'] = array();
        $qls = mysqli_query($this->getconn(), "SELECT * FROM m_status");
        while ($rdp = mysqli_fetch_array($qls)) {
            array_push($response['lsstatus'], ['text' => $rdp['namastatus'], 'valOpt' => $rdp['idstatus']]);
        }
        array_unshift($response['lsstatus'], ['text' => 'Pilih Status', 'valOpt' => 'X']);

        $response['lsjnskelamin'] = array(['text' => 'Pilih Jenis Kelamin', 'valOpt' => 'X'], ['text' => 'PRIA', 'valOpt' => 'PRIA'], ['text' => 'WANITA', 'valOpt' => 'WANITA']);

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
        $status = $request->input('namastatus');
        $dept = $request->input('namadept');
        $jabatan = $request->input('namajabatan');
        $email = $request->input('email');
        $agama = $request->input('agama');
        $statusmenikah = $request->input('statusmenikah');
        $updateby = $request->input('lastupdateby');

        $qupdate = mysqli_query($this->getconn(), "UPDATE m_employee SET nmlengkap = '" . $nmlengkap . "', tgllahir = '" . $tgllahir . "', " .
            " tmplahir = '" . $tmplahir . "', jnskelamin = '" . $jnskelamin . "', alamat = '" . $alamat . "', telepon = '" . $telepon . "', " .
            " tglbekerja = NULLIF('" . $tglbekerja . "',''), tglakhirkontrak = NULLIF('" . $tglakhirkontrak . "',''), status = '" . $status . "', dept = '" . $dept . "', " .
            " jabatan = '" . $jabatan . "', email = '" . $email . "', agama = '" . $agama . "', statusmenikah = '" . $statusmenikah . "', " .
            " lastupdateby = '" . $updateby . "', updateat = NOW() WHERE nip = '" . $nip . "'");
        $response['update'] = $qupdate;

        $qlog = mysqli_query($this->getconn(), "INSERT INTO log_employee (idactivity, nip, timelog, ket) VALUES ('LA002', '" . $updateby . "', NOW(), '" . $nip . "')");
        return response()->json($response);
    }

    public function listjabatan(Request $request)
    {
        $iddept = $request->route('iddept');
        $response = array();
        $qls = mysqli_query($this->getconn(), "SELECT idjabatan, namajabatan FROM m_jabatan WHERE iddept = '" . $iddept . "'");
        while ($rdp = mysqli_fetch_array($qls)) {
            array_push($response, ['text' => $rdp['namajabatan'], 'valOpt' => $rdp['idjabatan']]);
        }
        array_unshift($response, ['text' => 'Pilih Jabatan', 'valOpt' => 'X']);

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

    public function listdept()
    {
        $response = array();
        $qls = mysqli_query($this->getconn(), "SELECT * FROM m_departemen");
        while ($rdp = mysqli_fetch_array($qls)) {
            array_push($response, ['text' => $rdp['namadept'], 'valOpt' => $rdp['id_dept']]);
        }
        array_unshift($response, ['text' => 'Pilih Departemen', 'valOpt' => 'X']);
        return response()->json($response);
    }

    public function adddepartemen(Request $request)
    {
        $nip = $request->input('nip');
        $namadept = $request->input('namadept');

        $qdp = mysqli_query($this->getconn(), "INSERT INTO m_departemen (id_dept, namadept) SELECT get_iddept('DP') AS id_dept, '" . $namadept . "'");
        $response['adddept'] = $qdp;

        $qlog = mysqli_query($this->getconn(), "INSERT INTO log_employee (idactivity, nip, timelog, ket) VALUES ('LA005', '" . $nip . "', NOW(), '" . $namadept . "')");
        return response()->json($response);
    }

    public function liststatus()
    {
        $response = array();
        $qls = mysqli_query($this->getconn(), "SELECT * FROM m_status");
        while ($rdp = mysqli_fetch_array($qls)) {
            array_push($response, ['text' => $rdp['namastatus'], 'valOpt' => $rdp['idstatus']]);
        }
        array_unshift($response, ['text' => 'Pilih Status', 'valOpt' => 'X']);
        return response()->json($response);
    }

    public function addstatus(Request $request)
    {
        $nip = $request->input('nip');
        $namastatus = $request->input('namastatus');

        $qdp = mysqli_query($this->getconn(), "INSERT INTO m_status (idstatus, namastatus) SELECT get_status('ST') AS idstatus, '" . $namastatus . "'");
        $response['addstatus'] = $qdp;

        $qlog = mysqli_query($this->getconn(), "INSERT INTO log_employee (idactivity, nip, timelog, ket) VALUES ('LA006', '" . $nip . "', NOW(), '" . $namastatus . "')");
        return response()->json($response);
    }

    public function listjabatanall()
    {
        $response = array();
        $qls = mysqli_query($this->getconn(), "SELECT idjabatan, namajabatan, iddept, namadept FROM m_jabatan a INNER JOIN m_departemen b ON b.id_dept = a.iddept ORDER BY namadept");
        while ($rdp = mysqli_fetch_array($qls)) {
            array_push($response, ['iddept' => $rdp['iddept'], 'namadept' => $rdp['namadept'], 'idjabatan' => $rdp['idjabatan'], 'namajabatan' => $rdp['namajabatan']]);
        }

        $dept = collect($response)->unique('iddept')->values();
        $res = array();
        for ($i = 0; $i < count($dept); $i++) {
            $dp = [];
            $dp['iddept'] = $dept[$i]['iddept'];
            $dp['namadept'] = $dept[$i]['namadept'];
            $dp['lsjab'] = array();

            $dps = collect($response)->where('iddept', $dept[$i]['iddept'])->values();
            for ($x = 0; $x < count($dps); $x++) {
                $jb = [];
                $jb['idjabatan'] = $dps[$x]['idjabatan'];
                $jb['namajabatan'] = $dps[$x]['namajabatan'];
                array_push($dp['lsjab'], $jb);
            }
            array_push($res, $dp);
        }

        return response()->json($res);
    }

    public function addjabatan(Request $request)
    {
        $nip = $request->input('nip');
        $namajab = $request->input('namajab');
        $iddept = $request->input('iddept');

        $qdp = mysqli_query($this->getconn(), "INSERT INTO m_jabatan (idjabatan, iddept, namajabatan) SELECT get_jabatan('JB') AS idjabatan, '" . $iddept . "', '" . $namajab . "'");
        $response['addjab'] = $qdp;

        $qlog = mysqli_query($this->getconn(), "INSERT INTO log_employee (idactivity, nip, timelog, ket) VALUES ('LA007', '" . $nip . "', NOW(), '" . $namajab . "')");
        return response()->json($response);
    }

    public function login(Request $request)
    {
        $nip = $request->input('nip');
        $pass = $request->input('pass');

        $checkUser = User::where([['nip', $nip]])->first();
        if (is_null($checkUser)) {
            $response = ['data' => null, 'msg' => 'NIP tidak ditemukan', 'token' => null];
            return response()->json($response);
        }
        if (!Hash::check($pass, $checkUser->password)) {
            $response = ['data' => null, 'msg' => 'Password salah', 'token' => null];
            return response()->json($response);
        }
        if ($checkUser['dept'] != 'DP24010000001' && $checkUser['dept'] != 'DP24010000005') {
            $response = ['data' => null, 'msg' => 'Anda tidak memiliki izin untuk mengakses aplikasi Employee Management', 'token' => null];
            return response()->json($response);
        }
        $checkUser['nip2'] = $nip;
        $token = $checkUser->createToken('auth-token')->plainTextToken;
        $qlog = mysqli_query($this->getconn(), "INSERT INTO log_employee (idactivity, nip, timelog, ket) VALUES ('LA004', '" . $nip . "', NOW(), '')");
        $response = ['data' => $checkUser, 'msg' => '', 'token' => $token];

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
