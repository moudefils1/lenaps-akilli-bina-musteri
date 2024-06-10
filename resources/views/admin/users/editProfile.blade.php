@php use App\Enums\StatusEnum;use App\Enums\UserRoleEnum; @endphp
@extends('layouts.admin')
@section("title")
    Güncelle | Hesabım |
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
            <li class="breadcrumb-item text-muted">
                <a href="{{route('admin.users.profile', $user->slug)}}" class="text-muted text-hover-primary">Hesabım</a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">Güncelle</li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection

@section('content')
    <form id="" class="form d-flex flex-column flex-lg-row" action="{{route("admin.users.profile.update", $user)}}" method="post"
          enctype="multipart/form-data">
        @csrf
        <!--begin::Aside column-->
        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
            <!--begin::Thumbnail settings-->
            <div class="card card-flush py-4">
                @if($errors->any)
                    @foreach($errors->all() as $error)
                        <span class="text-danger">{{$error}}</span>
                    @endforeach
                @endif
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="required card-title">
                        <h2>Profil Resmi</h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body text-center pt-0">
                    <!--begin::Image input-->
                    <!--begin::Image input placeholder-->
                    <style>.image-input-placeholder {
                            background-image: url({{$user->getFirstMediaUrl("user")}});
                        }

                        [data-bs-theme="dark"] .image-input-placeholder {
                            background-image: url({{$user->getFirstMediaUrl("user")}});
                        }</style>
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
                    <div class="text-muted fs-7">Sadece *.png, *.jpg, *.jpeg ve *.svg uzantılı resimler kabul edilir.
                    </div>
                    <!--end::Description-->
                    @error('image')
                    <div class="text-danger fs-7">{{$message}}</div>
                    @enderror
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
                    @if($user->id == auth()->user()->id)
                        <div class="row">
                            <!-- İlk Sütun -->
                            <div class="col">
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row">
                                    <!--begin::Label-->
                                    <label class="form-label">Türü</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <input class="form-control mb-2 text-bg-secondary" placeholder="{{$user->role->getLabel()}}" readonly>
                                    <input type="hidden" name="role" value="{{$user->role}}">
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!-- İkinci Sütun -->
                            <div class="col">
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row">
                                    <!--begin::Label-->
                                    <label class="form-label">Durumu</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <input class="form-control mb-2 text-bg-secondary" placeholder="{{$user->status->getLabel()}}" value="" readonly>
                                    <input type="hidden" name="status" value="{{$user->status}}">
                                </div>
                                <!--end::Input group-->
                            </div>
                        </div>
                    @else
                        <!--begin::Input group-->
                        <div class="row">
                            <!-- İlk Sütun -->
                            <div class="col">
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row">
                                    <!--begin::Label-->
                                    <label class="required form-label">Türü</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select mb-2" name="role" data-control="select2"
                                            data-hide-search="true">
                                        @foreach(UserRoleEnum::cases() as $role)
                                            @if($role->value != 1)
                                                <option
                                                    value="{{$role->value}}" @selected(old("role", $user->role->value)==$role->value)>
                                                    {{$role->getLabel()}}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    @error('role')
                                    <div class="text-danger fs-7">{{$message}}</div>
                                    @enderror
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!-- İkinci Sütun -->
                            <div class="col">
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row">
                                    <!--begin::Label-->
                                    <label class="required form-label">Durumu</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select mb-2" name="status" data-control="select2"
                                            data-hide-search="true">
                                        @foreach(StatusEnum::cases() as $status)
                                            <option
                                                value="{{$status->value}}" @selected(old("status", $user->status->value)==$status->value)>
                                                {{$status->getLabel()}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    @error('status')
                                    <div class="text-danger fs-7">{{$message}}</div>
                                    @enderror
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                            </div>
                        </div>
                        <!--end::Input group-->
                    @endif
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row">
                        <div class="col">
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="required form-label">Ad ve Soyad</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="name"
                                       class="form-control mb-2 @error('name') is-invalid @enderror"
                                       placeholder="Kullanıcının adı ve soyadını giriniz" value="{{old('name', $user->name)}}"/>
                                <!--end::Input-->
                                <!--begin::Description-->
                                @error('name')
                                <div class="fs-7 text-danger">{{$message}}</div>@enderror
                                <!--end::Description-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <div class="col">
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="required form-label">Telefon</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="number" name="phone"
                                       class="form-control mb-2 @error("phone") is-valid @enderror" max="99999999999"
                                       placeholder="Telefon numarasını giriniz" value="{{old("phone", $user->phone)}}"/>
                                <!--end::Input-->
                                <!--begin::Description-->
                                @error('phone')
                                <div class="fs-7 text-danger">{{$message}}</div>@enderror
                                <!--end::Description-->
                            </div>
                            <!--end::Input group-->
                        </div>

                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div>
                        <!--begin::Label-->
                        <label class="required form-label">Açık Adres</label>
                        <!--end::Label-->
                        <!--begin::Editor-->
                        <textarea name="address" id="kt_docs_tinymce_basic" placeholder="Açık adresini giriniz"
                                  class="form-control min-h-200px mb-2">{{old('address', $user->address)}}</textarea>
                        <!--end::Editor-->
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Card header-->
            </div>
            <!--end::General options-->
            <div class="d-flex justify-content-end">
                <!--begin::Button-->
                <a href="{{route("admin.users.profile", $user->slug)}}" id="kt_ecommerce_add_product_cancel"
                   class="btn btn-light me-5">Geri</a>
                <!--end::Button-->
                <!--begin::Button-->
                <button type="submit" id="" class="btn btn-primary">
                    <span class="indicator-label">Güncelle</span>
                </button>
                <!--end::Button-->
            </div>
        </div>
        <!--end::Main column-->
    </form>
@endsection
@section('script')
    <script src="{{asset("assets/plugins/custom/datatables/datatables.bundle.js")}}"></script>
    <script src="{{asset('assets/js/custom/apps/ecommerce/catalog/categories.js')}}"></script>
@endsection
