@extends('student.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
@endpush
@section('content')

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

                            <span>{{ @$deposit->gateway->gateway_name }}</span>

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


                        <li class="list-group-item">
                            <form action="" method="post">
                                @csrf
                                <input type="hidden" name="amount" value="{{$deposit->final_amount}}">
                                <button type="submit" class="btn btn-primary ">{{__('Pay With Paypal')}}</button>

                            </form>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
