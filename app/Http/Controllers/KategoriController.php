<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View; // Import the correct View class

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        // Get all categories using the getKategoriAll method
        $rsetkategori = Kategori::select('kategori.id', 'deskripsi', 'kategori', DB::raw('ketKategori(kategori.kategori) as ketKategori'))
                            ->latest()
                            ->paginate(10);
        
        // Render view with categories
        return view('v_kategori.index', compact('rsetkategori'));
    }
    

    

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('v_kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required',
            'kategori' => 'required',
        ]);

        // Create category
        Kategori::create([
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori
        ]);

        // Redirect to index
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) : View
    {
        $rsetkategori = Kategori::findOrFail($id);
        

        // Return view
        return view('v_kategori.show', compact('rsetkategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) : View
    {
        $rsetkategori = Kategori::findOrFail($id);
        return view('v_kategori.edit', compact('rsetkategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kategori' => 'required',
            'deskripsi' => 'required'
        ]);

        $rsetkategori = Kategori::findOrFail($id);

        // Update category
        $rsetkategori->update([
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi
        ]);

        // Redirect to index
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (DB::table('barang')->where('kategori_id', $id)->exists()) {
            return redirect()->route('kategori.index')->with(['gagal' => 'Data Gagal Dihapus!']);
        } else {
            $rsetKategori = Kategori::findOrFail($id);
            $rsetKategori->delete();
            return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }
    }
}
