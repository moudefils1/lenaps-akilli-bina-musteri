@extends("layouts.admin")

@section("title")
    Listele | Gatewaye Yönetimi | Donanım Yönetimi |
@endsection

@section("styles")
    <link href="{{asset("assets/plugins/custom/datatables/datatables.bundle.css")}}" rel="stylesheet" type="text/css" />
@endsection

@section("breadcrumb")
    <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Listele</h1>
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
                <li class="breadcrumb-item text-muted">Donanım Yönetimi</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Gateway Yönetimi</li>
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
        <!--begin::Products-->
        <div class="card card-flush">
            <!--begin::Card header-->
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                        <input type="text" data-kt-ecommerce-category-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Ara..." />
                    </div>
                    <!--end::Search-->
                </div>
                <!--end::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                    <!--begin::Add product-->
                    <a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_add_gateway" class="btn btn-sm btn-flex btn-light-primary">
                        <i class="ki-outline ki-plus-square fs-3"></i> Ekle
                    </a>
                    <!--end::Add product-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_category_table">
                    <thead>
                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">
                            #
                        </th>
                        <th class="text-start min-w-200px">Adı</th>
                        <th class="text-start min-w-100px">Mac Adresi</th>
                        <th class="text-start min-w-100px">Markası</th>
                        <th class="text-start min-w-100px">Hassasiyet Oranı</th>
                        <th class="text-start min-w-100px">Durum</th>
                        <th class="text-start min-w-100px">Kayıt Tarihi</th>
                        <th class="text-start min-w-70px">Güncelleme Tarihi</th>
                        <th class="text-end min-w-70px">İşlemler</th>
                    </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                    @foreach($gateways as $gateway)
                        <tr>
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    {{$loop->iteration}}
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <!--begin::Thumbnail-->

                                    <!--end::Thumbnail-->
                                    <div class="">
                                        <!--begin::Title-->
                                        <a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bold" data-kt-ecommerce-product-filter="product_name"
                                           {{--data-bs-toggle="modal" data-bs-target="#kt_modal_add_gateway_{{$loop->iteration}}"--}}>
                                            {{$gateway->name}}
                                        </a>
                                        <!--end::Title-->
                                    </div>
                                </div>
                            </td>
                            <td class="text-start pe-0">
                                <span class="fw-bold">{{$gateway->mac}}</span>
                            </td>
                            <td class="text-start pe-0">
                                <span class="fw-bold">{{$gateway->brand}}</span>
                            </td>
                            <td class="text-start pe-0">
                                <span class="fw-bold">{{$gateway->sensitivity_rate}}</span>
                            </td>
                            <td class="text-start pe-0">
                                <span class="fw-bold">
                                    <div
                                        @class([
                                            'badge',
                                            'badge-success' => $gateway->status->value == 1,
                                            'badge-danger' => $gateway->status->value == 2,
                                        ])>
                                        {{ $gateway->status->getLabel() }}
                                    </div>
                                </span>
                            </td>
                            <td class="text-start pe-0">
                                <span class="fw-bold">{{$gateway->created_at->format("d.m.Y")}}</span>
                            </td>
                            <td class="text-start pe-0">
                                <span class="fw-bold">@if(isset($gateway->updatedBy?->name)) {{$gateway->updated_at->format("d.m.Y")}} @endif</span>
                            </td>
                            <td class="text-end">
                                <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                   data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">İşlemler
                                    <i class="ki-outline ki-down fs-5 ms-1"></i>
                                </a>
                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    {{--<div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                           data-bs-target="#kt_modal_update_role_{{$loop->iteration}}">
                                            Göster
                                        </a>
                                    </div>--}}
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        {{--<a href="{{route("admin.role-permissions.edit", $role->name)}}" class="menu-link px-3">Güncelle</a>--}}
                                        <a href="{{route("admin.gateways.edit", $gateways->slug)}}" class="menu-link px-3">
                                            <i class="ki-outline ki-message-edit fs-3"></i>&emsp;Güncelle
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                           data-bs-target="#kt_modal_{{$loop->iteration}}">
                                            <i class="ki-outline ki-trash fs-3"></i>&emsp;Sil
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu-->
                            </td>
                        </tr>

                        <!--BEGIN::MODALS-->
                        <!--begin::Sil Modalı-->
                        <div class="modal fade" tabindex="-1" id="kt_modal_{{$loop->iteration}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title">Gateway</h3>
                                        <!--begin::Close-->
                                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                             data-bs-dismiss="modal" aria-label="Close">
                                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                                    class="path2"></span></i>
                                        </div>
                                        <!--end::Close-->
                                    </div>

                                    <div class="modal-body text-center">
                                        <p style="color: red; font-size: 18px"><b>Dikkat !!!</b></p>
                                        <p style="font-size: 16px">Bu işlem kaydınızı sistemden tamamen <u style="color: red">silecektir.</u>
                                            <br> Devam etmek istediğinizden <u style="color: red">emin misiniz?</u>
                                        </p>
                                    </div>

                                    <div class="modal-footer justify-content-center">
                                        <button type="reset" class="btn btn-success me-20" data-bs-dismiss="modal">Hayır</button>
                                        <form action="{{route("admin.gateways.destroy", $gateway)}}" method="post">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="btn btn-danger">Evet</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Sil Modalı-->


                        {{--<!--begin::Role Users Modal-->
                        <div class="modal fade" id="kt_modal_role_users_{{$loop->iteration}}" role="dialog" tabindex="-1" aria-hidden="true">
                            <!--begin::Modal dialog-->
                            <div class="modal-dialog modal-dialog-centered mw-750px">
                                <!--begin::Modal content-->
                                <div class="modal-content">
                                    <!--begin::Modal header-->
                                    <div class="modal-header">
                                        <!--begin::Modal title-->
                                        <h2 class="">Rol Kullanıcıları</h2>
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
                                        <!--begin::Modal body-->
                                        <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                                            <div class="fv-row mb-2">
                                                <label class="fs-5 form-label mb-2">
                                                    <span class="">Rol Adı: </span>
                                                </label>
                                                <span class="fs-4 fw-bold">{{$roleWithUsers["role"]->name}}</span>
                                            </div>
                                            --}}{{--<!--begin::Heading-->
                                            <div class="text-center mb-13">
                                                <!--begin::Title-->
                                                <h1 class="mb-3">{{$roleWithUsers["role"]->name}}</h1>
                                                <!--end::Title-->
                                                <!--begin::Description-->
                                                <div class="text-muted fw-semibold fs-5">If you need more info, please check out our
                                                    <a href="#" class="link-primary fw-bold">Users Directory</a>.</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Heading-->--}}{{--
                                            <!--begin::Users-->
                                            <div class="mb-15">
                                                @foreach($roleWithUsers["users"] as $user)
                                                    <!--begin::List-->
                                                    <div class="mh-375px scroll-y me-n7 pe-7">
                                                        <!--begin::User-->
                                                        <div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
                                                            <!--begin::Details-->
                                                            <div class="d-flex align-items-center">
                                                                <!--begin::Avatar-->
                                                                <div class="symbol symbol-35px symbol-circle">
                                                                    @if($user?->getFirstMediaUrl("user"))
                                                                        <img alt="Pic" src="{{$user?->getFirstMediaUrl("user")}}" />
                                                                    @else
                                                                        <img alt="Pic" src="{{asset("assets/media/svg/files/blank-image.svg")}}" />
                                                                    @endif
                                                                </div>
                                                                <!--end::Avatar-->
                                                                <!--begin::Details-->
                                                                <div class="ms-6">
                                                                    <!--begin::Name-->
                                                                    <a href="#" class="d-flex align-items-center fs-5 fw-bold text-gray-900 text-hover-primary">{{$user->name ." ". $user->surname}}
                                                                        <span class="badge badge-light fs-8 fw-semibold ms-2">
                                                                            <div
                                                                                @class([
                                                                                    'badge',
                                                                                    'badge-danger' => $user->status->value == 0,
                                                                                    'badge-success' => $user->status->value == 1,
                                                                                    'badge-warning' => $user->status->value == 2,
                                                                                ])>
                                                                                {{ $user->status->getLabel() }}
                                                                            </div>
                                                                        </span>
                                                                    </a>
                                                                    <!--end::Name-->
                                                                    <!--begin::Email-->
                                                                    <div class="fw-semibold text-muted">{{$user->email}}</div>
                                                                    <!--end::Email-->
                                                                </div>
                                                                <!--end::Details-->
                                                            </div>
                                                            <!--end::Details-->
                                                            <!--begin::Stats-->
                                                            <div class="d-flex">
                                                                <!--begin::Sales-->
                                                                <div class="text-end">
                                                                    <div class="fs-5 fw-bold text-gray-900">{{$user?->phone}}</div>
                                                                    <div class="fs-7 text-muted">{{$user?->address}}</div>
                                                                </div>
                                                                <!--end::Sales-->
                                                            </div>
                                                            <!--end::Stats-->
                                                        </div>
                                                        <!--end::User-->
                                                    </div>
                                                    <!--end::List-->
                                                @endforeach
                                            </div>
                                            <!--end::Users-->
                                            --}}{{--<!--begin::Notice-->
                                            <div class="d-flex justify-content-between">
                                                <!--begin::Label-->
                                                <div class="fw-semibold">
                                                    <label class="fs-6">Adding Users by Team Members</label>
                                                    <div class="fs-7 text-muted">If you need more info, please check budget planning</div>
                                                </div>
                                                <!--end::Label-->
                                                <!--begin::Switch-->
                                                <label class="form-check form-switch form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="" checked="checked" />
                                                    <span class="form-check-label fw-semibold text-muted">Allowed</span>
                                                </label>
                                                <!--end::Switch-->
                                            </div>
                                            <!--end::Notice-->--}}{{--
                                        </div>
                                        <!--end::Modal body-->
                                    </div>
                                    <!--end::Modal body-->
                                </div>
                                <!--end::Modal content-->
                            </div>
                            <!--end::Modal dialog-->
                        </div>
                        <!--end::Role Users Modal-->--}}
                        <!--END::MODALS-->
                    @endforeach
                    </tbody>
                </table>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Products-->
    </div>

    <!--begin::Gateway Ekleme Modal-->
    <div class="modal fade" id="kt_modal_add_gateway" role="dialog" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-750px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2 class="">Yeni Gateway Oluştur</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <form id="" action="{{route("admin.gateways.store")}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body scroll-y mx-5">
                        <div class="row mb-2">
                            <div class="col">
                                <!--begin::Label-->
                                <label class="required form-label">Gateway Adı</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="name"
                                       class="form-control mb-2 @error('name') is-invalid @enderror"
                                       placeholder="Gateway adını giriniz" value="{{old('name')}}"/>
                                <!--end::Input-->
                                @error('name')<div class="fs-7 text-danger">{{$message}}</div>@enderror
                            </div>
                            <div class="col">
                                <!--begin::Label-->
                                <label class="required form-label">Mac Adresi</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="mac"
                                       class="form-control mb-2 @error('mac') is-invalid @enderror"
                                       placeholder="Gateway Mac adresini giriniz" value="{{old('mac')}}"/>
                                <!--end::Input-->
                                @error('mac')<div class="fs-7 text-danger">{{$message}}</div>@enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <!--begin::Label-->
                                <label class="required form-label">Marka Adı</label>
                                <!--end::Label-->
                                <!--begin::Select2-->
                                <select class="form-select mb-2" name="brand" data-control="select2" data-hide-search="false"
                                        data-placeholder="Marka Seçiniz" id="">
                                    <option></option>
                                    {{--@foreach($brands as $brand)
                                       <option value="{{ $brand->id }}" {{ old('brand') == $brand->id ? 'selected' : '' }}>
                                           {{ $brand->name }}
                                       </option>
                                   @endforeach--}}
                                </select>
                                <!--end::Select2-->
                                @error('brand') <div class="text-danger fs-7">{{$message}}</div> @enderror
                            </div>
                            <div class="col">
                                <!--begin::Label-->
                                <label class="required form-label">Hassasiyet Oranı</label>
                                <!--end::Label-->
                                <!--begin::Select2-->
                                <select class="form-select mb-2" name="sensitivity_rate" data-control="select2" data-hide-search="false"
                                        data-placeholder="Hassasiyet Oranı Seçiniz" id="">
                                    <option></option>
                                    {{--@foreach($sensitivity_rates as $rate)
                                        <option value="{{ $rate->id }}" {{ old('sensitivity_rate') == $rate->id ? 'selected' : '' }}>
                                            {{ $rate->name }}
                                        </option>
                                    @endforeach--}}
                                </select>
                                <!--end::Select2-->
                                @error('sensitivity_rate') <div class="text-danger fs-7">{{$message}}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <!--end::Modal body-->
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Gateway Ekleme Modal-->
@endsection

@section("scripts")
    <script src="{{asset("assets/plugins/custom/datatables/datatables.bundle.js")}}"></script>
    <script src="{{asset("assets/js/custom/apps/ecommerce/catalog/categories.js")}}"></script>
@endsection
