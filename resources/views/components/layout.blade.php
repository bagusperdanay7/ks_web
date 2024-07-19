<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Kpop Soulmate Website is a website from the Kpop Soulmate YouTube Channel that discusses Kpop, especially Kpop line distribution. Besides Line distribution, the content made are line evolution, album distribution and etc. ">
    <meta name="keywords" content="Kpop Soulmate,Kpop,Website,Line Distribution,Korea,Lyrics,Color Coded Lyrics">
    <meta name="author" content="Kpop Soulmate">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- TODO: Move from CDN To Local -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    {{-- My Style --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- Icon (Box Icon) --}}
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    {{-- Line Awesome --}}
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">
    @vite(['resources/css/app.css','resources/js/app.js'])

    <title>{{ $title }} - Kpop Soulmate</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Google tag (gtag.js) - Active kan ketika deploy -->
    {{-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-586T4HCWK2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
    
        gtag('config', 'G-586T4HCWK2');
    </script> --}}
</head>

<body class="bg-color-light">

    @include('layouts.navbar')

    <main>
        <div class="container">
            @yield('content')
            {{ $slot }}
        </div>
    </main>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
        integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous">
    </script>

    {{-- Bootstrap Script --}}
    <script>
        // Activate Tooltip
        const tooltipTriggerList = document.querySelectorAll(
            '[data-bs-toggle="tooltip"]'
        );

        const tooltipList = [...tooltipTriggerList].map(
            (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
        );

        // Add Toaster

        const toastElList = document.querySelectorAll('.toast')
        const toastList = [...toastElList].map(toastEl => new bootstrap.Toast(toastEl, option))

        const toastTrigger = document.getElementById("liveToastBtn");
        const toastLiveExample = document.getElementById("liveToast");

        if (toastTrigger) {
            const toastBootstrap =
                bootstrap.Toast.getOrCreateInstance(toastLiveExample);
            toastTrigger.addEventListener("click", () => {
                toastBootstrap.show();
            });
        }

        //  Add Alert
        const alertList = document.querySelectorAll(".alert");
        const alerts = [...alertList].map((element) => new bootstrap.Alert(element));
    </script>

    <script src="{{ asset('js/script.js') }}"></script>

    <!--Google Adsense - Aktifkan Ketika Deploy-->
    {{-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9138729091125895"
    crossorigin="anonymous"></script> --}}

</body>

</html>
