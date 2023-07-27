@extends('layouts.main')

@section('container')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb" class="space-navbar">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/projects">Projects</a></li>
            <li class="breadcrumb-item breadcumb-active" aria-current="page">Non-Project</li>
        </ol>
    </nav>

    <div class="row non-pro-hero">
        <div class="col">
            <h2 class="mb-3">Non-Project</h2>
            <p class="non-pro-text">Non-project Isn't based on your requests. Instead, it's based on our own desires and
                upcoming new
                comeback songs from particular artists.</p>
            <a href="" class="btn btn-non-project">View Details</a>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="project-section">
                <div class="d-flex justify-content-between">
                    <h3>Non-Project</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover projects-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Project Name</th>
                                <th>Category</th>
                                <th>Requester</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($non_project as $non_pro)
                                <tr>
                                    <td class="align-middle"><i class="lar la-calendar"></i>
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $non_pro->project_date)->format('d F Y') }}
                                    </td>
                                    <td class="align-middle">{{ $non_pro->project_title }}</td>
                                    <td class="align-middle">{{ $non_pro->content_category->name }}</td>
                                    <td class="align-middle">{{ $non_pro->project_requester }}</td>
                                    @if ($non_pro->project_status == 'Completed')
                                        <td class="align-middle">
                                            <span class="btn btn-complete">
                                                {{ $non_pro->project_status }}
                                            </span>
                                        </td>
                                    @elseif ($non_pro->project_status == 'On Process')
                                        <td class="align-middle">
                                            <span class="btn btn-onprocess">
                                                {{ $non_pro->project_status }}
                                            </span>
                                        </td>
                                    @elseif ($non_pro->project_status == 'Pending')
                                        <td class="align-middle">
                                            <span class="btn btn-pending">
                                                {{ $non_pro->project_status }}
                                            </span>
                                        </td>
                                    @elseif ($non_pro->project_status == 'Rejected')
                                        <td class="align-middle">
                                            <span class="btn btn-rejected">
                                                {{ $non_pro->project_status }}
                                            </span>
                                        </td>
                                    @else
                                        <td class="align-middle">
                                            <span class="btn btn-onprocess">
                                                {{ $non_pro->project_status }}
                                            </span>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center no-data-val">
                                        <i class="las la-ban"></i> No Project Found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
