@extends('landing.master')
@section('content')
    <section id="item" style="background-color: rgb(255, 255, 255);" class="item my-3 " data-filter="item">
        <div class="container py-5 d-flex align-items-center justify-content-center">
            <div class="card" style="width: 50%;">
                <img src="{{ asset('/storage/' . $campaign->foto_campaign) }}" class="card-img-top" alt="..."
                    style="height: 250px; object-fit:cover">
                <div class="card-body">
                    <h4>{{ $campaign->judul_campaign }}</h4>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" value="{{ $transaksi->nama }}" name="nama" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Jumlah Donasi (IDR)</label>
                        <input type="number" class="form-control" value="{{ $transaksi->nominal_transaksi }}"
                            id="amount" name="nominal" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Pesan / Do'a</label>
                        <input type="text" class="form-control" value="{{ $transaksi->keterangan }}" id="message"
                            name="pesan" disabled>
                    </div>
                    <div class="row p-2"><a href="#" id="pay-button" class="btn"
                            style="background-color: #435ebe; color: #fff">Bayar Sekarang</a></div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.server_key') }}">
    </script>
    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    window.location.href = '/campaign/{{ $campaign->slug_campaign }}';
                    alert("payment success!");
                    console.log(result);
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    alert("wating your payment!");
                    console.log(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            })
        });
    </script>
@endsection
