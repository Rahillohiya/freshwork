@extends('layouts.master')
@section('content')
    <main id="main">
            <div class="banner">
                <div class="container">
                    <div class="mainbox mainbox-top">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="banner-text text-center">
                                    <h1>Connect & automate workflows between store and other platforms </h1>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <img src="{{ asset('icons/5990697.png') }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section class="section ">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            @if(count($register_webhooks))
                                <div class="mainbox mb-4">
                                    <div class="row">
                                        <h5>Registered Webhooks</h5>
                                        <div class="col-md-12">
                                            <table class="table bordered">
                                                <thead>
                                                <tr>
                                                    <th>Channel</th>
                                                    <th>Name</th>
                                                    <th>Webhook</th>
                                                    <th>Event Name</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($register_webhooks as $register_webhook)
                                                    <tr>
                                                        <td width="50" >
                                                            <div class="img-box">
                                                                <img src="{{ config('channel.icon_path') }}" alt="">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span>{{ ucwords(str_replace("_", " ", config('channel.name'))) }}</span>
                                                        </td>
                                                        <td>{{ ucwords(str_replace("/", " -> ", $register_webhook->topic_name)) }}</td>
                                                        @php
                                                            $event_name = $register_webhook->channel_event_settings->channel_event->name ?? ($register_webhook->channel_event_settings->object_text) ?? '';
                                                            if(strlen($event_name) > 35) $event_name = substr($event_name, 0, 30).'...';
                                                        @endphp
                                                        <td>{{ $event_name }}</td>
                                                        <td>
                                                            <label class="switch"><input data-action-target="{{ route('update_event_status'  ,[$register_webhook->id]) }}" type="checkbox" data-id="{{ $register_webhook->id }}" class="update-webhook-status" {{ $register_webhook->status ? 'checked' : '' }} ><div class="slider round" id="{{ $register_webhook->id }}"><span class="on">ON</span><span class="off">OFF</span></div> </label>
                                                        </td>
                                                        <td><a href="{{ route('channel_config'  ,[$register_webhook->webhook_event_slug,$register_webhook->id]) }}"><i class="fal fa-pencil-square-o"></i></a> </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if(count($favorites))
                                <h3>Quickly Connect</h3>
                                <div class="row new_list_icon mt-4">
                                @foreach($favorites as $favorite)
                                <div class="col-sm-4">
                                <div class="mainbox">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="favorites">
                                                
                                                    <div class="card">
                                                        <div class="card-body text-center" style="background: transparent;">
                                                            <ul class="icon-list small">
                                                                <li>
                                                                    <div class="icon-box">
                                                                        <img src="{{ asset('icons/shopify-img.png') }}">
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="icon-box">
                                                                        <img src="{{ config('channel.icon_path') }}">
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                            <h4 class="mt-3 mb-3">{{ $favorite->message }} <a href="#">{{ ucwords(str_replace('_', ' ', config('channel.name'))) }}</a></h4>
                                                            <a href="{{ route('channel_config', [$favorite->webhook_event->slug]) }}" class="btn ">Try it</a>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                @endforeach
                                <div class="overflow-hidden  text-center mt-4">
                                    <a class="btn" href="{{ route('automate') }}">View All</a>
                                </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-12 mt-3">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mainbox mb-4">
                                        <div class="YourplanCard p-0 bg-transparent">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h4 class="mb-3 font-16">Your Plan</h4>
                                                <div class="mb-3">
                                                    <a href="{{ route('plans_listing') }}" class="btn font-12">Upgrade your Plan <i class="fas fa-angle-right"></i> </a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 py-3">
                                                    <h6 class="font-14">Plan</h6>
                                                    <div>
                                                            <span class="tag">
                                                                {{ ucfirst($shop->current_plan_type) }}
                                                            </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 py-3">
                                                    <h6 class="font-14">Next Billing Date</h6>
                                                    {{ $plan_history_next_date }}
                                                </div>
                                                <div class="col-lg-6 py-3">
                                                    <h6 class="font-14">Price</h6>
                                                    ${{ $shop->current_plan_type == 'elite' ? 29 : ($shop->current_plan_type == 'professional' ? 19 : 0) }}
                                                </div>
                                                <div class="col-lg-6 py-3">
                                                    <h6 class="font-14">Tasks per month </h6>
                                                    {{ number_format($allowed_webhooks_tasks) }} per month
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mainbox  mb-4">
                                        <div class="YourplanCard p-0 bg-transparent">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h4 class="mb-3 font-16">Usage</h4>
                                                <div class="mb-3">
                                                    <div class="text-muted">Resets on {{ $plan_history_next_date }}</div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p class="fst-normal mt-3"><strong>{{ $processed_webhooks }}</strong> of {{ $allowed_webhooks_tasks }} automations used</p>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-success" role="progressbar" aria-label="Success example" style="width: {{ $allowed_webhooks_tasks ? ($processed_webhooks/$allowed_webhooks_tasks)*100 : 0 }}%" aria-valuenow="{{ $processed_webhooks }}" aria-valuemin="0" aria-valuemax="{{ $allowed_webhooks_tasks }}"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mainbox">
                                        <div class="card mb-5">
                                            <div class="card-body p-0 bg-transparent">
                                                <ul class="icon-list">
                                                    <li>
                                                        <div class="icon-box" widhth="50">
                                                            <img src="{{ asset('icons/shopify_icon.png') }}">
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="icon-box">
                                                            <img src="{{ asset('icons/freshworks_online.png') }}" style="max-width: 40px">
                                                        </div>
                                                    </li>
                                                </ul>
                                                <div class="text-center">
                                                    <h5 class="text-blue my-3">Discover all the possible integrations for Shopify</h5>
                                                    <a href="{{ route('automate') }}" class="btn">Discover</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-5">
                                                <div class="card">
                                                    <div class="card-body  p-0 bg-transparent">
                                                        <h6>Request An Integration</h6>
                                                        <p>Can't find the software you're looking for? Dont't worry! We're constantly adding new intergrations based on our customer's requests. </p>
                                                        <a target="_blank" href="mailto:support@connectify.co">Request an Integration</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    </main>

    @include('partials.models_html')
    <footer id="footer">
        <div class="container">
            <svg viewBox="0 0 20 20"  focusable="false" aria-hidden="true">
                <path fill-rule="evenodd" d="M18 10a8 8 0 1 0-16 0 8 8 0 0 0 16 0zm-9 3a1 1 0 1 0 2 0v-2a1 1 0 1 0-2 0v2zm0-6a1 1 0 1 0 2 0 1 1 0 0 0-2 0z"></path>
            </svg>
            Learn more about
            <a href="https://connectify.co/" target="_blank" rel="noopener noreferrer" data-polaris-unstyled="true">CONNECTIFY
                <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                    <path d="M14 13v1a1 1 0 0 1-1 1h-7c-.575 0-1-.484-1-1v-7a1 1 0 0 1 1-1h1c1.037 0 1.04 1.5 0 1.5-.178.005-.353 0-.5 0v6h6v-.5c0-1 1.5-1 1.5 0zm-3.75-7.25a.75.75 0 0 1 .75-.75h4v4a.75.75 0 0 1-1.5 0v-1.44l-3.22 3.22a.75.75 0 1 1-1.06-1.06l3.22-3.22h-1.44a.75.75 0 0 1-.75-.75z"></path>
                </svg>
            </a> at the
            <a href="{{ route('faqs') }}" target="_blank" rel="noopener noreferrer" data-polaris-unstyled="true" class="Polaris-Link">Help Docs
                <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                    <path d="M14 13v1a1 1 0 0 1-1 1h-7c-.575 0-1-.484-1-1v-7a1 1 0 0 1 1-1h1c1.037 0 1.04 1.5 0 1.5-.178.005-.353 0-.5 0v6h6v-.5c0-1 1.5-1 1.5 0zm-3.75-7.25a.75.75 0 0 1 .75-.75h4v4a.75.75 0 0 1-1.5 0v-1.44l-3.22 3.22a.75.75 0 1 1-1.06-1.06l3.22-3.22h-1.44a.75.75 0 0 1-.75-.75z"></path>
                </svg>
            </a>.
        </div>
    </footer>
@endsection
@section('last_scripts')

    <script type="text/javascript">
        {{--scripts here--}}
        $(document).on('change', '.update-webhook-status', function () {
            var element=$(this);
            if ($(this).prop('checked')) {
                var status=1;
            }else{
                var status=0;
            }

            show_loading_img();

            $.ajax({
                url: element.attr('data-action-target'),
                type: 'POST',
                data: {
                    _method: 'POST',
                    _token: "<?= Session::token() ?>",
                    status:status,
                    id:element.data('id')
                },
                cache: false,
                success: function (result) {
                    if (result && result.status=='success') {
                        toastr.success(result.message)
                        // callSwalWithHTML(result.status, result.message, 'success');
                    }else{
                        toastr.error(result.message)
                        // callSwalWithHTML(result.status, result.message, 'error');
                        element.prop('checked', status==1?false:true);
                    }
                    hide_loading_img();
                }, error: function (response) {
                    toastr.warning('Failed to update . Try again !!')
                    // swal('Warning', 'Failed to update . Try again !!', 'warning');
                    element.prop('checked', status==1?false:true);
                    hide_loading_img();},
                timeout: 15000
            }).fail(function (jqXHR, textStatus) {
                if (textStatus === 'timeout') {
                    toastr.error('Please Wait... Slow connection!')
                    // swal("Sorry", 'Please Wait... Slow connection!', "error");
                    element.prop('checked', status==1?false:true);
                }hide_loading_img();
            });
        })
    </script>

@endsection
