<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('dist/assets/img/logo-bran.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('dist/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="{{ asset('dist/css/jquery-ui.css') }}">

    {{-- <link rel="stylesheet" href="{{ asset('dist/css/autoFill.bootstrap4.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('dist/css/my.css.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/semantic.min.css') }}">
    <title> {{ __('lang.login') }} | REG-KSIT</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        #bg-login{
            width: 100%;
            height: 100vh;
            position: fixed;
            background-image: url('{{ asset("dist/assets/img/background-login.jpg") }}');
            background-position: center;
            background-size: cover;
            top: 0;
            left: 0;
            background-repeat: no-repeat;
            background-position: center;
        }

        .overlay{
            background: #adadad64;
            width: 100%;
            height: 100%;
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .bg-form{
            position: relative;
            background: #ffffff;
            padding: 1.5rem;
            border-radius: 0.5rem;
        }
        footer{
            position: fixed;
            bottom: 0;
            width: 100%;
            background: #ffffff70;
            padding: 0.3rem 0;
            text-align: center;
            /* disfplay: flex;
            align-items: center;
            justify-content: center; */
        }
    </style>
</head>
<body>
    <div id="bg-login">
        <div class="overlay">
            <div class="bg-form col-11 col-sm-6 col-md-5 col-lg-4 col-xl-3 shadow-lg">
                <div class="col-md-12 part">
                    <img class="ui image tiny mx-auto d-block" src="{{ asset('dist/assets/img/logo-bran.png') }}" alt="" width="15%">
                    <h2 class="text-center ui medium header">{{__("lang.ims")}}</h2>
                    <form action="{{ route('login.save') }}" class="ui form" autocomplete="off" method="POST">
                        @csrf
                        @if(session('error'))
                            <div class="ui red message">{{session('error')}}</div>
                        @endif
                        <div class="field">
                            <label for="username"> {{ __("lang.username") }} </label>
                            {{-- <input type="text" id="username" name="username" placeholder="{{ __("lang.username") }}"> --}}
                            <div class="ui left icon input">
                                <input type="text" id="username" name="username" placeholder="{{ __("lang.username") }}" value="{{ old('username') }}">
                                <i class="bi bi-person-fill icon"></i>
                            </div>
                        </div>
                        <div class="field">
                            <label for="password"> {{ __("lang.password") }} </label>
                            <div class="ui left icon input">
                                <input type="password" id="password" name="password" placeholder="{{ __("lang.password") }}">
                                <i class="bi bi-lock-fill icon"></i>
                            </div>
                        </div>
                        <div class="ui checkbox">
                            <input type="checkbox" id="showPass" name="example">
                            <label for="showPass"> {{ __("lang.showPass") }} </label>
                        </div>

                        <div class="ui error message">

                        </div>



                        <button type="submit" class="ui primary button d-block w-100 mt-4"> {{ __('lang.login') }} </button>
                        <p class="m-0 mt-4 text-center">{{__("lang.forgotPassword")}} <a type="button" data-bs-toggle="modal" data-bs-target="#readInfo"class="link">{{__('lang.readInfo')}}</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="readInfo" tabindex="-1" aria-labelledby="readInfoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ui medium header" id="readInfoLabel"> <i class="bi bi-chat-right-text-fill pe-1"></i> {{ __('lang.messageFromIms') }} </h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div class="modal-body">
                    <h4 class="ui tiny header"> {{ __('lang.aboutForgotPassword') }} </h4>
                    <p>
                        {{ __('lang.fogotPasswordInfoContent') }}
                    </p>
                    {{-- <h4 class="ui tiny header"> {{ __('lang.contactBy') }} </h4> --}}
                    <div class="ui message">
                        <div class="ui tiny header">
                            {{ __('lang.contactBy') }}
                        </div>
                        <ul class="list">
                            <li> 085 483 609 / 010 770 774/ 096 47 67 709</li>
                            <li><a class="link text-primary">info@ksit.edu.kh</a> </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="ui tiny button " data-bs-dismiss="modal"> {{ __('lang.close') }} </button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="text-center text-muted">
            <p class="m-0"> {{ __('lang.copyright') }} &copy; {{ date('Y') }} | <a class="link">{{__('lang.ims')}}</a> <span class="ps-2">{{config('app.version')}}</span></p>
            {{-- <p class="m-0">{{ __('lang.poweredBy') }} <a href="https://www.facebook.com/khmerdevs" target="_blank" class="link">KhmerDevs</a></p> --}}
        </div>
    </footer>
    <script
        src="{{ asset('dist/js/bootstrap.min.js') }}"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"
    ></script>
    <script src="{{ asset('dist/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('dist/js/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/ui-css/semantic.min.js') }}"></script>

    <script>
        $('.ui.form').form({
            fields: {
                username: {
                    identifier: 'username',
                    rules: [
                        {
                            type   : 'empty',
                            prompt : '{{ __("lang.pleaseEnterusername") }}'
                        }
                    ]
                },
                password: {
                    identifier: 'password',
                    rules: [
                        {
                            type   : 'minLength[4]',
                            prompt : '{{ __("lang.pleaseEnterpasswordLest4Charecter") }}'
                        }
                    ]
                },
            }
        });

        $(document).ready(function () {
            $('#showPass').on('change', function () {
                if($('#password').attr('type') == 'password'){
                    $('#password').attr('type', 'text');
                }else{
                    $('#password').attr('type', 'password');
                }
            });
        });

        $('form').submit(function() {
            var submitButton = $('button[type="submit"]');
            submitButton.prop('disabled', true);
            submitButton.addClass('loading');

            setTimeout(function() {
                submitButton.prop('disabled', false);
                submitButton.removeClass('loading');
            }, 3000);
        });

    </script>
</body>
</html>
