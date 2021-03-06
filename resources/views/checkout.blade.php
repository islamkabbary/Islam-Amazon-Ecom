<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" href="img/favicon.png" type="image/png" />
    <title>Eiser ecommerce</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/linericon/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/owl-carousel/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/lightbox/simpleLightbox.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/nice-select/css/nice-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendors/jquery-ui/jquery-ui.css') }}" />
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}" />
</head>

<body>
    <section class="checkout_area section_gap">
        <div class="container">
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>Your Order</h2>
                            <ul class="list">
                                <li>
                                    <a href="#">Product
                                        <span>Total</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">{{$product->name}}
                                        <span class="middle">x {{$cart->qty}}</span>
                                        <span class="last">${{$product->price * $cart->qty}}</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="list list_2">
                                <li>
                                    <a href="#">Total
                                        <span>${{$product->price * $cart->qty}}</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="creat_account">
                                <input type="checkbox" id="f-option4" name="selector" />
                                <label for="f-option4">I???ve read and accept the </label>
                                <a href="#">terms & conditions*</a>
                            </div>
                            <a class="main_btn" href="{{URL::to('stripe/'.$product->id)}}">Proceed to Paypal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/stellar.js"></script>
    <script src="vendors/lightbox/simpleLightbox.min.js"></script>
    <script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
    <script src="vendors/isotope/imagesloaded.pkgd.min.js"></script>
    <script src="vendors/isotope/isotope-min.js"></script>
    <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/mail-script.js"></script>
    <script src="vendors/jquery-ui/jquery-ui.js"></script>
    <script src="vendors/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendors/counter-up/jquery.counterup.js"></script>
    <script src="js/theme.js"></script>
</body>

</html>
