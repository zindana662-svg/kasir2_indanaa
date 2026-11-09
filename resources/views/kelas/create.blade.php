```php
@extends('adminlte::page')

@section('title', 'Tambah Kelas')

@section('content_header')
    <h1>Tambah Kelas</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
             <form action="{{ route('kelas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf 

                <div class="form-group">
                    <label for="nama_kelas">Nama Kelas</label>
                    <input type="text" name="nama_kelas" class="form-control @error('nama_kelas') is-invalid @enderror" id="nama_kelas" required value="{{ old('nama_kelas') }}">
                    @error('nama_kelas')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jenjang_id">Jenjang Id</label>
                    <select name="jenjang_id" class="form-control @error('jenjang_id') is-invalid @enderror" id="jenjang_id">
                        <option value="">Pilih Jenjang</option>
                        @foreach ($jenjang as $item)
                            <option value="{{ $item->id }}" {{ old('jenjang_id') == $item->id ? 'selected' : '' }}>{{ $item->nama_jenjang }}</option>
                        @endforeach
                    </select>
                    
                    @error('jenjang_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jurusan_id">Jurusan Id</label>
                    <select name="jurusan_id" class="form-control @error('jurusan_id') is-invalid @enderror" id="jurusan_id">
                        <option value="">Pilih Jurusan</option>
                        @foreach ($jurusan as $item)
                            <option value="{{ $item->id }}" {{ old('jurusan_id') == $item->id ? 'selected' : '' }}>{{ $item->nama_jurusan }}</option>
                        @endforeach
                    </select>
                    @error('jurusan_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                        <option value="">Pilih Status</option>
                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>aktif</option>
                        <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif </option>
                    </select>
                    @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@stop
```