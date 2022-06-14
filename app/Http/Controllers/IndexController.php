<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{

    public function index()
    {
        return view('index');
    }

    public function submit_register(Request $request) {
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $age = $request->input('age');
        $address = $request->input('address');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $service = $request->input('service');
        $pokok_doa = $request->input('pokok_doa');
        $created_at = date('Y-m-d H:i:s', strtotime('now + 7 hours'));
        $attend_date = date('Y-m-d', strtotime('Wednesday', strtotime($created_at)));

        $getService = 600;

        $countUser = DB::table('registrant')->where('service',$service)->count();

        $existedUser = DB::table('registrant')->join('service', 'registrant.service', '=', 'service.id')->where('registrant.name',$first_name.' '. $last_name)->select('registrant.id as registrant_id', 'registrant.name as registrant_name', 'service.*')->first();

        if (!empty($existedUser)) {
            return view('fail', ['code' => 0, 'name' => $existedUser->registrant_name,'attend_date' => $attend_date, 'data' => $existedUser, 'id' => ($existedUser->registrant_id)]);
        }

        if ($countUser >= $getService) {
            // USER EXCEEDED CAPACITY
            return view('fail', ['code' => 1]);
        } else {

            $id = DB::table('registrant')->insertGetId(
                                                ['name' => $first_name.' '. $last_name,
                                                 'age' => $age,
                                                 'address' => $address,
                                                 'email' => $email,
                                                 'phone' => $phone,
                                                 'service' => $service,
                                                 'pokok_doa' => $pokok_doa,
                                                 'attend_date' => $attend_date,
                                                 'created_at' => $created_at,
                                                ] );

            if ($id) {
                // SET UP EMAIL
                // $temp_service = DB::table('service')->where('id', $service)->first();
                $temp_service = 'Worship Night Onsite';
                $name = $first_name.' '. $last_name;
                $this->registEmail($email, $attend_date, $temp_service, $name, $id);
                return view('success', ['data' => $temp_service, 'id' => $id, 'name' => $name, 'attend_date' => $attend_date]);
            } else {
                // GENERIC ERROR MESSAGE
                return view('fail', ['code' => 0]);
            }

        }

    }

    public function registEmail ($to, $date, $data, $name, $id) {
        $subject = 'Worship Night Onsite Service Confirmation';
        $htmlBody = '<table width=700px style="background-color:#07121E; padding:40px 40px">';
        $htmlBody .= '<tr>
                        <td> 
                            <table width=100% style="background-color: #1d252f; padding:20px 20px;font-family: sans-serif;color: #fff !important"> 
                                <tr>
                                    <td>
                                        <br>
                                        <tr> 
                                            <td> 
                                                <div style="display: inline-block;width: 100%; text-align: center"> 
                                                    <img src="https://i.imgur.com/eb3pyoN.png" width="50%"> 
                                                </div>
                                            </td>
                                        </tr>
                                        <tr> 
                                            <td align="center"> 
                                                <br><br><p> 
                                                <h1 style="word-break: break-word;color: #fff !important">No.urut: '.$id.'</h1> 
                                                <h1 style="word-break: break-word;color: #fff !important">Terima Kasih, '.$name.'</h1>
                                                <h3 style="word-break: break-word; font-weight: normal;color: #fff !important">Anda telah terdaftar untuk mengikuti ibadah onsite.</h3>
                                                <h1 style="word-break: break-word;color: #fff !important">Worship Night Onsite</h1> 
                                                <h3 style="word-break: break-word; font-weight: normal; font-style: italic;color: #fff !important">Jl. Aruna no. 19</h3> 
                                                <h3 style="word-break: break-word; font-weight: normal; font-style: italic;color: #fff !important">'.$date.', 18.30 WIB</h3> 
                                                <h3 style="word-break: break-word; font-weight: normal; font-style: italic;color: #fff !important">Informasi: - </h3> 
                                                <h3 style="word-break: break-word; font-weight: normal;color: #fff !important">Mohon membawa tanda bukti pengenalan diri (KAJ/KTP/SIM) sehingga tim kami dapat mengkonfirmasi kehadiran anda.</h3> 
                                                </p>
                                            </td>
                                        </tr>
                                        <tr> 
                                            <td align="center"> 
                                                <hr> <br>
                                                <p style="font-weight: bold"> <i>Tuhan Yesus Memberkati.</i></p><br>
                                            </td>
                                        </tr>
                                    <tr><td><br>';

        // Headers
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        $headers[] = 'From: GBI Sukawarna <gbisukawarna@gbisukawarna.org>';
        //End of send email//
        return mail($to, $subject, $htmlBody, implode("\r\n", $headers));
    }

    public function getServices () {
        // $services = DB::table('service')->get();
        $services = DB::select('SELECT id, name, time, qty, IFNULL(t.ct, 0) as ct FROM service LEFT OUTER JOIN (SELECT service, count(id) as ct FROM `registrant` GROUP BY service) as t ON service.id = t.service WHERE service.status = 1 ORDER BY service.id');

        return json_encode($services);
    }
}
