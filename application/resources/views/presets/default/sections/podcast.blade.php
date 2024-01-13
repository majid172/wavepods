@php
    $content = getContent('podcast.content',true);
    $podcasts = App\Models\Podcast::orderBy('created_at','desc')->with('episode')->limit(4)->get();

@endphp

<section class="topics-area pt-60 mb-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-12">
                <div class="section-title-wrap mb-5">
                    <h3 class="section-title">{{__(@$content->data_values->heading)}}</h3>
                </div>
            </div>
        </div>
        <div class="row">
            @forelse ($podcasts as $item)
            <div class="col-lg-3">
                <div class="single-topic">
                    <div class="single-topic__thumb">
                        <img src="{{getImage(getFilePath('podcast').'/' . @$item->path .'/'. @$item->image )}}" alt="">
                    </div>
                    <div class="single-topic__content">
                        <a class="title" href="{{route('podcast.episodes',$item->id)}}">
                            {{Illuminate\Support\Str::limit($item->title,20)}}
                        </a>
                        <p class="mb-3">{{Illuminate\Support\Str::limit(@$item->description,50)}}</p>
                        <a href="{{route('podcast.episodes', $item->id)}}" class="btn btn--ssm">{{@$item->episode->count()}} @lang('Episodes') </a>

                    </div>
                </div>
            </div>
            @empty
            <p>@lang('No podcast available now.')
            @endforelse

        </div>
    </div>
</section>
