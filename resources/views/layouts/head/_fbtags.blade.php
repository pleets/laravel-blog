<!-- Fb tags -->
<meta content='article' property='og:type'/>
<meta content='{{ config('app.fb_app_id') }}' property='fb:app_id'/>
<meta content='@yield('meta_title', $title)' property='og:title'/>
<meta content='@yield('fb_image')' property="og:image" />
<meta content='{{ url()->current() }}' property="og:url" />
<meta content='@yield('meta_description', $description)' property='og:description'/>
