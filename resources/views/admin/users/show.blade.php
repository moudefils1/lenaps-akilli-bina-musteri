@php use Carbon\Carbon; @endphp
@extends('layouts.admin')
@section("title")
    Kullanıcı Detayı | Kullanıcılar | Panel Yönetimi |
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" type="text/css">
@endsection

@section("breadcrumb")
    <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Kullanıcı Detayı</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="{{route("admin.dashboard")}}" class="text-muted text-hover-primary">Anasayfa</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Panel Yönetimi</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Kullanıcılar</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->

        <!--end::Actions-->
    </div>
@endsection

@section("content")
    <div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Layout-->
        <div class="d-flex flex-column flex-lg-row">
            <!--begin::Sidebar-->
            <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
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
                                    'badge-success' => $user->status->value == 1,
                                    'badge-warning' => $user->status->value == 2,
                                ])>
                                {{ $user->status->getLabel() }}
                            </div>
                        </div>
                        <!--end::Status-->
                        <!--begin::Summary-->
                        <div class="d-flex flex-center flex-column mb-5">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-150px symbol-circle mb-7 pt-4">
                                @if($user?->getFirstMediaUrl("user"))
                                    <img src="{{$user->getFirstMediaUrl("user")}}" alt="image"/>
                                @else
                                    <img src="{{asset('assets/media/avatars/blank.png')}}" alt="image"/>
                                @endif
                            </div>
                            <!--end::Avatar-->
                            <!--begin::Name-->
                            <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-5">{{$user->name ." ". $user->surname}}</a>
                            <!--end::Name-->
                            <!--begin::Position-->
                            {{--<div class="fs-5 fw-semibold text-muted mb-6 text-success">{{ $user->role->getLabel() }}</div>--}}
                            <div
                                class="badge badge-lg badge-light-primary d-inline mb-5">{{ $user->getRolName?->name }}</div>
                            <!--end::Position-->
                            <!--begin::Info-->
                            {{--<div class="d-flex flex-wrap flex-center">
                                <!--begin::Stats-->
                                <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                    <div class="fs-4 fw-bold text-gray-700">
                                        <span class="w-75px">6,900</span>
                                        <i class="ki-outline ki-arrow-up fs-3 text-success"></i>
                                    </div>
                                    <div class="fw-semibold text-muted">Earnings</div>
                                </div>
                                <!--end::Stats-->
                                <!--begin::Stats-->
                                <div class="border border-gray-300 border-dashed rounded py-3 px-3 mx-4 mb-3">
                                    <div class="fs-4 fw-bold text-gray-700">
                                        <span class="w-50px">130</span>
                                        <i class="ki-outline ki-arrow-down fs-3 text-danger"></i>
                                    </div>
                                    <div class="fw-semibold text-muted">Tasks</div>
                                </div>
                                <!--end::Stats-->
                                <!--begin::Stats-->
                                <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                    <div class="fs-4 fw-bold text-gray-700">
                                        <span class="w-50px">500</span>
                                        <i class="ki-outline ki-arrow-up fs-3 text-success"></i>
                                    </div>
                                    <div class="fw-semibold text-muted">Hours</div>
                                </div>
                                <!--end::Stats-->
                            </div>--}}
                            <!--end::Info-->
                        </div>
                        <!--end::Summary-->
                        <!--begin::Details toggle-->
                        <div class="d-flex flex-stack fs-4">
                            <div class="fw-bold rotate collapsible" data-bs-toggle="collapse" href="#kt_customer_view_details" role="button" aria-expanded="false" aria-controls="kt_customer_view_details">
                                <span class="ms-2 rotate-180">
                                    <i class="ki-outline ki-down fs-3"></i>
                                </span>
                            </div>

                            <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Kullanıcı şifresini güncelle">
                                <a href="#" class="btn btn-sm btn-light-danger"
                                   data-bs-toggle="modal" data-bs-target="#kt_modal_{{$user->id}}">
                                    <i class="ki-outline ki-key-square fs-3"></i>Şifreyi Sıfırla
                                </a>
                            </span>

                            <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Kullanıcı bilgilerini güncelle">
                                <a href="{{route("admin.users.edit", $user->slug)}}" class="btn btn-sm btn-light-primary"
                                   data-bs-toggle="" data-bs-target="#kt_modal_update_customer">
                                    <i class="ki-outline ki-message-edit fs-3"></i>Güncelle
                                </a>
                            </span>
                        </div>
                        <!--end::Details toggle-->
                        <div class="separator separator-dashed my-3"></div>
                        <!--begin::Details content-->
                        <div id="kt_customer_view_details" class="collapse show">
                            <div class="fs-6">
                                <!--begin::Badge-->
                                {{--<div class="badge badge-light-info d-inline">Premium user</div>--}}
                                <!--begin::Badge-->
                                <!--begin::Details item-->
                                <div class="fw-bold mt-5">Kaydeden</div>
                                <div class="text-gray-600">{{$user->createdBy->name ." ". $user->createdBy->surname}}</div>
                                <!--begin::Details item-->
                                <div class="fw-bold mt-2">Kayıt Tarihi</div>
                                <div class="text-gray-600">{{$user->created_at->format("d.m.Y - H:i")}}</div>
                                <!--begin::Details item-->
                                <div class="fw-bold mt-5">Son Güncelleyen</div>
                                <div class="text-gray-600">@if(isset($user->updatedBy?->name)) {{$user->updatedBy?->name ." ". $user->updatedBy?->surname}}@else - @endif</div>
                                <!--begin::Details item-->
                                <div class="fw-bold mt-2">Güncelleme Tarihi</div>
                                <div class="text-gray-600">@if(isset($user->updatedBy?->name)) {{$user->updated_at->format("d.m.Y - H:i")}}@else - @endif</div>
                            </div>
                        </div>
                        <!--end::Details content-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Sidebar-->

            <!--begin::Password Reinitialising Modal-->
            <div class="modal fade" tabindex="-1" id="kt_modal_{{$user->id}}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Şifre Sıfırlaması</h3>

                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                 data-bs-dismiss="modal" aria-label="Close">
                                <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                        class="path2"></span></i>
                            </div>
                            <!--end::Close-->
                        </div>

                        {{--<div class="modal-body text-center">
                            <b style="color: red; font-size: 18px">Dikkat !!!</b><br><br>
                            <p style="font-size: 16px">Yeni şifre <u style="color: red">{{$user->phone}}</u> olacaktır.</p><br><br>
                            <p style="font-size: 16px"><u style="color: red">Şifre sıfırlama</u> işlemine devam etmek istediğinizden emin misiniz ?</p>

                        </div>--}}
                        <div class="modal-body text-center">
                            <p style="color: red; font-size: 18px"><b>Dikkat !!!</b></p>
                            <p style="font-size: 16px">Kullanıcının şifresini <u style="color: red">sıfırlamak</u> üzeresiniz.
                                <br> Devam etmek istediğinizden <u style="color: red">emin misiniz?</u>
                            </p>
                        </div>

                        <div class="modal-footer justify-content-center">
                            <form action="{{route("admin.profile.password.reset", $user->slug)}}" method="POST">
                                @csrf
                                <button type="reset" class="btn btn-success me-20" data-bs-dismiss="modal">Hayır</button>
                                <button type="submit" class="btn btn-danger">Evet</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Password Reinitialising Modal-->

            <!--begin::Content-->
            <div class="flex-lg-row-fluid ms-lg-5">
                <!--begin:::Tabs-->
                <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#genel_bilgiler">Genel
                            Bilgiler</a>
                    </li>
                    <!--end:::Tab item-->
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#oturumlar">Oturum
                            Bilgileri</a>
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
                                    {{--<table class="table align-middle table-row-dashed gy-5" id="kt_table_users_login_session">
                                        <tbody class="fs-6 fw-semibold text-gray-600">
                                            <tr>
                                                <td>Email</td>
                                                <td>{{$user->email}}</td>
                                                <td class="text-end">
                                                    <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-bs-toggle="modal" data-bs-target="#kt_modal_update_email">
                                                        <i class="ki-outline ki-pencil fs-3"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Telefon</td>
                                                <td>{{$user->phone}}</td>
                                                <td class="text-end">
                                                    <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-bs-toggle="modal" data-bs-target="#kt_modal_update_password">
                                                        <i class="ki-outline ki-pencil fs-3"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Adres</td>
                                                <td>{{$user->address}}</td>
                                                <td class="text-end">
                                                    <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-bs-toggle="modal" data-bs-target="#kt_modal_update_role">
                                                        <i class="ki-outline ki-pencil fs-3"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>--}}
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
                                <div class="card-toolbar">
                                    <!--begin::Filter-->
                                    <button type="button" class="btn btn-sm btn-flex btn-light-primary" id="kt_modal_sign_out_sesions">
                                        <i class="ki-outline ki-entrance-right fs-3"></i>Tüm oturumları kapat
                                    </button>
                                    <!--end::Filter-->
                                </div>
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
    </div>



    {{--<div class="d-flex flex-column flex-xl-row">
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
                                'badge-danger' => $user->status == 0,
                                'badge-success d-inline' => $user->status == 1,
                                'badge-warning d-inline' => $user->status == 2,
                            ])>
                            {{ $user->name }}
                        </div>
                    </div>
                    <!--end::Status-->
                    <!--begin::Summary-->
                    <div class="d-flex flex-center flex-column mb-5">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-150px symbol-circle mb-7 pt-4">
                            <img src="{{$user?->getFirstMediaUrl("user")}}" alt="image"/>
                        </div>
                        <!--end::Avatar-->
                        <!--begin::Name-->
                        <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-5">{{$user->name}}</a>
                        <!--end::Name-->
                        <!--begin::Position-->
                        --}}{{--<div class="fs-5 fw-semibold text-muted mb-6 text-success">{{ $user->role->getLabel() }}</div>--}}{{--
                        <div
                            class="badge badge-lg badge-light-primary d-inline mb-5">{{ $user->role_id }}</div>
                        <!--end::Position-->
                        <!--begin::Info-->
                        --}}{{--<div class="d-flex flex-wrap flex-center">
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                <div class="fs-4 fw-bold text-gray-700">
                                    <span class="w-75px">6,900</span>
                                    <i class="ki-outline ki-arrow-up fs-3 text-success"></i>
                                </div>
                                <div class="fw-semibold text-muted">Earnings</div>
                            </div>
                            <!--end::Stats-->
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded py-3 px-3 mx-4 mb-3">
                                <div class="fs-4 fw-bold text-gray-700">
                                    <span class="w-50px">130</span>
                                    <i class="ki-outline ki-arrow-down fs-3 text-danger"></i>
                                </div>
                                <div class="fw-semibold text-muted">Tasks</div>
                            </div>
                            <!--end::Stats-->
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                <div class="fs-4 fw-bold text-gray-700">
                                    <span class="w-50px">500</span>
                                    <i class="ki-outline ki-arrow-up fs-3 text-success"></i>
                                </div>
                                <div class="fw-semibold text-muted">Hours</div>
                            </div>
                            <!--end::Stats-->
                        </div>--}}{{--
                        <!--end::Info-->
                    </div>
                    <!--end::Summary-->
                    <!--begin::Details toggle-->
                    <div class="d-flex flex-stack fs-4">
                        --}}{{--<div class="fw-bold rotate collapsible" data-bs-toggle="collapse" href="#kt_customer_view_details" role="button" aria-expanded="false" aria-controls="kt_customer_view_details">Detaylar
                            <span class="ms-2 rotate-180">
                                <i class="ki-outline ki-down fs-3"></i>
                            </span>
                        </div>--}}{{--
                        <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Kullanıcı bilgilerini güncelle">
                            <a href="{{route("admin.users.edit", $user->slug)}}" class="btn btn-sm btn-light-primary"
                               data-bs-toggle="" data-bs-target="#kt_modal_update_customer">Güncelle</a>
                        </span>
                    </div>
                    <!--end::Details toggle-->
                    --}}{{--<div class="separator separator-dashed my-3"></div>--}}{{--
                    <!--begin::Details content-->
                    --}}{{--<div id="kt_customer_view_details" class="collapse show">
                        <div class="py-5 fs-6">
                            <!--begin::Badge-->
                            --}}{{----}}{{--<div class="badge badge-light-info d-inline">Premium user</div>--}}{{----}}{{--
                            <div
                                @class([
                                    'badge',
                                    'badge-light-danger' => $user->status->value == 0,
                                    'badge-light-success' => $user->status->value == 1,
                                ])>
                                {{ $user->status->getLabel() }}
                            </div>
                            <!--begin::Badge-->
                            <!--begin::Details item-->
                            <div class="fw-bold mt-5">Account ID</div>
                            <div class="text-gray-600">ID-45453423</div>
                            <!--begin::Details item-->
                            <!--begin::Details item-->
                            <div class="fw-bold mt-5">Billing Email</div>
                            <div class="text-gray-600">
                                <a href="#" class="text-gray-600 text-hover-primary">info@keenthemes.com</a>
                            </div>
                            <!--begin::Details item-->
                            <!--begin::Details item-->
                            <div class="fw-bold mt-5">Billing Address</div>
                            <div class="text-gray-600">101 Collin Street,
                                <br />Melbourne 3000 VIC
                                <br />Australia</div>
                            <!--begin::Details item-->
                            <!--begin::Details item-->
                            <div class="fw-bold mt-5">Language</div>
                            <div class="text-gray-600">English</div>
                            <!--begin::Details item-->
                            <!--begin::Details item-->
                            <div class="fw-bold mt-5">Upcoming Invoice</div>
                            <div class="text-gray-600">54238-8693</div>
                            <!--begin::Details item-->
                            <!--begin::Details item-->
                            <div class="fw-bold mt-5">Tax ID</div>
                            <div class="text-gray-600">TX-8674</div>
                            <!--begin::Details item-->
                        </div>
                    </div>--}}{{--
                    <!--end::Details content-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
            <!--begin::Connected Accounts-->
            --}}{{--<div class="card mb-5 mb-xl-8">
                <!--begin::Card header-->
                <div class="card-header border-0">
                    <div class="card-title">
                        <h3 class="fw-bold m-0">Connected Accounts</h3>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-2">
                    <!--begin::Notice-->
                    <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-9 p-6">
                        <!--begin::Icon-->
                        <i class="ki-outline ki-design-1 fs-2tx text-primary me-4"></i>
                        <!--end::Icon-->
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack flex-grow-1">
                            <!--begin::Content-->
                            <div class="fw-semibold">
                                <div class="fs-6 text-gray-700">By connecting an account, you hereby agree to our
                                    <a href="#" class="me-1">privacy policy</a>and
                                    <a href="#">terms of use</a>.</div>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Notice-->
                    <!--begin::Items-->
                    <div class="py-2">
                        <!--begin::Item-->
                        <div class="d-flex flex-stack">
                            <div class="d-flex">
                                <img src="assets/media/svg/brand-logos/google-icon.svg" class="w-30px me-6" alt="" />
                                <div class="d-flex flex-column">
                                    <a href="#" class="fs-5 text-gray-900 text-hover-primary fw-bold">Google</a>
                                    <div class="fs-6 fw-semibold text-muted">Plan properly your workflow</div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <!--begin::Switch-->
                                <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input" name="google" type="checkbox" value="1" id="kt_modal_connected_accounts_google" checked="checked" />
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <span class="form-check-label fw-semibold text-muted" for="kt_modal_connected_accounts_google"></span>
                                    <!--end::Label-->
                                </label>
                                <!--end::Switch-->
                            </div>
                        </div>
                        <!--end::Item-->
                        <div class="separator separator-dashed my-5"></div>
                        <!--begin::Item-->
                        <div class="d-flex flex-stack">
                            <div class="d-flex">
                                <img src="assets/media/svg/brand-logos/github.svg" class="w-30px me-6" alt="" />
                                <div class="d-flex flex-column">
                                    <a href="#" class="fs-5 text-gray-900 text-hover-primary fw-bold">Github</a>
                                    <div class="fs-6 fw-semibold text-muted">Keep eye on on your Repositories</div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <!--begin::Switch-->
                                <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input" name="github" type="checkbox" value="1" id="kt_modal_connected_accounts_github" checked="checked" />
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <span class="form-check-label fw-semibold text-muted" for="kt_modal_connected_accounts_github"></span>
                                    <!--end::Label-->
                                </label>
                                <!--end::Switch-->
                            </div>
                        </div>
                        <!--end::Item-->
                        <div class="separator separator-dashed my-5"></div>
                        <!--begin::Item-->
                        <div class="d-flex flex-stack">
                            <div class="d-flex">
                                <img src="assets/media/svg/brand-logos/slack-icon.svg" class="w-30px me-6" alt="" />
                                <div class="d-flex flex-column">
                                    <a href="#" class="fs-5 text-gray-900 text-hover-primary fw-bold">Slack</a>
                                    <div class="fs-6 fw-semibold text-muted">Integrate Projects Discussions</div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <!--begin::Switch-->
                                <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input" name="slack" type="checkbox" value="1" id="kt_modal_connected_accounts_slack" />
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <span class="form-check-label fw-semibold text-muted" for="kt_modal_connected_accounts_slack"></span>
                                    <!--end::Label-->
                                </label>
                                <!--end::Switch-->
                            </div>
                        </div>
                        <!--end::Item-->
                    </div>
                    <!--end::Items-->
                </div>
                <!--end::Card body-->
                <!--begin::Card footer-->
                <div class="card-footer border-0 d-flex justify-content-center pt-0">
                    <button class="btn btn-sm btn-light-primary">Save Changes</button>
                </div>
                <!--end::Card footer-->
            </div>--}}{{--
            <!--end::Connected Accounts-->
        </div>
        <!--end::Sidebar-->
        <!--begin::Content-->
        <div class="flex-lg-row-fluid ms-lg-15">
            <!--begin:::Tabs-->
            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#genel_bilgiler">Genel
                        Bilgiler</a>
                </li>
                <!--end:::Tab item-->
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#oturumlar">Oturum
                        Bilgileri</a>
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
                                --}}{{--<table class="table align-middle table-row-dashed gy-5" id="kt_table_users_login_session">
                                    <tbody class="fs-6 fw-semibold text-gray-600">
                                        <tr>
                                            <td>Email</td>
                                            <td>{{$user->email}}</td>
                                            <td class="text-end">
                                                <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-bs-toggle="modal" data-bs-target="#kt_modal_update_email">
                                                    <i class="ki-outline ki-pencil fs-3"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Telefon</td>
                                            <td>{{$user->phone}}</td>
                                            <td class="text-end">
                                                <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-bs-toggle="modal" data-bs-target="#kt_modal_update_password">
                                                    <i class="ki-outline ki-pencil fs-3"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Adres</td>
                                            <td>{{$user->address}}</td>
                                            <td class="text-end">
                                                <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-bs-toggle="modal" data-bs-target="#kt_modal_update_role">
                                                    <i class="ki-outline ki-pencil fs-3"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>--}}{{--
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
                            <div class="card-toolbar">
                                <!--begin::Filter-->
                                <button type="button" class="btn btn-sm btn-flex btn-light-primary" id="kt_modal_sign_out_sesions">
                                    <i class="ki-outline ki-entrance-right fs-3"></i>Tüm oturumları kapat
                                </button>
                                <!--end::Filter-->
                            </div>
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
    </div>--}}
@endsection

@section("script")
    <script src="{{asset("assets/plugins/custom/datatables/datatables.bundle.js")}}"></script>
    <script src="{{asset("assets/js/custom/apps/ecommerce/catalog/products.js")}}"></script>
@endsection
