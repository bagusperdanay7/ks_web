@extends('layouts.main')

@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb" class="space-navbar">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('projects') }}">Projects</a></li>
            <li class="breadcrumb-item"><a
                    href="/gallery/artists/{{ $project->artist->codename }}">{{ $project->artist->artist_name }}</a></li>
            <li class="breadcrumb-item breadcumb-active" aria-current="page">{{ $project->project_title }}
            </li>
        </ol>
    </nav>

    <div class="row gallery-section-artist mb-5">
        <div class="col-6">
            <img src="{{ $project->thumbnail }}" class="img-fluid rounded" alt="">
        </div>
        <div class="col-6 bg-white-secondary rounded">
            <div class="project-detail-card">
                <h3>{{ $project->project_title }}</h3>

                <div class="row">
                    <div class="col-4">Category</div>
                    <div class="col-8">{{ $project->category->category_name }}</div>
                </div>
                <div class="row">
                    <div class="col-4">Date</div>
                    <div class="col-8">{{ $project->category->category_name }}</div>
                </div>
                <div class="row">
                    <div class="col-4">Project Type</div>
                    <div class="col-8">{{ $project->type->type_name }}</div>
                </div>
                <div class="row">
                    <div class="col-4">Requester</div>
                    <div class="col-8">{{ $project->requester }}</div>
                </div>
                <div class="row">
                    <div class="col-4">Request Made</div>
                    <div class="col-8">{{ $project->created_at }}</div>
                </div>
                <div class="row">
                    <div class="col-4">Status</div>
                    <div class="col-8">{{ $project->status }}</div>
                </div>
                <div class="row">
                    <div class="col-4">Artist</div>
                    <div class="col-8">{{ $project->artist->artist_name }}</div>
                </div>
                <div class="row">
                    <div class="col-4">Votes</div>
                    <div class="col-8">{{ $project->votes }}</div>
                </div>
                <div class="row">
                    <div class="col-4">Notes</div>
                    <div class="col-8">{{ $project->notes }}</div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="d-flex justify-content-between">
                            <p class="m-0 text-md-14">Progress</p>
                            <span class="text-sb-14 text-black-100">{{ $project->progress }}%</span>
                        </div>
                        <div class="progress" role="progressbar" aria-label="progress project"
                            aria-valuenow="{{ $project->progress }}" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-second rounded-pill" style="width: {{ $project->progress }}%;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{-- <div class="col-8 align-self-center">
            <h2 class="header-2">{{ $artists->first()->artist->artist_name }}</h2>
            <p class="text-about-artist">{{ $artists->first()->artist->about }}</p>
            <div class="row">
                <div class="col-2">
                    <h4 class="heading-info-artist">Debut</h4>
                </div>
                <div class="col">
                    <p>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $artists->first()->artist->artist_birthday)->format('d F Y') }}
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <h4 class="heading-info-artist">Fandom Name</h4>
                </div>
                <div class="col">
                    <p>{{ $artists->first()->artist->fandom_name }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <h4 class="heading-info-artist">Origin</h4>
                </div>
                <div class="col">
                    <p>{{ $artists->first()->artist->artist_birthplace }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <h4 class="heading-info-artist">Company</h4>
                </div>
                <div class="col">
                    <p>{{ $artists->first()->artist->company_name }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <h4 class="heading-info-artist">Total project</h4>
                </div>
                <div class="col">
                    <p>{{ $artists->count() }}</p>
                </div>
            </div>
        </div> --}}
    </div>

    {{-- <div class="row mt-4 mb-4">
        <h3>project</h3>
        @foreach ($projects as $project)
            <div class="col-4 artist-card">
                <a href="">
                    <div class="project-description-card">
                        @if ($project->project_thumbnail != null)
                            <img src="{{ $project->project_thumbnail }}" class="rounded thumbnail m-0 p-0" width="100%"
                                alt="{{ $project->project_title }} thumbnail">
                        @else
                            <img src="{{ asset('img/no_thumbnail.jpg') }}" class="rounded thumbnail m-0 p-0" width="100%"
                                alt="{{ $project->project_title }} thumbnail">
                        @endif
                        <a href="gallery?content_category={{ $project->content_category->slug }}">
                            <p class="category-text-project">{{ $project->content_category->name }}</p>
                        </a>
                        <h4>{{ $project->project_title }}
                            ({{ $project->content_category->name }})
                        </h4>
                        <span
                            class="pro-class-date">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($project->project_date))->diffForHumans() }}
                            &#8226; <a href="gallery?search={{ $project->project_class }}"
                                class="p-0 m-0 text-decoration-none"><span
                                    class="pro-class-text">{{ $project->project_class }}</span>
                            </a>
                        </span>
                        <div class="d-flex flex-row my-2 px-2 pb-2">
                            <div>
                                <a href="/gallery?artist={{ $project->artist->codename }}">
                                    @if ($project->artist->artist_pict != null)
                                        <img class="rounded-circle fit-img"
                                            src="{{ asset('img/artist/' . $project->artist->artist_pict) }}"
                                            alt="{{ $project->artist->artist_name }} thumbnail" width="40px"
                                            height="40px">
                                    @else
                                        <img class="rounded-circle fit-img"
                                            src="{{ asset('img/artist/unknown_artist.jpg') }}"
                                            alt="{{ $project->artist->artist_name }} thumbnail" width="40px"
                                            height="40px">
                                    @endif
                                </a>
                            </div>
                            <div class="align-self-center">
                                <a href="/gallery?artist={{ $project->artist->codename }}">
                                    <p class="mx-2 my-0 py-0">{{ $project->artist->artist_name }}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div> --}}
@endsection
