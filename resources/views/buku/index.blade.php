@extends('templates.app')
@section('title', 'Data Buku')

@section('content')
<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>Data Buku</h2>
    </div>
    <div class="card-body">
        <x-alert />
        @if(auth()->user()->role === 'admin')
        <a href="{{ route('buku.create') }}" class="btn btn-primary btn-sm font-weigth-bold mb-3"
            title="tambah kategori">+ Buku</a>
        @endif
        <table class="table table-bordered table-hover">
            <thead class="text-center">
                <tr>
                    <th>No</th>
                    <th>Pinjam</th>
                    <th>Kategori buku</th>
                    <th>Judul buku</th>
                    <th>Keterangan</th>
                    <th>Penulis</th>
                    <th>Stok</th>
                    @if(auth()->user()->role === 'admin')
                    <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($data_buku as $buku)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}.</td>
                    <td><a href="{{ route('pinjam.store', $buku->id) }}" class="btn btn-outline-primary btn-sm">Pinjam
                            Buku</a></td>
                    <td>{{ $buku->kategori->nama }}</td>
                    <td>{{ $buku->judul }}</td>
                    <td>
                        @if(auth()->user()->role === 'admin')

                        @if($buku->status === 1)
                        <a href="{{ route('buku.status', $buku->id) }}" class="badge badge-success"
                            title="nonaktifkan">Aktif</a>
                        @else
                        <a href="{{ route('buku.status', $buku->id) }}" class="badge badge-danger"
                            title="aktifkan">Tidak Aktif</a>
                        @endif

                        @else

                        @if($buku->status === 1)
                        <span class="badge badge-success" title="nonaktifkan">Aktif</span>
                        @else
                        <span class="badge badge-danger" title="aktifkan">Tidak Aktif</span>
                        @endif

                        @endif
                    </td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ $buku->stok }}</td>

                    @if(auth()->user()->role === 'admin')
                    <td>
                        <form action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-success btn-sm"
                                title="ubah buku">
                                <span class="mdi mdi-square-edit-outline"></span>
                            </a>
                            <button type="submit" onclick="return confirm('Yakin Hapus?')" class="btn btn-danger btn-sm"
                                title="hapus buku">
                                <span class="mdi mdi-trash-can-outline"></span>
                            </button>
                        </form>
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak Ada data buku</td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>
@endsection
