<div
    x-data="{
        open: false,
        get currentPage() {
            const path = window.location.pathname;
            if (path === '/') return '/';
            const found = window.pages.find(p => p.url !== '/' && (path === p.url || path.startsWith(p.url + '/')));
            return found ? found.url : null;
        },
    }"
    x-init="
        $watch('open', (val) => {
            if (typeof Lenis !== 'undefined' && window.__lenis) {
                val ? window.__lenis.stop() : window.__lenis.start();
            }
        });
    "
    class="drawer drawer-end lg:drawer-open"
>
    <input id="nav-drawer" type="checkbox" class="drawer-toggle" x-model="open" />

    <div class="drawer-content">
        <nav class="navbar bg-base-100 border-b border-base-300 w-full sticky top-0 z-20">
            <div class="flex flex-1 items-center gap-3.5 pl-2">
                <img src="{{ asset('images/logo.webp') }}" alt="Mimpi Maya" class="h-10 w-auto" />
                <img src="{{ asset('images/title.webp') }}" alt="Mimpi Maya" class="h-7 w-auto" />
            </div>

            <div class="flex flex-row items-center gap-1">
                <span x-show="currentPage" class="lg:pr-3 text-primary" x-text="currentPage ? window.pages.find(p => p.url === currentPage)?.title : ''"></span>
                <label
                    for="nav-drawer"
                    aria-label="Toggle sidebar"
                    class="btn btn-square btn-ghost lg:hidden"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256" fill="currentColor">
                        <path d="M224 128a8 8 0 0 1-8 8H40a8 8 0 0 1 0-16h176a8 8 0 0 1 8 8ZM40 72h176a8 8 0 0 0 0-16H40a8 8 0 0 0 0 16Zm176 112H40a8 8 0 0 0 0 16h176a8 8 0 0 0 0-16Z"/>
                    </svg>
                </label>
            </div>
        </nav>

        {{ $slot }}
    </div>

    <div class="drawer-side is-drawer-close:overflow-visible">
        <label for="nav-drawer" aria-label="Tutup sidebar" class="drawer-overlay"></label>

        <div class="flex min-h-full flex-col items-start bg-base-200 is-drawer-close:w-14 is-drawer-open:w-64">
            <div class="flex w-full justify-end p-2 lg:hidden">
                <label for="nav-drawer" aria-label="Tutup" class="btn btn-square btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256" fill="currentColor">
                        <path d="M205.66 194.34a8 8 0 0 1-11.32 11.32L128 139.31l-66.34 66.35a8 8 0 0 1-11.32-11.32L116.69 128 50.34 61.66a8 8 0 0 1 11.32-11.32L128 116.69l66.34-66.35a8 8 0 0 1 11.32 11.32L139.31 128Z"/>
                    </svg>
                </label>
            </div>
            <div class="flex w-full justify-end p-2 pt-3 max-lg:hidden">
                <label for="nav-drawer" aria-label="Tutup" class="btn btn-square btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256" fill="currentColor">
                        <path d="M224 128a8 8 0 0 1-8 8H40a8 8 0 0 1 0-16h176a8 8 0 0 1 8 8ZM40 72h176a8 8 0 0 0 0-16H40a8 8 0 0 0 0 16Zm176 112H40a8 8 0 0 0 0 16h176a8 8 0 0 0 0-16Z"/>
                    </svg>
                </label>
            </div>

            <ul class="menu w-full grow place-content-center gap-2">
                @foreach([
                    ['title' => 'Halaman Utama', 'url' => '/', 'icon' => 'house'],
                    ['title' => 'Audisi', 'url' => '/audition', 'icon' => 'microphone', 'isHot' => true],
                ] as $page)
                    <li class="w-full {{ request()->url() === url($page['url']) ? 'font-bold' : '' }} pr-1">
                        <a
                            href="{{ url($page['url']) }}"
                            class="is-drawer-close:tooltip is-drawer-close:tooltip-left {{ request()->url() === url($page['url']) ? 'text-primary' : '' }} is-drawer-open:flex is-drawer-open:justify-between is-drawer-open:items-center"
                            data-tip="{{ $page['title'] }}"
                        >
                            <div class="flex gap-3">
                                <span class="is-drawer-close:hidden">{{ $page['title'] }}</span>
                                @if ($page['isHot'] ?? false)
                                    <span class="is-drawer-close:hidden badge badge-error gap-1 shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 256 256" fill="currentColor"><path d="M197.58 129.06l-51.61-19-19-51.61a15.92 15.92 0 0 0-29.88 0L78.07 110l-51.65 19a15.92 15.92 0 0 0 0 29.88L78 178l19 51.62a15.92 15.92 0 0 0 29.88 0l19-51.61 51.65-19a15.92 15.92 0 0 0 0-29.88ZM140.39 163a15.87 15.87 0 0 0-9.43 9.43l-19 51.46L93 172.39A15.87 15.87 0 0 0 83.61 163l-51.46-19 51.46-19a15.87 15.87 0 0 0 9.43-9.43l19-51.46 19 51.46a15.87 15.87 0 0 0 9.43 9.43l51.41 18.96Z"/></svg>
                                        HOT
                                    </span>
                                @endif
                            </div>

                            @if ($page['icon'] === 'house')
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 256 256" fill="currentColor"><path d="M219.31 108.68l-80-80a16 16 0 0 0-22.62 0l-80 80A15.87 15.87 0 0 0 32 120v96a8 8 0 0 0 8 8h64a8 8 0 0 0 8-8v-56h32v56a8 8 0 0 0 8 8h64a8 8 0 0 0 8-8v-96a15.87 15.87 0 0 0-4.69-11.32ZM208 208h-48v-56a8 8 0 0 0-8-8h-48a8 8 0 0 0-8 8v56H48v-88l80-80 80 80Z"/></svg>
                            @elseif ($page['icon'] === 'microphone')
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 256 256" fill="currentColor"><path d="M128 176a48.05 48.05 0 0 0 48-48V64a48 48 0 0 0-96 0v64a48.05 48.05 0 0 0 48 48ZM96 64a32 32 0 0 1 64 0v64a32 32 0 0 1-64 0Zm40 143.6V240a8 8 0 0 1-16 0v-32.4A80.11 80.11 0 0 1 48 128a8 8 0 0 1 16 0 64 64 0 0 0 128 0 8 8 0 0 1 16 0 80.11 80.11 0 0 1-72 79.6Z"/></svg>
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

{{-- Alpine.js data for page lookup --}}
<script>
    window.pages = [
        { title: 'Halaman Utama', url: '/' },
        { title: 'Audisi', url: '/audition' },
    ];
</script>
