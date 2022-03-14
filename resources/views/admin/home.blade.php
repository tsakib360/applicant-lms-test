@extends('admin.layouts.app')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Row-->
            <div class="row g-5 g-xl-8">

                <div class="col-xl-3">
                    <a href="#" class="card bg-dark hoverable card-xl-stretch mb-5 mb-xl-8">
                    <div class="card-body bg-primary">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                        <span class="svg-icon svg-icon-white svg-icon-2hx ms-n1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect x="2" y="2" width="9" height="9" rx="2" fill="black"></rect>
                                <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black"></rect>
                                <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black"></rect>
                                <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black"></rect>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <div class="text-inverse-primary fw-bolder fs-1 mb-2 mt-5">{{ @$total_students }}</div>
                        <div class="fw-bold text-inverse-primary fs-6">Total Students</div>
                    </div>
                    </a>
                </div>
                <div class="col-xl-3">
                    <a href="#" class="card bg-dark hoverable card-xl-stretch mb-5 mb-xl-8">
                    <div class="card-body bg-secondary">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                        <span class="svg-icon svg-icon-primary svg-icon-3x ms-n1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z" fill="black" />
                                    <path opacity="0.3" d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z" fill="black" />
                                    <path opacity="0.3" d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z" fill="black" />
                                </svg>
                            </span>
                        <!--end::Svg Icon-->
                        <div class="text-inverse-black fw-bolder fs-1 mb-2 mt-5">{{ @$total_courses }}</div>
                        <div class="fw-bold text-inverse-black fs-6">Total Course</div>
                    </div>
                    </a>
                </div>
                <div class="col-xl-3">
                    <a href="#" class="card bg-info hoverable card-xl-stretch mb-5 mb-xl-8">
                    <div class="card-body bg-">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                        <span class="svg-icon svg-icon-gray-100 svg-icon-3x ms-n1">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect x="8" y="9" width="3" height="10" rx="1.5" fill="black" />
														<rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black" />
														<rect x="18" y="11" width="3" height="8" rx="1.5" fill="black" />
														<rect x="3" y="13" width="3" height="6" rx="1.5" fill="black" />
													</svg>
												</span>
                        <!--end::Svg Icon-->
                        <div class="text-gray-100 fw-bolder fs-1 mb-2 mt-5">{{ @$total_courses }}</div>
                        <div class="fw-bold text-gray-100 fs-6">Total Assigned Courses</div>
                    </div>
                    </a>
                </div>
                <div class="col-xl-3">
                    <a href="#" class="card bg-success hoverable card-xl-stretch mb-5 mb-xl-8">
                    <div class="card-body bg-">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                        <span class="svg-icon svg-icon-gray-100 svg-icon-3x ms-n1">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect x="8" y="9" width="3" height="10" rx="1.5" fill="black" />
														<rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black" />
														<rect x="18" y="11" width="3" height="8" rx="1.5" fill="black" />
														<rect x="3" y="13" width="3" height="6" rx="1.5" fill="black" />
													</svg>
												</span>
                        <!--end::Svg Icon-->
                        <div class="text-gray-100 fw-bolder fs-1 mb-2 mt-5">{{ @$total_sales }}</div>
                        <div class="fw-bold text-gray-100 fs-6">Total Sales</div>
                    </div>
                    </a>
                </div>

            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
@endsection
