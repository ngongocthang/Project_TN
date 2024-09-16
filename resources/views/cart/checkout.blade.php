@extends('layout')

@section('title', 'Check Page')

@section('content')

    <!--Hero Section-->
    <div class="hero-section hero-background">
        <h1 class="page-title">Organic Fruits</h1>
    </div>

    <!--Navigation section-->
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="index-2.html" class="permal-link">Home</a></li>
                <li class="nav-item"><span class="current-page">ShoppingCart</span></li>
            </ul>
        </nav>
    </div>

    <div class="page-contain checkout">
        <!-- Main content -->
        <div id="main-content" class="main-content">
            <div class="container sm-margin-top-37px">
                <div class="row">
                    <!--checkout progress box-->
                    <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                        <div class="checkout-progress-wrap">
                            <ul class="steps">
                                <li class="step 1st">
                                    <div class="checkout-act active">
                                        <h2 class="title-box" style="font-weight: bold;">Customer</h2>
                                        <div class="box-content">
                                            <div class="login-on-checkout">
                                                <form action="#" name="frm-login" method="post">
                                                    <p class="form-row">
                                                        <label for="input_email">Name:</label>
                                                        <input type="email" name="name" id="input_name" value="" placeholder="Your Name">
                                                        <label for="input_email">Email:</label>
                                                        <input type="email" name="email" id="input_email" value="" placeholder="Your Email">
                                                        <label for="input_email">Address:</label>
                                                        <input type="email" name="address" id="input_address" value="" placeholder="Your Address">
                                                        <label for="input_email">Phone:</label>
                                                        <input type="email" name="phone" id="input_phone" value="" placeholder="Your Phone"><br>

                                                        <p style="color: red; text-align: center; font-style: italic;">⚠️ Complete your purchase by providing your payment details</p>

                                                        <!-- <button type="submit" name="btn-sbmt" class="btn">Continue As Guest</button> -->
                                                    </p>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!--Order Summary-->
                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 sm-padding-top-48px sm-margin-bottom-0 xs-margin-bottom-15px">
                        <div class="order-summary sm-margin-bottom-80px">
                            <div class="title-block">
                                <h3 class="title">Order Summary</h3>
                            </div>
                            <div class="cart-list-box short-type">
                                <span class="number">1 items</span>
                                <ul class="cart-list">
                                    <li class="cart-elem">
                                        <div class="cart-item">
                                            <div class="product-thumb">
                                                <a class="prd-thumb" href="#">
                                                    <figure><img src="./images/shippingcart/pr-01.jpg" width="113" height="113" alt="shop-cart" ></figure>
                                                </a>
                                            </div>
                                            <div class="info">
                                                <span class="txt-quantity">1X</span>
                                                <a href="#" class="pr-name">National Fresh Fruit</a>
                                            </div>
                                            <div class="price price-contain">
                                                <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                                <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <ul class="subtotal">
                                    <li>
                                        <div class="subtotal-line">
                                            <b class="stt-name">Subtotal</b>
                                            <span class="stt-price">£170.00</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="subtotal-line">
                                            <b class="stt-name">Shipping</b>
                                            <span class="stt-price">£20.00</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="subtotal-line">
                                            <b class="stt-name">Tax</b>
                                            <span class="stt-price">£0.00</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="subtotal-line">
                                            <a href="#" class="link-forward">Promo/Gift Certificate</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="subtotal-line">
                                            <b class="stt-name">total:</b>
                                            <span class="stt-price">£190.00</span>
                                        </div>
                                    </li>
                                </ul>

                                <!-- <button type="submit" name="btn-sbmt" class="btn">Continue As Guest</button> -->

                                <button type="submit" name="btn-sbmt" class="my-button">Buy Now</button>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>

@endsection