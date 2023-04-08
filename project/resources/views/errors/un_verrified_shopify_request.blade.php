<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <title>{{ config('app.name') }}</title>
        <link rel="icon" href="{{ asset('cdn/icon-16x16.jpg') }}" type="image/jpg" sizes="16x16">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
              type="text/css"/>
        <link href="https://sdks.shopifycdn.com/polaris/3.5.0/polaris.min.css" rel="stylesheet" type="text/css"/>
        {{--<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>--}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <link href="{{ URL::asset('css/appdesign/css/login.css', null, true) }}" rel="stylesheet" type="text/css"/>
        
    </head>
    <body>
        <section class="py-5 bg-images d-flex"> 
            <div class="container-fluid d-flex">
                <div class="row align-items-center" style="display: flex;flex-wrap: wrap;justify-content: center;align-items: center;">
                    <div class="col-md-5">
                        <div class="row">
                            <div style="justify-content: center;display: flex;flex-wrap: wrap;">
                                <div >
                                    <div class="icon-inner">
                                        <img src="{{ asset('assets/images/5cb480cd5f1b6d3fbadece79.png') }}" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div >
                                    <div class="icon-inner">
                                        <img src="{{ asset('assets/images/Google_Sheets_2020_Logo.svg.png') }}" style="width: 31px;"
                                            class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div >
                                    <div class="icon-inner">
                                        <img src="{{ asset('assets/images/twilio_logo_2c883610a9.png') }}" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div >
                                    <div class="icon-inner">
                                        <img src="{{ asset('assets/images/Mail.png') }}" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div >
                                    <div class="icon-inner">
                                        <img src="{{ asset('assets/images/_8XBlvMyDTQiE0Ez49lHjPg_4AaEfOiSQ622mu_oN0vqeA_app_qbpne1ppRXCtNLHekBws-A_peUlz7vIRWCVi1IWQ9JlIw.png ') }}"
                                            class="img-fluid" alt="">
                                    </div>
                                </div>
                            
                                <div >
                                    <div class="icon-inner">
                                        <img src="{{ asset('assets/images/post_to_url.png') }}" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div >
                                    <div class="icon-inner">
                                        <img src="{{ asset('assets/images/mysql.png') }}" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div >
                                    <div class="icon-inner">
                                        <img src="{{ asset('assets/images/hubspot.png') }}" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div >
                                    <div class="icon-inner">
                                        <img src="{{ asset('assets/images/mailchimp.png') }}" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div >
                                    <div class="icon-inner">
                                        <img src="{{ asset('assets/images/freshworks.png') }}" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div >
                                    <div class="icon-inner">
                                        <img src="{{ asset('assets/images/salesforce.png') }}" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div >
                                    <div class="icon-inner">
                                        <img src="{{ asset('assets/images/quickbooks_online.png') }}" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div >
                                    <div class="icon-inner">
                                        <img src="{{ asset('assets/images/zoho_crm.png') }}" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div >
                                    <div class="icon-inner">
                                        <img src="{{ asset('assets/images/zoho_books.png') }}" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div >
                                    <div class="icon-inner">
                                        <img src="{{ asset('assets/images/dropbox.png') }}" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div >
                                    <div class="icon-inner">
                                        <img src="{{ asset('assets/images/lob.png') }}" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div >
                                    <div class="icon-inner">
                                        <img src="{{ asset('assets/images/klaviyo.png') }}" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div >
                                    <div class="icon-inner">
                                        <img src="{{ asset('assets/images/elastic_email.png') }}" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div >
                                    <div class="icon-inner">
                                        <img src="{{ asset('assets/images/marketo.png') }}" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div >
                                    <div class="icon-inner">
                                        <img src="{{ asset('assets/images/iContact.png') }}" class="img-fluid" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="login-inner">
                            @if(!isset($login_section_not_required))
                            <div class="login-from text-center">
                                <img src="{{ asset('assets/images/629b6c1a7c5cd817694c321c.png') }}" class="img-fluid" alt="">
                                <h3>LOGIN</h3>
                                <p>The URL of the Shop (enter it exactly like this: myshop.myshopify.com). </p>
                            </div>
                            <div>
                                <form role="form" action="{{ route('install') }}" method="get">
                                    <input type="text" placeholder="myshop.myshopify.com" name="shop" id="shop"  class="login-page-input">
                                    <h3 class="alert-warning"><strong>Oops !</strong> Request Not Verified! Please restart the
                                        app from apps listing in admin panel.</h3>
                                    <div class="text-center">
                                        <button class="install-btn" type="submit">Login or Install <i
                                                class="fa-solid fa-download fa ms-2"></i></button>
                                    </div>
                                </form>
                            </div>
                            @endif
                            @if(!isset($login_section_not_required))
                            <p class="login-title">Are you using Safari or google chrome incognito mode? Please upgrade to
                                your latest version for safari while enable cookies for third party app in google chrome
                                settings.</p>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
