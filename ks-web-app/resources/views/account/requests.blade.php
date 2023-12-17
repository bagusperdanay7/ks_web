@extends('layouts.main')
@section('content')
    <section id="my-requests" class="mb-50">
        {{-- TODO: Buat Responsive --}}
        <h2 class="mb-30 fw-bold text-color-100">My Request</h2>
        <div class="row">
            <div class="col order-2 order-lg-1">
                <div class="request-container border">
                    <h3 class="fw-semibold text-color-100 mb-24">All Request ({{ $myrequests->count() }})</h3>
                    <div class="row fs-14 mb-24">
                        <div class="col-4 fw-medium">Project Title</div>
                        <div class="col fw-medium">Category</div>
                        <div class="col fw-medium">Project Type</div>
                        <div class="col fw-medium">Status</div>
                        <div class="col-1"></div>
                    </div>
                    @forelse ($myrequests as $request)
                        <div class="row fs-12 {{ $loop->last ? 'mb-0' : 'mb-24' }}">
                            <div class="col-4">{{ $request->project_title }}</div>
                            <div @class([
                                'col',
                                'text-color-ld' =>
                                    $request->category->category_name === 'Line Distribution',
                                'text-color-le' => $request->category->category_name === 'Line Evolution',
                                'text-color-ad' =>
                                    $request->category->category_name === 'Album Distribution',
                                'text-color-ae' => $request->category->category_name === 'Album Evolution',
                                'text-color-rb' => $request->category->category_name === 'Ranking Battle',
                                'text-color-hs' => $request->category->category_name === 'How Should',
                                'text-color-hw' => $request->category->category_name === 'How Would',
                                'text-color-cd' =>
                                    $request->category->category_name === 'Center Distribution',
                            ])>{{ $request->category->category_name }}</div>
                            <div class="col">{{ $request->type->type_name }}</div>
                            <div class="col">
                                <span @class([
                                    'btn',
                                    'btn-complete' => $request->status === 'Completed',
                                    'btn-onprocess' => $request->status === 'On Process',
                                    'btn-pending' => $request->status === 'Pending',
                                    'btn-rejected' => $request->status === 'Rejected',
                                ])>{{ $request->status }}</span>
                            </div>
                            <div class="col-1">
                                <a href="/projects/{{ $request->id }}" class="dropdown-item" target="_blank"><i
                                        class="las la-external-link-alt fs-14"></i></a>
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
                                <p class="fs-14 fw-medium mt-1 mb-0"></p>No Request Has Been Made!
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection
