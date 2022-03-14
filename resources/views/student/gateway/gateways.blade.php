@extends('student.layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
@endpush
@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{__('Payment Gateways')}}</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @foreach ($gateways as $gateway)
                                <div class="col-md-3 card mt-2 mb-2">
                                    <div class="card-body">
                                        <h3>{{ $gateway->gateway_name }}</h3>
                                        <div class="caption text-center mt-3">
                                            <button data-href="{{ route('paynow', $gateway->id) }}"
                                                    data-id="{{ $gateway->id }}" class="btn btn-primary paynow">Pay
                                                Now
                                            </button>

                                        </div>
                                    </div>

                                </div>
                            @endforeach


                        </div>

                    </div>


                </div>


            </div>

        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="paynow">
            <div class="modal-dialog" role="document">
                <form action="" method="post">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ __('Deposit Now') }}</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" name="gateway_id" value="">
                                <input type="hidden" name="course_id" value="{{ @$cart->course_id }}">
                                <div class="form-group">
                                    <label for="">{{ __('Amount') }}</label>
                                    <input type="text" name="amount" class="form-control" value="{{ @$cart->course->price }}"
                                           placeholder="{{ __('Enter Deposit Amount') }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Deposit Now') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

@endsection

@push('style')

    <style>
        .image-area {
            height: 300px;
        }

        .gateway-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

    </style>

@endpush

@push('script')

    <script>
        $(function () {
            'use strict'

            $('.paynow').on('click', function () {
                const modal = $('#paynow')

                modal.find('form').attr('action', $(this).data('href'))
                modal.find('input[name=gateway_id]').val($(this).data('id'))

                modal.modal('show')
            })
        })
    </script>

@endpush
