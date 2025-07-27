@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header">Detail Donatur</div>
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $donatur->name }}</p>
            <p><strong>Email:</strong> {{ $donatur->email }}</p>
            <p><strong>No Telepon:</strong> {{ $donatur->phone_number }}</p>
            <a href="/admin/donatur" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
@endsection
