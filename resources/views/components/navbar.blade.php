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
                    <div class="w-[24px] h-[24px]">
                        <x-icon name="sidebar" />
                    </div>
                </label>
            </div>
        </nav>

        {{ $slot }}
    </div>

    <div class="drawer-side is-drawer-close:overflow-visible">
        <label for="nav-drawer" aria-label="Tutup sidebar" class="drawer-overlay"></label>

        <div class="flex min-h-full flex-col items-start bg-base-200 is-drawer-close:w-14 is-drawer-open:w-64">
            <div class="flex w-full justify-end p-2 pt-3">
                <label for="nav-drawer" aria-label="Tutup" class="is-drawer-close:hidden btn btn-square btn-ghost">
                    <div class="w-[24px] h-[24px]">
                        <x-icon name="x" />
                    </div>
                </label>
                <label for="nav-drawer" aria-label="Tutup" class="is-drawer-open:hidden btn btn-square btn-ghost max-lg:hidden">
                    <div class="w-[24px] h-[24px]">
                        <x-icon name="sidebar" />
                    </div>
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
                                    <div class="is-drawer-open:hidden w-[12px] h-[12px]">
                                        <x-icon name="fire" />
                                    </div>
                                    <span class="is-drawer-close:hidden badge badge-error gap-1 shrink-0">
                                        <div class="w-[12px] h-[12px]">
                                            <x-icon name="fire" />
                                        </div>
                                        HOT
                                    </span>
                                @endif
                            </div>

                            <div class="w-[20px] h-[20px]">
                                <x-icon name="{{ $page['icon'] }}" />
                            </div>
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
