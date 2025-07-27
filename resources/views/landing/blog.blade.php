@extends('landing.master')
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/assets/css/main/blog.css">
@endsection
@section('content')
    <header class="my-5">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="post-heading text-center">
                        <h1>Blog</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="my-5">
        <div class="container">
            <section class="text-center">

                <div class="row">
                    @foreach ($blog as $item)
                        <div class="col-lg-4 col-md-12 mb-4">
                            <div class="card">
                                <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                    <img src="{{ asset('/storage/images/thumbnail/' . $item->gambar_blog) }}"
                                        class="img-fluid" />
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="/blog/{{ $item->slug_blog }}"
                                            style="color: #212529; text-decoration: none;">{{ $item->judul_blog }}</a>
                                    </h5>
                                    <p class="card-text">
                                        {!! Str::limit($item->isi_blog, 100) !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <nav class="my-4" aria-label="...">
                    <ul class="pagination pagination-circle justify-content-center">
                        {{ $blog->links() }}
                    </ul>
                </nav>
            </section>
        </div>
    </main>
@endsection
