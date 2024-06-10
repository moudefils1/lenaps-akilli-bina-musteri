@php use Carbon\Carbon; @endphp
@extends('layouts.admin')
@section("title")
    Hesabım |
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" type="text/css">
@endsection

@section('breadcrumb')
    <div class="page-title py-2 py-sm-0 d-flex flex-column justify-content-center me-3 ">
        <!--begin::Title-->
        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Hesabım</h1>
        <!--end::Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">
                <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">Anasayfa</a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-500 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">Hesabım</li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection

@section("content")

    <!--begin::Layout-->
    <div class="d-flex flex-column flex-xl-row">
        <!--begin::Sidebar-->
        <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
            <!--begin::Card-->
            <div class="card mb-5 mb-xl-8">
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Status-->
                    <div class="card-body text-center">
                        <div
                            @class([
                                'badge',
                                'badge-danger' => $user->status->value == 0,
                                'badge-success d-inline' => $user->status->value == 1,
                                'badge-warning d-inline' => $user->status->value == 2,
                            ])>
                            {{ $user->status->getLabel() }}
                        </div>
                    </div>
                    <!--end::Status-->
                    <!--begin::Summary-->
                    <div class="d-flex flex-center flex-column mb-5">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-150px symbol-circle mb-7">
                            <img src="{{$user?->getFirstMediaUrl("user")}}" alt="image"/>
                        </div>
                        <!--end::Avatar-->
                        <!--begin::Name-->
                        <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-5">{{$user->name}}</a>
                        <!--end::Name-->
                        <!--begin::Position-->
                        {{--<div class="fs-5 fw-semibold text-muted mb-6 text-success">{{ $user->role->getLabel() }}</div>--}}
                        <div
                            class="badge badge-lg badge-light-primary d-inline mb-5">{{ $user->role->getLabel() }}</div>
                        <!--end::Position-->
                    </div>
                    <!--end::Summary-->
                    <!--begin::Details toggle-->
                    <div class="d-flex flex-stack fs-4">
                        <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Bilgilerini güncelle">
                            <a href="{{route("admin.users.profile.edit", $user->slug)}}" class="btn btn-sm btn-light-primary"
                               data-bs-toggle="" data-bs-target="#kt_modal_update_customer">Güncelle</a>
                        </span>
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Sidebar-->
        <!--begin::Content-->
        <div class="flex-lg-row-fluid ms-lg-15">
            <!--begin:::Tabs-->
            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#genel_bilgiler">Genel Bilgiler</a>
                </li>
                <!--end:::Tab item-->
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#oturumlar">Oturum Bilgileri</a>
                </li>
                <!--end:::Tab item-->
            </ul>
            <!--end:::Tabs-->
            <!--begin:::Tab content-->
            <div class="tab-content" id="myTabContent">
                <!--begin:::Tab pane-->
                <div class="tab-pane fade show active" id="genel_bilgiler" role="tabpanel">
                    <!--begin::Card-->
                    <div class="card pt-4 mb-6 mb-xl-9">
                        <!--begin::Card header-->
                        <div class="card-header border-0">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Profil</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0 pb-5">
                            <!--begin::Table wrapper-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed gy-5" id="">
                                    <tbody class="fs-6 fw-semibold text-gray-600">
                                    <tr>
                                        <td>Email:</td>
                                        <td class="text-gray-900">{{$user->email}}</td>
                                        <td>Telefon:</td>
                                        <td class="text-gray-900">{{$user->phone}}</td>
                                    </tr>
                                    <tr>
                                        <td>Adres:</td>
                                        <td class="text-gray-900">{{$user->address}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table wrapper-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                    <!--begin::Email Değiştirme Kısmı-->
                    <div id="kt_signin_email_edit" class="flex-row-fluid">
                        <!--begin::Form-->
                        <form id="" class="form" novalidate="novalidate" action="{{route('admin.users.email')}}" method="POST">
                            @csrf
                            <!--begin::Card-->
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>Email Güncellenmesi</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0 pb-5">
                                    <!--begin::Input group-->
                                    <div class="row">
                                        <!-- İlk Sütun -->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="mb-4 fv-row">
                                                <!--begin::Label-->
                                                <label for="emailaddress" class="form-label fs-6 fw-bold mb-3">Yeni Email Adresi Giriniz</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input name="email" type="email" class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror"
                                                       id="emailaddress" placeholder="Yeni Email Adresinizi Giriniz" />
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                @error('new_password') <div class="text-danger fs-7">{{$message}}</div> @enderror
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!-- İkinci Sütun -->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="mb-4 fv-row">
                                                <!--begin::Label-->
                                                <label for="confirmemailpassword" class="form-label fs-6 fw-bold mb-3">Şifre Doğrulaması</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="password" class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror"
                                                       name="password" id="confirmemailpassword" placeholder="Geçerli şifrenizi giriniz"/>
                                                <!--end::Input-->
                                                @error('password') <div class="text-danger fs-7">{{$message}}</div> @enderror
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <div class="d-flex justify-content-end">
                                        <!--begin::Button-->
                                        {{--<a href="{{route("admin.users.index")}}" id="kt_ecommerce_add_product_cancel"
                                           class="btn btn-light me-5">Geri</a>--}}
                                        <!--end::Button-->
                                        <!--begin::Button-->
                                        <button type="submit" id="" class="btn btn-primary">
                                            <span class="indicator-label">Güncelle</span>
                                        </button>
                                        <!--end::Button-->
                                    </div>
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </form>
                    </div>
                    <!--end::Email Değiştirme Kısmı-->
                    <!--begin::Şifre Oluşturma Kısmı-->
                    <div id="kt_signin_password_edit" class="card shadow-sm flex-row-fluid">
                        <!--begin::Form-->
                            <!--begin::Card-->
                            {{--<div class="card pt-4 mb-6 mb-xl-9">--}}
                                <!--begin::Card header-->
                                <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#collapseCard">
                                    <!--begin::Card title-->
                                    <h2 class="card-title">Yeni Şifre Oluşturun</h2>
                                    <div class="card-toolbar rotate-180">
                                        <i class="ki-duotone ki-down fs-1"></i>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <form id="" class="form" novalidate="novalidate" action="{{route('admin.users.password')}}" method="POST">
                                    @csrf
                                    <div class="collapse" id="collapseCard">
                                    <div class="card-body pt-5 pb-5">
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label for="currentpassword" class="form-label fs-6 fw-bold mb-3">Geçerli Şifreniz</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="password" class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror" name="password" id="currentpassword" placeholder="Geçerli Şifrenizi giriniz"/>
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            @error('password') <div class="fs-7 text-danger">{{$message}}</div> @enderror
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row">
                                            <!-- İlk Sütun -->
                                            <div class="col">
                                                <!--begin::Input group-->
                                                <div class="mb-4 fv-row">
                                                    <!--begin::Label-->
                                                    <label for="newpassword" class="form-label fs-6 fw-bold mb-3">Yeni Şifreniz</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="password" class="form-control form-control-lg form-control-solid @error('new_password') is-invalid @enderror" name="new_password" id="newpassword" placeholder="Yeni Şifrenizi giriniz"/>
                                                    <!--end::Input-->
                                                    <!--begin::Description-->
                                                    @error('new_password') <div class="text-danger fs-7">{{$message}}</div> @enderror
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!-- İkinci Sütun -->
                                            <div class="col">
                                                <!--begin::Input group-->
                                                <div class="mb-4 fv-row">
                                                    <!--begin::Label-->
                                                    <label for="confirmpassword" class="form-label fs-6 fw-bold mb-3">Yeni Şifrenizi Doğrulayınız</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="password" class="form-control form-control-lg form-control-solid @error('new_password_confirmation') is-invalid @enderror" name="new_password_confirmation" id="confirmpassword" placeholder="Yeni Şifrenizi doğrulayınız"/>
                                                    <!--end::Input-->
                                                    @error('new_password_confirmation') <div class="text-danger fs-7">{{$message}}</div> @enderror
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                        </div>
                                        <div class="form-text mb-5 pt-0 text-gray-900">(En az 8 karakterden oluşmalı ve sembol içermelidir)</div>
                                        <!--end::Input group-->
                                        <div class="d-flex justify-content-end">
                                            <!--begin::Button-->
                                            {{--<a href="{{route("admin.users.index")}}" id="kt_ecommerce_add_product_cancel"
                                            class="btn btn-light me-5">Geri</a>--}}
                                            <!--end::Button-->
                                            <!--begin::Button-->
                                            <button type="submit" id="" class="btn btn-primary">
                                                <span class="indicator-label">Güncelle</span>
                                            </button>
                                            <!--end::Button-->
                                        </div>
                                    </div>
                                </div>
                                </form>
                                <!--end::Card body-->
                            {{--</div>--}}
                            <!--end::Card-->
                    </div>
                    <!--end::Şifre Oluşturma Kısmı-->
                </div>
                <!--end:::Tab pane-->
                <!--begin:::Tab pane-->
                <div class="tab-pane fade" id="oturumlar" role="tabpanel">
                    <!--begin::Card-->
                    <div class="card pt-4 mb-6 mb-xl-9">
                        <!--begin::Card header-->
                        <div class="card-header border-0">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Oturum Bilgileri</h2>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            @if($user->role == 1)
                                <div class="card-toolbar">
                                    <!--begin::Filter-->
                                    <button type="button" class="btn btn-sm btn-flex btn-light-primary" id="kt_modal_sign_out_sesions">
                                        <i class="ki-outline ki-entrance-right fs-3"></i>Tüm oturumları kapat
                                    </button>
                                    <!--end::Filter-->
                                </div>
                            @endif
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0 pb-5">
                            <!--begin::Table wrapper-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed gy-5" id="kt_ecommerce_category_table">
                                    <thead class="border-bottom border-gray-200 fs-7 fw-bold">
                                        <tr class="text-start text-muted text-uppercase gs-0">
                                            <th class="w-10px pe-2">
                                                #
                                            </th>
                                            <th>İşletim Sistemi</th>
                                            <th>IP Adresi</th>
                                            <th>Son Giriş</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fs-6 fw-semibold text-gray-600">
                                    @foreach($user->loginLogs as $log)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$log->device}}</td>
                                            <td>{{$log->ip}}</td>
                                            <td>{{ Carbon::parse($log->last_login)->format("d.m.Y - H:i") }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table wrapper-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end:::Tab pane-->
            </div>
            <!--end:::Tab content-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Layout-->
@endsection

@section("script")
    <script src="{{asset("assets/plugins/custom/datatables/datatables.bundle.js")}}"></script>
    <script src="{{asset('assets/js/custom/apps/ecommerce/catalog/categories.js')}}"></script>
@endsection
