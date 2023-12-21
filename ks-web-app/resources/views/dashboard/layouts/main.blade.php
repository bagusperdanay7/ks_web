<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    {{-- https://www.w3schools.com/tags/tag_meta.asp --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    {{-- My Style --}}
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    {{-- Icon (Box Icon) --}}
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    {{-- Line Awesome --}}
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    {{-- Script for Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- Google Chart --}}
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <title>{{ $title }} - Kpop Soulmate</title>
</head>

<body class="body-light">

    {{-- sidebar toggle --}}
    <input type="checkbox" id="sidebar-toggle">

    @include('dashboard.layouts.sidebar')

    @include('dashboard.layouts.header')

    <main class="main-content">
        <div class="container-fluid">
            @yield('content')
        </div>
    </main>

    <label for="sidebar-toggle" class="body-label"></label>

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

    <script src="{{ asset('js/dashboard.js') }}"></script>

</body>

</html>
