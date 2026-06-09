<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function index()
    {
        return "Halaman Daftar Transfer";
    }

    public function create()
    {
        return "Halaman Form Transfer";
    }

    public function store(Request $request)
    {
        return "Transfer berhasil disimpan";
    }

    public function show(string $id)
    {
        return "Detail Transfer ID: " . $id;
    }

    public function edit(string $id)
    {
        return "Edit Transfer ID: " . $id;
    }

    public function update(Request $request, string $id)
    {
        return "Transfer berhasil diupdate";
    }

    public function destroy(string $id)
    {
        return "Transfer berhasil dihapus";
    }
}