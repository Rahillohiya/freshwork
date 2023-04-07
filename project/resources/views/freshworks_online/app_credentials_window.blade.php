@extends('layouts.popup_window_parent')
<?php $asset_controls = ['validation'];?>
@section('content')
    <main role="main">
        <div style="--top-bar-background:#00848e; --top-bar-background-lighter:#1d9ba4; --top-bar-color:#f9fafb; --p-frame-offset:0px;">
            <div class="Polaris-Page create ">
                <div class="Polaris-Page__MainContent">
                    <div class="Polaris-Page__Content">
                        <div class="Polaris-Layout">
                            <div class="Polaris-Layout__Section">
                                <div class="Polaris-Card">
                                    <div class="inner-content-fullWidth">
                                        <div class="Polaris-Card card-bg-color">
                                            <div class="Polaris-Card__Header header_design">
                                                <div class="header_img">
                                                    <img src="{{ asset('icons/freshworks_online.png') }}">
                                                </div>
                                                <h4 class="">Allow Connectify to access your Freshworks online app</h4>
                                                <div class="error-messages alert alert-danger" role="alert"
                                                     style="display:none;">
                                                </div>

                                            </div>
                                            <div class="channel-presentation-div">
                                                <form id="connect-freshworks_online-form" method="post" onsubmit="return false"
                                                      action="{{ route('store_freshworks_online_app_account') }}" >
                                                    <input id="account_id" type="hidden" name="account_id" value="{{ $account?$account->id:0 }}">

                                                    <div class="fields-wrapper">
                                                        <div class="Polaris-Labelled__LabelWrapper">
                                                            <div class="Polaris-Label">
                                                                <label id="PolarisTextField2Label"
                                                                       for="PolarisTextField2"
                                                                       class="Polaris-Label__Text">Instance URL
                                                                    <span style="font-size: 12px;color: red;">(required)</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="Polaris-Connected">
                                                            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                                                <div class="Polaris-TextField">
                                                                    <input id="instance_url"
                                                                           class="Polaris-TextField__Input"
                                                                           type="text"
                                                                           value="{{ old('instance_url')?old('instance_url'):($login_credentials['instance_url']??'') }}"
                                                                           data-rule-required="true"
                                                                           name="instance_url">
                                                                    <div class="Polaris-TextField__Backdrop"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="Polaris-Labelled__HelpText"
                                                             id="PolarisTextField2HelpText"><span>
                                                               Freshworks Instance URL
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="fields-wrapper">
                                                        <div class="Polaris-Labelled__LabelWrapper">
                                                            <div class="Polaris-Label">
                                                                <label id="PolarisTextField2Label"
                                                                       for="PolarisTextField2"
                                                                       class="Polaris-Label__Text">Freshworks Api Key
                                                                    <span style="font-size: 12px;color: red;">(required)</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="Polaris-Connected">
                                                            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                                                <div class="Polaris-TextField">
                                                                    <input id="api_key"
                                                                           class="Polaris-TextField__Input"
                                                                           type="text"
                                                                           value="{{ old('api_key')?old('api_key'):($login_credentials['api_key']??'') }}"
                                                                           data-rule-required="true"
                                                                           name="api_key">
                                                                    <div class="Polaris-TextField__Backdrop"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="Polaris-Labelled__HelpText"
                                                             id="PolarisTextField2HelpText"><span>
                                                                Freshworks Api Key of your freshworks online app
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="save-btn" style="margin: 19px 0;">
                                                        <button id="form-sybmit-btn" type="submit" class="Polaris-Button">
                                                            <span class="Polaris-Button__Content">
                                                                <span class="Polaris-Button__Text">{{ $account?"Continue":"Continue" }}</span></span>
                                                        </button>
                                                    </div>
                                                </form>
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

    </main>
@endsection

@section('last_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            oric_Validation_application("connect-freshworks_online-form",undefined,undefined,true);
            function register_freshworks_online_account() {
                show_loading_img();
//                $('#form-sybmit-btn').attr('disabled',true);
                $.ajax({
                    url: "{{ route('store_freshworks_online_app_account')}}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': "<?= Session::token() ?>"
                    },
                    dataType: "JSON",
                    data: {
                        instance_url: $('#instance_url').val(),
                        api_key: $('#api_key').val(),
                        account_id: $('#account_id').val()
                    },
                    cache: false,
                    success: function (response) {
                        hide_loading_img();
                        if(response.status=='success'){
                            window.opener.channelPopupCallback(response.message); //Call callback function

                            window.close(); // Close the current popup

                            /*@php $id = $request->id ?? 0; @endphp
                            var url = "{{route("freshworks_callback").'?id='.$id.'&channel_id='.$channel_id.'&account_type_splash_window=1' }}" +"&custom_app_id="+response.appId;

                            window.location.href=url.replace(/&amp;/g, '&');*/
                            // window.close(); // Close the current popup
                        }
                        else if(response.status=='error' &&  response.errors){
                            $('.error-messages').empty().show();
                            let errors=response.errors;
                            for(var i in errors){
                                $('.error-messages').append('<p>'+errors[i].message+'</p>');
                            }
                            $("html, body").animate({ scrollTop: 0 }, "slow");
                            $('#form-sybmit-btn').attr('disabled',false);

                        }


                    }, error: function (result) {
                        $('.error-messages').empty().show();
                        $('.error-messages').append('<p>Unable to save.Please try again later.</p>');
                        hide_loading_img();
                        $('#form-sybmit-btn').attr('disabled',false);

                    },
                    timeout: 1000000
                }).fail(function (jqXHR, textStatus) {
                    hide_loading_img();
                    $('.error-messages').empty().show();
                    $('.error-messages').append('<p>Unable to save.Please try again later.</p>');
                    $('#form-sybmit-btn').attr('disabled',false);


                });
            }
            $("#connect-freshworks_online-form").submit(function (e) {
                e.preventDefault();
                if ($('#connect-freshworks_online-form').valid()) {
                    register_freshworks_online_account();
                }else{
                    alert('Please fill required field values');
                }

            });
        });
    </script>
@endsection
