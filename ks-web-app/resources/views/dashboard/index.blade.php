@extends('dashboard.layouts.main')
{{-- TODO: Tambahkan Confirm apakah ingin keluar atau tidak? --}}
{{-- @if (session()->has('success'))
    <div aria-live="polite" aria-atomic="true" class="position-relative">
        <div class="toast-container top-0 end-0 p-3">
            <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-success-10 text-black-100">
                    <strong class="me-auto"><i class="las la-check-circle text-success-100 fs-18"></i> Kpop
                        Soulmate</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body bg-success-10 inter-regular-14 text-black-100">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    </div>
@endif --}}

@section('content')
    {{-- google Chart --}}
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Category Name', 'Number of Video'],
                ['Line Distribution', 11],
                ['Line Evolution', 2],
                ['Album Distribution', 2],
                ['All Title Tracks', 2]
            ]);

            var options = {
                pieHole: 0.4,
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }
    </script>

    {{-- TODO: Ubah Beberapa Teks menjadi inter --}}
    <section id="header-analytics">
        <div class="row mb-4">
            <div class="col">
                <div class="d-flex justify-content-between">
                    <div>
                        <h1 class="fw-bold">Analytics Dashboard</h1>
                        <p>Monitor key metrics. Check Reporting and review insights</p>
                    </div>

                    <div>
                        <button class="btn btn-main">
                            <i class="las la-download"></i>
                            Back Up
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="card-analytics">
        <div class="row mb-5">
            <div class="col">
                <div class="card-analytics">
                    <div class="d-flex flex-row justify-content-between">
                        <div class="card-info">
                            <div class="card-head">
                                <span>Requests</span>
                                <small>Number of Requests</small>
                            </div>
                            <h2>222</h2>
                            <small>On Google Form and Youtube</small>
                        </div>
                        <div class="card-icon align-self-center">
                            <i class="las la-clipboard-list"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card-analytics">
                    <div class="d-flex flex-row justify-content-between">
                        <div class="card-info">
                            <div class="card-head">
                                <span>Video</span>
                                <small>Number of Videos</small>
                            </div>
                            <h2>222</h2>
                            <small>Uploaded On Youtube</small>
                        </div>
                        <div class="card-icon align-self-center">
                            <i class="lab la-youtube"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card-analytics">
                    <div class="d-flex flex-row justify-content-between">
                        <div class="card-info">
                            <div class="card-head">
                                <span>Requests Completed</span>
                                <small>Number of Requests</small>
                            </div>
                            <h2>5 / 222</h2>
                            <small>Progress </small>
                        </div>
                        <div class="card-icon align-self-center">
                            <i class="las la-clipboard-check"></i>
                        </div>
                    </div>
                    <div class="progress rounded-pill">
                        <div class="progress-bar rounded-pill" role="progressbar"
                            style="width: 10%; background-color: #776eb7;" aria-valuemin="0" aria-valuemax="100">4%
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="category-statistics">
        <div class="row mb-5">
            <div class="col">
                <div class="analytics-card">
                    <div class="analytics-head">
                        <div class="link-details d-flex justify-content-between">
                            <h4 class="fw-semibold">Category Statistics</h4>
                            <a href="category">
                                <small>Show Category <i class="las la-angle-right"></i></small>
                            </a>
                        </div>
                        <div class="analytics-chart">
                            <div id="donutchart" style="width: 900px; height: 500px; margin:auto;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="schedule">
        <div class="row mb-5">
            <div class="col">
                <div class="analytics-card">
                    <div class="analytics-head">
                        <div class="link-details d-flex justify-content-between">
                            <h4 class="fw-semibold">Schedule</h4>
                            <a href="">
                                <small>Show All <i class="las la-angle-right"></i></small>
                            </a>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row tabel-head">
                            <div class="col">Date</div>
                            <div class="col">Project Name</div>
                            <div class="col">Category</div>
                            <div class="col">Requester</div>
                            <div class="col">Status</div>
                        </div>
                        <div class="row tabel-body">
                            <div class="col align-self-center">
                                <i class="lar la-calendar"></i> 21 Aug 2021
                            </div>
                            <div class="col align-self-center">WJSN - Neverland</div>
                            <div class="col align-self-center">Album Distribution</div>
                            <div class="col align-self-center">Kpop Soulmate</div>
                            <div class="col">
                                <span class="btn btn-onprocess">On Process</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="video-content">
        <div class="row mb-5">
            <div class="col">
                <div class="analytics-card">
                    <div class="analytics-head">
                        <div class="link-details d-flex justify-content-between">
                            <h4 class="fw-semibold">Video Content</h4>
                            <a href="">
                                <small>Show All <i class="las la-angle-right"></i></small>
                            </a>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row tabel-head">
                            <div class="col">Video</div>
                            <div class="col">Category</div>
                            <div class="col">Url</div>
                            <div class="col-2">Date</div>
                        </div>
                        <div class="row tabel-body">
                            <div class="col">
                                <div>
                                    <img src="https://i.ytimg.com/vi/bJGe8w1C5Dc/hqdefault.jpg?sqp=-oaymwEcCNACELwBSFXyq4qpAw4IARUAAIhCGAFwAcABBg==&rs=AOn4CLA8fdppwQTGokJ-ZJgApshnUF_p2w"
                                        alt="thumbnail" style="width: 120px; height: 68px;">
                                </div>TWICE - Heart Shaker
                            </div>
                            <div class="col">Line Distribution</div>
                            <div class="col url-youtube">
                                <a href="https://youtu.be/bJGe8w1C5Dc" target="__blank">https://youtu.be/bJGe8w1C5Dc</a>
                            </div>
                            <div class="col-2">
                                <i class="las la-calendar"></i> 16 Dec 2020
                            </div>
                        </div>
                        <div class="row tabel-body">
                            <div class="col">
                                <div>
                                    <img src="https://i.ytimg.com/vi/bJGe8w1C5Dc/hqdefault.jpg?sqp=-oaymwEcCNACELwBSFXyq4qpAw4IARUAAIhCGAFwAcABBg==&rs=AOn4CLA8fdppwQTGokJ-ZJgApshnUF_p2w"
                                        alt="thumbnail" style="width: 120px; height: 68px;">
                                </div>TWICE - Heart Shaker
                            </div>
                            <div class="col">Line Distribution</div>
                            <div class="col url-youtube">
                                <a href="https://youtu.be/bJGe8w1C5Dc" target="__blank">https://youtu.be/bJGe8w1C5Dc</a>
                            </div>
                            <div class="col-2">
                                <i class="las la-calendar"></i> 16 Dec 2020
                            </div>
                        </div>
                        <div class="row tabel-body">
                            <div class="col">
                                <div>
                                    <img src="https://i.ytimg.com/vi/bJGe8w1C5Dc/hqdefault.jpg?sqp=-oaymwEcCNACELwBSFXyq4qpAw4IARUAAIhCGAFwAcABBg==&rs=AOn4CLA8fdppwQTGokJ-ZJgApshnUF_p2w"
                                        alt="thumbnail" style="width: 120px; height: 68px;">
                                </div>TWICE - Heart Shaker
                            </div>
                            <div class="col">Line Distribution</div>
                            <div class="col url-youtube">
                                <a href="https://youtu.be/bJGe8w1C5Dc" target="__blank">https://youtu.be/bJGe8w1C5Dc</a>
                            </div>
                            <div class="col-2">
                                <i class="las la-calendar"></i> 16 Dec 2020
                            </div>
                        </div>
                        <div class="row tabel-body">
                            <div class="col">
                                <div>
                                    <img src="https://i.ytimg.com/vi/bJGe8w1C5Dc/hqdefault.jpg?sqp=-oaymwEcCNACELwBSFXyq4qpAw4IARUAAIhCGAFwAcABBg==&rs=AOn4CLA8fdppwQTGokJ-ZJgApshnUF_p2w"
                                        alt="thumbnail" style="width: 120px; height: 68px;">
                                </div>TWICE - Heart Shaker
                            </div>
                            <div class="col">Line Distribution</div>
                            <div class="col url-youtube">
                                <a href="https://youtu.be/bJGe8w1C5Dc" target="__blank">https://youtu.be/bJGe8w1C5Dc</a>
                            </div>
                            <div class="col-2">
                                <i class="las la-calendar"></i> 16 Dec 2020
                            </div>
                        </div>
                        <div class="row tabel-body">
                            <div class="col">
                                <div>
                                    <img src="https://i.ytimg.com/vi/bJGe8w1C5Dc/hqdefault.jpg?sqp=-oaymwEcCNACELwBSFXyq4qpAw4IARUAAIhCGAFwAcABBg==&rs=AOn4CLA8fdppwQTGokJ-ZJgApshnUF_p2w"
                                        alt="thumbnail" style="width: 120px; height: 68px;">
                                </div>TWICE - Heart Shaker
                            </div>
                            <div class="col">Line Distribution</div>
                            <div class="col url-youtube">
                                <a href="https://youtu.be/bJGe8w1C5Dc" target="__blank">https://youtu.be/bJGe8w1C5Dc</a>
                            </div>
                            <div class="col-2">
                                <i class="las la-calendar"></i> 16 Dec 2020
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="project-list">
        <div class="row mb-5">
            <div class="col">
                <div class="analytics-card">
                    <div class="analytics-head">
                        <div class="link-details d-flex justify-content-between">
                            <h4 class="fw-semibold">Project List</h4>
                            <a href="">
                                <small>Show All <i class="las la-angle-right"></i></small>
                            </a>
                        </div>
                    </div>
                    <table class="table table-responsive table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Project Title</th>
                                <th scope="col">Category</th>
                                <th scope="col">Requester</th>
                                <th scope="col">Status</th>
                                <th>
                                    <i class="las la-ellipsis-v" id="projectMenu" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="align-middle">WJSN - Neverland</td>
                                <td class="align-middle">Album Distribution</td>
                                <td class="align-middle">Kpop Soulmate</td>
                                <td class="align-middle">
                                    <span class="btn btn-onprocess">On Process</span>
                                </td>
                                <td class="align-middle">
                                    <div class="dropleft">
                                        <i class="las la-ellipsis-v" id="projectMenu" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false"></i>
                                        <div class="dropdown-menu" aria-labelledby="projectMenu">
                                            <button class="dropdown-item" type="button">Update</button>
                                            <button class="dropdown-item" type="button">Hapus</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Hello Venus - Runaway</td>
                                <td>Line Distribution</td>
                                <td>Kpop Soulmate</td>
                                <td>
                                    <span class="btn btn-pending">On Process</span>
                                </td>
                                <td>
                                    <div class="btn-group dropstart">
                                        <button class="btn p-0" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="las la-ellipsis-v"> </i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <button class="dropdown-item" type="button">Update</button>
                                            </li>
                                            <li>
                                                <button class="dropdown-item" type="button">Hapus</button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
