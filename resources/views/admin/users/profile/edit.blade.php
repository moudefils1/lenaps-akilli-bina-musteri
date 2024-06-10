@php use App\Enums\StatusEnum;use App\Enums\UserRoleEnum; @endphp
@extends('layouts.admin')
@section("title")
    Güncelle | Profilim |
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" type="text/css">
@endsection

@section("breadcrumb")
    <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Güncelle</h1>
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
                <li class="breadcrumb-item text-muted">Profilim</li>
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
        <form id="" class="form d-flex flex-column flex-lg-row" action="{{route("admin.profile.update", $user)}}"
          method="post"
          enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <!--begin::Aside column-->
        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
            <!--begin::Thumbnail settings-->
            <div class="card card-flush py-0">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2>Profil Resmi</h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body text-center pt-0">
                    <!--begin::Image input-->
                    <!--begin::Image input placeholder-->
                    @if($user?->getFirstMedia("user"))
                        <style>.image-input-placeholder {
                                background-image: url({{$user->getFirstMediaUrl("user")}});
                            }

                            [data-bs-theme="dark"] .image-input-placeholder {
                                background-image: url({{$user->getFirstMediaUrl("user")}});
                            }
                        </style>
                    @else
                        <style>.image-input-placeholder {
                                background-image: url({{asset("assets/media/svg/avatars/blank.svg")}});
                            }

                            [data-bs-theme="dark"] .image-input-placeholder {
                                background-image: url({{asset("assets/media/svg/avatars/blank-dark.svg")}});
                            }
                        </style>
                    @endif
                    <!--end::Image input placeholder-->
                    <!--begin::Image input-->
                    <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3"
                         data-kt-image-input="true">
                        <!--begin::Preview existing avatar-->
                        <div class="image-input-wrapper w-150px h-150px"></div>
                        <!--end::Preview existing avatar-->
                        <!--begin::Label-->
                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                               data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Değiştir">
                            <!--begin::Icon-->
                            <i class="ki-outline ki-pencil fs-7"></i>
                            <!--end::Icon-->
                            <!--begin::Inputs-->
                            <input type="file" name="image" accept=".jpg, .jpeg, .png, .gif, .svg"/>
                            <input type="hidden" name="avatar_remove"/>
                            <!--end::Inputs-->
                        </label>
                        <!--end::Label-->
                        <!--begin::Cancel-->
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                              data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="İptal">
                            <i class="ki-outline ki-cross fs-2"></i>
                        </span>
                        <!--end::Cancel-->
                        <!--begin::Remove-->
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                              data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Kaldır">
                            <i class="ki-outline ki-cross fs-2"></i>
                        </span>
                        <!--end::Remove-->
                    </div>
                    <!--end::Image input-->
                    <!--begin::Description-->
                    <div class="text-muted fs-7">Sadece *.png, *.jpg, *.jpeg ve *.svg uzantılı resimler kabul edilir.</div>
                    <!--end::Description-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Thumbnail settings-->
        </div>
        <!--end::Aside column-->
        <!--begin::Main column-->
        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
            <!--begin::General options-->
            <div class="card card-flush py-4">
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Input group-->
                    <div class="row mb-4">
                        <!-- İlk Sütun -->
                        <div class="col">
                            <!--begin::Label-->
                            <label class="form-label"> Rol </label>
                            <!--end::Label-->
                            <!--begin::Select2-->
                            <input class="form-control mb-2 text-bg-secondary" placeholder="{{$user->getRolName->name}}" readonly>
                            <input type="hidden" name="role_id" value="{{$user?->role_id}}">
                        </div>
                        <!-- İkinci Sütun -->
                        <div class="col">
                            <!--begin::Label-->
                            <label class="form-label">Statut</label>
                            <!--end::Label-->
                            <!--begin::Select2-->
                            <input class="form-control mb-2 text-bg-secondary" placeholder="{{$user->status?->getLabel()}}" value="" readonly>
                            <input type="hidden" name="status" value="{{$user?->status}}">
                        </div>
                    </div>
                    <!--begin::Input group-->
                    <div class="row mb-4">
                        <div class="col">
                            <!--begin::Label-->
                            <label class="required form-label" for="keywords">Ad</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="name"
                                   class="form-control mb-2 @error('name') is-invalid @enderror"
                                   placeholder="Adınızı giriniz" value="{{old('name', $user->name)}}"/>
                            <!--end::Input-->
                            <!--begin::Description-->
                            @error('name') <div class="fs-7 text-danger">{{$message}}</div> @enderror
                            <!--end::Description-->
                        </div>
                        <div class="col">
                            <!--begin::Label-->
                            <label class="required form-label" for="keywords">Soyad</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="surname"
                                   class="form-control mb-2 @error('surname') is-invalid @enderror"
                                   placeholder="Soyadınızı giriniz" value="{{old('surname', $user->surname)}}"/>
                            <!--end::Input-->
                            <!--begin::Description-->
                            @error('surname') <div class="fs-7 text-danger">{{$message}}</div> @enderror
                            <!--end::Description-->
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-4">
                        <!-- İlk Sütun -->
                        <div class="col">
                            <!--begin::Label-->
                            <label class="required form-label">Telefon</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="number" name="phone"
                                   class="form-control mb-2 @error("phone") is-valid @enderror" max="99999999999"
                                   placeholder="Telefon numaranızı giriniz" value="{{old("phone", $user->phone)}}"/>
                            <!--end::Input-->
                            <!--begin::Description-->
                            @error('phone') <div class="fs-7 text-danger">{{$message}}</div>@enderror
                            <!--end::Description-->
                        </div>
                        <!-- İkinci Sütun -->
                        <div class="col">
                            <!--begin::Label-->
                            <label class="form-label">Email</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control mb-2 text-bg-secondary" placeholder="{{$user?->email}}" readonly>
                            <input type="hidden" name="email" value="{{$user?->email}}">
                            <!--end::Input-->
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div>
                        <!--begin::Label-->
                        <label class="form-label">Adresse</label>
                        <!--end::Label-->
                        <!--begin::Editor-->
                        <textarea name="address" id="kt_docs_tinymce_basic" placeholder="Açık adresinizi giriniz"
                                  class="form-control min-h-100px mb-2">{{old('address', $user->address)}}</textarea>
                        <!--end::Editor-->
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Card header-->
            </div>
            <!--end::General options-->
            <div class="d-flex justify-content-end">
                {{--<!--begin::Button-->
                <a href="{{route("admin.profile.show", $user->slug)}}" id="kt_ecommerce_add_product_cancel"
                   class="btn btn-light me-5">Geri</a>
                <!--end::Button-->--}}
                <!--begin::Button-->
                <button type="submit" id="" class="btn btn-primary">
                    <span class="indicator-label">Kaydet</span>
                </button>
                <!--end::Button-->
            </div>
        </div>
        <!--end::Main column-->
    </form>
    </div>
@endsection

@section('scripts')
    <script src="{{asset("assets/plugins/custom/datatables/datatables.bundle.js")}}"></script>
    <script src="{{asset('assets/js/custom/apps/ecommerce/catalog/categories.js')}}"></script>
@endsection
