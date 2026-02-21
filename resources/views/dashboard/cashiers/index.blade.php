@extends('layouts.dashboard')

@section('title', 'Data Kasir | UD Jaya Mebel')
@section('page-title', 'Data Kasir')

@section('content')
    <div class="glass-panel p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h2 class="h5 fw-bold mb-0">Daftar Kasir</h2>
                <p class="text-muted mb-0" style="font-size:.8rem">{{ $cashiers->total() }} akun kasir terdaftar</p>
            </div>
            <a href="{{ route('dashboard.cashiers.create') }}" class="btn btn-primary-custom">
                <i class="bi bi-plus-lg"></i> Tambah Kasir
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-custom table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width:40px">#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Bergabung</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cashiers as $index => $cashier)
                        <tr>
                            <td class="text-muted">{{ $cashiers->firstItem() + $index }}</td>
                            <td>{{ $cashier->nama }}</td>
                            <td>{{ $cashier->email }}</td>
                            <td class="text-muted">{{ $cashier->created_at->format('d M Y') }}</td>
                            <td class="text-end">
                                <div class="d-flex align-items-center justify-content-end gap-2">
                                    <a href="{{ route('dashboard.cashiers.edit', $cashier) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('dashboard.cashiers.destroy', $cashier) }}" method="POST" onsubmit="return confirm('Hapus kasir {{ $cashier->nama }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="bi bi-people d-block mb-2" style="font-size:2rem;color:var(--text-muted)"></i>
                                <span class="text-muted">Belum ada akun kasir.</span>
                                <div class="mt-3">
                                    <a href="{{ route('dashboard.cashiers.create') }}" class="btn-accent text-decoration-none">Tambah Kasir Pertama</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($cashiers->hasPages())
            <div class="mt-3 px-2">{{ $cashiers->links() }}</div>
        @endif
    </div>
@endsection
