@extends('layouts.popup_window_parent')
{{--if its a splash window to ask user either to use sandbox or product account--}}
@if(isset($account_type_splash_window) && $account_type_splash_window==1)
    <style>
        .splash_window-parent-div {
            display: flex;
            justify-content: center;
            height: 100%;
            align-items: center;
        }
        .submit-btn-style input{
            width: 100%;
            max-width: 200px;
            background: #2ca01c;
            color: #ffff !important;
            border: none;
            padding: 10px 0;
            font-size: 16px;
            font-weight: 500;
        }
        .splash_window-parent-div p {
            font-size: 12px;
        }
        .form-content-div{
            border-radius: 10px;
            box-shadow: 0 15px 30px 0 rgb(0 0 0 / 11%), 0 5px 15px 0 rgb(0 0 0 / 8%);
            background: #fff;
            margin: 0 !important;
            padding: 40px 40px;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="splash_window-parent-div">
                <div class="col-md-10">
                    <div class="form-content-div">
                        <div class="header_img">
                            <img src="{{ asset('icons/freshworks.png') }}">
                        </div>
                        <h4  style="color: black" class="header-heading">Allow Connectify to Access you Freshworks account</h4>
                        <h6 style="color: black">QuickBook Environment <span>(required)</span></h6>
                        <p  style="color: black">Most People Should Chose the Default, "Production"</p>
                        <form method="post"
                              action="{{ route('freshworks_online_account_login',[
                                'channel_id'    =>  $channel_id,
                                'custom_app_id' =>  $custom_app_id ?? 0,
                                'id'            =>  $id ?? 0 ]) }}">
                            @csrf
                            <div class="form-group">
                                <select name="account_type" class="form-control" id="">
                                    <option value="production">Production</option>
                                    <option value="sandbox">Sandbox</option>
                                </select>
                            </div>
                            <div class="form-group submit-btn-style" style="text-align: center">
                                <input type="submit" value="Continue">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@section('last_scripts')
    <script type="text/javascript">
        {{--redirect user after callback method to list quickbook accounts--}}
        @if(!isset($account_type_splash_window))
        window.opener.freshworksPopupCallback('Successfully logged In.'); //Call callback function
        window.close(); // Close the current popup
        @endif
    </script>
@endsection