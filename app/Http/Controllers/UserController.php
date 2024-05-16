<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Status;
use App\Models\Dept;
use App\Models\Job;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $statuses = Status::all();
        $depts = Dept::all();
        $jobs = Job::all();
        $grades = Grade::all();
        $title = 'Users';
        return view('user.index', compact('title', 'users', 'statuses', 'depts', 'jobs', 'grades'));
    }

    // public function checkEmpCode(Request $request)
    // {
    //     $nik = $request->input('nik');
    //     $user = User::where('nik', $nik)->get();
    //     if ($user->count() > 0) {
    //         echo json_encode(FALSE);
    //     } else {
    //         echo json_encode(TRUE);
    //     }
    // }

    public function checkEmail(Request $request)
    {
        $email = $request->input('email');

        // Lakukan validasi sesuai kebutuhan Anda
        $isUnique = !User::where('email', $email)->exists();

        return response()->json(['valid' => $isUnique]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Ambil tahun dari 'start'
        $startYear = Carbon::parse($request->start)->year;

        // Ambil digit dari tahun 'start'
        $firstOneDigitsOfYear = substr($startYear, 0, 1); //1 digit awal
        $lastTwoDigitsOfYear = substr($startYear, -2); //2 digit akhir

        $yearCode = $firstOneDigitsOfYear . $lastTwoDigitsOfYear; //gabung digit jadi kode

        // mendapatkan nik terakhir sesuai kode tahun
        $nikUser = User::where('nik', 'like', $yearCode . '%')->latest()->first();
        if ($nikUser != null) { //jika nik User didapat
            /**
             * substr mengambil 3 digit akhir nik, kemudian ditambah 1
             * misal 001 maka ditambah 1 akan menjadi 002
             */
            $nikLast = substr($nikUser->nik, -3) + 1;
            //agar nilai 0 diawal tetap bertahan tidak hilang
            $nikCode = str_pad($nikLast, 3, '0', STR_PAD_LEFT);
        } else {
            $nikCode = '001'; //jika tidak ada maka akan dimuali dari 001
        }

        // gabungkan mejadi nomor kepegawaian yang unik
        $EmpCode = $yearCode . '-' . $nikCode;

        User::create([
            'nik' => $EmpCode,
            'name' => $request->name,
            'id_status' => $request->id_status,
            'id_dept' => $request->id_dept,
            'id_job' => $request->id_job,
            'id_grade' => $request->id_grade,
            'sex' => $request->sex,
            'ttl' => $request->ttl,
            'start' => $request->start,
            'pendidikan' => $request->education,
            'agama' => $request->religion,
            'domisili' => $request->domisili,
            'email' => $request->email,
            'no_ktp' => $request->no_ktp,
            'no_telpon' => $request->no_telpon,
            'status_pernikahan' => $request->status_pernikahan,
            'role_app' => $request->role_app,
            'active' => $request->active,
            'password' => Hash::make($request->email),
        ]);

        return redirect()->route('user.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
