@extends('user.layouts.layout')

@section('title', 'Home')

@section('content')
    <main>
        <article>
            <!-- Banner Carousel -->
            <section>
                <div id="carouselBanner" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('storage/images/banners/Banner-Slider-Home-banner-1742015338.jpg') }}"
                                class="d-block w-100" alt="Banner 1">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('storage/images/banners/Banner-Slider-Home-Casing-CG-Cinema-Athos-1744711639.jpg') }}"
                                class="d-block w-100" alt="Banner 2">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('storage/images/banners/Banner-Slider-Home-Cooler-Anima-1745993994.jpg') }}"
                                class="d-block w-100" alt="Banner 3">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('storage/images/banners/Banner-Slider-Home-Cooler-galahad-1746179641.jpg') }}"
                                class="d-block w-100" alt="Banner 4">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('storage/images/banners/Banner-Slider-Home-PSU-1stplayer-ngdp-1746154754.jpg') }}"
                                class="d-block w-100" alt="Banner 5">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('storage/images/banners/Banner-Slider-Home-PSU-bequiet-pure-power-1744711720.jpg') }}"
                                class="d-block w-100" alt="Banner 6">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselBanner"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselBanner"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </section>

            <!-- Categories -->
            <section>
                <div class="container-fluid px-5 pt-5">
                    <h2 class="mb-4">Categories</h2>
                    <div class="row row-cols-2 row-cols-md-4 align-items-start justify-content-center">
                        <div class="col">
                            <a class="text-decoration-none" href="{{ url('products?category=PC Components') }}">
                                <div class="highlight card-template d-flex justify-content-center align-items-center"
                                    style="--bg-image: url('{{ asset('storage/images/categories/pc_components.jpg') }}')">
                                </div>
                                <div class="category-text">
                                    <h5>PC Components <span class="arrow">→</span></h5>
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <a class="text-decoration-none" href="{{ url('products?category=Peripherals') }}">
                                <div class="highlight card-template d-flex justify-content-center align-items-center"
                                    style="--bg-image: url('{{ asset('storage/images/categories/peripherals.jpeg') }}')">
                                </div>
                                <div class="category-text">
                                    <h5>Peripherals <span class="arrow">→</span></h5>
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <a class="text-decoration-none" href="{{ url('products?category=Laptops and Desktops') }}">
                                <div class="highlight card-template d-flex justify-content-center align-items-center"
                                    style="--bg-image: url('{{ asset('storage/images/categories/laptops_and_desktops.jpg') }}')">
                                </div>
                                <div class="category-text">
                                    <h5>Laptops and Desktops <span class="arrow">→</span></h5>
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <a class="text-decoration-none" href="{{ url('products?category=Accesories') }}Accesories">
                                <div class="highlight card-template d-flex justify-content-center align-items-center"
                                    style="--bg-image: url('{{ asset('storage/images/categories/accessories.jpg') }}')">
                                </div>
                                <div class="category-text">
                                    <h5>Accesories <span class="arrow">→</span></h5>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Products -->
            <section>
                <div class="container-fluid px-5 py-5">
                    <h2 class="mb-4">Products</h2>
                    @if (count($products) === 0)
                        <h4 class="text-center my-5">Product not available!</h4>
                    @else
                        <div class="row row-cols-3 row-cols-md-5">
                            @foreach ($products as $product)
                                <div class="col px-1 py-2 d-flex">
                                    <div class="d-flex flex-column w-100 p-0">
                                        <a href="{{ route('product-details', $product->product_id) }}"
                                            class="text-decoration-none product-text">
                                            <div class="card-template mb-2"
                                                style="--bg-image: url('{{ asset('storage/' . $product->image_url) }}')">
                                            </div>
                                            <h6 class="mb-1">{{ $product->product_name }}</h6>
                                            <p class="price-text mb-2">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                        </a>
                                        <div class="mt-auto">
                                            <button type="button" class="w-100 button-template">Add to cart</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                </div>
            </section>
        </article>
    </main>
@endsection