@extends('dashboard.layouts.layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Berita</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="judul_berita">Judul Berita</label>
                    <input type="text" name="judul_berita" id="judul_berita"
                        class="form-control @error('judul_berita') is-invalid @enderror" value="{{ old('judul_berita') }}"
                        required>
                    @error('judul_berita')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="slug_berita">Slug Berita</label>
                    <input type="text" name="slug_berita" id="slug_berita"
                        class="form-control @error('slug_berita') is-invalid @enderror" value="{{ old('slug_berita') }}"
                        required>
                    @error('slug_berita')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="konten_berita">Konten Berita</label>
                    <textarea name="konten_berita" id="konten_berita" cols="30" rows="10"
                        class="form-control @error('konten_berita') is-invalid @enderror">{{ old('konten_berita') }}</textarea>
                    @error('konten_berita')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="gambar_berita">Gambar Berita</label>
                    <input type="file" name="gambar_berita" id="gambar_berita" accept="image/*"
                        class="form-control @error('gambar_berita') is-invalid @enderror"
                        value="{{ old('gambar_berita') }}">
                    @error('gambar_berita')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="status_berita">Status Berita</label>
                    <select name="status_berita" id="status_berita"
                        class="form-control @error('status_berita') is-invalid @enderror" required>
                        <option value="">Pilih Status Berita</option>
                        <option value="draft" {{ old('status_berita') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status_berita') == 'published' ? 'selected' : '' }}>Published
                        </option>
                    </select>
                    @error('status_berita')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                {{-- <div class="form-group">
                    <label for="published_at_berita">Published At Berita</label>
                    <input type="datetime-local" name="published_at_berita" id="published_at_berita"
                        class="form-control @error('published_at_berita') is-invalid @enderror"
                        value="{{ old('published_at_berita') }}" required>
                    @error('published_at_berita')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}
                <button type="submit" class="btn btn-primary">Create</button>
            </form>

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



            const gambarBerita = document.getElementById('gambar_berita');
            const preview = document.getElementById('preview');

            gambarBerita.addEventListener('change', function() {
                const file = gambarBerita.files[0];
                const reader = new FileReader();

                reader.onloadend = function() {
                    preview.src = reader.result;
                }

                if (file) {
                    reader.readAsDataURL(file);
                } else {
                    preview.src = "";
                }
            });
        </script>
    @endpush
