@extends('dashboard.layouts.layout')
@section('content')
    <div class="container my-5">
        <div class="card shadow-lg border-0">
            <div class="card-body">
                <h3 class="mb-4">Edit Berita</h3>

                <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Judul --}}
                    <div class="form-group mb-3">
                        <label for="judul_berita">Judul Berita</label>
                        <input type="text" name="judul_berita" id="judul_berita"
                            class="form-control @error('judul_berita') is-invalid @enderror"
                            value="{{ old('judul_berita', $berita->judul_berita) }}" required>
                        @error('judul_berita')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Slug --}}
                    <div class="form-group mb-3">
                        <label for="slug_berita">Slug Berita</label>
                        <input type="text" name="slug_berita" id="slug_berita"
                            class="form-control @error('slug_berita') is-invalid @enderror"
                            value="{{ old('slug_berita', $berita->slug_berita) }}" required>
                        @error('slug_berita')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Konten --}}
                    <div class="form-group mb-3">
                        <label for="konten_berita">Konten Berita</label>
                        <textarea name="konten_berita" id="konten_berita" cols="30" rows="10"
                            class="form-control @error('konten_berita') is-invalid @enderror">{{ old('konten_berita', $berita->konten_berita) }}</textarea>
                        @error('konten_berita')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Gambar --}}
                    <div class="form-group mb-3">
                        <label for="gambar_berita">Gambar Berita</label>
                        @if ($berita->gambar_berita)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $berita->gambar_berita) }}" alt="Current Image"
                                    class="img-thumbnail" width="200">
                            </div>
                        @endif
                        <input type="file" name="gambar_berita" id="gambar_berita"
                            class="form-control @error('gambar_berita') is-invalid @enderror">
                        @error('gambar_berita')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="form-group mb-3">
                        <label for="status_berita">Status</label>
                        <select name="status_berita" id="status_berita"
                            class="form-control @error('status_berita') is-invalid @enderror" required>
                            <option value="draft"
                                {{ old('status_berita', $berita->status_berita) == 'draft' ? 'selected' : '' }}>Draft
                            </option>
                            <option value="published"
                                {{ old('status_berita', $berita->status_berita) == 'published' ? 'selected' : '' }}>
                                Published</option>
                        </select>
                        @error('status_berita')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tanggal Publish --}}
                    <div class="form-group mb-3">
                        <label for="published_at">Tanggal Publish</label>
                        <input type="datetime-local" name="published_at" id="published_at"
                            class="form-control @error('published_at') is-invalid @enderror"
                            value="{{ old('published_at', $berita->published_at ? $berita->published_at->format('Y-m-d TH:i') : '') }}">
                        @error('published_at')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('berita.show', $berita->id) }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Update Berita</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        ClassicEditor
            .create(document.querySelector('#konten_berita'), {
                toolbar: [
                    'heading', '|',
                    'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
                    'blockQuote', 'insertTable', 'undo', 'redo', '|',
                    'imageUpload'
                ],
            })
            .then(editor => {
                editor.editing.view.change(writer => {
                    writer.setStyle('height', '300px', editor.editing.view.document.getRoot());
                });
                console.log('Editor initialized', editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
