@extends('layout.admin')

@section('content')

<div class="container-fluid py-4">

    <div class="row justify-content-center">
        <div class="col-12 col-lg-8 col-xl-7">

            {{-- Page Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1">Edit Shop Settings</h2>
                    <p class="text-muted mb-0">
                        Update your shop information and preferences.
                    </p>
                </div>

                <a href="{{ route('setting.list') }}"
                   class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
            </div>

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Please correct the following errors:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-md-5">

                    {{-- Header Title & Description --}}
                    <h4 class="fw-bold mb-1">Shop Information</h4>
                    <p class="text-muted mb-4">
                        Update your shop information below.
                    </p>

                    <form action="{{ route('setting.update', $shop->id) }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf

                        {{-- Shop Name --}}
                        <div class="mb-3">
                            <label for="shop_name" class="form-label text-dark">
                                Shop Name
                            </label>
                            <input type="text"
                                   id="shop_name"
                                   name="shop_name"
                                   class="form-control"
                                   placeholder="Enter shop name"
                                   value="{{ old('shop_name', $shop->shop_name) }}"
                                   required>
                        </div>

                        {{-- Telephone --}}
                        <div class="mb-3">
                            <label for="tel" class="form-label text-dark">
                                Telephone Number
                            </label>
                            <input type="text"
                                   id="tel"
                                   name="tel"
                                   class="form-control"
                                   placeholder="Enter telephone number"
                                   value="{{ old('tel', $shop->tel) }}">
                        </div>

                        {{-- Exchange Rate --}}
                        <div class="mb-3">
                            <label for="exchange_rate" class="form-label text-dark">
                                Exchange Rate
                            </label>
                            <input type="number"
                                   id="exchange_rate"
                                   name="exchange_rate"
                                   class="form-control"
                                   placeholder="Enter exchange rate"
                                   value="{{ old('exchange_rate', $shop->exchange_rate) }}"
                                   min="0"
                                   step="any">
                        </div>

                        {{-- Address --}}
                        <div class="mb-3">
                            <label for="address" class="form-label text-dark">
                                Shop Address
                            </label>
                            <textarea id="address"
                                      name="address"
                                      class="form-control"
                                      rows="3"
                                      placeholder="Enter shop address">{{ old('address', $shop->address) }}</textarea>
                        </div>

                        {{-- Current Logo --}}
                        <div class="mb-3">
                            <label class="form-label text-dark">
                                Current Shop Logo
                            </label>

                            <div class="mb-3">
                                @if($shop->logo)
                                    <img src="{{ asset('uploads/' . $shop->logo) }}"
                                         alt="Shop Logo"
                                         class="img-thumbnail"
                                         style="max-width: 120px; max-height: 120px; object-fit: contain;">

                                    <p class="text-muted small mt-2 mb-0">
                                        Upload a new image below to replace the current logo.
                                    </p>
                                @else
                                    <p class="text-muted mb-0">
                                        No logo uploaded yet.
                                    </p>
                                @endif
                            </div>

                            <label for="logo" class="form-label text-dark">
                                Upload New Logo
                            </label>
                            <input type="file"
                                   id="logo"
                                   name="logo"
                                   class="form-control"
                                   accept="image/*">
                        </div>

                        {{-- Form Actions --}}
                        <div class="d-flex align-items-center gap-2 mt-4">
                            <button type="submit" class="btn btn-success px-4 text-white" style="background-color: #10b981; border-color: #10b981;">
                                Save Changes
                            </button>

                            <a href="{{ route('setting.list') }}" class="btn btn-light border px-4 text-muted">
                                Cancel
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

@endsection