<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::role('vendor')
        ->select('users.id', 'users.name', 'users.email', 'users.status')
        ->with(['vendor' => function($query) {
            $query->select(
                'vendor.user_id',
                'vendor.nama_company',
                'vendor.nama_pemilik',
                'vendor.alamat',
                'vendor.image_users',
                'vendor.rekening',
            );
        }])
        ->orderBy('users.status', 'asc')
        ->get();
        return view('admin.users-index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'nama_perusahaan' => 'required|min:3|max:255',
            'nama_pemilik' => 'required|min:3|max:255',
            'alamat' => 'required|min:3|max:255',
            'rekening' => 'required|min:3|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user =new User();
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->status = true;
        $user->save();

        $user->assignRole('vendor');

        $foto = $request->file('foto');
        $nama_foto = time() . '_' . $user->id . '.' . $foto->getClientOriginalExtension();
        $path = $foto->storeAs('vendor_photos', $nama_foto, 'public');

        $vendor = new Vendor();
        $vendor->user_id = $user->id;
        $vendor->nama_company = $request->nama_perusahaan;
        $vendor->nama_pemilik = $request->nama_pemilik;
        $vendor->alamat = $request->alamat;
        $vendor->image_users = $path;
        $vendor->rekening = $request->rekening;
        $vendor->save();



        return redirect()->route('admin.users-index')->with('success', 'Vendor berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::role('vendor')->where('users.id', $id)
        ->select('users.id', 'users.name', 'users.email', 'users.password', 'users.status')
        ->with(['vendor' => function($query) {
            $query->select(
                'vendor.user_id',
                'vendor.nama_company',
                'vendor.nama_pemilik',
                'vendor.alamat',
                'vendor.image_users',
                'vendor.rekening',
            );
        }])
        ->first();
        return view('admin.users-edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8',
            'nama_perusahaan' => 'required|min:3|max:255',
            'nama_pemilik' => 'required|min:3|max:255',
            'alamat' => 'required|min:3|max:255',
            'rekening' => 'required|min:3|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = User::find($id);
        $user->name = $request->nama;
        $user->email = $request->email;
        if ($request->password != null) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        $vendor = Vendor::where('user_id', $id)->first();
        $vendor->nama_company = $request->nama_perusahaan;
        $vendor->nama_pemilik = $request->nama_pemilik;
        $vendor->alamat = $request->alamat;
        if ($request->foto != null) {
            if ($vendor->image_users && Storage::exists($vendor->image_users)) {
                Storage::delete($vendor->image_users);
            }

            $foto = $request->file('foto');
            $nama_foto = time() . '_' . $user->id . '.' . $foto->getClientOriginalExtension();
            $path = $foto->storeAs('public/vendor_photos', $nama_foto);
            $vendor->image_users = $path;
        }
        $vendor->rekening = $request->rekening;
        $vendor->save();

        return redirect()->route('admin.users-index')->with('success', 'Vendor berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function nonActive(string $id)
    {
        $user = User::find($id);
        $user->status = false;
        $user->save();
        return redirect()->route('admin.users-index')->with('success', 'Vendor berhasil dinonaktifkan.');
    }

    public function activate(string $id)
    {
        $user = User::find($id);
        $user->status = true;
        $user->save();
        return redirect()->route('admin.users-index')->with('success', 'Vendor berhasil dinonaktifkan.');
    }
}
