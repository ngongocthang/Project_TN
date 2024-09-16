@extends('layout')

@section('title', 'Like Page')

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
                <li class="nav-item"><span class="current-page">ShoppingLike </span></li>
            </ul>
        </nav>
    </div>

    <div class="page-contain shopping-cart">

        <!-- Main content -->
        <div id="main-content" class="main-content">
            <div class="container">
                <!--Cart Table-->
                <div class="shopping-cart-container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h3 class="box-title">Wishlist</h3>
                            <form class="shopping-cart-form" action="#" method="post">
                                <table class="shop_table cart-form">
                                    <thead>
                                        <tr>
                                            <th class="product-subtotal">STT</th>
                                            <th class="product-name">Product Name</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-description">Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="cart_item">
                                            <td>
                                                <p>1</p>
                                            </td>
                                            <td class="product-thumbnail" data-title="Product Name">
                                                <a class="prd-thumb" href="#">
                                                    <figure><img width="113" height="113"
                                                            src="images/shippingcart/pr-01.jpg"
                                                            alt="shipping cart"></figure>
                                                </a>
                                                <a class="prd-name" href="#">National Fresh Fruit</a>
                                                <div class="action">
                                                    <a href="#" class="remove"><i class="fa fa-trash-o"
                                                            aria-hidden="true"></i></a>
                                                </div>
                                            </td>
                                            <td class="product-price" data-title="Price">
                                                <div class="price price-contain">
                                                    <ins><span class="price-amount"><span
                                                                class="currencySymbol">£</span>85.00</span></ins>
                                                    <del><span class="price-amount"><span
                                                                class="currencySymbol">£</span>95.00</span></del>
                                                </div>
                                            </td>
                                            <td class="product-description" data-title="Description">
                                                <div class="quantity-box type1">
                                                    <p>Lorem ipsum dolor, sit amet...</p>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="cart_item">
                                            <td>
                                                <p>2</p>
                                            </td>
                                            <td class="product-thumbnail" data-title="Product Name">
                                                <a class="prd-thumb" href="#">
                                                    <figure><img width="113" height="113"
                                                            src="images/shippingcart/pr-01.jpg"
                                                            alt="shipping cart"></figure>
                                                </a>
                                                <a class="prd-name" href="#">National Fresh Fruit</a>
                                                <div class="action">
                                                    <a href="#" class="remove"><i class="fa fa-trash-o"
                                                            aria-hidden="true"></i></a>
                                                </div>
                                            </td>
                                            <td class="product-price" data-title="Price">
                                                <div class="price price-contain">
                                                    <ins><span class="price-amount"><span
                                                                class="currencySymbol">£</span>85.00</span></ins>
                                                    <del><span class="price-amount"><span
                                                                class="currencySymbol">£</span>95.00</span></del>
                                                </div>
                                            </td>
                                            <td class="product-description" data-title="Description">
                                                <div class="quantity-box type1">
                                                    <p>Lorem ipsum dolor, sit amet...</p>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="cart_item wrap-buttons">
                                            <td class="wrap-btn-control" colspan="4">
                                                <a class="btn back-to-shop">Back to Shop</a>
                                                <button class="btn btn-clear" type="reset">clear all</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection