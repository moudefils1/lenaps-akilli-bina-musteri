@extends("layouts.auth")

@section("title")
    Akıllı Bina Yönetim Sistemi
@endsection

@section("content")
    <form class="form w-100" novalidate="novalidate" id="" action="{{route("login.login")}}" method="POST">
        @csrf
        <!--begin::Heading-->
        <div class="text-center mb-11">
            <!--begin::Title-->
            <h1 class="text-gray-900 fw-bolder mb-3">Giriş Paneli</h1>
            <!--end::Title-->
            <!--begin::Subtitle-->
            <div class="text-gray-500 fw-semibold fs-6">Akıllı Bina Yönetim Sistemi</div>
            <!--end::Subtitle=-->
        </div>
        <!--begin::Heading-->
        @error('email')
            <div class="alert alert-danger fs-5 "  role="alert">
                {{ $message }}
            </div>
        @enderror
        <!--begin::Input group=-->
        <div class="fv-row mb-8">
            <!--begin::Email-->
            <input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" />
            <!--end::Email-->
        </div>
        <!--end::Input group=-->
        <div class="fv-row mb-3">
            <!--begin::Password-->
            <input type="password" placeholder="Şifre" name="password" autocomplete="off" class="form-control bg-transparent" />
            <!--end::Password-->
        </div>
        <!--end::Input group=-->
        <!--begin::Wrapper-->
        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
            <div></div>
            <!--begin::Link-->
            <a href="#" class="link-primary">Şifremi Unuttum</a>
            <!--end::Link-->
        </div>
        <!--end::Wrapper-->
        <!--begin::Submit button-->
        <div class="d-grid mb-10">
            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                <!--begin::Indicator label-->
                <span class="indicator-label">Giriş Yap</span>
                <!--end::Indicator label-->
            </button>
        </div>
        <!--end::Submit button-->
        <!--begin::Sign up-->
        {{--<div class="text-gray-500 text-center fw-semibold fs-6">Not a Member yet?
            <a href="#" class="link-primary">Sign up</a>
        </div>--}}
        <!--end::Sign up-->
    </form>
@endsection
