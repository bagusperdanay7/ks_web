@extends('layouts.main')

@section('content')
    <section id="project-header" class="mb-30">
        <div class="row">
            <h2 class="fw-bold text-color-100 mb-10">Projects</h2>
            <p class="project-text">The projects we are currently working on consists of Huge Project, Nostalgic Vibes,
                and
                requests from Youtube comments.</p>
        </div>
    </section>

    <section id="upcoming-projects" class="mb-30">
        <div class="row">
            <div class="col">
                <div class="table-card">
                    <h3>Upcoming Schedule</h3>
                    <p>The upcoming Schedule shows what projects are coming up in a short time.</p>
                    <div class="table-responsive d-md-block d-none">
                        <table class="table-hover projects-table table">
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
                                @forelse ($upcomingProjects as $project)
                                    <tr>
                                        <td class="title-with-progress align-middle">
                                            <div>
                                                <div class="d-flex justify-content-between fw-medium fs-14">
                                                    <p class="m-0 p-0">
                                                        {{ $project->title }}
                                                    </p>
                                                    <span class="text-color-100 m-0 p-0">
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
                                            'text-color-ae' =>
                                                $project->category->category_name === 'Total Line Evolution',
                                            'text-color-rb' => $project->category->category_name === 'Ranking Battle',
                                            'text-color-hs' => $project->category->category_name === 'How Should',
                                            'text-color-hw' => $project->category->category_name === 'How Would',
                                            'text-color-cd' =>
                                                $project->category->category_name === 'Center Distribution',
                                            'text-info' => $project->category->category_name === 'Other',
                                        ])> {{ $project->category->category_name }}</td>
                                        @if ($project->date == null)
                                            <td class="fw-medium text-color-100 align-middle"><i
                                                    class="lar la-calendar"></i>
                                                Coming Soon
                                            </td>
                                        @else
                                            <td class="fw-medium text-color-100 align-middle"><i
                                                    class="lar la-calendar"></i>
                                                {{ \Carbon\Carbon::parse($project->date)->format('d F Y, G:i T') }}
                                            </td>
                                        @endif
                                        <td class="text-color-100 align-middle">{{ $project->projectType->type_name }}</td>
                                        <td class="text-color-100 align-middle">{{ $project->requester }}</td>
                                        <td class="align-middle">
                                            <span @class([
                                                'btn',
                                                'btn-complete' => $project->status === 'Completed',
                                                'btn-onprocess' => $project->status === 'In Progress',
                                                'btn-pending' => $project->status === 'Pending',
                                                'btn-rejected' => $project->status === 'Rejected',
                                            ])> {{ $project->status }}</span>
                                        </td>
                                        <td class="text-color-100 text-center align-middle">{{ $project->votes }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-color-100 text-center">
                                            <svg width="48" height="48" viewBox="0 0 84 84" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M39.176 46.828L38.564 29.44H44L43.424 46.828H39.176ZM44.468 52.3C44.468 53.956 43.172 55.252 41.408 55.252C39.572 55.252 38.276 53.956 38.276 52.3C38.276 50.644 39.572 49.348 41.408 49.348C43.172 49.348 44.468 50.644 44.468 52.3Z"
                                                    fill="#EA8887" />
                                                <path
                                                    d="M47.9745 8.0255C47.65 7.69985 47.2644 7.4416 46.8397 7.2656C46.415 7.0896 45.9597 6.99934 45.5 7H21C17.1395 7 14 10.1395 14 14V70C14 73.8605 17.1395 77 21 77H63C66.8605 77 70 73.8605 70 70V31.5C70.0007 31.0403 69.9104 30.585 69.7344 30.1603C69.5584 29.7356 69.3002 29.35 68.9745 29.0255L47.9745 8.0255ZM21 14H44.051L63 32.949L63.007 65.058L54.019 56.07C55.244 53.9875 56 51.5865 56 49C56 41.279 49.721 35 42 35C34.279 35 28 41.279 28 49C28 56.721 34.279 63 42 63C44.5865 63 46.9875 62.244 49.07 61.019L58.051 70H21V14ZM42 56C38.1395 56 35 52.8605 35 49C35 45.1395 38.1395 42 42 42C45.8605 42 49 45.1395 49 49C49 52.8605 45.8605 56 42 56Z"
                                                    fill="#787878" />
                                            </svg>
                                            <p class="fs-14 fw-medium mb-0 mt-1">No Upcoming Project!</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="table-mobile">
                        @forelse ($upcomingProjects as $project)
                            <div class="row {{ $loop->last ? '' : 'mb-3' }}">
                                <div class="col">
                                    <div class="table-content-mobile">
                                        @if ($project->date == null)
                                            <div class="fs-14 fw-medium text-color-80 mb-10"><i class="lar la-calendar"></i>
                                                Coming Soon
                                            </div>
                                        @else
                                            <div class="fs-14 fw-medium text-color-80 mb-10"><i class="lar la-calendar"></i>
                                                {{ \Carbon\Carbon::parse($project->date)->format('j F Y, G:i T') }}
                                            </div>
                                        @endif
                                        <div class="mb5">
                                            <span @class([
                                                'btn',
                                                'btn-complete' => $project->status === 'Completed',
                                                'btn-onprocess' => $project->status === 'In Progress',
                                                'btn-pending' => $project->status === 'Pending',
                                                'btn-rejected' => $project->status === 'Rejected',
                                            ])> {{ $project->status }}</span>
                                        </div>
                                        <div class="mb5">
                                            <p class="fs-14 fw-semibold text-color-100 m-0">
                                                {{ $project->title }}
                                            </p>
                                        </div>
                                        <div class="fs-14 fw-medium mb5">
                                            <span @class([
                                                'text-color-ld' =>
                                                    $project->category->category_name === 'Line Distribution',
                                                'text-color-le' => $project->category->category_name === 'Line Evolution',
                                                'text-color-ad' =>
                                                    $project->category->category_name === 'Album Distribution',
                                                'text-color-ae' =>
                                                    $project->category->category_name === 'Total Line Evolution',
                                                'text-color-rb' => $project->category->category_name === 'Ranking Battle',
                                                'text-color-hs' => $project->category->category_name === 'How Should',
                                                'text-color-hw' => $project->category->category_name === 'How Would',
                                                'text-color-cd' =>
                                                    $project->category->category_name === 'Center Distribution',
                                                'text-info' => $project->category->category_name === 'Other',
                                            ])>
                                                {{ $project->category->category_name }}</span> •
                                            <span class="text-color-100">{{ $project->projectType->type_name }}</span>
                                        </div>
                                        <div class="text-color-100 fs-14 fw-medium mb5">
                                            <i class="las la-user-alt"></i> {{ $project->requester }} |
                                            {{ $project->votes }}
                                            Votes
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p class="fs-14 m-0">Progress</p>
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
                            <div class="col text-color-100 text-center">
                                <svg width="48" height="48" viewBox="0 0 84 84" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M39.176 46.828L38.564 29.44H44L43.424 46.828H39.176ZM44.468 52.3C44.468 53.956 43.172 55.252 41.408 55.252C39.572 55.252 38.276 53.956 38.276 52.3C38.276 50.644 39.572 49.348 41.408 49.348C43.172 49.348 44.468 50.644 44.468 52.3Z"
                                        fill="#EA8887" />
                                    <path
                                        d="M47.9745 8.0255C47.65 7.69985 47.2644 7.4416 46.8397 7.2656C46.415 7.0896 45.9597 6.99934 45.5 7H21C17.1395 7 14 10.1395 14 14V70C14 73.8605 17.1395 77 21 77H63C66.8605 77 70 73.8605 70 70V31.5C70.0007 31.0403 69.9104 30.585 69.7344 30.1603C69.5584 29.7356 69.3002 29.35 68.9745 29.0255L47.9745 8.0255ZM21 14H44.051L63 32.949L63.007 65.058L54.019 56.07C55.244 53.9875 56 51.5865 56 49C56 41.279 49.721 35 42 35C34.279 35 28 41.279 28 49C28 56.721 34.279 63 42 63C44.5865 63 46.9875 62.244 49.07 61.019L58.051 70H21V14ZM42 56C38.1395 56 35 52.8605 35 49C35 45.1395 38.1395 42 42 42C45.8605 42 49 45.1395 49 49C49 52.8605 45.8605 56 42 56Z"
                                        fill="#787878" />
                                </svg>
                                <p class="fs-14 fw-medium mb-0 mt-1">No Upcoming Project!</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    @foreach ($allProjectType as $projectItem)
        <section id="{{ $projectItem->slug }}" {{ $loop->last ? '' : 'class=mb-30' }}>
            <div class="row">
                <div class="col">
                    <div class="table-card">
                        <div class="d-flex justify-content-between">
                            <h3>{{ $projectItem->type_name ?? '' }}</h3>
                        </div>
                        <p>{{ $projectItem->about ?? '' }}</p>
                        <div class="table-responsive d-md-block d-none mb-2">
                            <table class="table-hover projects-table table">
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
                                    @if ($projectItem->type_name == 'Non-Project')
                                        @forelse ($nonProjects as $projectByType)
                                            <tr>
                                                <td class="fw-medium text-color-100 align-middle">
                                                    {{ $projectByType->title }}
                                                </td>
                                                <td @class([
                                                    'align-middle',
                                                    'fw-medium',
                                                    'text-color-ld' =>
                                                        $projectByType->category->category_name === 'Line Distribution',
                                                    'text-color-le' =>
                                                        $projectByType->category->category_name === 'Line Evolution',
                                                    'text-color-ad' =>
                                                        $projectByType->category->category_name === 'Album Distribution',
                                                    'text-color-ae' =>
                                                        $projectByType->category->category_name === 'Total Line Evolution',
                                                    'text-color-rb' =>
                                                        $projectByType->category->category_name === 'Ranking Battle',
                                                    'text-color-hs' => $projectByType->category->category_name === 'How Should',
                                                    'text-color-hw' => $projectByType->category->category_name === 'How Would',
                                                    'text-color-cd' =>
                                                        $projectByType->category->category_name === 'Center Distribution',
                                                    'text-info' => $projectByType->category->category_name === 'Other',
                                                ])>
                                                    {{ $projectByType->category->category_name }}
                                                </td>
                                                @if ($projectByType->date == null)
                                                    <td class="text-color-100 align-middle"><i class="lar la-calendar"></i>
                                                        Coming Soon
                                                    </td>
                                                @else
                                                    <td class="text-color-100 align-middle"><i class="lar la-calendar"></i>
                                                        {{ \Carbon\Carbon::parse($projectByType->date)->format('d F Y, G:i T') }}
                                                    </td>
                                                @endif
                                                <td class="text-color-100 align-middle">{{ $projectByType->requester }}
                                                </td>
                                                <td class="align-middle">
                                                    <span @class([
                                                        'btn',
                                                        'btn-complete' => $projectByType->status === 'Completed',
                                                        'btn-onprocess' => $projectByType->status === 'In Progress',
                                                        'btn-pending' => $projectByType->status === 'Pending',
                                                        'btn-rejected' => $projectByType->status === 'Rejected',
                                                    ])> {{ $projectByType->status }}</span>
                                                </td>
                                                <td class="text-color-100 align-middle">{{ $projectByType->votes }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-color-100 text-center">
                                                    <svg width="48" height="48" viewBox="0 0 84 84" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M39.176 46.828L38.564 29.44H44L43.424 46.828H39.176ZM44.468 52.3C44.468 53.956 43.172 55.252 41.408 55.252C39.572 55.252 38.276 53.956 38.276 52.3C38.276 50.644 39.572 49.348 41.408 49.348C43.172 49.348 44.468 50.644 44.468 52.3Z"
                                                            fill="#EA8887" />
                                                        <path
                                                            d="M47.9745 8.0255C47.65 7.69985 47.2644 7.4416 46.8397 7.2656C46.415 7.0896 45.9597 6.99934 45.5 7H21C17.1395 7 14 10.1395 14 14V70C14 73.8605 17.1395 77 21 77H63C66.8605 77 70 73.8605 70 70V31.5C70.0007 31.0403 69.9104 30.585 69.7344 30.1603C69.5584 29.7356 69.3002 29.35 68.9745 29.0255L47.9745 8.0255ZM21 14H44.051L63 32.949L63.007 65.058L54.019 56.07C55.244 53.9875 56 51.5865 56 49C56 41.279 49.721 35 42 35C34.279 35 28 41.279 28 49C28 56.721 34.279 63 42 63C44.5865 63 46.9875 62.244 49.07 61.019L58.051 70H21V14ZM42 56C38.1395 56 35 52.8605 35 49C35 45.1395 38.1395 42 42 42C45.8605 42 49 45.1395 49 49C49 52.8605 45.8605 56 42 56Z"
                                                            fill="#787878" />
                                                    </svg>
                                                    <p class="fs-14 fw-medium mb-0 mt-1">No Project Found!</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    @elseif ($projectItem->type_name == 'Huge Project Vol.#01')
                                        @forelse ($hugeProjects as $projectByType)
                                            <tr>
                                                <td class="fw-medium text-color-100 align-middle">
                                                    {{ $projectByType->title }}
                                                </td>
                                                <td @class([
                                                    'align-middle',
                                                    'fw-medium',
                                                    'text-color-ld' =>
                                                        $projectByType->category->category_name === 'Line Distribution',
                                                    'text-color-le' =>
                                                        $projectByType->category->category_name === 'Line Evolution',
                                                    'text-color-ad' =>
                                                        $projectByType->category->category_name === 'Album Distribution',
                                                    'text-color-ae' =>
                                                        $projectByType->category->category_name === 'Total Line Evolution',
                                                    'text-color-rb' =>
                                                        $projectByType->category->category_name === 'Ranking Battle',
                                                    'text-color-hs' => $projectByType->category->category_name === 'How Should',
                                                    'text-color-hw' => $projectByType->category->category_name === 'How Would',
                                                    'text-color-cd' =>
                                                        $projectByType->category->category_name === 'Center Distribution',
                                                    'text-info' => $projectByType->category->category_name === 'Other',
                                                ])>
                                                    {{ $projectByType->category->category_name }}
                                                </td>
                                                @if ($projectByType->date == null)
                                                    <td class="text-color-100 align-middle"><i
                                                            class="lar la-calendar"></i>
                                                        Coming Soon
                                                    </td>
                                                @else
                                                    <td class="text-color-100 align-middle"><i
                                                            class="lar la-calendar"></i>
                                                        {{ \Carbon\Carbon::parse($projectByType->date)->format('d F Y, G:i T') }}
                                                    </td>
                                                @endif
                                                <td class="text-color-100 align-middle">{{ $projectByType->requester }}
                                                </td>
                                                <td class="align-middle">
                                                    <span @class([
                                                        'btn',
                                                        'btn-complete' => $projectByType->status === 'Completed',
                                                        'btn-onprocess' => $projectByType->status === 'In Progress',
                                                        'btn-pending' => $projectByType->status === 'Pending',
                                                        'btn-rejected' => $projectByType->status === 'Rejected',
                                                    ])> {{ $projectByType->status }}</span>
                                                </td>
                                                <td class="text-color-100 align-middle">{{ $projectByType->votes }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-color-100 text-center">
                                                    <svg width="48" height="48" viewBox="0 0 84 84"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M39.176 46.828L38.564 29.44H44L43.424 46.828H39.176ZM44.468 52.3C44.468 53.956 43.172 55.252 41.408 55.252C39.572 55.252 38.276 53.956 38.276 52.3C38.276 50.644 39.572 49.348 41.408 49.348C43.172 49.348 44.468 50.644 44.468 52.3Z"
                                                            fill="#EA8887" />
                                                        <path
                                                            d="M47.9745 8.0255C47.65 7.69985 47.2644 7.4416 46.8397 7.2656C46.415 7.0896 45.9597 6.99934 45.5 7H21C17.1395 7 14 10.1395 14 14V70C14 73.8605 17.1395 77 21 77H63C66.8605 77 70 73.8605 70 70V31.5C70.0007 31.0403 69.9104 30.585 69.7344 30.1603C69.5584 29.7356 69.3002 29.35 68.9745 29.0255L47.9745 8.0255ZM21 14H44.051L63 32.949L63.007 65.058L54.019 56.07C55.244 53.9875 56 51.5865 56 49C56 41.279 49.721 35 42 35C34.279 35 28 41.279 28 49C28 56.721 34.279 63 42 63C44.5865 63 46.9875 62.244 49.07 61.019L58.051 70H21V14ZM42 56C38.1395 56 35 52.8605 35 49C35 45.1395 38.1395 42 42 42C45.8605 42 49 45.1395 49 49C49 52.8605 45.8605 56 42 56Z"
                                                            fill="#787878" />
                                                    </svg>
                                                    <p class="fs-14 fw-medium mb-0 mt-1">No Project Found!</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    @elseif ($projectItem->type_name == 'Nostalgic Vibes')
                                        @forelse ($nostalgicVibesProjects as $projectByType)
                                            <tr>
                                                <td class="fw-medium text-color-100 align-middle">
                                                    {{ $projectByType->title }}
                                                </td>
                                                <td @class([
                                                    'align-middle',
                                                    'fw-medium',
                                                    'text-color-ld' =>
                                                        $projectByType->category->category_name === 'Line Distribution',
                                                    'text-color-le' =>
                                                        $projectByType->category->category_name === 'Line Evolution',
                                                    'text-color-ad' =>
                                                        $projectByType->category->category_name === 'Album Distribution',
                                                    'text-color-ae' =>
                                                        $projectByType->category->category_name === 'Total Line Evolution',
                                                    'text-color-rb' =>
                                                        $projectByType->category->category_name === 'Ranking Battle',
                                                    'text-color-hs' => $projectByType->category->category_name === 'How Should',
                                                    'text-color-hw' => $projectByType->category->category_name === 'How Would',
                                                    'text-color-cd' =>
                                                        $projectByType->category->category_name === 'Center Distribution',
                                                    'text-info' => $projectByType->category->category_name === 'Other',
                                                ])>
                                                    {{ $projectByType->category->category_name }}
                                                </td>
                                                @if ($projectByType->date == null)
                                                    <td class="text-color-100 align-middle"><i
                                                            class="lar la-calendar"></i>
                                                        Coming Soon
                                                    </td>
                                                @else
                                                    <td class="text-color-100 align-middle"><i
                                                            class="lar la-calendar"></i>
                                                        {{ \Carbon\Carbon::parse($projectByType->date)->format('d F Y, G:i T') }}
                                                    </td>
                                                @endif
                                                <td class="text-color-100 align-middle">{{ $projectByType->requester }}
                                                </td>
                                                <td class="align-middle">
                                                    <span @class([
                                                        'btn',
                                                        'btn-complete' => $projectByType->status === 'Completed',
                                                        'btn-onprocess' => $projectByType->status === 'In Progress',
                                                        'btn-pending' => $projectByType->status === 'Pending',
                                                        'btn-rejected' => $projectByType->status === 'Rejected',
                                                    ])> {{ $projectByType->status }}</span>
                                                </td>
                                                <td class="text-color-100 align-middle">{{ $projectByType->votes }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-color-100 text-center">
                                                    <svg width="48" height="48" viewBox="0 0 84 84"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M39.176 46.828L38.564 29.44H44L43.424 46.828H39.176ZM44.468 52.3C44.468 53.956 43.172 55.252 41.408 55.252C39.572 55.252 38.276 53.956 38.276 52.3C38.276 50.644 39.572 49.348 41.408 49.348C43.172 49.348 44.468 50.644 44.468 52.3Z"
                                                            fill="#EA8887" />
                                                        <path
                                                            d="M47.9745 8.0255C47.65 7.69985 47.2644 7.4416 46.8397 7.2656C46.415 7.0896 45.9597 6.99934 45.5 7H21C17.1395 7 14 10.1395 14 14V70C14 73.8605 17.1395 77 21 77H63C66.8605 77 70 73.8605 70 70V31.5C70.0007 31.0403 69.9104 30.585 69.7344 30.1603C69.5584 29.7356 69.3002 29.35 68.9745 29.0255L47.9745 8.0255ZM21 14H44.051L63 32.949L63.007 65.058L54.019 56.07C55.244 53.9875 56 51.5865 56 49C56 41.279 49.721 35 42 35C34.279 35 28 41.279 28 49C28 56.721 34.279 63 42 63C44.5865 63 46.9875 62.244 49.07 61.019L58.051 70H21V14ZM42 56C38.1395 56 35 52.8605 35 49C35 45.1395 38.1395 42 42 42C45.8605 42 49 45.1395 49 49C49 52.8605 45.8605 56 42 56Z"
                                                            fill="#787878" />
                                                    </svg>
                                                    <p class="fs-14 fw-medium mb-0 mt-1">No Project Found!</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    @elseif ($projectItem->type_name == 'Youtube Comment')
                                        @forelse ($youtubeCommentProjects as $projectByType)
                                            <tr>
                                                <td class="fw-medium text-color-100 align-middle">
                                                    {{ $projectByType->title }}
                                                </td>
                                                <td @class([
                                                    'align-middle',
                                                    'fw-medium',
                                                    'text-color-ld' =>
                                                        $projectByType->category->category_name === 'Line Distribution',
                                                    'text-color-le' =>
                                                        $projectByType->category->category_name === 'Line Evolution',
                                                    'text-color-ad' =>
                                                        $projectByType->category->category_name === 'Album Distribution',
                                                    'text-color-ae' =>
                                                        $projectByType->category->category_name === 'Total Line Evolution',
                                                    'text-color-rb' =>
                                                        $projectByType->category->category_name === 'Ranking Battle',
                                                    'text-color-hs' => $projectByType->category->category_name === 'How Should',
                                                    'text-color-hw' => $projectByType->category->category_name === 'How Would',
                                                    'text-color-cd' =>
                                                        $projectByType->category->category_name === 'Center Distribution',
                                                    'text-info' => $projectByType->category->category_name === 'Other',
                                                ])>
                                                    {{ $projectByType->category->category_name }}
                                                </td>
                                                @if ($projectByType->date == null)
                                                    <td class="text-color-100 align-middle"><i
                                                            class="lar la-calendar"></i>
                                                        Coming Soon
                                                    </td>
                                                @else
                                                    <td class="text-color-100 align-middle"><i
                                                            class="lar la-calendar"></i>
                                                        {{ \Carbon\Carbon::parse($projectByType->date)->format('d F Y, G:i T') }}
                                                    </td>
                                                @endif
                                                <td class="text-color-100 align-middle">{{ $projectByType->requester }}
                                                </td>
                                                <td class="align-middle">
                                                    <span @class([
                                                        'btn',
                                                        'btn-complete' => $projectByType->status === 'Completed',
                                                        'btn-onprocess' => $projectByType->status === 'In Progress',
                                                        'btn-pending' => $projectByType->status === 'Pending',
                                                        'btn-rejected' => $projectByType->status === 'Rejected',
                                                    ])>
                                                        {{ $projectByType->status }}</span>
                                                </td>
                                                <td class="text-color-100 align-middle">{{ $projectByType->votes }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-color-100 text-center">
                                                    <svg width="48" height="48" viewBox="0 0 84 84"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M39.176 46.828L38.564 29.44H44L43.424 46.828H39.176ZM44.468 52.3C44.468 53.956 43.172 55.252 41.408 55.252C39.572 55.252 38.276 53.956 38.276 52.3C38.276 50.644 39.572 49.348 41.408 49.348C43.172 49.348 44.468 50.644 44.468 52.3Z"
                                                            fill="#EA8887" />
                                                        <path
                                                            d="M47.9745 8.0255C47.65 7.69985 47.2644 7.4416 46.8397 7.2656C46.415 7.0896 45.9597 6.99934 45.5 7H21C17.1395 7 14 10.1395 14 14V70C14 73.8605 17.1395 77 21 77H63C66.8605 77 70 73.8605 70 70V31.5C70.0007 31.0403 69.9104 30.585 69.7344 30.1603C69.5584 29.7356 69.3002 29.35 68.9745 29.0255L47.9745 8.0255ZM21 14H44.051L63 32.949L63.007 65.058L54.019 56.07C55.244 53.9875 56 51.5865 56 49C56 41.279 49.721 35 42 35C34.279 35 28 41.279 28 49C28 56.721 34.279 63 42 63C44.5865 63 46.9875 62.244 49.07 61.019L58.051 70H21V14ZM42 56C38.1395 56 35 52.8605 35 49C35 45.1395 38.1395 42 42 42C45.8605 42 49 45.1395 49 49C49 52.8605 45.8605 56 42 56Z"
                                                            fill="#787878" />
                                                    </svg>
                                                    <p class="fs-14 fw-medium mb-0 mt-1">No Project Found!</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="table-mobile mb-30">
                            @if ($projectItem->type_name == 'Non-Project')
                                @forelse ($nonProjects as $projectByType)
                                    <div class="row {{ $loop->last ? '' : 'mb-3' }}">
                                        <div class="col">
                                            <div class="table-content-mobile">
                                                @if ($projectByType->date == null)
                                                    <div class="fs-14 fw-medium text-color-80 mb-10"><i
                                                            class="lar la-calendar"></i>
                                                        Coming Soon
                                                    </div>
                                                @else
                                                    <div class="fs-14 fw-medium text-color-80 mb-10"><i
                                                            class="lar la-calendar"></i>
                                                        {{ \Carbon\Carbon::parse($projectByType->date)->format('j F Y, G:i T') }}
                                                    </div>
                                                @endif
                                                <div class="mb5">
                                                    <span @class([
                                                        'btn',
                                                        'btn-complete' => $projectByType->status === 'Completed',
                                                        'btn-onprocess' => $projectByType->status === 'In Progress',
                                                        'btn-pending' => $projectByType->status === 'Pending',
                                                        'btn-rejected' => $projectByType->status === 'Rejected',
                                                    ])>
                                                        {{ $projectByType->status }}</span>
                                                </div>
                                                <div class="mb5">
                                                    <p class="fs-14 fw-semibold text-color-100 m-0">
                                                        {{ $projectByType->title }}
                                                    </p>
                                                </div>
                                                <div class="fs-14 fw-medium mb5">
                                                    <span @class([
                                                        'text-color-ld' =>
                                                            $projectByType->category->category_name === 'Line Distribution',
                                                        'text-color-le' =>
                                                            $projectByType->category->category_name === 'Line Evolution',
                                                        'text-color-ad' =>
                                                            $projectByType->category->category_name === 'Album Distribution',
                                                        'text-color-ae' =>
                                                            $projectByType->category->category_name === 'Total Line Evolution',
                                                        'text-color-rb' =>
                                                            $projectByType->category->category_name === 'Ranking Battle',
                                                        'text-color-hs' => $projectByType->category->category_name === 'How Should',
                                                        'text-color-hw' => $projectByType->category->category_name === 'How Would',
                                                        'text-color-cd' =>
                                                            $projectByType->category->category_name === 'Center Distribution',
                                                        'text-info' => $projectByType->category->category_name === 'Other',
                                                    ])>
                                                        {{ $projectByType->category->category_name }}</span>
                                                </div>
                                                <div class="text-color-100 fs-14 fw-medium">
                                                    <i class="las la-user-alt"></i> {{ $projectByType->requester }} |
                                                    {{ $projectByType->votes }}
                                                    Votes
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col text-color-100 text-center">
                                        <svg width="48" height="48" viewBox="0 0 84 84" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M39.176 46.828L38.564 29.44H44L43.424 46.828H39.176ZM44.468 52.3C44.468 53.956 43.172 55.252 41.408 55.252C39.572 55.252 38.276 53.956 38.276 52.3C38.276 50.644 39.572 49.348 41.408 49.348C43.172 49.348 44.468 50.644 44.468 52.3Z"
                                                fill="#EA8887" />
                                            <path
                                                d="M47.9745 8.0255C47.65 7.69985 47.2644 7.4416 46.8397 7.2656C46.415 7.0896 45.9597 6.99934 45.5 7H21C17.1395 7 14 10.1395 14 14V70C14 73.8605 17.1395 77 21 77H63C66.8605 77 70 73.8605 70 70V31.5C70.0007 31.0403 69.9104 30.585 69.7344 30.1603C69.5584 29.7356 69.3002 29.35 68.9745 29.0255L47.9745 8.0255ZM21 14H44.051L63 32.949L63.007 65.058L54.019 56.07C55.244 53.9875 56 51.5865 56 49C56 41.279 49.721 35 42 35C34.279 35 28 41.279 28 49C28 56.721 34.279 63 42 63C44.5865 63 46.9875 62.244 49.07 61.019L58.051 70H21V14ZM42 56C38.1395 56 35 52.8605 35 49C35 45.1395 38.1395 42 42 42C45.8605 42 49 45.1395 49 49C49 52.8605 45.8605 56 42 56Z"
                                                fill="#787878" />
                                        </svg>
                                        <p class="fs-14 fw-medium mb-0 mt-1"></p>No Project found!
                                    </div>
                                @endforelse
                            @elseif ($projectItem->type_name == 'Huge Project Vol.#01')
                                @forelse ($hugeProjects as $projectByType)
                                    <div class="row {{ $loop->last ? '' : 'mb-3' }}">
                                        <div class="col">
                                            <div class="table-content-mobile">
                                                @if ($projectByType->date == null)
                                                    <div class="fs-14 fw-medium text-color-80 mb-10"><i
                                                            class="lar la-calendar"></i>
                                                        Coming Soon
                                                    </div>
                                                @else
                                                    <div class="fs-14 fw-medium text-color-80 mb-10"><i
                                                            class="lar la-calendar"></i>
                                                        {{ \Carbon\Carbon::parse($projectByType->date)->format('j F Y, G:i T') }}
                                                    </div>
                                                @endif
                                                <div class="mb5">
                                                    <span @class([
                                                        'btn',
                                                        'btn-complete' => $projectByType->status === 'Completed',
                                                        'btn-onprocess' => $projectByType->status === 'In Progress',
                                                        'btn-pending' => $projectByType->status === 'Pending',
                                                        'btn-rejected' => $projectByType->status === 'Rejected',
                                                    ])>
                                                        {{ $projectByType->status }}</span>
                                                </div>
                                                <div class="mb5">
                                                    <p class="fs-14 fw-semibold text-color-100 m-0">
                                                        {{ $projectByType->title }}
                                                    </p>
                                                </div>
                                                <div class="fs-14 fw-medium mb5">
                                                    <span @class([
                                                        'text-color-ld' =>
                                                            $projectByType->category->category_name === 'Line Distribution',
                                                        'text-color-le' =>
                                                            $projectByType->category->category_name === 'Line Evolution',
                                                        'text-color-ad' =>
                                                            $projectByType->category->category_name === 'Album Distribution',
                                                        'text-color-ae' =>
                                                            $projectByType->category->category_name === 'Total Line Evolution',
                                                        'text-color-rb' =>
                                                            $projectByType->category->category_name === 'Ranking Battle',
                                                        'text-color-hs' => $projectByType->category->category_name === 'How Should',
                                                        'text-color-hw' => $projectByType->category->category_name === 'How Would',
                                                        'text-color-cd' =>
                                                            $projectByType->category->category_name === 'Center Distribution',
                                                        'text-info' => $projectByType->category->category_name === 'Other',
                                                    ])>
                                                        {{ $projectByType->category->category_name }}</span>
                                                </div>
                                                <div class="text-color-100 fs-14 fw-medium">
                                                    <i class="las la-user-alt"></i> {{ $projectByType->requester }} |
                                                    {{ $projectByType->votes }}
                                                    Votes
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col text-color-100 text-center">
                                        <svg width="48" height="48" viewBox="0 0 84 84" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M39.176 46.828L38.564 29.44H44L43.424 46.828H39.176ZM44.468 52.3C44.468 53.956 43.172 55.252 41.408 55.252C39.572 55.252 38.276 53.956 38.276 52.3C38.276 50.644 39.572 49.348 41.408 49.348C43.172 49.348 44.468 50.644 44.468 52.3Z"
                                                fill="#EA8887" />
                                            <path
                                                d="M47.9745 8.0255C47.65 7.69985 47.2644 7.4416 46.8397 7.2656C46.415 7.0896 45.9597 6.99934 45.5 7H21C17.1395 7 14 10.1395 14 14V70C14 73.8605 17.1395 77 21 77H63C66.8605 77 70 73.8605 70 70V31.5C70.0007 31.0403 69.9104 30.585 69.7344 30.1603C69.5584 29.7356 69.3002 29.35 68.9745 29.0255L47.9745 8.0255ZM21 14H44.051L63 32.949L63.007 65.058L54.019 56.07C55.244 53.9875 56 51.5865 56 49C56 41.279 49.721 35 42 35C34.279 35 28 41.279 28 49C28 56.721 34.279 63 42 63C44.5865 63 46.9875 62.244 49.07 61.019L58.051 70H21V14ZM42 56C38.1395 56 35 52.8605 35 49C35 45.1395 38.1395 42 42 42C45.8605 42 49 45.1395 49 49C49 52.8605 45.8605 56 42 56Z"
                                                fill="#787878" />
                                        </svg>
                                        <p class="fs-14 fw-medium mb-0 mt-1"></p>No Project found!
                                    </div>
                                @endforelse
                            @elseif ($projectItem->type_name == 'Nostalgic Vibes')
                                @forelse ($nostalgicVibesProjects as $projectByType)
                                    <div class="row {{ $loop->last ? '' : 'mb-3' }}">
                                        <div class="col">
                                            <div class="table-content-mobile">
                                                @if ($projectByType->date == null)
                                                    <div class="fs-14 fw-medium text-color-80 mb-10"><i
                                                            class="lar la-calendar"></i>
                                                        Coming Soon
                                                    </div>
                                                @else
                                                    <div class="fs-14 fw-medium text-color-80 mb-10"><i
                                                            class="lar la-calendar"></i>
                                                        {{ \Carbon\Carbon::parse($projectByType->date)->format('j F Y, G:i T') }}
                                                    </div>
                                                @endif
                                                <div class="mb5">
                                                    <span @class([
                                                        'btn',
                                                        'btn-complete' => $projectByType->status === 'Completed',
                                                        'btn-onprocess' => $projectByType->status === 'In Progress',
                                                        'btn-pending' => $projectByType->status === 'Pending',
                                                        'btn-rejected' => $projectByType->status === 'Rejected',
                                                    ])>
                                                        {{ $projectByType->status }}</span>
                                                </div>
                                                <div class="mb5">
                                                    <p class="fs-14 fw-semibold text-color-100 m-0">
                                                        {{ $projectByType->title }}
                                                    </p>
                                                </div>
                                                <div class="fs-14 fw-medium mb5">
                                                    <span @class([
                                                        'text-color-ld' =>
                                                            $projectByType->category->category_name === 'Line Distribution',
                                                        'text-color-le' =>
                                                            $projectByType->category->category_name === 'Line Evolution',
                                                        'text-color-ad' =>
                                                            $projectByType->category->category_name === 'Album Distribution',
                                                        'text-color-ae' =>
                                                            $projectByType->category->category_name === 'Total Line Evolution',
                                                        'text-color-rb' =>
                                                            $projectByType->category->category_name === 'Ranking Battle',
                                                        'text-color-hs' => $projectByType->category->category_name === 'How Should',
                                                        'text-color-hw' => $projectByType->category->category_name === 'How Would',
                                                        'text-color-cd' =>
                                                            $projectByType->category->category_name === 'Center Distribution',
                                                        'text-info' => $projectByType->category->category_name === 'Other',
                                                    ])>
                                                        {{ $projectByType->category->category_name }}</span>
                                                </div>
                                                <div class="text-color-100 fs-14 fw-medium">
                                                    <i class="las la-user-alt"></i> {{ $projectByType->requester }} |
                                                    {{ $projectByType->votes }}
                                                    Votes
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col text-color-100 text-center">
                                        <svg width="48" height="48" viewBox="0 0 84 84" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M39.176 46.828L38.564 29.44H44L43.424 46.828H39.176ZM44.468 52.3C44.468 53.956 43.172 55.252 41.408 55.252C39.572 55.252 38.276 53.956 38.276 52.3C38.276 50.644 39.572 49.348 41.408 49.348C43.172 49.348 44.468 50.644 44.468 52.3Z"
                                                fill="#EA8887" />
                                            <path
                                                d="M47.9745 8.0255C47.65 7.69985 47.2644 7.4416 46.8397 7.2656C46.415 7.0896 45.9597 6.99934 45.5 7H21C17.1395 7 14 10.1395 14 14V70C14 73.8605 17.1395 77 21 77H63C66.8605 77 70 73.8605 70 70V31.5C70.0007 31.0403 69.9104 30.585 69.7344 30.1603C69.5584 29.7356 69.3002 29.35 68.9745 29.0255L47.9745 8.0255ZM21 14H44.051L63 32.949L63.007 65.058L54.019 56.07C55.244 53.9875 56 51.5865 56 49C56 41.279 49.721 35 42 35C34.279 35 28 41.279 28 49C28 56.721 34.279 63 42 63C44.5865 63 46.9875 62.244 49.07 61.019L58.051 70H21V14ZM42 56C38.1395 56 35 52.8605 35 49C35 45.1395 38.1395 42 42 42C45.8605 42 49 45.1395 49 49C49 52.8605 45.8605 56 42 56Z"
                                                fill="#787878" />
                                        </svg>
                                        <p class="fs-14 fw-medium mb-0 mt-1"></p>No Project found!
                                    </div>
                                @endforelse
                            @elseif ($projectItem->type_name == 'Youtube Comment')
                                @forelse ($youtubeCommentProjects as $projectByType)
                                    <div class="row {{ $loop->last ? '' : 'mb-3' }}">
                                        <div class="col">
                                            <div class="table-content-mobile">
                                                @if ($projectByType->date == null)
                                                    <div class="fs-14 fw-medium text-color-80 mb-10"><i
                                                            class="lar la-calendar"></i>
                                                        Coming Soon
                                                    </div>
                                                @else
                                                    <div class="fs-14 fw-medium text-color-80 mb-10"><i
                                                            class="lar la-calendar"></i>
                                                        {{ \Carbon\Carbon::parse($projectByType->date)->format('j F Y, G:i T') }}
                                                    </div>
                                                @endif
                                                <div class="mb5">
                                                    <span @class([
                                                        'btn',
                                                        'btn-complete' => $projectByType->status === 'Completed',
                                                        'btn-onprocess' => $projectByType->status === 'In Progress',
                                                        'btn-pending' => $projectByType->status === 'Pending',
                                                        'btn-rejected' => $projectByType->status === 'Rejected',
                                                    ])>
                                                        {{ $projectByType->status }}</span>
                                                </div>
                                                <div class="mb5">
                                                    <p class="fs-14 fw-semibold text-color-100 m-0">
                                                        {{ $projectByType->title }}
                                                    </p>
                                                </div>
                                                <div class="fs-14 fw-medium mb5">
                                                    <span @class([
                                                        'text-color-ld' =>
                                                            $projectByType->category->category_name === 'Line Distribution',
                                                        'text-color-le' =>
                                                            $projectByType->category->category_name === 'Line Evolution',
                                                        'text-color-ad' =>
                                                            $projectByType->category->category_name === 'Album Distribution',
                                                        'text-color-ae' =>
                                                            $projectByType->category->category_name === 'Total Line Evolution',
                                                        'text-color-rb' =>
                                                            $projectByType->category->category_name === 'Ranking Battle',
                                                        'text-color-hs' => $projectByType->category->category_name === 'How Should',
                                                        'text-color-hw' => $projectByType->category->category_name === 'How Would',
                                                        'text-color-cd' =>
                                                            $projectByType->category->category_name === 'Center Distribution',
                                                        'text-info' => $projectByType->category->category_name === 'Other',
                                                    ])>
                                                        {{ $projectByType->category->category_name }}</span>
                                                </div>
                                                <div class="text-color-100 fs-14 fw-medium">
                                                    <i class="las la-user-alt"></i> {{ $projectByType->requester }} |
                                                    {{ $projectByType->votes }}
                                                    Votes
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col text-color-100 text-center">
                                        <svg width="48" height="48" viewBox="0 0 84 84" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M39.176 46.828L38.564 29.44H44L43.424 46.828H39.176ZM44.468 52.3C44.468 53.956 43.172 55.252 41.408 55.252C39.572 55.252 38.276 53.956 38.276 52.3C38.276 50.644 39.572 49.348 41.408 49.348C43.172 49.348 44.468 50.644 44.468 52.3Z"
                                                fill="#EA8887" />
                                            <path
                                                d="M47.9745 8.0255C47.65 7.69985 47.2644 7.4416 46.8397 7.2656C46.415 7.0896 45.9597 6.99934 45.5 7H21C17.1395 7 14 10.1395 14 14V70C14 73.8605 17.1395 77 21 77H63C66.8605 77 70 73.8605 70 70V31.5C70.0007 31.0403 69.9104 30.585 69.7344 30.1603C69.5584 29.7356 69.3002 29.35 68.9745 29.0255L47.9745 8.0255ZM21 14H44.051L63 32.949L63.007 65.058L54.019 56.07C55.244 53.9875 56 51.5865 56 49C56 41.279 49.721 35 42 35C34.279 35 28 41.279 28 49C28 56.721 34.279 63 42 63C44.5865 63 46.9875 62.244 49.07 61.019L58.051 70H21V14ZM42 56C38.1395 56 35 52.8605 35 49C35 45.1395 38.1395 42 42 42C45.8605 42 49 45.1395 49 49C49 52.8605 45.8605 56 42 56Z"
                                                fill="#787878" />
                                        </svg>
                                        <p class="fs-14 fw-medium mb-0 mt-1"></p>No Project found!
                                    </div>
                                @endforelse
                            @endif
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <a href="/projects-type/{{ $projectItem->slug ?? '' }}" class="link-show-all">Show
                                All <i class="las la-arrow-right"> </i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach
@endsection