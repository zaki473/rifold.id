<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
</head>

    @include('components.navbar')
<body>

    <div class="container py-4 py-lg-5">
        <div class="row g-4">
            <!-- Kolom Utama: Daftar Keranjang -->
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3 mb-0">Keranjang Saya</h1>
                    <a href="{{ route('home') }}" class="text-decoration-none">Lanjutkan Belanja <i
                            class="fas fa-arrow-right ms-1"></i></a>
                </div>

                <!-- Kartu Keranjang -->
                <div class="cart-card">
                    <!-- Header Toko 1 -->
                    <div class="all-produk d-flex align-items-center">
                        <input class="form-check-input" type="checkbox" id="produk1">
                        <label class="form-check-label ms-3 produk-name" for="produk2">
                            <i class="fas fa-all-produk me-2 text-muted"></i>Pilih Semua Produk
                        </label>
                    </div>

                    <!-- Produk 1.1 -->
                    <div class="product-item row g-3 align-items-center">
                        <div class="col-1 text-center"><input class="form-check-input" type="checkbox"></div>
                        <div class="col-3 col-md-2"><img src="{{ asset('images/katalog/Weekend walk.png') }}"
                                alt="Produk" class="product-image object-contain"></div>
                        <div class="col-8 col-md-5">
                            <div class="product-title">Jam Tangan Chronograph Pria</div>
                            <div class="product-variation">Warna: Hitam Klasik</div>
                        </div>
                        <div class="col-6 col-md-2 text-md-center">
                            <div class="product-price">Rp1.250.000</div>
                        </div>
                        <div class="col-5 col-md-2">
                            <input type="number" class="form-control form-control-sm mx-auto quantity-selector"
                                value="1" min="1">
                        </div>
                        <div class="col-1 text-end">
                            <button class="remove-btn"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>

                    <!-- Produk 1.2 -->
                    <div class="product-item row g-3 align-items-center">
                        <div class="col-1 text-center"><input class="form-check-input" type="checkbox"></div>
                        <div class="col-3 col-md-2"><img src="{{ asset('images/katalog/Weekend walk.png') }}"
                                alt="Produk" class="product-image object-contain" ></div>
                        <div class="col-8 col-md-5">
                            <div class="product-title">Dompet Kulit Asli</div>
                            <div class="product-variation">Warna: Coklat Tua</div>
                        </div>
                        <div class="col-6 col-md-2 text-md-center">
                            <div class="product-price">Rp350.000</div>
                        </div>
                        <div class="col-5 col-md-2">
                            <input type="number" class="form-control form-control-sm mx-auto quantity-selector"
                                value="1" min="1">
                        </div>
                        <div class="col-1 text-end">
                            <button class="remove-btn"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Samping: Ringkasan Pesanan (Hanya Desktop) -->
            <div class="col-lg-4 d-none d-lg-block">
                <div class="summary-card">
                    <h4 class="mb-4">Ringkasan Pesanan</h4>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal (2 item)</span>
                        <span>Rp1.600.000</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Ongkos Kirim</span>
                        <span>Rp22.000</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold h5 mb-4">
                        <span>Total</span>
                        <span>Rp1.622.000</span>
                    </div>
                    <a href="{{ route('checkout') }}" class="btn btn-primary w-100 btn-lg">
                        Lanjutkan ke Pembayaran
                    </a>

                </div>
            </div>
        </div>
    </div>

    <!-- Footer Ringkasan (Hanya Mobile) -->
    <div class="cart-footer-mobile d-lg-none p-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="selectAllMobile">
                    <label class="form-check-label" for="selectAllMobile">Pilih Semua</label>
                </div>
                <div class="fw-bold mt-1">Total: <span class="product-price">Rp1.622.000</span></div>
            </div>
            <button class="btn btn-primary px-4">Checkout</button>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>
