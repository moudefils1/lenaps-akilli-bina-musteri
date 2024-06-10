@extends('layouts.admin')
@section("title")
    Pasif | Kullanıcılar | Panel Yönetimi |
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" type="text/css">
@endsection

@section("breadcrumb")
    <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Pasif</h1>
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

@section('content')
    <div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Products-->
        <div class="card card-flush">
            <!--begin::Card header-->
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                        <input type="text" data-kt-ecommerce-product-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Ara..." />
                    </div>
                    <!--end::Search-->
                </div>
                <!--end::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                    <!--begin::Add product-->
                    <a href="{{route("admin.users.index")}}" class="btn btn-sm btn-flex btn-light-primary">
                        <i class="ki-outline ki-eye fs-3"></i>Aktif Kullanıcılar
                    </a>
                    <!--end::Add product-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_table">
                    <thead>
                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">
                            #
                        </th>
                        <th class="min-w-125px">Ad ve Soyad</th>
                        <th class="min-w-125px">Telefon</th>
                        <th class="min-w-125px">Email</th>
                        <th class="min-w-125px">Rol</th>
                        <th class="min-w-125px">Kayıt Tarih</th>
                        <th class="min-w-125px">Silme Tarih</th>
                        <th class="text-end min-w-70px">İşlemler</th>
                    </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                    @foreach($deletedUsers as $user)
                        <tr class="text-danger">
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    {{$loop?->iteration}}
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <!--begin::Thumbnail-->
                                    <div class="symbol symbol-50px">
                                    @if($user?->getFirstMedia("user"))
                                        <span class="symbol-label" style="background-image:url({{$user?->getFirstMediaUrl("user")}});"></span>
                                    @else
                                        <span class="symbol-label" style="background-image:url({{asset("assets/media/svg/avatars/blank.svg")}});"></span>
                                    @endif
                                    </div>
                                    <!--end::Thumbnail-->
                                    <div class="ms-5">
                                        <!--begin::Title-->
                                        <span>{{$user?->name ." ". $user->surname}}</span>
                                        <!--end::Title-->
                                    </div>
                                </div>
                            </td>
                            <td>{{$user?->phone}}</td>
                            <td>{{$user?->email}}</td>
                            <td>{{ $user?->getRolName?->name }}</td>
                            <td class="text-center">{{$user->created_at?->format("d.m.Y - H:i")}}</td>
                            <td class="text-center">{{$user->deleted_at?->format("d.m.Y - H:i")}}</td>
                            <td class="text-end">
                                <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                   data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">İşlemler
                                    <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                     data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    @if($user?->id !== auth()->user()?->id)
                                        <div class="menu-item px-1">
                                            <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                               data-bs-target="#kt_modal_{{$loop->iteration}}">
                                                <i class="ki-outline ki-arrow-circle-left fs-3"></i>&emsp;Geri Al
                                            </a>
                                        </div>
                                    @endif

                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu-->
                            </td>
                        </tr>
                        <!--begin::Restore Modalı-->
                        <div class="modal fade" tabindex="-1" id="kt_modal_{{$loop?->iteration}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title">Kullanıcı</h3>

                                        <!--begin::Close-->
                                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                             data-bs-dismiss="modal" aria-label="Close">
                                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                                    class="path2"></span></i>
                                        </div>
                                        <!--end::Close-->
                                    </div>

                                    <div class="modal-body text-center">
                                        <label class="form-label fs-3 text-danger"><b>DİKKAT</b></label>
                                        <div class="fs-4 pt-4">
                                            Aşağıdaki bilgilere ait kullanıcıyı <span class="text-danger">geri almak</span> üzeresiniz:<br><br>
                                            <u>Ad ve Soyad:</u> <b>{{$user?->name ." ". $user->surname}}</b> <br>
                                            <u>Email:</u> <b>{{$user?->email}}</b><br><br>
                                            Devam etmek istediğinizden emin misiniz?
                                        </div>
                                    </div>

                                    <div class="modal-footer justify-content-center">
                                        <form action="{{route("admin.users.restore", $user->slug)}}" method="post">
                                            @csrf
                                            <button type="reset" class="btn btn-success me-20" data-bs-dismiss="modal">Hayır</button>
                                            <button type="submit" class="btn btn-danger">Evet</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Restore Modalı-->
                    @endforeach
                    </tbody>
                </table>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Products-->
    </div>





@endsection
@section('scripts')
    <script src="{{asset("assets/plugins/custom/datatables/datatables.bundle.js")}}"></script>
    <script src="{{asset("assets/js/custom/apps/ecommerce/catalog/products.js")}}"></script>
@endsection
