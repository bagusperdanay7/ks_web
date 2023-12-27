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
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- Icon (Box Icon) --}}
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    {{-- Line Awesome --}}
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">


    <title>Page Doesn't Exist - Kpop Soulmate</title>
</head>

<body class="bg-color-light">

    <header class="bg-second p-3">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="brand">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo Kpop Soulmate" width="50px"
                            class=" align-middle">
                        <a class="navbar-brand logo-navbar align-middle text-color-100" href="{{ route('home') }}">KPOP
                            SOULMATE</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="row text-center">
                <div class="col">
                    <img src="{{ asset('img/NoPageIllustration.svg') }}" alt="Illustration Not Found" class="img-fluid">
                    <h2 class="fw-bold mt-3 text-color-100">404 Not Found</h2>
                    <p class="fw-medium text-color-100 mb-4">The page you are looking for doesn't exist!</p>
                    <a href="{{ route('home') }}" class="btn-404">Back to Home</a>
                </div>
            </div>
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

</body>

</html>
