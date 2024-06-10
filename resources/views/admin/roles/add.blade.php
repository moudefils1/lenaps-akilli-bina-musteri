@extends("layouts.admin")

@section("title")
    Ekle | Roller | Panel Yönetimi |
@endsection

@section("styles")

@endsection

@section("breadcrumb")
    <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Ekle</h1>
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
                <li class="breadcrumb-item text-muted">Roller</li>
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
            <div class="card-body pt-5">
                {{--@if($errors->any)
                    @foreach($errors->all() as $error)
                        <span class="text-danger">{{$error}}</span>
                    @endforeach
                @endif--}}
                <form id="" class="form" action="{{route("admin.role-permissions.store")}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-5 fw-bold form-label mt-3">
                            <span class="required">Rol Adı</span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control form-control-solid @error('name') is-invalid @enderror"
                               placeholder="Rol adını giriniz" name="name"/>
                        @error('name') <div class="fs-6 text-danger">{{$message}}</div> @enderror
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row">
                        <!--begin::Label-->
                        <label class="fs-5 fw-bold form-label mb-2">Rol Yetkileri</label>
                        <!--end::Label-->
                        <!--begin::Table wrapper-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-5">
                                <!--begin::Table body-->
                                <tbody class="text-gray-600 fw-semibold">
                                <!--begin::Table row-->
                                <tr>
                                    <td class="text-gray-800">Yönetici Erişimi
                                        <span class="ms-1" data-bs-toggle="tooltip" title="Sisteme tam erişim sağlar">
                                            <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                        </span>
                                    </td>
                                    <td>
                                        <!--begin::Checkbox-->
                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-9">
                                            <input class="form-check-input" type="checkbox" value="" id="admin_access" />
                                            <span class="form-check-label" for="kt_roles_select_all">Hepsini Seç</span>
                                        </label>
                                        <!--end::Checkbox-->
                                    </td>
                                </tr>
                                <!--end::Table row-->
                                @foreach(\App\Enums\PermissionsEnum::cases() as $permission)
                                    <!--begin::Table row-->
                                    <tr>
                                        <!--begin::Label-->
                                        <td class="text-gray-800">{{$permission->getLabel()}}</td>
                                        <!--end::Label-->
                                        <!--begin::Input group-->
                                        <td>
                                            <!--begin::Wrapper-->
                                            <div class="d-flex">
                                                <!--begin::Checkbox-->
                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                    <input class="form-check-input permissions" type="checkbox"
                                                           name="permissions[]" value="view_{{$permission->name()}}" />
                                                    <span class="form-check-label">Listeleme</span>
                                                </label>
                                                <!--end::Checkbox-->
                                                <!--begin::Checkbox-->
                                                <label class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                    <input class="form-check-input permissions" type="checkbox"
                                                           name="permissions[]" value="create_{{$permission->name()}}"/>
                                                    <span class="form-check-label">Ekleme</span>
                                                </label>
                                                <!--end::Checkbox-->
                                                <!--begin::Checkbox-->
                                                <label class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                    <input class="form-check-input permissions" type="checkbox"
                                                           name="permissions[]" value="update_{{$permission->name()}}" />
                                                    <span class="form-check-label">Güncelleme</span>
                                                </label>
                                                <!--end::Checkbox-->
                                                <!--begin::Checkbox-->
                                                <label class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input permissions" type="checkbox"
                                                           name="permissions[]" value="delete_{{$permission->name()}}" />
                                                    <span class="form-check-label">Silme</span>
                                                </label>
                                                <!--end::Checkbox-->
                                            </div>
                                            <!--end::Wrapper-->
                                        </td>
                                        <!--end::Input group-->
                                    </tr>
                                    <!--end::Table row-->
                                @endforeach
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table wrapper-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Action buttons-->
                    {{--<div class="d-flex flex-center mt-5">
                        <!--begin::Button-->
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Kaydet</span>
                        </button>
                        <!--end::Button-->
                    </div>--}}


                    <div class="d-flex flex-center mt-5">
                        <button type="reset" class="btn btn-secondary me-20">Temizle</button>
                        <button type="submit" id="" class="btn btn-primary">Kaydet</button>
                    </div>
                    <!--end::Action buttons-->
                </form>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script>
        $(document).ready(function () {
            // select all
            $('#admin_access').change(function () {
                if (this.checked) {
                    $('.permissions').prop('checked', true);
                } else {
                    $('.permissions').prop('checked', false);
                }
            });

            // show password

        });
    </script>
@endsection
