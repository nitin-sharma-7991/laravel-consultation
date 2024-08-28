<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="nitin">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" sizes="32x32">
    <title>{{ env('APP_NAME') }} {{ @$title }}</title>
    <link href="{!! asset('assets/css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('assets/css/style.css') !!}" rel="stylesheet">
    <link href="{!! asset('assets/css/custom.css') !!}" rel="stylesheet">
    <link href="{!! asset('assets/vendor/fontawesome-free/css/all.min.css') !!}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @stack('css')
</head>
<body>
   
    <main class="form-signin">
        @yield('content')
    </main>
    
    <!-- Scripts -->
    <script src="{!! asset('assets/js/jquery.min.js') !!}"></script>
    <script src="{!! asset('assets/js/bootstrap.min.js') !!}"></script>
    <script src="{!! asset('assets/js/parsley.min.js') !!}"></script>
    <script src="{!! asset('assets/js/sweetalert.min.js') !!}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Include Pusher and Laravel Echo -->
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.1/dist/echo.iife.js"></script>
    
    <script>
        // Enable Pusher logging - don't include this in production
        Pusher.logToConsole = true;

        // Initialize Echo
        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: '{{ env('PUSHER_APP_KEY') }}',
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
            forceTLS: true
        });

        // Example of listening to a channel and event
        window.Echo.channel('consultations')
            .listen('ConsultationUpdated', (event) => {
                console.log('Consultation updated:', event.consultation);
                // You can handle the event data here (e.g., update the UI)
                // Display a notification
                showNotification(event.consultation);
            });

            function showNotification(consultation) {
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "positionClass": "toast-top-right",
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.info(`Consultation updated: ${consultation.date} at ${consultation.time}`);
            }

    </script>

    <script>
        $("form").parsley();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("input:required, select:required, textarea:required").prevAll("label").append("<span class='required'> *</span>");
        $(":input:not(:hidden)").each(function(i) {
            $(this).attr('tabindex', i + 1);
        });
    </script>
    @stack('scripts')

</body>
</html>
