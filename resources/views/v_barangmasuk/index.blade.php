@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('barangmasuk.create') }}" class="btn btn-md btn-success">TAMBAH BARANG MASUK</a>
                        
                        @if(session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger mt-3">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="sort-buttons text-right mt-3 mb-3">
                    <!-- Tambahkan kode dropdown untuk sorting -->
                </div>

            <form action="{{ route('barangmasuk.index') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Cari barang..." value="{{ request()->input('search') }}">
                    <input type="date" name="tgl_masuk" class="form-control" value="{{ request()->input('tgl_masuk') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                    @if(request()->filled('search') || request()->filled('tgl_masuk'))
                        <div class="input-group-append">
                            <a href="{{ route('barangmasuk.index') }}" class="btn btn-danger"><i class="fa fa-times"></i></a>
                        </div>
                    @endif
                </div>
            </form>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 5%">ID</th>
                            <th>TANGGAL MASUK</th>
                            <th>JUMLAH MASUK</th>
                            <th>STOK SAAT INI</th>
                            <th>MERK</th>
                            <th style="width: 15%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($barangmasuk as $bm)
                            <tr>
                                <td>{{ $bm->id }}</td>
                                <td>{{ $bm->tgl_masuk }}</td>
                                <td>{{ $bm->qty_masuk }}</td>
                                <td>{{ $bm->barang->stok }}</td>
                                <td>{{ $bm->barang->merk }}</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('barangmasuk.destroy', $bm->id) }}" method="POST">
                                        <a href="{{ route('barangmasuk.show', $bm->id) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('barangmasuk.edit', $bm->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Data Barang Masuk belum tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="pagination">
                    {{ $barangmasuk->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
