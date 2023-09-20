@extends('layouts.main')

@section('content')
    <nav class="mb-15"
        style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb fs-sm-12">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('projects') }}">Projects</a></li>
            <li class="breadcrumb-item breadcumb-active" aria-current="page">{{ $project->project_title }}
            </li>
        </ol>
    </nav>

    <section id="detail-single-project">
        <div class="row">
            <div class="col-12 col-md-6">
                @if ($project->thumbnail)
                    <img src="{{ $project->thumbnail }}" class="img-fluid thumbnail"
                        alt="{{ $project->project_title }} thumbnail">
                @else
                    <img src="{{ asset('img/no_thumbnail.jpg') }}" class="img-fluid thumbnail"
                        alt="{{ $project->project_title }} thumbnail">
                @endif

            </div>
            <div class="col-12 col-md-6">
                <div class="detail-project border">
                    <h3 class="fw-semibold mb-15 fs-sm-18">{{ $project->project_title }}</h3>
                    <div class="row mb-10">
                        <div class="col-4 fs-inter-14 fw-semibold text-color-100">Category</div>
                        <div @class([
                            'col-8',
                            'fw-medium',
                            'fs-inter-14',
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
                        ])>{{ $project->category->category_name }}
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-4 fs-inter-14 fw-semibold text-color-100">Date</div>
                        <div class="col-8 fs-inter-14 text-color-100">
                            @if ($project->date)
                                {{ \Carbon\Carbon::parse($project->date)->format('d F Y, G:i T') }}
                            @else
                                Coming Soon
                            @endif
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-4 fs-inter-14 fw-semibold text-color-100">Project Type</div>
                        <div class="col-8 fs-inter-14 text-color-100">{{ $project->type->type_name }}</div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-4 fs-inter-14 fw-semibold text-color-100">Requester</div>
                        <div class="col-8 fs-inter-14 text-color-100">{{ $project->requester }}</div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-4 fs-inter-14 fw-semibold text-color-100">Request Made</div>
                        <div class="col-8 fs-inter-14 text-color-100">
                            {{ \Carbon\Carbon::parse($project->created_at)->format('d F Y, G:i T') }}</div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-4 fs-inter-14 fw-semibold text-color-100">Status</div>
                        <div class="col-8">
                            <span @class([
                                'btn',
                                'btn-complete' => $project->status === 'Completed',
                                'btn-onprocess' => $project->status === 'On Process',
                                'btn-pending' => $project->status === 'Pending',
                                'btn-rejected' => $project->status === 'Rejected',
                            ])>{{ $project->status }}</span>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-4 fs-inter-14 fw-semibold text-color-100">Artist</div>
                        <div class="col-8 fs-inter-14 text-color-100">{{ $project->artist->artist_name }}</div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-4 fs-inter-14 fw-semibold text-color-100">Votes</div>
                        <div class="col-8 fs-inter-14 text-color-100">{{ $project->votes }}</div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-4 fs-inter-14 fw-semibold text-color-100">Exclusive</div>
                        <div class="col-8 fs-inter-14 text-color-100">{{ $project->is_exclusive }}</div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-4 fs-inter-14 fw-semibold text-color-100">Notes</div>
                        <div class="col-8 fs-inter-14 text-color-100">{{ $project->notes }}</div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="d-flex justify-content-between mb-1">
                                <p class="m-0 fs-inter-14 fw-semibold text-color-100">Progress</p>
                                <span class="fs-inter-14 fw-medium text-color-100">{{ $project->progress }}%</span>
                            </div>
                            <div class="progress bg-main-20" role="progressbar" aria-label="progress project"
                                aria-valuenow="{{ $project->progress }}" aria-valuemin="0" aria-valuemax="100"
                                style="height: 10px">
                                <div class="progress-bar bg-main rounded-pill" style="width: {{ $project->progress }}%;">
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- TODO: Add Upvote --}}
                    @auth
                        @if ($project->status !== 'Completed')
                            <div class="row mt-15">
                                <div class="col">
                                    <button class="btn btn-main col-12">Upvote</button>
                                </div>
                            </div>
                        @endif
                    @endauth

                </div>
            </div>
        </div>
    </section>
@endsection
