@extends('layouts.main')
@section('content')
    <section id="my-requests" class="mb-50">
        <h2 class="mb-10 fw-bold text-color-100">My Request</h2>
        <p class="mb-4">These are your requests, just in case you require assistance. Please contact us via email.</p>
        <ul class="nav nav-pills nav-fill mb-4 text-responsive fs-sm-12" id="tab-requests" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all"
                    type="button" role="tab" aria-controls="pills-all" aria-selected="true">All</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-completed-tab" data-bs-toggle="pill" data-bs-target="#pills-completed"
                    type="button" role="tab" aria-controls="pills-completed" aria-selected="false">Completed</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-onprocess-tab" data-bs-toggle="pill" data-bs-target="#pills-onprocess"
                    type="button" role="tab" aria-controls="pills-onprocess" aria-selected="false">On Process</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-pending-tab" data-bs-toggle="pill" data-bs-target="#pills-pending"
                    type="button" role="tab" aria-controls="pills-pending" aria-selected="false">Pending</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-rejected-tab" data-bs-toggle="pill" data-bs-target="#pills-rejected"
                    type="button" role="tab" aria-controls="pills-rejected" aria-selected="false">Rejected</button>
            </li>
        </ul>
        <div class="row">
            <div class="col order-2 order-lg-1">
                <div class="table-card">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-all" role="tabpanel"
                            aria-labelledby="pills-all-tab" tabindex="0">
                            <h3 class="fw-semibold text-color-100 mb-24">All Request ({{ $myrequests->count() }})</h3>
                            <div class="row fs-14 mb-3 text-color-100 d-none d-md-flex">
                                <div class="col-3 fw-medium">Project Title</div>
                                <div class="col fw-medium">Category</div>
                                <div class="col fw-medium">Date</div>
                                <div class="col fw-medium">Project Type</div>
                                <div class="col fw-medium">Status</div>
                                <div class="col-1"></div>
                            </div>
                            @forelse ($myrequests as $request)
                                <div class="row fs-12 align-items-center {{ $loop->last ? 'mb-0' : 'mb-4' }}">
                                    <div
                                        class="col-12 col-md-3 text-truncate text-color-100 order-3 order-md-1 mb5 mb-md-0 fw-semibold">
                                        {{ $request->title }}</div>
                                    <div @class([
                                        'col-12',
                                        'col-md',
                                        'order-4',
                                        'order-md-2',
                                        'mb-0',
                                        'fw-medium',
                                        'text-color-ld' =>
                                            $request->category->category_name === 'Line Distribution',
                                        'text-color-le' => $request->category->category_name === 'Line Evolution',
                                        'text-color-ad' =>
                                            $request->category->category_name === 'Album Distribution',
                                        'text-color-ae' => $request->category->category_name === 'Total Line Evolution',
                                        'text-color-rb' => $request->category->category_name === 'Ranking Battle',
                                        'text-color-hs' => $request->category->category_name === 'How Should',
                                        'text-color-hw' => $request->category->category_name === 'How Would',
                                        'text-color-cd' =>
                                            $request->category->category_name === 'Center Distribution',
                                        'text-info' => $request->category->category_name === 'Other',
                                    ])>{{ $request->category->category_name }} <span
                                            class="d-inline d-md-none text-color-100 fw-medium">•
                                            {{ $request->projectType->type_name }}</span></div>
                                    <div
                                        class="col-12 col-md text-color-100 order-1 order-md-3 mb-10 mb-md-0 d-flex d-md-block justify-content-between">
                                        <div>
                                            <i class="lar la-calendar"></i>
                                            {{ $request->date === null ? 'Coming Soon' : \Carbon\Carbon::parse($request->date)->format('d F Y, G:i T') }}
                                        </div>
                                        <div class="d-md-none">
                                            <a href="{{ route('show-project', $request->id) }}"
                                                class="text-decoration-none text-color-primary" target="_blank" aria-label="Show Details about project">
                                                <i class="las la-external-link-alt fs-14" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Show Detail Project">
                                                </i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md d-none d-md-block text-color-100 order-4">
                                        {{ $request->projectType->type_name }}</div>
                                    <div class="col-12 col-md order-2 order-md-5 mb5 mb-md-0">
                                        <span @class([
                                            'btn',
                                            'btn-complete' => $request->status === 'Completed',
                                            'btn-onprocess' => $request->status === 'On Process',
                                            'btn-pending' => $request->status === 'Pending',
                                            'btn-rejected' => $request->status === 'Rejected',
                                        ])>{{ $request->status }}</span>
                                    </div>
                                    <div class="col-md-1 d-none d-md-block order-last">
                                        <a href="{{ route('show-project', $request->id) }}"
                                            class="text-decoration-none text-color-primary" target="_blank" aria-label="Show Details about project">
                                            <i class="las la-external-link-alt fs-14" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-title="Show Detail Project">
                                            </i>
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div class="row">
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
                                        <p class="fs-14 fw-medium mt-1 mb-0">No Request Found!</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        <div class="tab-pane fade" id="pills-completed" role="tabpanel"
                            aria-labelledby="pills-completed-tab" tabindex="0">
                            <h3 class="fw-semibold text-color-100 mb-24">Completed Request ({{ $myCompletedRequests->count() }})
                            </h3>
                            <div class="row fs-14 mb-3 text-color-100 d-none d-md-flex">
                                <div class="col-3 fw-medium">Project Title</div>
                                <div class="col fw-medium">Category</div>
                                <div class="col fw-medium">Date</div>
                                <div class="col fw-medium">Project Type</div>
                                <div class="col fw-medium">Status</div>
                                <div class="col-1"></div>
                            </div>
                            @forelse ($myCompletedRequests as $completedRequest)
                                <div class="row fs-12 align-items-center {{ $loop->last ? 'mb-0' : 'mb-4' }}">
                                    <div
                                        class="col-12 col-md-3 text-truncate text-color-100 order-3 order-md-1 mb5 mb-md-0 fw-semibold">
                                        {{ $completedRequest->title }}</div>
                                    <div @class([
                                        'col-12',
                                        'col-md',
                                        'order-4',
                                        'order-md-2',
                                        'mb-0',
                                        'fw-medium',
                                        'text-color-ld' =>
                                            $completedRequest->category->category_name === 'Line Distribution',
                                        'text-color-le' =>
                                            $completedRequest->category->category_name === 'Line Evolution',
                                        'text-color-ad' =>
                                            $completedRequest->category->category_name === 'Album Distribution',
                                        'text-color-ae' =>
                                            $completedRequest->category->category_name === 'Total Line Evolution',
                                        'text-color-rb' =>
                                            $completedRequest->category->category_name === 'Ranking Battle',
                                        'text-color-hs' =>
                                            $completedRequest->category->category_name === 'How Should',
                                        'text-color-hw' =>
                                            $completedRequest->category->category_name === 'How Would',
                                        'text-color-cd' =>
                                            $completedRequest->category->category_name === 'Center Distribution',
                                        'text-info' => $request->category->category_name === 'Other',
                                    ])>{{ $completedRequest->category->category_name }}
                                        <span class="d-inline d-md-none text-color-100 fw-medium">•
                                            {{ $completedRequest->projectType->type_name }}</span></div>
                                    <div
                                        class="col-12 col-md text-color-100 order-1 order-md-3 mb-10 mb-md-0 d-flex d-md-block justify-content-between">
                                        <div>
                                            <i class="lar la-calendar"></i>
                                            {{ $completedRequest->date === null ? 'Coming Soon' : \Carbon\Carbon::parse($completedRequest->date)->format('d F Y, G:i T') }}
                                        </div>
                                        <div class="d-md-none">
                                            <a href="{{ route('show-project', $completedRequest->id) }}"
                                                class="text-decoration-none text-color-primary" target="_blank" aria-label="Show Details about project">
                                                <i class="las la-external-link-alt fs-14" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Show Detail Project">
                                                </i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md d-none d-md-block text-color-100 order-4">
                                        {{ $completedRequest->projectType->type_name }}</div>
                                    <div class="col-12 col-md order-2 order-md-5 mb5 mb-md-0">
                                        <span @class([
                                            'btn',
                                            'btn-complete' => $completedRequest->status === 'Completed',
                                            'btn-onprocess' => $completedRequest->status === 'On Process',
                                            'btn-pending' => $completedRequest->status === 'Pending',
                                            'btn-rejected' => $completedRequest->status === 'Rejected',
                                        ])>{{ $completedRequest->status }}</span>
                                    </div>
                                    <div class="col-md-1 d-none d-md-block order-last">
                                        <a href="{{ route('show-project', $completedRequest->id) }}"
                                            class="text-decoration-none text-color-primary" target="_blank" aria-label="Show Details about project">
                                            <i class="las la-external-link-alt fs-14" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-title="Show Detail Project">
                                            </i>
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div class="row">
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
                                        <p class="fs-14 fw-medium mt-1 mb-0">No Request Found!</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        <div class="tab-pane fade" id="pills-onprocess" role="tabpanel"
                            aria-labelledby="pills-onprocess-tab" tabindex="0">
                            <h3 class="fw-semibold text-color-100 mb-24">On Process Request ({{ $myOnProcessRequests->count() }})
                            </h3>
                            <div class="row fs-14 mb-3 text-color-100 d-none d-md-flex">
                                <div class="col-3 fw-medium">Project Title</div>
                                <div class="col fw-medium">Category</div>
                                <div class="col fw-medium">Date</div>
                                <div class="col fw-medium">Project Type</div>
                                <div class="col fw-medium">Status</div>
                                <div class="col-1"></div>
                            </div>
                            @forelse ($myOnProcessRequests as $OnProcessRequest)
                                <div class="row fs-12 align-items-center {{ $loop->last ? 'mb-0' : 'mb-4' }}">
                                    <div
                                        class="col-12 col-md-3 text-truncate text-color-100 order-3 order-md-1 mb5 mb-md-0 fw-semibold">
                                        {{ $OnProcessRequest->title }}</div>
                                    <div @class([
                                        'col-12',
                                        'col-md',
                                        'order-4',
                                        'order-md-2',
                                        'mb-0',
                                        'fw-medium',
                                        'text-color-ld' =>
                                            $OnProcessRequest->category->category_name === 'Line Distribution',
                                        'text-color-le' =>
                                            $OnProcessRequest->category->category_name === 'Line Evolution',
                                        'text-color-ad' =>
                                            $OnProcessRequest->category->category_name === 'Album Distribution',
                                        'text-color-ae' =>
                                            $OnProcessRequest->category->category_name === 'Total Line Evolution',
                                        'text-color-rb' =>
                                            $OnProcessRequest->category->category_name === 'Ranking Battle',
                                        'text-color-hs' =>
                                            $OnProcessRequest->category->category_name === 'How Should',
                                        'text-color-hw' =>
                                            $OnProcessRequest->category->category_name === 'How Would',
                                        'text-color-cd' =>
                                            $OnProcessRequest->category->category_name === 'Center Distribution',
                                        'text-info' => $request->category->category_name === 'Other',
                                    ])>{{ $OnProcessRequest->category->category_name }}
                                        <span class="d-inline d-md-none text-color-100 fw-medium">•
                                            {{ $OnProcessRequest->projectType->type_name }}</span></div>
                                    <div
                                        class="col-12 col-md text-color-100 order-1 order-md-3 mb-10 mb-md-0 d-flex d-md-block justify-content-between">
                                        <div>
                                            <i class="lar la-calendar"></i>
                                            {{ $OnProcessRequest->date === null ? 'Coming Soon' : \Carbon\Carbon::parse($OnProcessRequest->date)->format('d F Y, G:i T') }}
                                        </div>
                                        <div class="d-md-none">
                                            <a href="{{ route('show-project', $onPrcessRequest->id) }}"
                                                class="text-decoration-none text-color-primary" target="_blank" aria-label="Show Details about project">
                                                <i class="las la-external-link-alt fs-14" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Show Detail Project">
                                                </i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md d-none d-md-block text-color-100 order-4">
                                        {{ $OnProcessRequest->projectType->type_name }}</div>
                                    <div class="col-12 col-md order-2 order-md-5 mb5 mb-md-0">
                                        <span @class([
                                            'btn',
                                            'btn-complete' => $OnProcessRequest->status === 'Completed',
                                            'btn-onprocess' => $OnProcessRequest->status === 'On Process',
                                            'btn-pending' => $OnProcessRequest->status === 'Pending',
                                            'btn-rejected' => $OnProcessRequest->status === 'Rejected',
                                        ])>{{ $OnProcessRequest->status }}</span>
                                    </div>
                                    <div class="col-md-1 d-none d-md-block order-last">
                                        <a href="{{ route('show-project', $OnProcessRequest->id) }}"
                                            class="text-decoration-none text-color-primary" target="_blank" aria-label="Show Details about project">
                                            <i class="las la-external-link-alt fs-14" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-title="Show Detail Project">
                                            </i>
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div class="row">
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
                                        <p class="fs-14 fw-medium mt-1 mb-0">No Request Found!</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        <div class="tab-pane fade" id="pills-pending" role="tabpanel"
                            aria-labelledby="pills-pending-tab" tabindex="0">
                            <h3 class="fw-semibold text-color-100 mb-24">Pending Request ({{ $myPendingRequests->count() }})
                            </h3>
                            <div class="row fs-14 mb-3 text-color-100 d-none d-md-flex">
                                <div class="col-3 fw-medium">Project Title</div>
                                <div class="col fw-medium">Category</div>
                                <div class="col fw-medium">Date</div>
                                <div class="col fw-medium">Project Type</div>
                                <div class="col fw-medium">Status</div>
                                <div class="col-1"></div>
                            </div>
                            @forelse ($myPendingRequests as $pendingRequest)
                                <div class="row fs-12 align-items-center {{ $loop->last ? 'mb-0' : 'mb-4' }}">
                                    <div
                                        class="col-12 col-md-3 text-truncate text-color-100 order-3 order-md-1 mb5 mb-md-0 fw-semibold">
                                        {{ $pendingRequest->title }}</div>
                                    <div @class([
                                        'col-12',
                                        'col-md',
                                        'order-4',
                                        'order-md-2',
                                        'mb-0',
                                        'fw-medium',
                                        'text-color-ld' =>
                                            $pendingRequest->category->category_name === 'Line Distribution',
                                        'text-color-le' =>
                                            $pendingRequest->category->category_name === 'Line Evolution',
                                        'text-color-ad' =>
                                            $pendingRequest->category->category_name === 'Album Distribution',
                                        'text-color-ae' =>
                                            $pendingRequest->category->category_name === 'Total Line Evolution',
                                        'text-color-rb' =>
                                            $pendingRequest->category->category_name === 'Ranking Battle',
                                        'text-color-hs' =>
                                            $pendingRequest->category->category_name === 'How Should',
                                        'text-color-hw' => $pendingRequest->category->category_name === 'How Would',
                                        'text-color-cd' =>
                                            $pendingRequest->category->category_name === 'Center Distribution',
                                        'text-info' => $request->category->category_name === 'Other',
                                    ])>{{ $pendingRequest->category->category_name }} <span
                                            class="d-inline d-md-none text-color-100 fw-medium">•
                                            {{ $pendingRequest->projectType->type_name }}</span></div>
                                    <div
                                        class="col-12 col-md text-color-100 order-1 order-md-3 mb-10 mb-md-0 d-flex d-md-block justify-content-between">
                                        <div>
                                            <i class="lar la-calendar"></i>
                                            {{ $pendingRequest->date === null ? 'Coming Soon' : \Carbon\Carbon::parse($pendingRequest->date)->format('d F Y, G:i T') }}
                                        </div>
                                        <div class="d-md-none">
                                            <a href="{{ route('show-project', $pendingRequest->id) }}"
                                                class="text-decoration-none text-color-primary" target="_blank" aria-label="Show Details about project">
                                                <i class="las la-external-link-alt fs-14" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Show Detail Project">
                                                </i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md d-none d-md-block text-color-100 order-4">
                                        {{ $pendingRequest->projectType->type_name }}</div>
                                    <div class="col-12 col-md order-2 order-md-5 mb5 mb-md-0">
                                        <span @class([
                                            'btn',
                                            'btn-complete' => $pendingRequest->status === 'Completed',
                                            'btn-onprocess' => $pendingRequest->status === 'On Process',
                                            'btn-pending' => $pendingRequest->status === 'Pending',
                                            'btn-rejected' => $pendingRequest->status === 'Rejected',
                                        ])>{{ $pendingRequest->status }}</span>
                                    </div>
                                    <div class="col-md-1 d-none d-md-block order-last">
                                        <a href="{{ route('show-project', $pendingRequest->id) }}"
                                            class="text-decoration-none text-color-primary" target="_blank" aria-label="Show Details about project">
                                            <i class="las la-external-link-alt fs-14" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-title="Show Detail Project">
                                            </i>
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div class="row">
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
                                        <p class="fs-14 fw-medium mt-1 mb-0">No Request Found!</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        <div class="tab-pane fade" id="pills-rejected" role="tabpanel"
                            aria-labelledby="pills-rejected-tab" tabindex="0">
                            <h3 class="fw-semibold text-color-100 mb-24">Rejected Request ({{ $myRejectedRequests->count() }})
                            </h3>
                            <div class="row fs-14 mb-3 text-color-100 d-none d-md-flex">
                                <div class="col-3 fw-medium">Project Title</div>
                                <div class="col fw-medium">Category</div>
                                <div class="col fw-medium">Date</div>
                                <div class="col fw-medium">Project Type</div>
                                <div class="col fw-medium">Status</div>
                                <div class="col-1"></div>
                            </div>
                            @forelse ($myRejectedRequests as $rejectedRequest)
                                <div class="row fs-12 align-items-center {{ $loop->last ? 'mb-0' : 'mb-4' }}">
                                    <div
                                        class="col-12 col-md-3 text-truncate text-color-100 order-3 order-md-1 mb5 mb-md-0 fw-semibold">
                                        {{ $rejectedRequest->title }}</div>
                                    <div @class([
                                        'col-12',
                                        'col-md',
                                        'order-4',
                                        'order-md-2',
                                        'mb-0',
                                        'fw-medium',
                                        'text-color-ld' =>
                                            $rejectedRequest->category->category_name === 'Line Distribution',
                                        'text-color-le' =>
                                            $rejectedRequest->category->category_name === 'Line Evolution',
                                        'text-color-ad' =>
                                            $rejectedRequest->category->category_name === 'Album Distribution',
                                        'text-color-ae' =>
                                            $rejectedRequest->category->category_name === 'Total Line Evolution',
                                        'text-color-rb' =>
                                            $rejectedRequest->category->category_name === 'Ranking Battle',
                                        'text-color-hs' =>
                                            $rejectedRequest->category->category_name === 'How Should',
                                        'text-color-hw' =>
                                            $rejectedRequest->category->category_name === 'How Would',
                                        'text-color-cd' =>
                                            $rejectedRequest->category->category_name === 'Center Distribution',
                                        'text-info' => $request->category->category_name === 'Other',
                                    ])>{{ $rejectedRequest->category->category_name }} <span
                                            class="d-inline d-md-none text-color-100 fw-medium">•
                                            {{ $rejectedRequest->projectType->type_name }}</span></div>
                                    <div
                                        class="col-12 col-md text-color-100 order-1 order-md-3 mb-10 mb-md-0 d-flex d-md-block justify-content-between">
                                        <div>
                                            <i class="lar la-calendar"></i>
                                            {{ $rejectedRequest->date === null ? 'Coming Soon' : \Carbon\Carbon::parse($rejectedRequest->date)->format('d F Y, G:i T') }}
                                        </div>
                                        <div class="d-md-none">
                                            <a href="{{ route('show-project', $rejectedRequest->id) }}"
                                                class="text-decoration-none text-color-primary" target="_blank" aria-label="Show Details about project">
                                                <i class="las la-external-link-alt fs-14" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Show Detail Project">
                                                </i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md d-none d-md-block text-color-100 order-4">
                                        {{ $rejectedRequest->projectType->type_name }}</div>
                                    <div class="col-12 col-md order-2 order-md-5 mb5 mb-md-0">
                                        <span @class([
                                            'btn',
                                            'btn-complete' => $rejectedRequest->status === 'Completed',
                                            'btn-onprocess' => $rejectedRequest->status === 'On Process',
                                            'btn-pending' => $rejectedRequest->status === 'Pending',
                                            'btn-rejected' => $rejectedRequest->status === 'Rejected',
                                        ])>{{ $rejectedRequest->status }}</span>
                                    </div>
                                    <div class="col-md-1 d-none d-md-block order-last">
                                        <a href="{{ route('show-project', $rejectedRequest->id) }}"
                                            class="text-decoration-none text-color-primary" target="_blank" aria-label="Show Details about project">
                                            <i class="las la-external-link-alt fs-14" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-title="Show Detail Project">
                                            </i>
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div class="row">
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
                                        <p class="fs-14 fw-medium mt-1 mb-0">No Request Found!</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
