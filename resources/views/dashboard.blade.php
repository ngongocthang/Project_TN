<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div id="style" class="style">
        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <img src="{{ Auth::user()->userMeta->thumbnail ? Storage::url(Auth::user()->userMeta->thumbnail) : asset('images/avatar.jpg') }}"
                                alt="Profile" class="rounded-circle">
                            <h2>{{ Auth::user()->name }}</h2>
                            <h3>{{ Auth::user()->job }}</h3>
                            <div class="social-links mt-2">
                                <a href="{{ Auth::user()->twitter }}" class="twitter"><i class="bi bi-twitter"></i></a>
                                <a href="{{ Auth::user()->facebook }}" class="facebook"><i
                                        class="bi bi-facebook"></i></a>
                                <a href="{{ Auth::user()->instagram }}" class="instagram"><i
                                        class="bi bi-instagram"></i></a>
                                <a href="{{ Auth::user()->linkedin }}" class="linkedin"><i
                                        class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Overview</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                        Profile</button>
                                </li>
                            </ul>

                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="card-title">Profile Details</h5>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Full Name</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->name }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Address</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ Auth::user()->userMeta->address ?? 'Chưa có thông tin' }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Phone</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ Auth::user()->userMeta->phone ?? 'Chưa có thông tin' }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->email }}</div>
                                    </div>
                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                    <form action="{{ route('profile.update') }}" method="POST">
                                        @csrf
                                        @method('patch')
                                        <div class="row mb-3">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                                Image</label>
                                            <div class="col-md-8 col-lg-9">
                                                <img src="{{ Auth::user()->userMeta->thumbnail ? Storage::url(Auth::user()->userMeta->thumbnail) : asset('images/avatar.jpg') }}"
                                                    alt="Profile" class="rounded-circle">
                                                <div class="pt-2">
                                                    <a href="#" class="btn btn-primary btn-sm"
                                                        title="Upload new profile image"><i
                                                            class="bi bi-upload"></i></a>
                                                    <a href="#" class="btn btn-danger btn-sm"
                                                        title="Remove my profile image"><i class="bi bi-trash"></i></a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-lg-3 col-form-label">Full
                                                Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="name" type="text" class="form-control" id="name"
                                                    value="{{ old('name', Auth::user()->name) }}" required autofocus
                                                    autocomplete="name">
                                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control" id="email"
                                                    value="{{ old('email', Auth::user()->email) }}" required
                                                    autocomplete="email">
                                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="address"
                                                class="col-md-4 col-lg-3 col-form-label">Address</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="address" type="text" class="form-control"
                                                    id="address"
                                                    value="{{ old('address', Auth::user()->userMeta->address ?? '') }}">
                                                <x-input-error class="mt-2" :messages="$errors->get('address')" />
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="phone"
                                                class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone" type="text" class="form-control"
                                                    id="phone"
                                                    value="{{ old('phone', Auth::user()->userMeta->phone ?? '') }}">
                                                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <x-primary-button>{{ __('Save Changes') }}</x-primary-button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->
                                </div>
                            </div><!-- End Bordered Tabs -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
