@extends("auth.login")

@section("title")
    Şifremi Unuttum | Lenaps IoT Platformu
@endsection

@section("content")
    <div class="creative-card-body card-body p-sm-5">
        <h2 class="fs-20 fw-bolder mb-4">Şifremi Unuttum</h2>
        <h4 class="fs-13 fw-bold mb-2">Şifrenizi Sıfırlayın</h4>
        <p class="fs-12 fw-medium text-muted">E-postanızı girin, size bir sıfırlama bağlantısı gönderilecektir.</p>
        <form class="form w-100" novalidate="novalidate" id="" data-kt-redirect-url="" action="{{route("password.email")}}" method="post">
            @csrf
            @error('email')
                <div class="alert alert-danger fs-5 "  role="alert"> {{ $message }} </div>
            @enderror
            <div class="mb-4">
                <input type="email" name="email" class="form-control" autocomplete="off" placeholder="Email" required>
            </div>
            <div class="mt-5">
                <button type="submit" class="btn btn-lg btn-primary w-100">Sıfırla</button>
            </div>
        </form>
        <div class="mt-5 text-muted">
            <span> Zaten hesabınız var mı?</span>
            <a href="{{route("login")}}" class="fw-bold">Giriş Yap</a>
        </div>
    </div>
@endsection
