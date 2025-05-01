<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function create()
    {
        return view('kasir.transaksi.create2'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'idmember' => 'required|unique:members',
            'nama' => 'required',
            'nomor_telepon' => 'required',
        ]);

        Member::create([
            'idmember' => $request->idmember,
            'nama' => $request->nama,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat' => $request-> alamat,
        ]);

        return redirect()->route('member.create')->with('success', 'Member added successfully.');
    }
}
