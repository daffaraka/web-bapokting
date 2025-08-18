@extends('dashboard.layouts.layout')
@section('content')
    <div class="container">
        {{-- Judul Berita --}}
        <div class="container my-5">
            <div class="card shadow-lg border-0">
                <div class="card-body">

                    {{-- Slug Berita --}}
                    <p class="text-muted fst-italic mb-2">
                        <i class="bi bi-link-45deg"></i> Slug: {{ $berita->slug_berita }}
                    </p>

                    {{-- Status Berita --}}
                    <p class="mb-3">
                        <strong>Status:</strong>
                        <span
                            class="{{ $berita->status_berita == 'published' ? 'text-success fw-bold' : 'text-danger fw-bold' }}">
                            {{ ucfirst($berita->status_berita) }}
                        </span>
                    </p>

                    {{-- Gambar Berita --}}
                    @if ($berita->gambar_berita)
                        <div class="mb-4 text-center">
                            <img src="{{ asset('storage/' . $berita->gambar_berita) }}" alt="{{ $berita->judul_berita }}"
                                class="img-fluid rounded shadow-sm">
                        </div>
                    @endif

                    {{-- Konten Berita --}}
                    <div class="p-4 rounded bg-light border">
                        <h2 class="mb-3">{{ $berita->judul_berita }}</h2>
                        <div class="prose">
                            {!! $berita->konten_berita !!}
                        </div>
                    </div>

                    {{-- Informasi User --}}
                    <div class="mt-4 p-3 bg-secondary-subtle rounded">
                        <p class="mb-0 text-muted small">
                            ✍️ Ditulis oleh: <strong>{{ $berita->user->name ?? 'Tidak diketahui' }}</strong><br>
                            📅 Dipublikasikan pada: {{ $berita->created_at->format('d M Y H:i') }}
                        </p>
                    </div>

                    <div class="d-flex mt-3">
                        <a href="{{route('berita.index')}}" class="btn btn-info">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    @endsection
