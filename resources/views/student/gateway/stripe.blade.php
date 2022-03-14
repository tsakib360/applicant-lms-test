@extends('student.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
@endpush
@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="card credit-card-box">
                    <div class="card-header text-center">
                        <h5>{{__('Payment Preview')}}</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">

                            <li class="list-group-item d-flex justify-content-between">
                                <span>{{ __('Gateway Name') }}:</span>

                                <span>{{ $deposit->gateway->gateway_name }}</span>

                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>{{ __('Amount') }}:</span>
                                <span>{{ $deposit->amount }}</span>
                            </li>

                            <li class="list-group-item d-flex justify-content-between">
                                <span>{{ __('Charge') }}:</span>
                                <span>{{ $deposit->charge }}</span>
                            </li>


                            <li class="list-group-item d-flex justify-content-between">
                                <span>{{ __('Conversion Rate') }}:</span>
                                <span>{{ '1 ' . @$general->site_currency . ' = ' . $deposit->rate }}</span>
                            </li>


                            <li class="list-group-item d-flex justify-content-between">
                                <span>{{ __('Total Payable Amount') }}:</span>
                                <span>{{ $deposit->final_amount }}</span>
                            </li>


                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-md-offset-3">
                <div class="card credit-card-box">

                    <div class="card-body">


                        <form role="form" action="" method="post" class="require-validation"
                              data-cc-on-file="false"
                              data-stripe-publishable-key="{{ $gateway->gateway_parameters->stripe_client_id }}"
                              id="payment-form">
                            @csrf
                            <div class="row">


                                <div class='form-group col-md-12'>
                                    <div class='col-xs-12 form-group required'>
                                        <label class='control-label'>{{__('Name on Card')}}</label> <input
                                            class='form-control' size='4'
                                            type='text'>
                                    </div>
                                </div>

                                <div class='form-group col-md-12'>
                                    <div class='col-xs-12 form-group card required'>
                                        <label class='control-label'>{{__('Card Number')}}</label> <input
                                            autocomplete='off'
                                            class='form-control card-number' size='20' type='text'>
                                    </div>
                                </div>

                                <div class='form-group col-md-12'>
                                    <div class="row">
                                        <div class='col-xs-12 col-md-4 form-group cvc required'>
                                            <label class='control-label'>{{__('CVC')}}</label> <input
                                                autocomplete='off'
                                                class='form-control card-cvc' size='4' type='text'>
                                        </div>
                                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                                            <label class='control-label'>{{__('Expiration Month')}}</label> <input
                                                class='form-control card-expiry-month' size='2' type='text'>
                                        </div>
                                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                                            <label class='control-label'>{{__('Expiration Year')}}</label> <input
                                                class='form-control card-expiry-year' size='4' type='text'>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class='form-group col-md-'>
                                <div class='col-md-12 error form-group d-none'>
                                    <div class='alert-danger alert'>
                                        {{__('Please correct the errors and try again.')}}</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <button class="btn btn-primary btn-lg btn-block"
                                            type="submit">{{__('Pay Now')}}</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@push('script')
    <script src="https://js.stripe.com/v2/"></script>

    <script>
        'use strict'
        $(function () {
            var $form = $(".require-validation");
            $('form.require-validation').bind('submit', function (e) {
                var $form = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'
                    ].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;
                $errorMessage.addClass('hide');

                $('.has-error').removeClass('has-error');
                $inputs.each(function (i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }

            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    // token contains id, last4, and card type
                    var token = response['id'];
                    // insert the token into the form so it gets submitted to the server
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

        });
    </script>

@endpush
