@extends('layouts.dashboard')

@section('title', 'Data Kasir | UD Jaya Mebel')
@section('page-title', 'Data Kasir')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h5 fw-bold mb-1">Daftar Kasir</h1>
            <p class="text-muted mb-0" style="font-size:.85rem">{{ $cashiers->total() }} akun kasir terdaftar</p>
        </div>
        <a href="{{ route('admin.cashiers.create') }}" class="btn-accent d-flex align-items-center gap-2 text-decoration-none">
            <i class="bi bi-plus-lg"></i> Tambah Kasir
        </a>
    </div>

    <div class="section-card">
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
                            <td class="text-muted" style="font-size:.8rem">{{ $cashiers->firstItem() + $index }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width:36px;height:36px;border-radius:50%;background:var(--accent-soft);display:flex;align-items:center;justify-content:center;font-weight:700;color:var(--accent);font-size:.8rem;flex-shrink:0">
                                        {{ strtoupper(substr($cashier->nama, 0, 1)) }}
                                    </div>
                                    <span>{{ $cashier->nama }}</span>
                                </div>
                            </td>
                            <td class="text-muted" style="font-size:.875rem">{{ $cashier->email }}</td>
                            <td class="text-muted" style="font-size:.8rem">{{ $cashier->created_at->format('d M Y') }}</td>
                            <td class="text-end">
                                <div class="d-flex align-items-center justify-content-end gap-2">
                                    <a href="{{ route('admin.cashiers.edit', $cashier) }}"
                                       class="btn-outline-custom d-inline-flex align-items-center gap-1"
                                       style="font-size:.8rem;padding:.3rem .75rem">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.cashiers.destroy', $cashier) }}" method="POST"
                                          onsubmit="return confirm('Hapus kasir {{ $cashier->nama }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius:8px;font-size:.8rem">
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
                                    <a href="{{ route('admin.cashiers.create') }}" class="btn-accent text-decoration-none">Tambah Kasir Pertama</a>
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