@php use Carbon\Carbon; @endphp
@extends('layouts.admin')
@section("title")
    Profilim |
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" type="text/css">
@endsection

@section("breadcrumb")
    <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Profilim</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="{{route("admin.dashboard")}}" class="text-muted text-hover-primary">Anasayfa</a>
                </li>
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
        <div class="d-flex flex-column flex-xl-row">
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
                            <div class="badge badge-lg badge-light-primary d-inline mb-5">{{$user->getRolName?->name}}</div>
                            <!--end::Position-->
                            <!--begin::Info-->

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

                            <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="">
                                <a href="#" class="btn btn-sm btn-light-success"
                                   data-bs-toggle="modal" data-bs-target="#kt_modal_update_role">
                                    <i class="ki-outline ki-shield-tick fs-3"></i>Yetkilerim
                                </a>
                            </span>

                            <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="">
                                <a href="{{route("admin.profile.edit", $user->slug)}}" class="btn btn-sm btn-light-primary"
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

            <!--begin::Role Permissions Modal-->
            <div class="modal fade" id="kt_modal_update_role" role="dialog" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-750px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header">
                            <!--begin::Modal title-->
                            <h2 class="">Rol ve Yetkilerim</h2>
                            <!--end::Modal title-->
                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                <i class="ki-outline ki-cross fs-1"></i>
                            </div>
                            <!--end::Close-->
                        </div>
                        <!--end::Modal header-->
                        <!--begin::Modal body-->
                        <div class="modal-body scroll-y mx-5">
                            <!--begin::Form-->
                            <form id="" class="form" action="#">
                                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_role_header" data-kt-scroll-wrappers="#kt_modal_update_role_scroll" data-kt-scroll-offset="300px">
                                    <div class="fv-row mb-2">
                                        <label class="fs-5 form-label mb-2">
                                            <span class="">Rol Adı: </span>
                                        </label>
                                        <span class="fs-4 fw-bold">{{$role->name}}</span>
                                    </div>
                                    <div class="fv-row mb-4">
                                        @foreach(\App\Enums\PermissionsEnum::cases() as $permission)
                                            <div class="row mb-2">
                                                <div class="form-label fw-bold ms-4">{{$permission->getLabel()}}</div>
                                                <div class="d-flex mb-2 ms-4">
                                                    <!--begin::Checkbox-->
                                                    <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20 ms-4">
                                                        <input class="form-check-input permissions" type="checkbox" name="permissions[]"
                                                               @checked($role->hasPermissionTo("view_" . $permission->name()))
                                                               value="view_{{$permission->name()}}" disabled/>
                                                        <span class="form-check-label text-gray-900">Listeleme</span>
                                                    </label>
                                                    <!--end::Checkbox-->
                                                    <!--begin::Checkbox-->
                                                    <label class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                        <input class="form-check-input permissions" type="checkbox" name="permissions[]"
                                                               @checked($role->hasPermissionTo("create_" . $permission->name()))
                                                               value="create_{{$permission->name()}}" disabled/>
                                                        <span class="form-check-label text-gray-900 text-gray-900">Ekleme</span>
                                                    </label>
                                                    <!--end::Checkbox-->
                                                    <!--begin::Checkbox-->
                                                    <label class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                        <input class="form-check-input permissions" type="checkbox" name="permissions[]"
                                                               @checked($role->hasPermissionTo("update_" . $permission->name()))
                                                               value="update_{{$permission->name()}}" disabled/>
                                                        <span class="form-check-label text-gray-900">Güncelleme</span>
                                                    </label>
                                                    <!--end::Checkbox-->
                                                    <!--begin::Checkbox-->
                                                    <label class="form-check form-check-custom form-check-solid">
                                                        <input class="form-check-input permissions" type="checkbox" name="permissions[]"
                                                               @checked($role->hasPermissionTo("delete_" . $permission->name()))
                                                               value="delete_{{$permission->name()}}" disabled/>
                                                        <span class="form-check-label text-gray-900">Silme</span>
                                                    </label>
                                                    <!--end::Checkbox-->
                                                </div>
                                                <div class="separator"></div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
            <!--end::Role Permissions Modal-->

            <!--begin::Content-->
            <div class="flex-lg-row-fluid ms-lg-5">
                <!--begin:::Tabs-->
                <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#genel_bilgiler">Genel Bilgilerim</a>
                    </li>
                    <!--end:::Tab item-->
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#oturumlar">Oturum Bilgilerim</a>
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
                                            <td>E-mail:</td>
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
                            <form id="" class="form" novalidate="novalidate" action="{{route('admin.profile.email.update')}}" method="POST">
                                @csrf
                                <!--begin::Card-->
                                <div class="card pt-4 mb-6 mb-xl-9">
                                    <!--begin::Card header-->
                                    <div class="card-header border-0">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h2>E-mail Güncellenmesi</h2>
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
                                                    <label for="emailaddress" class="form-label fs-6 fw-bold mb-3">Yeni e-mail</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input name="email" type="email" class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror"
                                                           id="emailaddress" placeholder="Yeni e-mail adresinizi giriniz" />
                                                    <!--end::Input-->
                                                    <!--begin::Description-->
                                                    @error('email') <div class="text-danger fs-7">{{$message}}</div> @enderror
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!-- İkinci Sütun -->
                                            <div class="col">
                                                <!--begin::Input group-->
                                                <div class="mb-4 fv-row">
                                                    <!--begin::Label-->
                                                    <label for="confirmemailpassword" class="form-label fs-6 fw-bold mb-3">Şifre doğrulaması</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="password" class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror"
                                                           name="password" id="confirmemailpassword" placeholder="Şifrenizi giriniz"/>
                                                    <!--end::Input-->
                                                    @error('password') <div class="text-danger fs-7">{{$message}}</div> @enderror
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                        <div class="d-flex justify-content-end">
                                            <!--begin::Button-->
                                            <button type="submit" id="" class="btn btn-primary">
                                                <span class="indicator-label">Sauvegarder</span>
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
                            <div class="card pt-4 mb-6 mb-xl-9">
                            <!--begin::Card header-->
                            <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#collapseCard">
                                <!--begin::Card title-->
                                <h2 class="card-title">Şifre Güncellenmesi</h2>
                                <div class="card-toolbar rotate-180">
                                    <i class="ki-duotone ki-down fs-1"></i>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <form id="" class="form" novalidate="novalidate" action="{{route('admin.profile.password.update')}}" method="POST">
                                @csrf
                                <div class="collapse" id="collapseCard">
                                    <div class="card-body pt-5 pb-5">
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label for="currentpassword" class="form-label fs-6 fw-bold mb-3">Geçerli şifreniz</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="password" class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror"
                                                   name="password" id="currentpassword" placeholder="Geçerli şifrenizi giriniz"/>
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
                                                    <label for="newpassword" class="form-label fs-6 fw-bold mb-3">Yeni şifreniz</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="password" class="form-control form-control-lg form-control-solid @error('new_password') is-invalid @enderror"
                                                           name="new_password" id="newpassword" placeholder="Yeni şifrenizi giriniz"/>
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
                                                    <label for="confirmpassword" class="form-label fs-6 fw-bold mb-3">Tekrar giriniz</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="password" class="form-control form-control-lg form-control-solid @error('new_password_confirmation') is-invalid @enderror"
                                                           name="new_password_confirmation" id="confirmpassword" placeholder="Yeni şifrenizi tekrar giriniz"/>
                                                    <!--end::Input-->
                                                    @error('new_password_confirmation') <div class="text-danger fs-7">{{$message}}</div> @enderror
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                        </div>
                                        <div class="form-text mb-5 pt-0 text-gray-900">(Şifreniz en az 8 karakter uzunluğunda olmalı ve özel karakterler içermelidir)</div>
                                        <!--end::Input group-->
                                        <div class="d-flex justify-content-end">
                                            <!--begin::Button-->
                                            <button type="submit" id="" class="btn btn-primary">
                                                <span class="indicator-label">Sauvegarder</span>
                                            </button>
                                            <!--end::Button-->
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!--end::Card body-->
                            </div>
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
                                    <h2>Son Erişim</h2>
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
                                                <th>Son Erişim Tarihi</th>
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
@endsection

@section("scripts")
    <script src="{{asset("assets/plugins/custom/datatables/datatables.bundle.js")}}"></script>
    <script src="{{asset('assets/js/custom/apps/ecommerce/catalog/categories.js')}}"></script>
@endsection
