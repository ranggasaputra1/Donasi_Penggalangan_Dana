@extends('landing.master')
@section('style')
    <link rel="stylesheet" href="/css/splide.min.css">
@endsection
@section('content')
    <section id="item" style="background-color: rgb(255, 255, 255);" class="item my-3 " data-filter="item">
        <div class="container p-4">
            <h3 style="font-weight:bold; color: #435ebe;">Selamat Datang !</h3>
            <a href="#" data-bs-toggle="modal" data-bs-target="#createcampaign" style="text-decoration: none;">
                <div class="hvr-grow shadow mt-3 d-flex align-items-center"
                    style="height: 250px; border-radius:25px; background-image: linear-gradient(to right, #435ebe, rgba(231, 231, 231, 0.5)), url('https://images.unsplash.com/photo-1516570161787-2fd917215a3d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80'); background-size: cover;">
                    <div class="p-4" style="max-width:80%">
                        <h1 style="font-weight: inherit; color:#ffffff; font-size:35px;">Galang Dana Sekarang</h1>
                    </div>
                </div>
            </a>
        </div>

        <!-- modal -->
        <div class="modal fade" id="createcampaign" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                @auth
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tatacara Galang Dana</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Temporibus, doloremque aut?
                            Neque aliquam eos sed alias quidem sunt sapiente doloremque,
                            molestiae quasi iusto rerum ut commodi cum ipsam corrupti, illo saepe a nesciunt quod. Beatae
                            dolorem quibusdam voluptates reprehenderit! Est, praesentium!
                            Iusto, dicta. At magnam pariatur, sed accusantium deleniti porro!
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#create"
                                style="background-color: #435ebe; color:#fff">Selanjutnya</button>
                        </div>
                    </div>
                @else
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Anda Perlu Login</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <a class="btn" style="border-radius: 50px; background-color:#435ebe; color:#ffffff"
                                href="/login">Login</a>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
        @auth
            <div class="modal fade" id="create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    @if (Auth::user()->role == 2)
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Galang Dana</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="/buat-campaign"enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Email</label>
                                            <input type="text" class="form-control" disabled
                                                value="{{ Auth::user()->email }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Nama</label>
                                            <input disabled type="text" class="form-control"
                                                value="{{ Auth::user()->name }}">
                                            <input name="user_id" type="hidden" class="form-control"
                                                value="{{ Auth::user()->id }}" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label class="form-label">Kategori Campaign</label>
                                        <select name="category_id" class="form-select" aria-label="Default select example">
                                            @foreach ($kategori as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label class="form-label">Judul Campaign</label>
                                        <input name="judul_campaign" type="text" class="form-control" required>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label class="form-label">Deskripsi Campaign</label>
                                        <textarea name="deskripsi_campaign" id="editor" type="text" class="form-control"></textarea>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label class="form-label">Target Dana</label>
                                        <input name="target_campaign" type="number" class="form-control" required>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label class="form-label">Tanggal Akhir Campaign</label>
                                        <input name="tgl_akhir" type="date" min="{{ date('Y-m-d') }}"
                                            class="form-control" required>
                                    </div>
                                    <div class="form-group mt-3">
                                        <strong>Banner Campaign</strong>
                                        <input class="form-control" type="file" name="image" id="formFile" required>
                                    </div>
                                    <div class="text-center mt-3">
                                        <button type="submit" class="btn"
                                            style="background-color: #435ebe; color:#fff; border-radius:50px; width:100%">Kirim</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Verifikasi Akun Anda</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <a class="btn" style="border-radius: 50px; background-color:#435ebe; color:#ffffff"
                                    href="/verifikasi-akun/.{{ Auth::user()->id }}">Verifikasi</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endauth

    </section>

    <section data-filter="item" id="item" style="background-color: rgb(255, 255, 255);" class="item my-3 py-3">
        <div class="container text-center">
            <div class="row p-4" style="font-size:medium">
                <a href="/kategori/pendidikan" class="col hvr-grow"
                    style="background-color: white; border: none; text-decoration:none; color: #000;">
                    <img src="assets/img/education.svg" alt="" style="height: 90px">
                    <div class="d-flex align-items-center justify-content-center">
                        <p style="margin: 0px;">Pendidikan</p>
                    </div>
                </a>
                <a href="/kategori/sosial" class="col hvr-grow"
                    style="background-color: white; border: none; text-decoration:none; color: #000;">
                    <img src="assets/img/social.svg" alt="" style="height: 90px">
                    <div class="d-flex align-items-center justify-content-center">
                        <p style="margin: 0px;">Sosial</p>
                    </div>
                </a>
                <a href="/kategori/kesehatan" value="3" class="col hvr-grow"
                    style="background-color: white; border: none; text-decoration:none; color: #000;">
                    <img src="assets/img/health.svg" alt="" style="height: 90px">
                    <div class="d-flex align-items-center justify-content-center">
                        <p style="margin: 0px;">Kesehatan</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <section data-filter="item" class="item splide my-3" aria-labelledby="carousel-heading" id="item"
        style="background-color: rgb(253, 253, 253);">
        <div class="container item py-4 px-2">
            <div class="col" style="width: 75%;">
                <h5 class="p-3" style="font-weight:bold; color: #435ebe;">Penggalangan Dana Mendesak</h5>
            </div>
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach ($campaign as $item)
                        <a href="/campaign/{{ $item->slug_campaign }}"
                            class="splide__slide d-flex justify-content-center px-2 py-1"
                            style="text-decoration: none; color:black">
                            <div class="card hvr-grow" style="width: 95%;  border-color: #435ebe;">
                                <img src="{{ asset('/storage/' . $item->foto_campaign) }}" class="card-img-top"
                                    alt="..." style="height: 250px; object-fit: cover;">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h5>{{ $item->judul_campaign }}</h5>
                                    </div>
                                    <div class="progress" style="height: 10px;">
                                        <div class="progress-bar" role="progressbar" aria-label="Basic example"
                                            aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                            style="background-color:#435ebe;width:{{ ($item->dana_terkumpul / $item->target_campaign) * 100 }}%">
                                        </div>
                                    </div>
                                    <p class="card-text mt-2">Donasi terkumpul : Rp{{ number_format($item->dana_terkumpul, 2, ',', '.') }}</p>
                                    <p class="card-text">Aktif hingga :
                                        {{ date('d-m-Y', strtotime($item->tgl_akhir_campaign)) }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <section data-filter="item" id="item" style="background-color: rgb(255, 255, 255);" class="item my-3 py-3">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="container p-4">
                <div class="carousel-inner" style="border-radius: 10px;">
                    <div class="carousel-item active">
                        <img src="https://images.unsplash.com/photo-1581059686229-de26e6ae5dc4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1172&q=80"
                            class="d-block w-100" alt="..." style="height: 30vh; object-fit: cover">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Aksi Penyaluran Dana Bantuan Tsunami</h5>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Incidunt, deserunt.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://images.unsplash.com/photo-1475776408506-9a5371e7a068?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1058&q=80"
                            class="d-block w-100" alt="..." style="height: 30vh; object-fit: cover">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Penyaluran Dana Bantuan Korban Erupsi Semeru</h5>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minima, aliquid.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://images.unsplash.com/photo-1544257750-572358f5da22?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1215&q=80"
                            class="d-block w-100" alt="..." style="height: 30vh; object-fit: cover">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Penyaluran Dana Bantuan Korban Terdampak Badai</h5>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolor, molestias!</p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <section data-filter="item" id="item" style="background-color: rgb(255, 255, 255);" class="item my-3 py-3">
        <div class="container p-4">
            <div class="col" style="width: 75%;">
                <h5 class="p-2" style="font-weight:bold; color: #435ebe;">Artikel Terbaru</h5>
            </div>
            <div class="card-group">
                @foreach ($blog as $item)
                    <div class="card" style="border-color: #435ebe;">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="/blog/{{ $item->slug_blog }}"
                                    style="color: #212529; text-decoration: none;">{{ $item->judul_blog }}</a>
                            </h5>
                            <p class="card-text">
                                {!! Str::limit($item->isi_blog, 100) !!}
                            </p>
                            <p class="card-text"><small class="text-muted">Diperbarui
                                    {{ date('d-m-Y', strtotime($item->updated_at)) }}</small></p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-12 text-center mt-5">
                <a href="/blog">
                    <div class="btn me-1 mb-1" style="background-color: #435ebe; color:#fff">
                        Artikel Lainnya</div>
                </a>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor5/36.0.1/ckeditor.min.js"
        integrity="sha512-m1b22NPZjHOJ4PEMtKYmqK7s9UOKOQ2o7e+tTMfPLqGDN1jXUeE0JHSOVkuF3UIWDk/tLvbhv/Qjgb3c8G1k6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var splide = new Splide('.splide', {
            perPage: window.innerWidth <= 480 ? 1 : 3, // menampilkan 1 slide pada tampilan mobile
            rewind: true,
        });

        // tambahkan event listener untuk memeriksa perubahan lebar layar dan menyesuaikan jumlah slide yang ditampilkan
        window.addEventListener('resize', function() {
            splide.options.perPage = window.innerWidth <= 480 ? 1 : 3;
            splide.destroy(false);
            splide.mount();
        });

        splide.mount();
    </script>
    <script>
        //Define an adapter to upload the files
        class MyUploadAdapter {
            constructor(loader) {
                // The file loader instance to use during the upload. It sounds scary but do not
                // worry — the loader will be passed into the adapter later on in this guide.
                this.loader = loader;

                // URL where to send files.
                this.url = '{{ route('upload-gambar-campaign') }}';

                //
            }
            // Starts the upload process.
            upload() {
                return this.loader.file.then(
                    (file) =>
                    new Promise((resolve, reject) => {
                        this._initRequest();
                        this._initListeners(resolve, reject, file);
                        this._sendRequest(file);
                    })
                );
            }
            // Aborts the upload process.
            abort() {
                if (this.xhr) {
                    this.xhr.abort();
                }
            }
            // Initializes the XMLHttpRequest object using the URL passed to the constructor.
            _initRequest() {
                const xhr = (this.xhr = new XMLHttpRequest());
                // Note that your request may look different. It is up to you and your editor
                // integration to choose the right communication channel. This example uses
                // a POST request with JSON as a data structure but your configuration
                // could be different.
                // xhr.open('POST', this.url, true);
                xhr.open("POST", this.url, true);
                xhr.setRequestHeader("x-csrf-token", "{{ csrf_token() }}");
                xhr.responseType = "json";
            }
            // Initializes XMLHttpRequest listeners.
            _initListeners(resolve, reject, file) {
                const xhr = this.xhr;
                const loader = this.loader;
                const genericErrorText = `Couldn't upload file: ${file.name}.`;
                xhr.addEventListener("error", () => reject(genericErrorText));
                xhr.addEventListener("abort", () => reject());
                xhr.addEventListener("load", () => {
                    const response = xhr.response;
                    // This example assumes the XHR server's "response" object will come with
                    // an "error" which has its own "message" that can be passed to reject()
                    // in the upload promise.
                    //
                    // Your integration may handle upload errors in a different way so make sure
                    // it is done properly. The reject() function must be called when the upload fails.
                    if (!response || response.error) {
                        return reject(response && response.error ? response.error.message : genericErrorText);
                    }
                    // If the upload is successful, resolve the upload promise with an object containing
                    // at least the "default" URL, pointing to the image on the server.
                    // This URL will be used to display the image in the content. Learn more in the
                    // UploadAdapter#upload documentation.
                    resolve({
                        default: response.url,
                    });
                });
                // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
                // properties which are used e.g. to display the upload progress bar in the editor
                // user interface.
                if (xhr.upload) {
                    xhr.upload.addEventListener("progress", (evt) => {
                        if (evt.lengthComputable) {
                            loader.uploadTotal = evt.total;
                            loader.uploaded = evt.loaded;
                        }
                    });
                }
            }
            // Prepares the data and sends the request.
            _sendRequest(file) {
                // Prepare the form data.
                const data = new FormData();
                data.append("upload", file);
                // Important note: This is the right place to implement security mechanisms
                // like authentication and CSRF protection. For instance, you can use
                // XMLHttpRequest.setRequestHeader() to set the request headers containing
                // the CSRF token generated earlier by your application.
                // Send the request.
                this.xhr.send(data);
            }
            // ...
        }

        function SimpleUploadAdapterPlugin(editor) {
            editor.plugins.get("FileRepository").createUploadAdapter = (loader) => {
                // Configure the URL to the upload script in your back-end here!
                return new MyUploadAdapter(loader);
            };
        }

        //Initialize the ckeditor
        ClassicEditor.create(document.querySelector("#editor"), {
            extraPlugins: [SimpleUploadAdapterPlugin],
        }).catch((error) => {
            console.error(error);
        });
    </script>
@endsection
