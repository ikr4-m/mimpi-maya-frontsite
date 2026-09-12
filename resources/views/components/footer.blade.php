<footer class="footer footer-horizontal lg:footer-vertical footer-center p-10 bg-base-200 text-base-content mt-auto border-t border-base-300">
    <aside>
        <img src="{{ asset('images/logo.webp') }}" alt="Mimpi Maya" class="h-12 w-auto" />
        <img src="{{ asset('images/title.webp') }}" alt="Mimpi Maya" class="h-7 w-auto mt-2" />
    </aside>
    <nav class="flex flex-row flex-wrap justify-center items-center gap-x-4 gap-y-2">
        @foreach(config('navigation.main') as $page)
            <a href="{{ url($page['url']) }}" class="link link-hover">{{ $page['title'] }}</a>
        @endforeach
    </nav>
    <nav>
        <div class="flex flex-row flex-wrap justify-center items-center gap-x-4 gap-y-2">
            <a href="#" class="link link-hover">Twitter / X</a>
            <a href="#" class="link link-hover">YouTube</a>
            <a href="#" class="link link-hover">Instagram</a>
        </div>
    </nav>
</footer>
