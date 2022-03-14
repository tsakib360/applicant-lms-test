@extends('admin.layouts.app')

@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Card-->
                <div class="card">
                    <div class="card-body pt-0">
                        <form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#" method="post">
                            @csrf
                            <!--begin::Heading-->
                            <div class="mb-13 text-center">
                                <!--begin::Title-->
                                <h1 class="mb-3"></h1>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->


                            <!--begin::Input group-->
                            <div class="row g-9 mb-8" data-select2-id="select2-data-72-r8v7">
                                <!--begin::Col-->
                                <div class="col-md-4 ">
                                    <label class="required fs-6 fw-bold mb-2">Gateway Currency</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Enter Gateway Name" name="gateway_currency"
                                    value="{{ @$gateway->gateway_parameters->gateway_currency ?? old('gateway_currency') }}">
                                </div>

                                <div class="col-md-4 ">
                                    <label class="required fs-6 fw-bold mb-2">Paypal Account Mode</label>
                                    <select name="mode" class="form-control">
                                        <option value="">Select Option</option>
                                        <option value="sandbox" {{ @$gateway->gateway_parameters->mode == 'sandbox' ? 'selected' : '' }}>Sandbox</option>
                                        <option value="live" {{ @$gateway->gateway_parameters->mode == 'live' ? 'selected' : '' }}>Live</option>
                                    </select>
                                </div>
                                <div class="col-md-4 ">
                                    <label class="required fs-6 fw-bold mb-2">Conversion Rate</label>
                                    <div class="d-flex">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            {{ '1 tk = ' }}
                                        </div>
                                    </div>
                                    <input type="text" class="form-control currency" name="rate" placeholder=""
                                           value="{{ number_format(@$gateway->rate, 4) ?? 0 }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text append_currency">
                                            {{ @$gateway->gateway_name ?? "paypal" }}
                                        </div>
                                    </div>
                                    </div>
                                </div>

                                <div class="col-md-12 ">
                                    <label class="required fs-6 fw-bold mb-2">Paypal Client ID</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Enter Paypal Client ID"
                                           name="paypal_client_id" value="{{ @$gateway->gateway_parameters->paypal_client_id ?? old('paypal_client_id') }}">
                                </div>
                                <div class="col-md-12 ">
                                    <label class="required fs-6 fw-bold mb-2">Paypal Client Secret</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Enter Paypal Client Secret" name="paypal_client_secret" value="{{ @$gateway->gateway_parameters->paypal_client_secret ?? old('paypal_client_secret') }}">
                                </div>
                                <div class="col-md-12 ">
                                    <label class="required fs-6 fw-bold mb-2">Allowed Payment Method</label>
                                    <select name="status" class="form-control">
                                        <option value="1" {{ @$gateway->status ? 'selected' : '' }}>Yes</option>
                                        <option value="0"  {{ @$gateway->status ? '' : 'selected' }}>NO</option>
                                    </select>
                                </div>

                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->


                            <!--begin::Actions-->
                            <div class="text-center">
                                <button type="submit"  class="btn btn-primary">
                                    <span class="indicator-label">Update</span>
                                </button>
                            </div>
                            <!--end::Actions-->
                            <div></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
