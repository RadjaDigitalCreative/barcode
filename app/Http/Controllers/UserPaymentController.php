<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\EloquentDataTable;
use Carbon\Carbon;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserPaymentController extends Controller
{
    public function index(Request $request)
    {
        $company = DB::table('companies')->get();
        $count_payment = DB::table('users')
            ->join('profils', 'users.id', '=', 'profils.user_id')
            ->join('payments', 'users.id', '=', 'payments.user_id')
            ->select(DB::raw('SUM(payments.total_payment) as countTotal'))
            ->first();

        if ($request->ajax()) {
            $data = DB::table('users')
                ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
                ->join('roles', 'user_roles.role_id', '=', 'roles.id')
                ->join('profils', 'users.id', '=', 'profils.user_id')
                ->leftJoin('payments', 'users.id', '=', 'payments.user_id')
                ->selectRaw('*,users.id as user_id, datediff(payments.lease_limit, now())as "date"')
                ->where('users.company_id', Auth::user()->company_id)
                ->get();
            $current_date = Carbon::now();
            return DataTables::of($data)
                ->addColumn('masa_pemakaian', function ($data) use ($current_date) {
                    if (!empty($data->status_payment)) {
                        if ($data->lease_limit == $current_date || $data->lease_limit <= $current_date) {
                            $masa_pemakaian = '<p>Telah Berakhir</>';
                            return $masa_pemakaian;
                        } elseif($data->status_payment == 'Menunggu Konfirmasi'){
                            $masa_pemakaian = '<button type="button" class="btn btn-warning"> Menunggu Konfirmasi </button>';
                            return $masa_pemakaian;
                        } else{
                            $masa_pemakaian = '<button type="button" class="btn btn-success"> ' . $data->max_created . ' Creted Barcode & QR  </button>';
                            return $masa_pemakaian;
                        }
                    } else {
                        $masa_pemakaian = '<p>Belum Melakukan Pembayaran</>';
                        return $masa_pemakaian;
                    }
                })
                ->addColumn('status', function ($data) {
                    if (!empty($data->payment_date)) {
                        if ($data->status_payment == 'Menunggu Konfirmasi') {
                            $button = '<a href="#" class="btn btn-warning">Menunggu Konfirmasi</a>';
                            return $button;
                        } elseif($data->status_payment == 'Sudah Terlunasi'){
                            $button = '<a href="https://api.whatsapp.com/send/?phone=' . $data->phone_number . '&text&app_absent=0" target="_blank" class="btn btn-warning btn-block">Phone</a>';
                            $button .= '<a href="/user-payment/' . $data->user_id . '/edit" class="btn btn-primary btn-block">Edit</a>';
                            $button .= '<a href="/user-payment/delete/' . $data->user_id . '" id="' . $data->user_id . '" class="btn btn-danger btn-block">Delete</a>';
                            return $button;
                        }
                    } else {
                        $button = '<a href="/user-payment/transfer/' . $data->user_id . '"class="btn btn-danger">Bayar Sekarang</a>';
                        return $button;
                    }
                })
                ->rawColumns(['status', 'masa_pemakaian', 'total_bayar'])
                ->make(true);
        }
        return view('user_payment.index', [
            'count_payment' => $count_payment,
            'company' => $company
        ]);
    }

    public function create(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'company_id' => $request->company_id,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
        ]);
        DB::table('user_roles')
            ->insert([
                'user_id' => $user->id,
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        DB::table('profils')
            ->insert([
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        return redirect()->route('user-payment.index')->with('success', 'User Added');

    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $role = DB::table('roles')->get();
        $user_data = DB::table('users')
            ->join('profils', 'profils.user_id', 'users.id')
            ->where('users.id', $id)
            ->selectRaw('users.id, users.name, users.email, users.password, profils.lokasi')
            ->first();
        return view('user_payment.edit', [
            'roles' => $role,
            'user' => $user_data
        ]);
    }


    public function update(Request $request, $id)
    {
        // dd($request->all());
        $dataValidation = $request->validate([
            'user_name' => 'required',
            'email' => 'email|required',
            'jabatan' => 'required'
        ]);

        $updateData = DB::table('users')
            ->where('id', $id)
            ->update([
                'name' => $request->get('user_name'),
                'email' => $request->get('email')
            ]);

        $updateRole = DB::table('user_roles')
            ->where('user_id', $id)
            ->update([
                'role_id' => $request->get('jabatan')
            ]);

        return redirect()->route('user-payment.index')->with('success', 'Berhasi Memperbarui Data User');
    }


    public function destroy($id)
    {
        //
    }

    public function delete($id)
    {
        $deletUser = DB::table('users')
            ->where('id', $id)
            ->delete();

        return redirect()->route('user-payment.index')->with('success', 'Berhasil Menghapus Data');
    }

    public function transfer_proses($id)
    {
        $user_data = DB::table('users')
            ->where('id', $id)
            ->first();

        $payment = DB::table('subscription_prices')
            ->where('user_id', Auth::id())
            ->get();
        $date = Carbon::now();

        return view('user_payment.transfer.index', [
            'user_data' => $user_data,
            'payment' => $payment,
            'date' => $date
        ]);
    }

    public function transfer_store(Request $request, $id)
    {
        $validateData = $request->validate([
            'paket' => 'required',
            'proof' => 'required|required|file|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $check_subscription = DB::table('payments')
            ->where('user_id', $id)
            ->first();


        $subscription_prices = DB::table('subscription_prices')
            ->where('id', $request->get('paket'))
            ->first();

        $file = $request->file('proof');
        $file_name = time() . '_' . $file->getClientOriginalName();
        $tujuan_upload = 'bukti_transfer';
        $file->move($tujuan_upload, $file);

        $payment_date = Carbon::now();
        $lease_limit = Carbon::now()->addMonthsNoOverflow($subscription_prices->month);

        if (empty($check_subscription)) {
            DB::table('payments')->insert([
                'payment_date' => $payment_date,
                'total_payment' => $subscription_prices->price,
                'lease_limit' => $lease_limit,
                'max_created' => $subscription_prices->month,
                'user_id' => $id,
                'status_payment' => 'Menunggu Konfirmasi',
                'proof' => $file_name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        } else {
            DB::table('payments')
                ->where('id', $check_subscription->id)
                ->update([
                    'payment_date' => $payment_date,
                    'total_payment' => $subscription_prices->price,
                    'lease_limit' => $lease_limit,
                    'max_created' => $subscription_prices->month,
                    'user_id' => $id,
                    'status_payment' => 'Menunggu Konfirmasi',
                    'proof' => $file_name,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
        }

        return redirect()->route('user-payment.index')->with('success', 'Berhasil Melakukan Pembayaran');
    }
}
