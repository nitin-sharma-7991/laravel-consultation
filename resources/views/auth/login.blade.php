@extends('layouts.app')

<section class="sign-in py-5 d-fllex d-flex justify-content-center align-items-center"
        style="background-color: #1e65a6; min-height: 100vh">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center" style="margin: 0;">
                <div class="col-xl-10" style="padding: 0;">
                    <div class="card rounded-3 text-black overflow-hidden" style="border-width: 5px;">
                        <div class="row g-0">
                            <div class="col-lg-6 left-side left-side-login2 ">
                                <div class="left-side-content text-center w-100 h-100">
                                    <div class="bg-color-login d-flex align-items-center h-100">

                                        <div class="w-100">
                                            <!-- <img src="{{ asset('assets/images/logo.png') }}" alt="" class=""
                                                width="150px"> -->

                                            <h4 class="mt-2">
                                                <?= !empty($language_id) && isset($all_tranlations_arr[$language_id]['welcome_back']) ? $all_tranlations_arr[$language_id]['welcome_back'] : 'Welcome Back' ?>
                                            </h4>
                                            <span
                                                class="mt-3"><?= !empty($language_id) && isset($all_tranlations_arr[$language_id]['lets_get_started!']) ? $all_tranlations_arr[$language_id]['lets_get_started!'] : ' Let\'s get started!' ?></span>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6 my-auto">
                                <div class="card-body p-md-5 mx-md-4 sign-in-side">
                                    @include('layouts.partials.messages')


                                    <form method="POST" id="login-form" action="{{ url('/login') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="form-outline mb-4">
                                            <label for="password"> {{ __('Password') }}</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control password" id="password"
                                                    name="password" required autocomplete="off"
                                                    data-parsley-errors-container="#errorpasswordContainer">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-eye-slash toggle-password"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div id="errorpasswordContainer"></div>
                                        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <div class="text-center mt-3">
    Don’t have an account? <a href="{{ route('register') }}">Register here</a>
</div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @push('scripts')
        <script>
            $(document).ready(function() {

                $('#login-form').parsley().on('form:submit', function() {
                    current_btn = $(this).closest('form');
                    current_btn.find('.login-btn').prop('disabled', true);
                });

            });
            $('.toggle-password').click(function() {
                $(this).toggleClass('fa-eye fa-eye-slash');
                var input = $("#password");
                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                } else {
                    input.attr('type', 'password');
                }
            });
        </script>
    @endpush