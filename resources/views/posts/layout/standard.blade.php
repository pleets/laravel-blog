<div class="container pt-3">
    <div class="row">
        <div class="col-sm-9">
            <article>
                <h1 style="font-family: 'Fjalla One', sans-serif;" class="pltsword">{{ $post->title }}</h1>
                <div>
                    <span class="badge badge-success">{{ $post->published_at }}</span>
                    <span class="badge badge-primary">{{ $post->category->name }}</span>
                </div>
                @if ($post->tags->count())
                    <div>
                        Tags &nbsp;
                        @foreach ($post->tags as $tag)
                            <span class="badge badge-light">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                @endif
                <br />

                <!-- FB Social Plugin -->
                @if(config('facebook.posts.starting.activated'))
                    <div class="fb-like"
                         data-href="{{ url()->current() }}"
                         data-width=""
                         data-layout="{{ config('facebook.posts.starting.layout') }}"
                         data-action="{{ config('facebook.posts.starting.action') }}"
                         data-size="{{ config('facebook.posts.starting.size') }}"
                         data-share="{{ config('facebook.posts.starting.share_button') }}"
                         style="float: left; margin-right: 10px;">
                    </div>
                @endif

                {!! $post->content !!}

                <div style="overflow: hidden;">
                    <!-- FB Social Plugin -->
                    @if(config('facebook.posts.ending.activated'))
                        <div class="fb-like"
                             data-href="{{ url()->current() }}"
                             data-width=""
                             data-layout="{{ config('facebook.posts.ending.layout') }}"
                             data-action="{{ config('facebook.posts.ending.action') }}"
                             data-size="{{ config('facebook.posts.ending.size') }}"
                             data-share="{{ config('facebook.posts.ending.share_button') }}"
                             style="float: left; margin-right: 10px;">
                        </div>
                    @endif
                </div>

                <hr />

                @if(\Pleets\LaravelPayPal\Helpers\Environment::isCheckoutActivated())
                    <div class="row">
                        <div class="col-sm-10 col-md-8">
                            <p class="text-center pltsword" style="font-size: 25px;">
                                {{ __('paypal.smart_button_invitation') }}
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10 col-md-8 text-center">
                            <img src="{{ asset('img/cup-of-coffee.png') }}" width="190"><br />
                            @include('laravel-paypal::checkout.button')
                        </div>
                    </div>
                @endif

                <footer class="pt-5">
                    <h4>Acerca de {{ $post->author->user->name }}</h4>
                    <div class="row">
                        <div class="col-sm-auto text-center">
                            <img src="{{ asset('img/authors/fermius.jpg') }}" alt="Author" class="rounded-circle" width="100">
                        </div>
                        <div class="col">
                            <p class="text-justify">
                                {!! $post->author->about !!}
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <blockquote class="custom" cite="{{ $post->author->user->name }}">
                                <p class="mb-0 text-justify" style="font-size: 15px">
                                    {!! $post->author->citation !!}
                                </p>
                            </blockquote>
                        </div>
                    </div>
                </footer>
            </article>

            <!-- FB Social Plugin -->
            @if(config('facebook.posts.comments.activated'))
                <div class="fb-comments"
                     data-href="{{ url()->current() }}"
                     data-numposts="5"
                     data-width="100%">
                </div>
            @endif

        </div>
        <div class="col-sm-3">
            <div class="widget">
                <h5>Categorías</h5>
                <ul style="list-style: none; padding: 0;">
                    @foreach ($categories as $category)
                        <li>
                            <a href="{{ route('category', $category) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
