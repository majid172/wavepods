@extends($activeTemplate.'layouts.master')
@section('content')

<div class="dashboard py-80 section-bg">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                @include($activeTemplate.'components.sidebar')

            </div>

            <div class="col-xl-9">
                <div class="row justify-content-center">
                    @forelse ($subscriptions as $item)
                    <div class="col-lg-6">
                        <div class="single-trending-episode">

                            <div class="single-trending-episode__thumb mb-3">
                                <img src="{{getImage(getFilePath('podcast').'/' . @$item->podcast->path .'/'. @$item->podcast->image )}}" alt="">
                            </div>

                            <div class="single-trending-episode__info">
                                <h5>
                                    <a class="title" href="{{route('podcast')}}">
                                        {{__(@$item->podcast->title)}}
                                    </a>
                                </h5>

                                <div class="profile-block d-flex mb-2">
                                    <img src="{{ getImage(getFilePath('userProfile').'/'.@ $item->user->image) }}" class="profile-block-image img-fluid" alt="">

                                    <div>
                                        {{__(@$item->user->fullname)}}

                                        <h5>{{__(@$item->user->designation)}}</h5>
                                    </div>

                                </div>
                                <div>
                                    <p><strong>@lang('Expired Date'): </strong>{{showDateTime(@$item->expire_date)}}</p>
                                </div>

                                @if ($item->expire_date > now())
                                    <button class="btn btn--base btn-sm mt-2"> @lang('Active') </button>
                                @else
                                <button class="btn btn--base btn-sm mt-2"> @lang('Inactive') </button>
                                @endif

                            </div>
                        </div>
                    </div>
                    @empty

                    @endforelse
                </div>
            </div>

        </div>
    </div>
</div>


@endsection


