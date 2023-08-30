
<div class="separator separator-dashed my-4"></div>

<section class="tab_section">
    <div class="card">
        <div class="card-header border-0 p-0 mb-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Delete Course</span>
                <span id="kt_course_settings_tagline" class="text-muted mt-1 fw-semibold fs-7">This action will remove all available contents, instructors, reviews and followers of this course</span>
            </h3>
        </div>
        <div class="card-body p-0 pt-5">

        <!--begin::Form-->
        <form id="kt_form_delete_course" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
            <!--begin::Notice-->
            <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
                <!--begin::Icon-->
                <i class="ki-duotone ki-information fs-2tx text-warning me-4">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                </i>
                <!--end::Icon-->
                <!--begin::Wrapper-->
                <div class="d-flex flex-stack flex-grow-1">
                    <!--begin::Content-->
                    <div class="fw-semibold">
                        <h4 class="text-gray-900 fw-bold">You Are Deleting This Course</h4>
                        <div class="fs-6 text-gray-700">This work cannot be undone please check and confirm before take any action.</div>
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Notice-->

            <!--begin::Form Options-->
            <div class="d-flex flex-end pt-10">
                <button id="kt_btn_delete_course" type="submit" class="btn btn-danger fw-semibold">Delete Course</button>
            </div>
            <!--end::Form Options-->
        </form>
        <!--end::Form-->

        </div>
    </div>
</section>