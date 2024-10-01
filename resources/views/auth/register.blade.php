@extends('layout')

@section('title', 'Register Page')

@section('content')

    <!-- Preloader -->
    <div id="biof-loading">
        <div class="biof-loading-center">
            <div class="biof-loading-center-absolute">
                <div class="dot dot-one"></div>
                <div class="dot dot-two"></div>
                <div class="dot dot-three"></div>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="hero-section hero-background">
        <h1 class="page-title">Register</h1>
    </div>

    <!-- Navigation section -->
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="{{ route('home') }}" class="permal-link">Home</a></li>
                <li class="nav-item"><span class="current-page">Register</span></li>
            </ul>
        </nav>
    </div>

    <div class="page-contain register-page">
        <!-- Main content -->
        <div id="main-content" class="main-content">
            <div class="container">
                <div class="row">
                    <!-- Form Register -->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="signin-container">
                            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                @csrf

                                <!-- Name -->
                                <p class="form-row">
                                    <label for="name">Name:<span class="requite">*</span></label>
                                    <x-text-input id="name" class="txt-input" type="text" name="name"
                                        :value="old('name')" required autofocus autocomplete="name" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </p>

                                <!-- Email Address -->
                                <p class="form-row">
                                    <label for="email">Email Address:<span class="requite">*</span></label>
                                    <x-text-input id="email" class="txt-input" type="email" name="email"
                                        :value="old('email')" required autocomplete="username" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </p>

                                <!-- Thumbnail -->
                                <p class="form-row">
                                    <x-input-label for="thumbnail" :value="__('Thumbnail (optional)')" />
                                    <x-text-input id="thumbnail" class="block mt-1 w-full" type="file" name="thumbnail"
                                        :value="old('thumbnail')" autocomplete="thumbnail" />
                                    <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                                </p>

                                <!-- Password -->
                                <p class="form-row">
                                    <label for="password">Password:<span class="requite">*</span></label>
                                    <x-text-input id="password" class="txt-input" type="password" name="password" required
                                        autocomplete="new-password" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </p>

                                <!-- Confirm Password -->
                                <p class="form-row">
                                    <label for="password_confirmation">Confirm Password:<span
                                            class="requite">*</span></label>
                                    <x-text-input id="password_confirmation" class="txt-input" type="password"
                                        name="password_confirmation" required autocomplete="new-password" />
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </p>

                                <!-- phone -->
                                <p class="form-row">
                                    <label for="phone">phone:<span class="requite">*</span></label>
                                    <x-text-input id="phone" class="txt-input" type="phone" name="phone" required
                                        autocomplete="new-phone" />
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                </p>

                                <p class="form-row wrap-btn">
                                    <button class="btn btn-submit btn-bold" type="submit">Sign Up</button>
                                    <a href="{{ route('login') }}" class="link-to-help">Already registered?</a>
                                </p>
                            </form>
                        </div>
                    </div>

                    <!-- Go to Register form -->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="register-in-container">
                            <div class="intro">
                                <h4 class="box-title">New Customer?</h4>
                                <p class="sub-title">Create an account with us and you’ll be able to:</p>
                                <ul class="lis">
                                    <li>Check out faster</li>
                                    <li>Save multiple shipping addresses</li>
                                    <li>Access your order history</li>
                                    <li>Track new orders</li>
                                    <li>Save items to your Wishlist</li>
                                </ul>
                                <a href="{{ route('register') }}" class="btn btn-bold">Create an account</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
