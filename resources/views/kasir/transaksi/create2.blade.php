@extends('layout.layout')
@section('content')

    @php
        $title = 'Add Member';
    @endphp

    <div class="container-fluid">
        <h1 class="mb-4">{{ $title }}</h1>
        
        @if (session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-lg-6 mx-auto">
                <form action="{{ url('/transaksi/create2') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="idmember">ID Member</label>
                        <input type="text" name="idmember" class="form-control" id="idmember" required>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" required>
                    </div>

                    <div class="form-group">
                        <label for="nomor_telepon">Nomor Telepon</label>
                        <input type="text" name="nomor_telepon" class="form-control" id="nomor_telepon" required>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" name="alamat" class="form-control" id="alamat" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3 w-100">Add Member</button>
                </form>
            </div>
        </div>
    </div>

@endsection
