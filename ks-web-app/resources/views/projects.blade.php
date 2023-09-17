@extends('layouts.main')

@section('content')
    <section id="project-header" class="mb-30">
        <div class="row">
            <h2 class="mb-10 fw-bold text-color-100">Projects</h2>
            <p class="project-text">The projects we are currently working on consists of Huge Project, Nostalgic Vibes,
                and
                requests from Youtube comments.</p>
        </div>
    </section>

    <section id="upcoming-projects" class="mb-30">
        <div class="row">
            <div class="col">
                <div class="project-section border">
                    <h3>Upcoming Schedule</h3>
                    <p>The upcoming Schedule shows what projects are coming up in a short time.</p>
                    <div class="table-responsive d-md-block d-none">
                        <table class="table table-hover projects-table">
                            <thead>
                                <tr>
                                    <th>Project Title</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                    <th>Project Type</th>
                                    <th>Requester</th>
                                    <th>Status</th>
                                    <th>Votes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($projectsUpcoming as $project)
                                    <tr>
                                        <td class="align-middle title-with-progress">
                                            <div>
                                                <div class="d-flex justify-content-between fw-medium fs-14">
                                                    <p class="p-0 m-0">
                                                        {{ $project->project_title }}
                                                    </p>
                                                    <span class="p-0 m-0 ">
                                                        {{ $project->progress }}%
                                                    </span>
                                                </div>
                                                <div class="progress bg-main-20" style="height: 10px">
                                                    <div class="progress-bar bg-main rounded-pill" role="progressbar"
                                                        style="width: {{ $project->progress }}%;"
                                                        aria-valuenow="{{ $project->progress }}" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td @class([
                                            'align-middle',
                                            'fw-medium',
                                            'text-color-ld' =>
                                                $project->category->category_name === 'Line Distribution',
                                            'text-color-le' => $project->category->category_name === 'Line Evolution',
                                            'text-color-ad' =>
                                                $project->category->category_name === 'Album Distribution',
                                            'text-color-ae' => $project->category->category_name === 'Album Evolution',
                                            'text-color-rb' => $project->category->category_name === 'Ranking Battle',
                                            'text-color-hs' => $project->category->category_name === 'How Should',
                                            'text-color-hw' => $project->category->category_name === 'How Would',
                                            'text-color-cd' =>
                                                $project->category->category_name === 'Center Distribution',
                                        ])> {{ $project->category->category_name }}</td>
                                        <td class="align-middle fw-medium text-color-100"><i class="lar la-calendar"></i>
                                            {{ \Carbon\Carbon::parse($project->date)->format('d F Y, G:i T') }}
                                        </td>
                                        <td class="align-middle text-color-100">{{ $project->type->type_name }}</td>
                                        <td class="align-middle text-color-100">{{ $project->requester }}</td>
                                        <td class="align-middle">
                                            <span @class([
                                                'btn',
                                                'btn-complete' => $project->status === 'Completed',
                                                'btn-onprocess' => $project->status === 'On Process',
                                                'btn-pending' => $project->status === 'Pending',
                                                'btn-rejected' => $project->status === 'Rejected',
                                            ])> {{ $project->status }}</span>
                                        </td>
                                        <td class="align-middle text-center text-color-100">{{ $project->votes }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-color-100">
                                            <svg width="48" height="48" viewBox="0 0 84 84" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M39.176 46.828L38.564 29.44H44L43.424 46.828H39.176ZM44.468 52.3C44.468 53.956 43.172 55.252 41.408 55.252C39.572 55.252 38.276 53.956 38.276 52.3C38.276 50.644 39.572 49.348 41.408 49.348C43.172 49.348 44.468 50.644 44.468 52.3Z"
                                                    fill="#EA8887" />
                                                <path
                                                    d="M47.9745 8.0255C47.65 7.69985 47.2644 7.4416 46.8397 7.2656C46.415 7.0896 45.9597 6.99934 45.5 7H21C17.1395 7 14 10.1395 14 14V70C14 73.8605 17.1395 77 21 77H63C66.8605 77 70 73.8605 70 70V31.5C70.0007 31.0403 69.9104 30.585 69.7344 30.1603C69.5584 29.7356 69.3002 29.35 68.9745 29.0255L47.9745 8.0255ZM21 14H44.051L63 32.949L63.007 65.058L54.019 56.07C55.244 53.9875 56 51.5865 56 49C56 41.279 49.721 35 42 35C34.279 35 28 41.279 28 49C28 56.721 34.279 63 42 63C44.5865 63 46.9875 62.244 49.07 61.019L58.051 70H21V14ZM42 56C38.1395 56 35 52.8605 35 49C35 45.1395 38.1395 42 42 42C45.8605 42 49 45.1395 49 49C49 52.8605 45.8605 56 42 56Z"
                                                    fill="#787878" />
                                            </svg>
                                            <p class="fs-14 fw-medium mt-1 mb-0">No Upcoming Project!</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="table-mobile">
                        @forelse ($projectsUpcoming as $project)
                            <div class="row {{ $loop->last ? '' : 'mb-3' }}">
                                <div class="col">
                                    <div class="table-content-mobile">
                                        <div class="fs-14 fw-medium text-color-80 mb-10"><i class="lar la-calendar"></i>
                                            {{ \Carbon\Carbon::parse($project->date)->format('j F Y, G:i T') }}
                                        </div>
                                        <div class="mb5">
                                            <span @class([
                                                'btn',
                                                'btn-complete' => $project->status === 'Completed',
                                                'btn-onprocess' => $project->status === 'On Process',
                                                'btn-pending' => $project->status === 'Pending',
                                                'btn-rejected' => $project->status === 'Rejected',
                                            ])> {{ $project->status }}</span>
                                        </div>
                                        <div class="mb5">
                                            <p class="fs-14 m-0 fw-semibold text-color-100">
                                                {{ $project->project_title }}
                                            </p>
                                        </div>
                                        <div class="fs-14 fw-medium mb5">
                                            <span @class([
                                                'text-color-ld' =>
                                                    $project->category->category_name === 'Line Distribution',
                                                'text-color-le' => $project->category->category_name === 'Line Evolution',
                                                'text-color-ad' =>
                                                    $project->category->category_name === 'Album Distribution',
                                                'text-color-ae' => $project->category->category_name === 'Album Evolution',
                                                'text-color-rb' => $project->category->category_name === 'Ranking Battle',
                                                'text-color-hs' => $project->category->category_name === 'How Should',
                                                'text-color-hw' => $project->category->category_name === 'How Would',
                                                'text-color-cd' =>
                                                    $project->category->category_name === 'Center Distribution',
                                            ])>
                                                {{ $project->category->category_name }}</span> •
                                            <span class="text-color-100">{{ $project->type->type_name }}</span>
                                        </div>
                                        <div class="text-color-100 fs-14 fw-medium mb5">
                                            <i class="las la-user-alt"></i> {{ $project->requester }} |
                                            {{ $project->votes }}
                                            Votes
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p class="m-0 fs-14">Progress</p>
                                            <span class="fs-14 fw-semibold text-color-100">{{ $project->progress }}%</span>
                                        </div>
                                        <div class="progress bg-main-20" role="progressbar" style="height: 10px"
                                            aria-label="progress project" aria-valuenow="{{ $project->progress }}"
                                            aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-main rounded-pill"
                                                style="width: {{ $project->progress }}%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col text-center text-color-100">
                                <svg width="48" height="48" viewBox="0 0 84 84" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M39.176 46.828L38.564 29.44H44L43.424 46.828H39.176ZM44.468 52.3C44.468 53.956 43.172 55.252 41.408 55.252C39.572 55.252 38.276 53.956 38.276 52.3C38.276 50.644 39.572 49.348 41.408 49.348C43.172 49.348 44.468 50.644 44.468 52.3Z"
                                        fill="#EA8887" />
                                    <path
                                        d="M47.9745 8.0255C47.65 7.69985 47.2644 7.4416 46.8397 7.2656C46.415 7.0896 45.9597 6.99934 45.5 7H21C17.1395 7 14 10.1395 14 14V70C14 73.8605 17.1395 77 21 77H63C66.8605 77 70 73.8605 70 70V31.5C70.0007 31.0403 69.9104 30.585 69.7344 30.1603C69.5584 29.7356 69.3002 29.35 68.9745 29.0255L47.9745 8.0255ZM21 14H44.051L63 32.949L63.007 65.058L54.019 56.07C55.244 53.9875 56 51.5865 56 49C56 41.279 49.721 35 42 35C34.279 35 28 41.279 28 49C28 56.721 34.279 63 42 63C44.5865 63 46.9875 62.244 49.07 61.019L58.051 70H21V14ZM42 56C38.1395 56 35 52.8605 35 49C35 45.1395 38.1395 42 42 42C45.8605 42 49 45.1395 49 49C49 52.8605 45.8605 56 42 56Z"
                                        fill="#787878" />
                                </svg>
                                <p class="fs-14 fw-medium mt-1 mb-0"></p>No Upcoming Project!
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="non-projects" class="mb-30">
        <div class="row">
            <div class="col">
                <div class="project-section border">
                    <div class="d-flex justify-content-between">
                        <h3>{{ $nonProjectType->type_name ?? '' }}</h3>
                    </div>
                    <p>{{ $nonProjectType->about ?? '' }}</p>
                    <div class="table-responsive mb-2 d-md-block d-none">
                        <table class="table table-hover projects-table">
                            <thead>
                                <tr>
                                    <th>Project Title</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                    <th>Requester</th>
                                    <th>Status</th>
                                    <th>Votes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($nonProjects as $nonProject)
                                    <tr>
                                        <td class="align-middle fw-medium text-color-100">{{ $nonProject->project_title }}
                                        </td>
                                        <td @class([
                                            'align-middle',
                                            'fw-medium',
                                            'text-color-ld' =>
                                                $nonProject->category->category_name === 'Line Distribution',
                                            'text-color-le' =>
                                                $nonProject->category->category_name === 'Line Evolution',
                                            'text-color-ad' =>
                                                $nonProject->category->category_name === 'Album Distribution',
                                            'text-color-ae' =>
                                                $nonProject->category->category_name === 'Album Evolution',
                                            'text-color-rb' =>
                                                $nonProject->category->category_name === 'Ranking Battle',
                                            'text-color-hs' => $nonProject->category->category_name === 'How Should',
                                            'text-color-hw' => $nonProject->category->category_name === 'How Would',
                                            'text-color-cd' =>
                                                $nonProject->category->category_name === 'Center Distribution',
                                        ])> {{ $nonProject->category->category_name }}</td>
                                        <td class="align-middle text-color-100"><i class="lar la-calendar"></i>
                                            {{ \Carbon\Carbon::parse($nonProject->date)->format('d F Y, G:i T') }}
                                        </td>
                                        <td class="align-middle text-color-100">{{ $nonProject->requester }}</td>
                                        <td class="align-middle">
                                            <span @class([
                                                'btn',
                                                'btn-complete' => $nonProject->status === 'Completed',
                                                'btn-onprocess' => $nonProject->status === 'On Process',
                                                'btn-pending' => $nonProject->status === 'Pending',
                                                'btn-rejected' => $nonProject->status === 'Rejected',
                                            ])> {{ $nonProject->status }}</span>
                                        </td>
                                        <td class="align-middle text-color-100">{{ $nonProject->votes }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-color-100">
                                            <svg width="48" height="48" viewBox="0 0 84 84" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M39.176 46.828L38.564 29.44H44L43.424 46.828H39.176ZM44.468 52.3C44.468 53.956 43.172 55.252 41.408 55.252C39.572 55.252 38.276 53.956 38.276 52.3C38.276 50.644 39.572 49.348 41.408 49.348C43.172 49.348 44.468 50.644 44.468 52.3Z"
                                                    fill="#EA8887" />
                                                <path
                                                    d="M47.9745 8.0255C47.65 7.69985 47.2644 7.4416 46.8397 7.2656C46.415 7.0896 45.9597 6.99934 45.5 7H21C17.1395 7 14 10.1395 14 14V70C14 73.8605 17.1395 77 21 77H63C66.8605 77 70 73.8605 70 70V31.5C70.0007 31.0403 69.9104 30.585 69.7344 30.1603C69.5584 29.7356 69.3002 29.35 68.9745 29.0255L47.9745 8.0255ZM21 14H44.051L63 32.949L63.007 65.058L54.019 56.07C55.244 53.9875 56 51.5865 56 49C56 41.279 49.721 35 42 35C34.279 35 28 41.279 28 49C28 56.721 34.279 63 42 63C44.5865 63 46.9875 62.244 49.07 61.019L58.051 70H21V14ZM42 56C38.1395 56 35 52.8605 35 49C35 45.1395 38.1395 42 42 42C45.8605 42 49 45.1395 49 49C49 52.8605 45.8605 56 42 56Z"
                                                    fill="#787878" />
                                            </svg>
                                            <p class="fs-14 fw-medium mt-1 mb-0">No Project Found!</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="table-mobile mb-30">
                        @forelse ($nonProjects as $nonProject)
                            <div class="row {{ $loop->last ? '' : 'mb-3' }}">
                                <div class="col">
                                    <div class="table-content-mobile">
                                        <div class="fs-14 fw-medium text-color-80 mb-10"><i class="lar la-calendar"></i>
                                            {{ \Carbon\Carbon::parse($nonProject->date)->format('j F Y, G:i T') }}
                                        </div>
                                        <div class="mb5">
                                            <span @class([
                                                'btn',
                                                'btn-complete' => $nonProject->status === 'Completed',
                                                'btn-onprocess' => $nonProject->status === 'On Process',
                                                'btn-pending' => $nonProject->status === 'Pending',
                                                'btn-rejected' => $nonProject->status === 'Rejected',
                                            ])> {{ $nonProject->status }}</span>
                                        </div>
                                        <div class="mb5">
                                            <p class="fs-14 m-0 fw-semibold text-color-100">
                                                {{ $nonProject->project_title }}
                                            </p>
                                        </div>
                                        <div class="fs-14 fw-medium mb5">
                                            <span @class([
                                                'text-color-ld' =>
                                                    $nonProject->category->category_name === 'Line Distribution',
                                                'text-color-le' =>
                                                    $nonProject->category->category_name === 'Line Evolution',
                                                'text-color-ad' =>
                                                    $nonProject->category->category_name === 'Album Distribution',
                                                'text-color-ae' =>
                                                    $nonProject->category->category_name === 'Album Evolution',
                                                'text-color-rb' =>
                                                    $nonProject->category->category_name === 'Ranking Battle',
                                                'text-color-hs' => $nonProject->category->category_name === 'How Should',
                                                'text-color-hw' => $nonProject->category->category_name === 'How Would',
                                                'text-color-cd' =>
                                                    $nonProject->category->category_name === 'Center Distribution',
                                            ])>
                                                {{ $nonProject->category->category_name }}</span>
                                        </div>
                                        <div class="text-color-100 fs-14 fw-medium">
                                            <i class="las la-user-alt"></i> {{ $nonProject->requester }} |
                                            {{ $nonProject->votes }}
                                            Votes
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col text-center text-color-100">
                                <svg width="48" height="48" viewBox="0 0 84 84" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M39.176 46.828L38.564 29.44H44L43.424 46.828H39.176ZM44.468 52.3C44.468 53.956 43.172 55.252 41.408 55.252C39.572 55.252 38.276 53.956 38.276 52.3C38.276 50.644 39.572 49.348 41.408 49.348C43.172 49.348 44.468 50.644 44.468 52.3Z"
                                        fill="#EA8887" />
                                    <path
                                        d="M47.9745 8.0255C47.65 7.69985 47.2644 7.4416 46.8397 7.2656C46.415 7.0896 45.9597 6.99934 45.5 7H21C17.1395 7 14 10.1395 14 14V70C14 73.8605 17.1395 77 21 77H63C66.8605 77 70 73.8605 70 70V31.5C70.0007 31.0403 69.9104 30.585 69.7344 30.1603C69.5584 29.7356 69.3002 29.35 68.9745 29.0255L47.9745 8.0255ZM21 14H44.051L63 32.949L63.007 65.058L54.019 56.07C55.244 53.9875 56 51.5865 56 49C56 41.279 49.721 35 42 35C34.279 35 28 41.279 28 49C28 56.721 34.279 63 42 63C44.5865 63 46.9875 62.244 49.07 61.019L58.051 70H21V14ZM42 56C38.1395 56 35 52.8605 35 49C35 45.1395 38.1395 42 42 42C45.8605 42 49 45.1395 49 49C49 52.8605 45.8605 56 42 56Z"
                                        fill="#787878" />
                                </svg>
                                <p class="fs-14 fw-medium mt-1 mb-0"></p>No Project found!
                            </div>
                        @endforelse
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <a href="/projects-type/{{ $nonProjectType->slug ?? '' }}"
                            class="link-show-all text-decoration-none fs-14 fw-medium">Show
                            All <i class="las la-arrow-right"> </i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="huge-projects-vol1" class="mb-30">
        <div class="row">
            <div class="col">
                <div class="project-section border">
                    <div class="d-flex justify-content-between">
                        <h3>{{ $hugeProjectType->type_name ?? '' }}</h3>
                    </div>
                    <p>{{ $hugeProjectType->about ?? '' }}</p>
                    <div class="table-responsive mb-2 d-md-block d-none">
                        <table class="table table-hover projects-table">
                            <thead>
                                <tr>
                                    <th>Project Title</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                    <th>Requester</th>
                                    <th>Status</th>
                                    <th>Votes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($hugeProjects as $hugeProj)
                                    <tr>
                                        <td class="align-middle fw-medium text-color-100">{{ $hugeProj->project_title }}
                                        </td>
                                        <td @class([
                                            'align-middle',
                                            'fw-medium',
                                            'text-color-ld' =>
                                                $hugeProj->category->category_name === 'Line Distribution',
                                            'text-color-le' => $hugeProj->category->category_name === 'Line Evolution',
                                            'text-color-ad' =>
                                                $hugeProj->category->category_name === 'Album Distribution',
                                            'text-color-ae' => $hugeProj->category->category_name === 'Album Evolution',
                                            'text-color-rb' => $hugeProj->category->category_name === 'Ranking Battle',
                                            'text-color-hs' => $hugeProj->category->category_name === 'How Should',
                                            'text-color-hw' => $hugeProj->category->category_name === 'How Would',
                                            'text-color-cd' =>
                                                $hugeProj->category->category_name === 'Center Distribution',
                                        ])> {{ $hugeProj->category->category_name }}</td>
                                        <td class="align-middle text-color-100"><i class="lar la-calendar"></i>
                                            {{ \Carbon\Carbon::parse($hugeProj->date)->format('d F Y, G:i T') }}
                                        </td>
                                        <td class="align-middle text-color-100">{{ $hugeProj->requester }}</td>
                                        <td class="align-middle">
                                            <span @class([
                                                'btn',
                                                'btn-complete' => $hugeProj->status === 'Completed',
                                                'btn-onprocess' => $hugeProj->status === 'On Process',
                                                'btn-pending' => $hugeProj->status === 'Pending',
                                                'btn-rejected' => $hugeProj->status === 'Rejected',
                                            ])> {{ $hugeProj->status }}</span>
                                        </td>
                                        <td class="align-middle text-color-100">{{ $hugeProj->votes }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-color-100">
                                            <svg width="48" height="48" viewBox="0 0 84 84" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M39.176 46.828L38.564 29.44H44L43.424 46.828H39.176ZM44.468 52.3C44.468 53.956 43.172 55.252 41.408 55.252C39.572 55.252 38.276 53.956 38.276 52.3C38.276 50.644 39.572 49.348 41.408 49.348C43.172 49.348 44.468 50.644 44.468 52.3Z"
                                                    fill="#EA8887" />
                                                <path
                                                    d="M47.9745 8.0255C47.65 7.69985 47.2644 7.4416 46.8397 7.2656C46.415 7.0896 45.9597 6.99934 45.5 7H21C17.1395 7 14 10.1395 14 14V70C14 73.8605 17.1395 77 21 77H63C66.8605 77 70 73.8605 70 70V31.5C70.0007 31.0403 69.9104 30.585 69.7344 30.1603C69.5584 29.7356 69.3002 29.35 68.9745 29.0255L47.9745 8.0255ZM21 14H44.051L63 32.949L63.007 65.058L54.019 56.07C55.244 53.9875 56 51.5865 56 49C56 41.279 49.721 35 42 35C34.279 35 28 41.279 28 49C28 56.721 34.279 63 42 63C44.5865 63 46.9875 62.244 49.07 61.019L58.051 70H21V14ZM42 56C38.1395 56 35 52.8605 35 49C35 45.1395 38.1395 42 42 42C45.8605 42 49 45.1395 49 49C49 52.8605 45.8605 56 42 56Z"
                                                    fill="#787878" />
                                            </svg>
                                            <p class="fs-14 fw-medium mt-1 mb-0">No Project Found!</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="table-mobile mb-30">
                        @forelse ($hugeProjects as $hugeProj)
                            <div class="row {{ $loop->last ? '' : 'mb-3' }}">
                                <div class="col">
                                    <div class="table-content-mobile">
                                        <div class="fs-14 fw-medium text-color-80 mb-10"><i class="lar la-calendar"></i>
                                            {{ \Carbon\Carbon::parse($hugeProj->date)->format('j F Y, G:i T') }}
                                        </div>
                                        <div class="mb5">
                                            <span @class([
                                                'btn',
                                                'btn-complete' => $hugeProj->status === 'Completed',
                                                'btn-onprocess' => $hugeProj->status === 'On Process',
                                                'btn-pending' => $hugeProj->status === 'Pending',
                                                'btn-rejected' => $hugeProj->status === 'Rejected',
                                            ])> {{ $hugeProj->status }}</span>
                                        </div>
                                        <div class="mb5">
                                            <p class="fs-14 m-0 fw-semibold text-color-100">
                                                {{ $hugeProj->project_title }}
                                            </p>
                                        </div>
                                        <div class="fs-14 fw-medium mb5">
                                            <span @class([
                                                'text-color-ld' =>
                                                    $hugeProj->category->category_name === 'Line Distribution',
                                                'text-color-le' => $hugeProj->category->category_name === 'Line Evolution',
                                                'text-color-ad' =>
                                                    $hugeProj->category->category_name === 'Album Distribution',
                                                'text-color-ae' => $hugeProj->category->category_name === 'Album Evolution',
                                                'text-color-rb' => $hugeProj->category->category_name === 'Ranking Battle',
                                                'text-color-hs' => $hugeProj->category->category_name === 'How Should',
                                                'text-color-hw' => $hugeProj->category->category_name === 'How Would',
                                                'text-color-cd' =>
                                                    $hugeProj->category->category_name === 'Center Distribution',
                                            ])>
                                                {{ $hugeProj->category->category_name }}</span>
                                        </div>
                                        <div class="text-color-100 fs-14 fw-medium">
                                            <i class="las la-user-alt"></i> {{ $hugeProj->requester }} |
                                            {{ $hugeProj->votes }}
                                            Votes
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col text-center text-color-100">
                                <svg width="48" height="48" viewBox="0 0 84 84" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M39.176 46.828L38.564 29.44H44L43.424 46.828H39.176ZM44.468 52.3C44.468 53.956 43.172 55.252 41.408 55.252C39.572 55.252 38.276 53.956 38.276 52.3C38.276 50.644 39.572 49.348 41.408 49.348C43.172 49.348 44.468 50.644 44.468 52.3Z"
                                        fill="#EA8887" />
                                    <path
                                        d="M47.9745 8.0255C47.65 7.69985 47.2644 7.4416 46.8397 7.2656C46.415 7.0896 45.9597 6.99934 45.5 7H21C17.1395 7 14 10.1395 14 14V70C14 73.8605 17.1395 77 21 77H63C66.8605 77 70 73.8605 70 70V31.5C70.0007 31.0403 69.9104 30.585 69.7344 30.1603C69.5584 29.7356 69.3002 29.35 68.9745 29.0255L47.9745 8.0255ZM21 14H44.051L63 32.949L63.007 65.058L54.019 56.07C55.244 53.9875 56 51.5865 56 49C56 41.279 49.721 35 42 35C34.279 35 28 41.279 28 49C28 56.721 34.279 63 42 63C44.5865 63 46.9875 62.244 49.07 61.019L58.051 70H21V14ZM42 56C38.1395 56 35 52.8605 35 49C35 45.1395 38.1395 42 42 42C45.8605 42 49 45.1395 49 49C49 52.8605 45.8605 56 42 56Z"
                                        fill="#787878" />
                                </svg>
                                <p class="fs-14 fw-medium mt-1 mb-0"></p>No Project found!
                            </div>
                        @endforelse
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <a href="/projects-type/{{ $hugeProjectType->slug ?? '' }}"
                            class="link-show-all text-decoration-none fs-14 fw-medium">Show
                            All <i class="las la-arrow-right"> </i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="nostalgic-vibes" class="mb-30">
        <div class="row">
            <div class="col">
                <div class="project-section border">
                    <div class="d-flex justify-content-between">
                        <h3>{{ $nostalgicVibesType->type_name ?? '' }}</h3>
                    </div>
                    <p>{{ $nostalgicVibesType->about ?? '' }}</p>
                    <div class="table-responsive mb-2 d-md-block d-none">
                        <table class="table table-hover projects-table">
                            <thead>
                                <tr>
                                    <th>Project Title</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                    <th>Requester</th>
                                    <th>Status</th>
                                    <th>Votes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($nostalgicVibesProjects as $nvProj)
                                    <tr>
                                        <td class="align-middle fw-medium text-color-100">{{ $nvProj->project_title }}
                                        </td>
                                        <td @class([
                                            'align-middle',
                                            'fw-medium',
                                            'text-color-ld' => $nvProj->category->category_name === 'Line Distribution',
                                            'text-color-le' => $nvProj->category->category_name === 'Line Evolution',
                                            'text-color-ad' =>
                                                $nvProj->category->category_name === 'Album Distribution',
                                            'text-color-ae' => $nvProj->category->category_name === 'Album Evolution',
                                            'text-color-rb' => $nvProj->category->category_name === 'Ranking Battle',
                                            'text-color-hs' => $nvProj->category->category_name === 'How Should',
                                            'text-color-hw' => $nvProj->category->category_name === 'How Would',
                                            'text-color-cd' =>
                                                $nvProj->category->category_name === 'Center Distribution',
                                        ])>
                                            {{ $nvProj->category->category_name }}</td>
                                        <td class="align-middle text-color-100"><i class="lar la-calendar"></i>
                                            {{ \Carbon\Carbon::parse($nvProj->date)->format('d F Y, G:i T') }}
                                        </td>
                                        <td class="align-middle text-color-100">{{ $nvProj->requester }}</td>
                                        <td class="align-middle">
                                            <span @class([
                                                'btn',
                                                'btn-complete' => $nvProj->status === 'Completed',
                                                'btn-onprocess' => $nvProj->status === 'On Process',
                                                'btn-pending' => $nvProj->status === 'Pending',
                                                'btn-rejected' => $nvProj->status === 'Rejected',
                                            ])> {{ $nvProj->status }}</span>
                                        </td>
                                        <td class="align-middle text-color-100">{{ $nvProj->votes }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-color-100">
                                            <svg width="48" height="48" viewBox="0 0 84 84" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M39.176 46.828L38.564 29.44H44L43.424 46.828H39.176ZM44.468 52.3C44.468 53.956 43.172 55.252 41.408 55.252C39.572 55.252 38.276 53.956 38.276 52.3C38.276 50.644 39.572 49.348 41.408 49.348C43.172 49.348 44.468 50.644 44.468 52.3Z"
                                                    fill="#EA8887" />
                                                <path
                                                    d="M47.9745 8.0255C47.65 7.69985 47.2644 7.4416 46.8397 7.2656C46.415 7.0896 45.9597 6.99934 45.5 7H21C17.1395 7 14 10.1395 14 14V70C14 73.8605 17.1395 77 21 77H63C66.8605 77 70 73.8605 70 70V31.5C70.0007 31.0403 69.9104 30.585 69.7344 30.1603C69.5584 29.7356 69.3002 29.35 68.9745 29.0255L47.9745 8.0255ZM21 14H44.051L63 32.949L63.007 65.058L54.019 56.07C55.244 53.9875 56 51.5865 56 49C56 41.279 49.721 35 42 35C34.279 35 28 41.279 28 49C28 56.721 34.279 63 42 63C44.5865 63 46.9875 62.244 49.07 61.019L58.051 70H21V14ZM42 56C38.1395 56 35 52.8605 35 49C35 45.1395 38.1395 42 42 42C45.8605 42 49 45.1395 49 49C49 52.8605 45.8605 56 42 56Z"
                                                    fill="#787878" />
                                            </svg>
                                            <p class="fs-14 fw-medium mt-1 mb-0">No Project Found!</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="table-mobile mb-30">
                        @forelse ($nostalgicVibesProjects as $nvProj)
                            <div class="row {{ $loop->last ? '' : 'mb-3' }}">
                                <div class="col">
                                    <div class="table-content-mobile">
                                        <div class="fs-14 fw-medium text-color-80 mb-10"><i class="lar la-calendar"></i>
                                            {{ \Carbon\Carbon::parse($nvProj->date)->format('j F Y, G:i T') }}
                                        </div>
                                        <div class="mb5">
                                            <span @class([
                                                'btn',
                                                'btn-complete' => $nvProj->status === 'Completed',
                                                'btn-onprocess' => $nvProj->status === 'On Process',
                                                'btn-pending' => $nvProj->status === 'Pending',
                                                'btn-rejected' => $nvProj->status === 'Rejected',
                                            ])> {{ $nvProj->status }}</span>
                                        </div>
                                        <div class="mb5">
                                            <p class="fs-14 m-0 fw-semibold text-color-100">
                                                {{ $nvProj->project_title }}
                                            </p>
                                        </div>
                                        <div class="fs-14 fw-medium mb5">
                                            <span @class([
                                                'text-color-ld' => $nvProj->category->category_name === 'Line Distribution',
                                                'text-color-le' => $nvProj->category->category_name === 'Line Evolution',
                                                'text-color-ad' =>
                                                    $nvProj->category->category_name === 'Album Distribution',
                                                'text-color-ae' => $nvProj->category->category_name === 'Album Evolution',
                                                'text-color-rb' => $nvProj->category->category_name === 'Ranking Battle',
                                                'text-color-hs' => $nvProj->category->category_name === 'How Should',
                                                'text-color-hw' => $nvProj->category->category_name === 'How Would',
                                                'text-color-cd' =>
                                                    $nvProj->category->category_name === 'Center Distribution',
                                            ])>
                                                {{ $nvProj->category->category_name }}</span>
                                        </div>
                                        <div class="text-color-100 fs-14 fw-medium">
                                            <i class="las la-user-alt"></i> {{ $nvProj->requester }} |
                                            {{ $nvProj->votes }}
                                            Votes
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col text-center text-color-100">
                                <svg width="48" height="48" viewBox="0 0 84 84" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M39.176 46.828L38.564 29.44H44L43.424 46.828H39.176ZM44.468 52.3C44.468 53.956 43.172 55.252 41.408 55.252C39.572 55.252 38.276 53.956 38.276 52.3C38.276 50.644 39.572 49.348 41.408 49.348C43.172 49.348 44.468 50.644 44.468 52.3Z"
                                        fill="#EA8887" />
                                    <path
                                        d="M47.9745 8.0255C47.65 7.69985 47.2644 7.4416 46.8397 7.2656C46.415 7.0896 45.9597 6.99934 45.5 7H21C17.1395 7 14 10.1395 14 14V70C14 73.8605 17.1395 77 21 77H63C66.8605 77 70 73.8605 70 70V31.5C70.0007 31.0403 69.9104 30.585 69.7344 30.1603C69.5584 29.7356 69.3002 29.35 68.9745 29.0255L47.9745 8.0255ZM21 14H44.051L63 32.949L63.007 65.058L54.019 56.07C55.244 53.9875 56 51.5865 56 49C56 41.279 49.721 35 42 35C34.279 35 28 41.279 28 49C28 56.721 34.279 63 42 63C44.5865 63 46.9875 62.244 49.07 61.019L58.051 70H21V14ZM42 56C38.1395 56 35 52.8605 35 49C35 45.1395 38.1395 42 42 42C45.8605 42 49 45.1395 49 49C49 52.8605 45.8605 56 42 56Z"
                                        fill="#787878" />
                                </svg>
                                <p class="fs-14 fw-medium mt-1 mb-0"></p>No Project found!
                            </div>
                        @endforelse
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <a href="/projects-type/{{ $nostalgicVibesType->slug ?? '' }}"
                            class="link-show-all text-decoration-none fs-14 fw-medium">Show
                            All <i class="las la-arrow-right"> </i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="youtube-comment">
        <div class="row">
            <div class="col">
                <div class="project-section border">
                    <div class="d-flex justify-content-between">
                        <h3>{{ $youtubeCommentType->type_name ?? '' }}</h3>
                    </div>
                    <p>{{ $youtubeCommentType->about ?? '' }}</p>
                    <div class="table-responsive mb-2 d-md-block d-none">
                        <table class="table table-hover projects-table">
                            <thead>
                                <tr>
                                    <th>Project Title</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                    <th>Requester</th>
                                    <th>Status</th>
                                    <th>Votes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($youtubeCommentProjects as $ytComPro)
                                    <tr>
                                        <td class="align-middle fw-medium text-color-100">{{ $ytComPro->project_title }}
                                        </td>
                                        <td @class([
                                            'align-middle',
                                            'fw-medium',
                                            'text-color-ld' =>
                                                $ytComPro->category->category_name === 'Line Distribution',
                                            'text-color-le' => $ytComPro->category->category_name === 'Line Evolution',
                                            'text-color-ad' =>
                                                $ytComPro->category->category_name === 'Album Distribution',
                                            'text-color-ae' => $ytComPro->category->category_name === 'Album Evolution',
                                            'text-color-rb' => $ytComPro->category->category_name === 'Ranking Battle',
                                            'text-color-hs' => $ytComPro->category->category_name === 'How Should',
                                            'text-color-hw' => $ytComPro->category->category_name === 'How Would',
                                            'text-color-cd' =>
                                                $ytComPro->category->category_name === 'Center Distribution',
                                        ])>
                                            {{ $ytComPro->category->category_name }}</td>
                                        <td class="align-middle text-color-100"><i class="lar la-calendar"></i>
                                            {{ \Carbon\Carbon::parse($ytComPro->date)->format('d F Y, G:i T') }}
                                        </td>
                                        <td class="align-middle text-color-100">{{ $ytComPro->requester }}</td>
                                        <td class="align-middle">
                                            <span @class([
                                                'btn',
                                                'btn-complete' => $ytComPro->status === 'Completed',
                                                'btn-onprocess' => $ytComPro->status === 'On Process',
                                                'btn-pending' => $ytComPro->status === 'Pending',
                                                'btn-rejected' => $ytComPro->status === 'Rejected',
                                            ])> {{ $ytComPro->status }}</span>
                                        </td>
                                        <td class="align-middle text-color-100">{{ $ytComPro->votes }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-color-100">
                                            <svg width="48" height="48" viewBox="0 0 84 84" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M39.176 46.828L38.564 29.44H44L43.424 46.828H39.176ZM44.468 52.3C44.468 53.956 43.172 55.252 41.408 55.252C39.572 55.252 38.276 53.956 38.276 52.3C38.276 50.644 39.572 49.348 41.408 49.348C43.172 49.348 44.468 50.644 44.468 52.3Z"
                                                    fill="#EA8887" />
                                                <path
                                                    d="M47.9745 8.0255C47.65 7.69985 47.2644 7.4416 46.8397 7.2656C46.415 7.0896 45.9597 6.99934 45.5 7H21C17.1395 7 14 10.1395 14 14V70C14 73.8605 17.1395 77 21 77H63C66.8605 77 70 73.8605 70 70V31.5C70.0007 31.0403 69.9104 30.585 69.7344 30.1603C69.5584 29.7356 69.3002 29.35 68.9745 29.0255L47.9745 8.0255ZM21 14H44.051L63 32.949L63.007 65.058L54.019 56.07C55.244 53.9875 56 51.5865 56 49C56 41.279 49.721 35 42 35C34.279 35 28 41.279 28 49C28 56.721 34.279 63 42 63C44.5865 63 46.9875 62.244 49.07 61.019L58.051 70H21V14ZM42 56C38.1395 56 35 52.8605 35 49C35 45.1395 38.1395 42 42 42C45.8605 42 49 45.1395 49 49C49 52.8605 45.8605 56 42 56Z"
                                                    fill="#787878" />
                                            </svg>
                                            <p class="fs-14 fw-medium mt-1 mb-0">No Project Found!</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="table-mobile mb-30">
                        @forelse ($youtubeCommentProjects as $ytComPro)
                            <div class="row {{ $loop->last ? '' : 'mb-3' }}">
                                <div class="col">
                                    <div class="table-content-mobile">
                                        <div class="fs-14 fw-medium text-color-80 mb-10"><i class="lar la-calendar"></i>
                                            {{ \Carbon\Carbon::parse($ytComPro->date)->format('j F Y, G:i T') }}
                                        </div>
                                        <div class="mb5">
                                            <span @class([
                                                'btn',
                                                'btn-complete' => $ytComPro->status === 'Completed',
                                                'btn-onprocess' => $ytComPro->status === 'On Process',
                                                'btn-pending' => $ytComPro->status === 'Pending',
                                                'btn-rejected' => $ytComPro->status === 'Rejected',
                                            ])> {{ $ytComPro->status }}</span>
                                        </div>
                                        <div class="mb5">
                                            <p class="fs-14 m-0 fw-semibold text-color-100">
                                                {{ $ytComPro->project_title }}
                                            </p>
                                        </div>
                                        <div class="fs-14 fw-medium mb5">
                                            <span @class([
                                                'text-color-ld' =>
                                                    $ytComPro->category->category_name === 'Line Distribution',
                                                'text-color-le' => $ytComPro->category->category_name === 'Line Evolution',
                                                'text-color-ad' =>
                                                    $ytComPro->category->category_name === 'Album Distribution',
                                                'text-color-ae' => $ytComPro->category->category_name === 'Album Evolution',
                                                'text-color-rb' => $ytComPro->category->category_name === 'Ranking Battle',
                                                'text-color-hs' => $ytComPro->category->category_name === 'How Should',
                                                'text-color-hw' => $ytComPro->category->category_name === 'How Would',
                                                'text-color-cd' =>
                                                    $ytComPro->category->category_name === 'Center Distribution',
                                            ])>
                                                {{ $ytComPro->category->category_name }}</span>
                                        </div>
                                        <div class="text-color-100 fs-14 fw-medium">
                                            <i class="las la-user-alt"></i> {{ $ytComPro->requester }} |
                                            {{ $ytComPro->votes }}
                                            Votes
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col text-center text-color-100">
                                <svg width="48" height="48" viewBox="0 0 84 84" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M39.176 46.828L38.564 29.44H44L43.424 46.828H39.176ZM44.468 52.3C44.468 53.956 43.172 55.252 41.408 55.252C39.572 55.252 38.276 53.956 38.276 52.3C38.276 50.644 39.572 49.348 41.408 49.348C43.172 49.348 44.468 50.644 44.468 52.3Z"
                                        fill="#EA8887" />
                                    <path
                                        d="M47.9745 8.0255C47.65 7.69985 47.2644 7.4416 46.8397 7.2656C46.415 7.0896 45.9597 6.99934 45.5 7H21C17.1395 7 14 10.1395 14 14V70C14 73.8605 17.1395 77 21 77H63C66.8605 77 70 73.8605 70 70V31.5C70.0007 31.0403 69.9104 30.585 69.7344 30.1603C69.5584 29.7356 69.3002 29.35 68.9745 29.0255L47.9745 8.0255ZM21 14H44.051L63 32.949L63.007 65.058L54.019 56.07C55.244 53.9875 56 51.5865 56 49C56 41.279 49.721 35 42 35C34.279 35 28 41.279 28 49C28 56.721 34.279 63 42 63C44.5865 63 46.9875 62.244 49.07 61.019L58.051 70H21V14ZM42 56C38.1395 56 35 52.8605 35 49C35 45.1395 38.1395 42 42 42C45.8605 42 49 45.1395 49 49C49 52.8605 45.8605 56 42 56Z"
                                        fill="#787878" />
                                </svg>
                                <p class="fs-14 fw-medium mt-1 mb-0"></p>No Project found!
                            </div>
                        @endforelse
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <a href="/projects-type/{{ $youtubeCommentType->slug ?? '' }}"
                            class="link-show-all text-decoration-none fs-14 fw-medium">Show
                            All <i class="las la-arrow-right"> </i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
