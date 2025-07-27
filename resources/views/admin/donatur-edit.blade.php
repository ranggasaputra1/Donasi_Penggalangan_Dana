@extends('layouts.master')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Donatur</h3>
                </div>
            </div>
        </div>

        <!-- Basic Vertical form layout section start -->
        <section id="basic-vertical-layouts">
            <div class="row match-height">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Donatur</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                @if (count($errors) > 0)
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger alert-dismissible show fade" role="alert">
                                            {{ $error }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endforeach
                                @endif
                                <form class="form form-vertical" method="POST" action="/admin/donatur/update">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $donatur->id }}" />
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input type="text" class="form-control" name="name"
                                                        placeholder="Nama Donatur"
                                                        value="{{ old('name', $donatur->name) }}" />
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control" name="email"
                                                        placeholder="Email Donatur"
                                                        value="{{ old('email', $donatur->email) }}" />
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>No Telepon</label>
                                                    <input type="text" class="form-control" name="phone_number"
                                                        placeholder="Nomor Telepon"
                                                        value="{{ old('phone_number', $donatur->phone_number) }}" />
                                                </div>
                                            </div>

                                            <div class="col-12 d-flex justify-content-end mt-3">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">
                                                    Simpan Perubahan
                                                </button>
                                                <a href="/admin/donatur" class="btn btn-secondary me-1 mb-1">
                                                    Batal
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- // Basic Vertical form layout section end -->
    </div>
@endsection

@section('script')
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="/assets/extensions/parsleyjs/parsley.min.js"></script>
    <script src="/assets/js/pages/parsley.js"></script>
@endsection
