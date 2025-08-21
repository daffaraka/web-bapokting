@extends('frontend.base-layout')
@section('title', $berita->judul_berita)
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-8">

                <!-- Blog Details Section -->
                <section id="blog-details" class="blog-details section">
                    <div class="container">

                        <article class="article">

                            <div class="post-img">
                                <img src="{{ asset('storage/' . $berita->gambar_berita) }}" alt="" class="img-fluid">
                            </div>

                            <h2 class="title">{{ $berita->judul_berita }}</h2>

                            <div class="meta-top">
                                <ul>
                                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                                            href="blog-details.html">{{ $berita->user->name }}</a></li>
                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                            href="blog-details.html"><time datetime="{{ $berita->published_at }}">{{ $berita->published_at }}</time></a></li>
                                    <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a
                                            href="blog-details.html">12 Comments</a></li>
                                </ul>
                            </div><!-- End meta top -->

                            <div class="content">
                                <p>
                                    {!! $berita->konten_berita !!}
                                </p>

                            </div><!-- End post content -->

                            {{-- <div class="meta-bottom">
                                <i class="bi bi-folder"></i>
                                <ul class="cats">
                                    <li><a href="#">Business</a></li>
                                </ul>

                                <i class="bi bi-tags"></i>
                                <ul class="tags">
                                    <li><a href="#">Creative</a></li>
                                    <li><a href="#">Tips</a></li>
                                    <li><a href="#">Marketing</a></li>
                                </ul>
                            </div><!-- End meta bottom --> --}}

                        </article>

                    </div>
                </section><!-- /Blog Details Section -->


            </div>

            <div class="col-lg-4 sidebar">

                <div class="widgets-container">

                    <!-- Blog Author Widget -->
                    <div class="blog-author-widget widget-item">

                        <div class="d-flex flex-column align-items-center">
                            <img src="assets/img/blog/blog-author.jpg" class="rounded-circle flex-shrink-0"
                                alt="">
                            <h4>Jane Smith</h4>
                            <div class="social-links">
                                <a href="https://x.com/#"><i class="bi bi-twitter-x"></i></a>
                                <a href="https://facebook.com/#"><i class="bi bi-facebook"></i></a>
                                <a href="https://instagram.com/#"><i class="biu bi-instagram"></i></a>
                                <a href="https://instagram.com/#"><i class="biu bi-linkedin"></i></a>
                            </div>

                            <p>
                                Itaque quidem optio quia voluptatibus dolorem dolor. Modi eum sed possimus accusantium. Quas
                                repellat voluptatem officia numquam sint aspernatur voluptas. Esse et accusantium ut unde
                                voluptas.
                            </p>

                        </div>
                    </div><!--/Blog Author Widget -->

                    <!-- Search Widget -->
{{--
                    <div class="recent-posts-widget widget-item">

                        <h3 class="widget-title">Recent Posts</h3>

                        <div class="post-item">
                            <h4><a href="blog-details.html">Nihil blanditiis at in nihil autem</a></h4>
                            <time datetime="2020-01-01">Jan 1, 2020</time>
                        </div><!-- End recent post item-->

                        <div class="post-item">
                            <h4><a href="blog-details.html">Quidem autem et impedit</a></h4>
                            <time datetime="2020-01-01">Jan 1, 2020</time>
                        </div><!-- End recent post item-->

                        <div class="post-item">
                            <h4><a href="blog-details.html">Id quia et et ut maxime similique occaecati ut</a></h4>
                            <time datetime="2020-01-01">Jan 1, 2020</time>
                        </div><!-- End recent post item-->

                        <div class="post-item">
                            <h4><a href="blog-details.html">Laborum corporis quo dara net para</a></h4>
                            <time datetime="2020-01-01">Jan 1, 2020</time>
                        </div><!-- End recent post item-->

                        <div class="post-item">
                            <h4><a href="blog-details.html">Et dolores corrupti quae illo quod dolor</a></h4>
                            <time datetime="2020-01-01">Jan 1, 2020</time>
                        </div><!-- End recent post item-->

                    </div><!--/Recent Posts Widget --> --}}

                    <!-- Tags Widget -->
                    {{-- <div class="tags-widget widget-item">

                        <h3 class="widget-title">Tags</h3>
                        <ul>
                            <li><a href="#">App</a></li>
                            <li><a href="#">IT</a></li>
                            <li><a href="#">Business</a></li>
                            <li><a href="#">Mac</a></li>
                            <li><a href="#">Design</a></li>
                            <li><a href="#">Office</a></li>
                            <li><a href="#">Creative</a></li>
                            <li><a href="#">Studio</a></li>
                            <li><a href="#">Smart</a></li>
                            <li><a href="#">Tips</a></li>
                            <li><a href="#">Marketing</a></li>
                        </ul>

                    </div><!--/Tags Widget --> --}}

                </div>

            </div>

        </div>
    </div>
@endsection
