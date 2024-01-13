@php
    $content        = getContent('latest_episodes.content',true);
    $episodes       = App\Models\Episode::orderBy('created_at','desc')->limit(3)->with('podcast', 'podcast.user')->get();
@endphp

<section class="latest-podcast pt-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-12">
                <div class="section-title-wrap mb-5">
                    <h3 class="section-title">{{@$content->data_values->heading}}</h3>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            @foreach($episodes as $item)
            <div class="col-lg-4 mb-3">
                <div class="single-trending-episode">

                    <div class="single-trending-episode__thumb">
                        <img src="{{getImage(getFilePath('podcastEpisode').'/' . @$item->image_path .'/'. @$item->image )}}" alt="episode_img">
                    </div>

                    <div class="single-trending-episode__info">
                        <h5 class="mb-2">
                            <a class="title" href="{{route('podcast.details', $item->id)}}">
                               {{Illuminate\Support\Str::limit($item->title,30)}}
                            </a>
                        </h5>


                        <div class="profile-block d-flex mb-2">
                            @if ($item->creator_id !=0)
                            @if($item->podcast->user && $item->podcast->user->image != null)
                                <img src="{{ getImage(getFilePath('userProfile').'/'. @$item->podcast->user->image) }}" class="profile-block-image img-fluid" alt="">
                             @endif
                            @endif



                            <div>
                                {{__(@$item->podcast->user->fullname) ?? 'Admin'}}

                                <h5> {{__(@$item->podcast->user->designation)}} </h5>
                            </div>
                        </div>

                        <p class="mb-0"> @php echo substr($item->description,0,90).'...'; @endphp </p>

                        <div class="latest-episode-bottom  justify-content-between mt-3">
                            <a href="javascript:void(0)" class="bi-headphones me-1">
                                <i class="fa-solid fa-headphones"></i> <span> {{__($item->listen_count)}} </span>
                            </a>

                            <a href="{{route('user.podcast.bookmark.add', $item->id)}}" class="bi-heart me-2">
                                <i class="fa-solid fa-bookmark"></i>
                            </a>

                        </div>
                    </div>
                </div>
            </div>


            @endforeach





        </div>

        {{-- <div class="row gy-4 justify-content-center">
            @forelse ($episodes as $item)
            <div class="col-lg-6 col-12 mb-4">
                <div class="latest-episode-item">
                    <div class="latest-episode-item__thumb">
                        <div class="image-wrap">
                            <img src="{{getImage(getFilePath('podcastEpisode').'/' . @$item->image_path .'/'. @$item->image )}}" alt="">

                            <div class="popup-vide-wrap">
                                <div class="video-main">
                                    <div class="promo-video">
                                        <div class="waves-block">
                                            <div class="waves wave-1"></div>
                                            <div class="waves wave-2"></div>
                                            <div class="waves wave-3"></div>
                                        </div>
                                    </div>
                                    <a class="play-video"  href="{{route('podcast.details',$item->id)}}">
                                        <i class="fa fa-play"></i>
                                    </a>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="latest-episode-item__info">
                        <h5 class="mb-2">
                            <a class="title" href="{{route('podcast.details', $item->id)}}"> {{__(@$item->title)}} </a>
                        </h5>

                        <div class="my-2">
                            @if ($item->is_special == 1)
                            <a href="{{route('user.payment', $item->id)}}" class="btn btn--ssm">@lang('Subscribe')</a>
                            @endif

                        </div>

                        <div class="profile-block d-flex mb-2">
                            <div>
                                @if (@$item->podcast->creator_id != 0)
                                    @lang('Author'):
                                    {{__(@$item->podcast->user->fullname)}}
                                @endif
                            </div>
                        </div>

                        <p class="mb-0">
                            {{Illuminate\Support\Str::limit(@$item->description,120)}}
                        </p>

                        <div class="latest-episode-bottom justify-content-between mt-3">
                            <a href="javascript:void(0)" class="bi-headphones me-1">
                                <i class="fa-solid fa-headphones"></i> <span>{{__(@$item->listen_count)}}</span>
                            </a>
                            <a href="{{route('user.podcast.bookmark.add', $item->id)}}" class="badge">
                                <i class="fa-solid fa-bookmark"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <p>@lang('No episodes available now')</p>
            @endforelse
        </div> --}}
    </div>
</section>

{{-- <section class="trending-episode-area py-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-12">
                <div class="section-title-wrap mb-5">
                    <h3 class="section-title">@lang('Episodes List')</h3>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            @forelse ($episodes as $item)
            <div class="col-lg-4 mb-3">
                <div class="single-trending-episode">

                    <div class="single-trending-episode__thumb">
                        <img src="{{getImage(getFilePath('podcastEpisode').'/' . @$item->image_path .'/'. @$item->image )}}" alt="episode_img">
                    </div>

                    <div class="single-trending-episode__info">
                        <h5 class="mb-2">
                            <a class="title" href="{{route('podcast.details', $item->id)}}">
                               {{Illuminate\Support\Str::limit($item->title,30)}}
                            </a>
                        </h5>


                        <div class="profile-block d-flex mb-2">
                            @if($item->podcast->user && $item->podcast->user->image != null)
                                    <img src="{{ getImage(getFilePath('userProfile').'/'. @$item->podcast->user->image) }}" class="profile-block-image img-fluid" alt="">
                                @endif


                            <div>
                                {{__(@$item->podcast->user->fullname) ?? 'Admin'}}

                                <h5> {{__(@$item->podcast->user->designation)}} </h5>
                            </div>
                        </div>

                        <p class="mb-0"> @php echo substr($item->description,0,90).'...'; @endphp </p>

                        <div class="latest-episode-bottom  justify-content-between mt-3">
                            <a href="javascript:void(0)" class="bi-headphones me-1">
                                <i class="fa-solid fa-headphones"></i> <span> {{__($item->listen_count)}} </span>
                            </a>

                            <a href="{{route('user.podcast.bookmark.add', $item->id)}}" class="bi-heart me-2">
                                <i class="fa-solid fa-bookmark"></i>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
            @empty

            @endforelse



        @if ($episodes->hasPages())
        <div class=" py-4">
            @php echo paginateLinks($episodes) @endphp
        </div>
        @endif

        </div>
    </div>
</section> --}}


