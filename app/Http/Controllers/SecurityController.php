<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Security;

class SecurityController extends Controller
{
    public function index()
    {
        return view('security');
    }

    public function store(Request $request)
    {
        Security::create([
            'username' => $request->username,
            'pin' => $request->pin,
            'security_question' => $request->security_question,
            'security_answer' => $request->security_answer
        ]);

        return back()->with(
            'success',
            'Data Security berhasil disimpan'
        );
    }
}