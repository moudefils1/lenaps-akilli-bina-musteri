@extends("layouts.admin(old)")

@section("title")
Ekle | Roller |
@endsection

@section("styles")
<link rel="stylesheet" type="text/css" href="{{asset("assets/vendors/css/dataTables.bs5.min.css")}}">
@endsection

@section("breadcrumb")
<div class="page-header">
    <div class="page-header-left d-flex align-items-center">
        <div class="page-header-title">
            <h5 class="m-b-10">Roller</h5>
        </div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route("admin.dashboard")}}">Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="{{route("admin.role-permissions.index")}}">Roller</a></li>
            <li class="breadcrumb-item">Ekle</li>
        </ul>
    </div>
    <div class="page-header-right ms-auto">
        <div class="page-header-right-items">
            <div class="d-flex d-md-none">
                <a href="javascript:void(0)" class="page-header-right-close-toggle">
                    <i class="feather-arrow-left me-2"></i>
                    <span>Back</span>
                </a>
            </div>
            <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                <a href="javascript:void(0);" class="btn btn-icon btn-light-brand" data-bs-toggle="collapse"
                   data-bs-target="#collapseOne">
                    <i class="feather-bar-chart"></i>
                </a>

            </div>
        </div>
        <div class="d-md-none d-flex align-items-center">
            <a href="javascript:void(0)" class="page-header-right-open-toggle">
                <i class="feather-align-right fs-20"></i>
            </a>
        </div>
    </div>
</div>
<div id="collapseOne" class="accordion-collapse collapse page-header-collapse">
    <div class="accordion-body pb-2">
        <div class="row">
            <div class="col-xxl-3 col-md-6">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="javascript:void(0);" class="fw-bold d-block">
                                <span class="d-block">Paid</span>
                                <span class="fs-20 fw-bold d-block">78/100</span>
                            </a>
                            <div class="badge bg-soft-success text-success">
                                <i class="feather-arrow-up fs-10 me-1"></i>
                                <span>36.85%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="javascript:void(0);" class="fw-bold d-block">
                                <span class="d-block">Unpaid</span>
                                <span class="fs-20 fw-bold d-block">38/50</span>
                            </a>
                            <div class="badge bg-soft-danger text-danger">
                                <i class="feather-arrow-down fs-10 me-1"></i>
                                <span>23.45%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="javascript:void(0);" class="fw-bold d-block">
                                <span class="d-block">Overdue</span>
                                <span class="fs-20 fw-bold d-block">15/30</span>
                            </a>
                            <div class="badge bg-soft-success text-success">
                                <i class="feather-arrow-up fs-10 me-1"></i>
                                <span>25.44%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="javascript:void(0);" class="fw-bold d-block">
                                <span class="d-block">Draft</span>
                                <span class="fs-20 fw-bold d-block">3/10</span>
                            </a>
                            <div class="badge bg-soft-danger text-danger">
                                <i class="feather-arrow-down fs-10 me-1"></i>
                                <span>12.68%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("content")
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Yeni Rol Ekle</h5>
        </div>
        <div class="card-body">
            <form id="" class="form" action="{{route("admin.role-permissions.store")}}" method="post"
            enctype="multipart/form-data">
            @csrf
            <!--begin::Scroll-->
            <!--begin::Input group-->
            <div class="fv-row mb-3">
                <!--begin::Label-->
                <label for="InvoiceLabel" class="form-label">Rol Adı <span class="text-danger">*</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input class="form-control @error('name') is-invalid @enderror" id="InvoiceNumber"
                       placeholder="Rol adını giriniz" name="name"/>
                @error('name')
                <div class="fs-6 text-danger">{{$message}}</div> @enderror
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Permissions-->
            <div class="fv-row">
                <!--begin::Label-->
                <label for="InvoiceLabel" class="form-label mb-2 fs-1">Rol Yetkileri</label>
                <!--end::Label-->
                <!--begin::Table wrapper-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dash">
                        <!--begin::Table body-->
                        <tbody class="text-gray-600 fw-semibold">
                        <tr>
                            <td class="text-gray-800">Yönetici Erişimi</td>
                            <td>
                                <!--begin::Checkbox-->
                                <label class="form-check form-check-sm form-check-custom form-check-solid me-9">
                                    <input class="form-check-input" type="checkbox" value="" id="admin_access"/>
                                    <span class="form-check-label">Hepsini Seç</span>
                                </label>
                                <!--end::Checkbox-->
                            </td>
                        </tr>
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
                                    <label
                                        class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                        <input class="form-check-input permissions" type="checkbox"
                                               value="view_{{$permission->name()}}" name="permissions[]"/>
                                        <span class="form-check-label">Listeleme</span>
                                    </label>
                                    <!--end::Checkbox-->
                                    <!--begin::Checkbox-->
                                    <label
                                        class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                        <input class="form-check-input permissions" type="checkbox"
                                               value="create_{{$permission->name()}}" name="permissions[]"/>
                                        <span class="form-check-label">Ekleme</span>
                                    </label>
                                    <!--end::Checkbox-->
                                    <!--begin::Checkbox-->
                                    <label
                                        class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                        <input class="form-check-input permissions" type="checkbox"
                                               value="update_{{$permission->name()}}" name="permissions[]"/>
                                        <span class="form-check-label">Güncelleme</span>
                                    </label>
                                    <!--end::Checkbox-->
                                    <!--begin::Checkbox-->
                                    <label class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input permissions" type="checkbox"
                                               value="delete_{{$permission->name()}}" name="permissions[]"/>
                                        <span class="form-check-label">Silme</span>
                                    </label>
                                    <!--end::Checkbox-->
                                </div>
                                <!--end::Wrapper-->
                            </td>
                            <!--end::Input group-->
                        </tr>
                        <!--end::Table row-->
                        </tbody>
                        @endforeach
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table wrapper-->
            </div>
            <!--end::Permissions-->
            <!--end::Scroll-->
            <!--begin::Actions-->
            <div class="footer text-end">
                <button type="reset" class="btn btn-secondary me-3">Temizle</button>
                <button type="submit" class="btn btn-primary me-3">Kaydet</button>
            </div>
            <!--end::Actions-->
            </form>


            {{--<form>
                <div class="form-group">
                    <label for="roleName">Rol Adı</label>
                    <input type="text" class="form-control" id="roleName" placeholder="Rol adını giriniz">
                </div>

                <div class="form-group">
                    <label>Permissions</label>
                    <div class="mb-3">
                        <label>Permission 1</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="permission1List">
                            <label class="form-check-label" for="permission1List">Listele</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="permission1Add">
                            <label class="form-check-label" for="permission1Add">Ekle</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="permission1Update">
                            <label class="form-check-label" for="permission1Update">Güncelle</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="permission1Delete">
                            <label class="form-check-label" for="permission1Delete">Sil</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Permission 2</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="permission2List">
                            <label class="form-check-label" for="permission2List">Listele</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="permission2Add">
                            <label class="form-check-label" for="permission2Add">Ekle</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="permission2Update">
                            <label class="form-check-label" for="permission2Update">Güncelle</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="permission2Delete">
                            <label class="form-check-label" for="permission2Delete">Sil</label>
                        </div>
                    </div>

                    <!-- Daha fazla permission eklemek için yukarıdaki kalıbı kullanabilirsiniz -->

                </div>
                <button type="submit" class="btn btn-primary">Kaydet</button>
            </form>--}}
        </div>
    </div>
</div>



{{--<!--! [Start] Add New task Modal !-->
<!--! ================================================================ !-->
<div class="modal fade" id="addNewTasks" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yeni Rol Ekle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <label for="taskName" class="form-label">Rol Adı</label>
                    <input type="text" id="taskName" class="form-control" placeholder="Rol İsmini Giriniz">
                    <small class="text-muted">Tasks name for your todo</small>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kapat</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Kaydet</button>
            </div>
        </div>
    </div>
</div>
<!--! ================================================================ !-->
<!--! [End] Add New task Modal !-->--}}
@endsection

@section("scripts")
<script src="{{asset("assets/vendors/js/dataTables.min.js")}}"></script>
<script src="{{asset("assets/vendors/js/dataTables.bs5.min.js")}}"></script>
<script src="{{asset("assets/js/payment-init.min.js")}}"></script>

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
