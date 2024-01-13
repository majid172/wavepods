@php
    $content        = getContent('banner.content',true);
    $elements       = getContent('banner.element',false);
    $creators        = App\Models\Podcast::where('creator_id','!=',0)->with('user')->get();

    $socialIcons    = getContent('social_icon.element',false);
@endphp

<section class="banner-area bg-img" style="background-image: url({{asset($activeTemplateTrue.'images/banner/banner-bg.jpg')}});">
	<div class="container">
		<div class="row gy-4 align-items-center justify-content-center">
			<div class="col-lg-7">
				<div class="banner__content text-center">
					<h2> {{__(@$content->data_values->heading)}} </h2>
					<p>{{__(@$content->data_values->subheading)}}</p>
					<a class="btn btn--base" href="{{route('podcast')}}">{{__(@$content->data_values->button)}}</a>
				</div>
			</div>
		</div>
		<div class="podcast-team-area mt-5">
			<div class="container">
				<div class="row podcast-team-slider justify-content-center">
                    @foreach ($creators as $item)
                    <div class="podcast-team-single">
						<div class="podcast-team-single__thumb">
							<img src="{{getImage(getFilePath('userProfile').'/'.@$item->user->image)}}" alt="">
						</div>

						<div class="podcast-team-single__content">
							<div class="podcast-team-single__content name">
								<h4>{{__(@$item->user->firstname)}} {{__(@$item->user->lastname)}}</h4>
							</div>
							<div class="podcast-team-single__content-tags">
								<span class="btn btn--ssm">{{__(@$item->user->designation)}}</span>

							</div>
							<ul class="social-list">

                                <li class="social-list__item">
                                    <a href="{{@$item->user->facebook_url}}" class="social-list__link text-white">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>

                                <li class="social-list__item">
                                    <a href="{{@$item->user->twitter_url}}" class="social-list__link text-white">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>

                                <li class="social-list__item">
                                    <a href="{{@$item->user->linkedin_url}}" class="social-list__link text-white">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>

							</ul>
						</div>
					</div>
                    @endforeach


				</div>
			</div>
		</div>
	</div>
</section>
