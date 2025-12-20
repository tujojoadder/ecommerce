<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Groci - Organic Food')</title>
    <!-- Favicon Icon -->
    <link rel="icon" type="image/png" href="{{ asset('frontend/assets/img/favicon.png') }}">
    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Material Design Icons -->
    <link href="{{ asset('frontend/assets/vendor/icons/css/materialdesignicons.min.css') }}" media="all"
        rel="stylesheet" type="text/css" />

    <!-- Select2 CSS -->
    <link href="{{ asset('frontend/assets/vendor/select2/css/select2-bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/assets/vendor/select2/css/select2.min.css') }}" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="{{ asset('frontend/assets/css/osahan.css') }}" rel="stylesheet">

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/owl-carousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/owl-carousel/owl.theme.css') }}">

    <style>
        .remove-icon {
        
            font-size: 18px;
            /* big size, adjust as needed */
            cursor: pointer;
           
        }
    </style>
    @stack('styles')
</head>

<body>

    @include('layouts.frontend.header')

    @yield('content')

    @include('layouts.frontend.footer')
    {{-- sweet 2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('frontend/assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- select2 Js -->
    <script src="{{ asset('frontend/assets/vendor/select2/js/select2.min.js') }}"></script>
    <!-- Owl Carousel -->
    <script src="{{ asset('frontend/assets/vendor/owl-carousel/owl.carousel.js') }}"></script>
    <!-- Custom -->
    <script src="{{ asset('frontend/assets/js/custom.js') }}"></script>
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('frontend/assets/js/demo.css') }}">

    {{-- Google Material Icons --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    {{-- JS --}}
    <script src="{{ asset('frontend/assets/js/hc-offcanvas-nav.js') }}"></script>
    {{-- theme script --}}
    <script>
        (function($) {
            var $main_nav = $('#main-nav');
            var $toggle = $('.toggle');

            var defaultOptions = {
                disableAt: false,
                customToggle: $toggle,
                levelSpacing: 40,
                navTitle: 'All Categories',
                levelTitles: true,
                levelTitleAsBack: true,
                pushContent: '#container',
                insertClose: 2
            };

            // call our plugin
            var Nav = $main_nav.hcOffcanvasNav(defaultOptions);

            // add new items to original nav
            $main_nav.find('li.add').children('a').on('click', function() {
                var $this = $(this);
                var $li = $this.parent();
                var items = eval('(' + $this.attr('data-add') + ')');

                $li.before('<li class="new"><a href="#">' + items[0] + '</a></li>');

                items.shift();

                if (!items.length) {
                    $li.remove();
                } else {
                    $this.attr('data-add', JSON.stringify(items));
                }

                Nav.update(true);
            });

            // demo settings update

            const update = (settings) => {
                if (Nav.isOpen()) {
                    Nav.on('close.once', function() {
                        Nav.update(settings);
                        Nav.open();
                    });

                    Nav.close();
                } else {
                    Nav.update(settings);
                }
            };

            $('.actions').find('a').on('click', function(e) {
                e.preventDefault();

                var $this = $(this).addClass('active');
                var $siblings = $this.parent().siblings().children('a').removeClass('active');
                var settings = eval('(' + $this.data('demo') + ')');

                update(settings);
            });

            $('.actions').find('input').on('change', function() {
                var $this = $(this);
                var settings = eval('(' + $this.data('demo') + ')');

                if ($this.is(':checked')) {
                    update(settings);
                } else {
                    var removeData = {};
                    $.each(settings, function(index, value) {
                        removeData[index] = false;
                    });

                    update(removeData);
                }
            });
        })(jQuery);
    </script>

    {{-- js script --}}
    <script>
        function addCartData() {
            var url = "{{ route('frontend.addCart.get.data') }}";
            var currency = '৳';
            var base_url = "{{ asset('storage/product/') }}/";

            $.ajax({
                type: "GET",
                dataType: "json",
                url: url,
                success: function(data) {
                    $('.cartCount').text(data.length);

                    var html = '';
                    var total = 0;

                    if (data.length != 0) {
                        $.each(data, function(index, value) {
                            // ✅ Add to total
                            total += (parseFloat(value.price) * parseInt(value.quantity));
                            html += '<div class="cart-list-product">';

                            html +=
                                '<a class="float-right remove-cart" href="javascript:void(0)" ' +
                                'onclick="removeCartData(' + value.product.id + ')">' +
                                '<i class="fas fa-trash remove-icon"></i></a>';

                            html +=
                                '<img class="img-fluid" style="height:80px; object-fit:contain" ' +
                                'src="' + base_url + value.product.image + '" ' +
                                'alt="' + value.product.name + '">';

                            // 🔖 Optional discount badge
                            if (value.product.discount) {
                                html += '<span class="badge badge-success">' + value.product.discount +
                                    '% OFF</span>';
                            }

                            html +=
                                '<h5><a href="#">' + value.product.name + '</a></h5>';

                            html +=
                                '<h6><strong>Quantity:</strong> ' + value.quantity + '</h6>';

                            html +=
                                '<p class="offer-price mb-0">' +
                                (value.price * value.quantity).toFixed(2) + ' ' + currency + '</p>';

                            html += '</div>';

                        });

                        $('.minicart-items').html(html);

                        $('.cartTotalAmount').text(total.toFixed(2) + ' ' + currency);
                    } else {
                        $('.minicart-items').html('<li>No items in cart</li>');
                        $('.cartTotalAmount').text('0.00 ' + currency);
                    }
                }
            });
        }


        function removeCartData(product_id) {
            url = "{{ route('frontend.addCart.destroy', ':product_id') }}";
            url = url.replace(':product_id', product_id);
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    addCartData();
                }
            });
        }
        $(document).ready(function() {
            addCartData();
        });

        function addToCart(product_id) {

            var qty = $("#qty1").val() || 1;
            var url = "{{ route('frontend.addCart.store') }}";
            $.ajax({
                type: "POST",
                dataType: "json",
                data: {
                    product_id: product_id,
                    qty: qty,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                success: function(data) {
                    if (data[0] == 'success') {
                        Swal.fire({
                            title: 'Congratulation',
                            text: "Add to Cart Successfull.",
                            icon: 'success',
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        });
                        addCartData();
                    } else if (data[0] == 'increase') {
                        Swal.fire({
                            title: 'Congratulation',
                            text: "Product Quantity Increased.",
                            icon: 'info',
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,

                        });
                        addCartData();
                    } else {
                        Swal.fire({
                            title: 'Sorry',
                            text: "Something Wrong.",
                            icon: 'warning',
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        });
                    }
                }
            });
        }
    </script>

    @stack('scripts')
</body>

</html>
