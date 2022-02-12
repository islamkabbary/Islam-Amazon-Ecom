
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>stripe</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #343a40
        }

        .card {
            background: #000;
            color: #fff;
            width: 410px !important
        }

        .mrow {
            margin-top: 30px;
            margin-bottom: 30px
        }

        img {
            margin-right: 10px
        }

        .main span:hover {
            text-decoration: underline;
            cursor: pointer
        }

        .mrow img:hover {
            border-bottom: 1px solid #fff;
            cursor: pointer
        }

        .btn-primary {
            border: none;
            border-radius: 30px
        }

        h5 {
            padding-top: 8px
        }

        .form-group {
            position: relative;
            margin-bottom: 2rem
        }

        .form-control-placeholder {
            position: absolute;
            top: 6px;
            padding: 7px 0 0 10px;
            transition: all 200ms;
            opacity: 0.5;
            color: #dae0e5 !important;
            font-size: 75%
        }

        .form-control:focus+.form-control-placeholder,
        .form-control:valid+.form-control-placeholder {
            font-size: 75%;
            transform: translate3d(0, -100%, 0);
            opacity: 1;
            top: 10px
        }

        .form-control {
            background: transparent;
            border: none;
            border-bottom: 1px solid #fff !important;
            border-radius: 0;
            outline: 0
        }

        .form-control:focus,
        .form-control:after {
            outline-width: 0;
            border-bottom: 1px solid #fff !important;
            background: transparent;
            box-shadow: none;
            border-radius: 0;
            color: #dae0e5;
            letter-spacing: 1px
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="card my-4 p-3">
            <div class="row main">
                <div class="col-12">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Credit card checkout</span></div>
            </div>
            <form class="form-card" method="post" action="{{route('payment')}}">
                @csrf
                <input type="hidden" name="product" value="{{$product->id}}">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group"> <input type="text" class="form-control p-0" name="cardNumber" id="number" required><label class="form-control-placeholder p-0" for="number">CardNumber</label> </div>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-12">
                        <div class="form-group"> <input type="text" name="name" class="form-control p-0" id="name" required><label class="form-control-placeholder p-0" for="name">Cardholder'sName</label> </div>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-sm-4 col-12">
                        <div class="form-group"> <input type="text" name="month" class="form-control p-0" id="sdate" required><label class="form-control-placeholder p-0" for="sdate">Month</label> </div>
                    </div>
                    <div class="col-sm-4 col-12">
                        <div class="form-group"> <input type="text" name="year" class="form-control p-0" id="expdate" required><label class="form-control-placeholder p-0" for="expdate">Year</label> </div>
                    </div>
                    <div class="col-sm-4 col-12">
                        <div class="form-group"> <input type="password" name="cvc" class="form-control p-0" id="passw" required><label class="form-control-placeholder p-0" for="passw">CVV</label> </div>
                    </div>
                </div>
                <div class="row lrow mt-4 mb-3">
                    <div class="col-sm-8 col-12">
                        <h3>Grand Total:</h3>
                    </div>
                    <div class="col-sm-4 col-12">
                        <h5>&#36;{{$product->price}}</h5>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-12"> <button type="submit" class="btn btn-primary btn-block">Pay</button> </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>

</script>
</html>

