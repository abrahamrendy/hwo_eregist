<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $code = $user->code;
        if ($code == null) {
            return view('home');
        } else {
            if ($code == 1) {
                $registrants = DB::table('registrant')->join('service', 'registrant.service', '=', 'service.id')->select('registrant.id as id', 'registrant.name', 'registrant.email', 'registrant.age', 'registrant.phone', 'registrant.address', 'service.name as svc_name', 'service.time as svc_time', 'registrant.pokok_doa as pokok_doa')->orderBy('registrant.id', 'desc')->get();

                return view('home',['data'=>$registrants]);
            } else {
                $registrants = DB::table('registrant')->join('service', 'registrant.service', '=', 'service.id')->select('registrant.id as id', 'registrant.name', 'registrant.email', 'registrant.age', 'registrant.phone', 'registrant.address', 'service.name as svc_name', 'service.time as svc_time', 'registrant.pokok_doa as pokok_doa')->where('service.code', $code)->orderBy('registrant.id', 'desc')->get();

                return view('home',['data'=>$registrants]);
            }
        }


    }

    public function getAllRegistrants() {
        $registrants = DB::table('registrant')->get();

        return json_encode($registrant);
    }

    public function deleteRegistrants() {
        $user = Auth::user();
        $code = $user->code;

        if ($code == null) {
            // DO NOTHING
        } else {
            if ($code == 1) {
                DB::table('registrant')->truncate();
                return redirect()->route('home');
            } else {
                DB::table('registrant')->join('service', 'registrant.service', '=', 'service.id')->select('registrant.*', 'service.name as svc_name')->where('service.code', $code)->delete();
                
            }
        }

        return redirect()->route('home');
    }

    // SERVICE
    public function ibadah()
    {
        $user = Auth::user();
        $code = $user->code;
        if ($code == null) {
            return view('home');
        } else {
            if ($code == 1) {
                $ibadah = DB::table('service')->get();

                return view('ibadah',['data'=>$ibadah, 'code' => $code]);
            } else {
                $ibadah = DB::table('service')->where('code', $code)->get();

                return view('ibadah',['data'=>$ibadah, 'code' => $code]);
            }
        }


    }

    public function submit_service(Request $request){
        $name = $request->input('name');
        $address = $request->input('address');
        $time = $request->input('time');
        $contact_person = $request->input('contact_person');
        $qty = $request->input('qty');
        $created_at = date('Y-m-d H:i:s', strtotime('now'));


        $id = DB::table('service')->insertGetId(
                                                ['name' => $name,
                                                 'address' => $address,
                                                 'time' => $time,
                                                 'contact_person' => $contact_person,
                                                 'qty' => $qty,
                                                 'created_at' => $created_at,
                                                ] );

        if ($id) {
            return redirect()->route('ibadah');
        } else {
            // GENERIC ERROR MESSAGE
            return view('fail', ['code' => 0]);
        }
    }

    public function edit_service(Request $request){
        $id = $request->input('id');
        $name = $request->input('name');
        $address = $request->input('address');
        $time = $request->input('time');
        $contact_person = $request->input('contact_person');
        $qty = $request->input('qty');
        $created_at = date('Y-m-d H:i:s', strtotime('now'));


        $affected = DB::table('service')->where('id', $id)->update(
                                                ['name' => $name,
                                                 'address' => $address,
                                                 'time' => $time,
                                                 'contact_person' => $contact_person,
                                                 'qty' => $qty,
                                                 'created_at' => $created_at,
                                                ] );

        return redirect()->route('ibadah');
    }

    public function delete_service($id){

        DB::table('service')->where('id', $id)->delete();

        return redirect()->route('ibadah');
    }


    // ADMINS
    public function admins()
    {
        $user = Auth::user();
        $code = $user->code;
        if ($code == null) {
            return view('home');
        } else {
            if ($code == 1) {
                $admins = DB::table('users')->get();

                return view('admins',['data'=>$admins, 'code' => $code]);
            } else {
                $admins = DB::table('users')->where('code', $code)->get();

                return view('admins',['data'=>$admins, 'code' => $code]);
            }
        }


    }

    public function submit_admins(Request $request){
        $name = $request->input('name');
        $email = $request->input('email');
        $code = $request->input('code');
        $created_at = date('Y-m-d H:i:s', strtotime('now'));


        $id = DB::table('admins')->insertGetId(
                                                ['name' => $name,
                                                 'email' => $email,
                                                 'code' => $code,
                                                 'created_at' => $created_at,
                                                ] );

        if ($id) {
            return redirect()->route('admins');
        } else {
            // GENERIC ERROR MESSAGE
            return view('fail', ['code' => 0]);
        }
    }

    public function edit_admins(Request $request){
        $id = $request->input('id');
        $name = $request->input('name');
        $email = $request->input('address');
        $code = $request->input('time');
        $created_at = date('Y-m-d H:i:s', strtotime('now'));


        $affected = DB::table('service')->where('id', $id)->update(
                                                ['name' => $name,
                                                 'email' => $email,
                                                 'code' => $code,
                                                 'created_at' => $created_at,
                                                ] );

        return redirect()->route('admins');
    }

    public function delete_admins($id){

        DB::table('users')->where('id', $id)->delete();

        return redirect()->route('admins');
    }
}
