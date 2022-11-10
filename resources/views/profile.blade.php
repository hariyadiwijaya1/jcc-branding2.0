<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>K-WD Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('tailwinds') }}/public/build/css/tailwind.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpine-collective/alpine-magic-helpers@0.5.x/dist/component.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />

</head>

<body>
    <div x-data="setup()" x-init="$refs.loading.classList.add('hidden');
    setColors(color);" :class="{ 'dark': isDark }">
        <div class="flex h-screen antialiased text-gray-900 bg-gray-100 dark:bg-dark dark:text-light">
            <!-- Loading screen -->
            <div x-ref="loading"
                class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white bg-primary-darker">
                Loading.....
            </div>

            <!-- Sidebar -->
            <div class="flex-1 h-full overflow-x-hidden overflow-y-auto">
                <!-- Navbar -->
                <header class="relative bg-white dark:bg-darker">
                    <div class="flex items-center justify-between p-2 border-b dark:border-primary-darker">
                        <!-- Mobile menu button -->
                        <button @click="isMobileMainMenuOpen = !isMobileMainMenuOpen"
                            class="p-1 transition-colors duration-200 rounded-md text-primary-lighter bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark md:hidden focus:outline-none focus:ring">
                            <span class="sr-only">Open main manu</span>
                            <span aria-hidden="true">
                                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </span>
                        </button>

                        <!-- Brand -->
                        <a href="index.html"
                            class="inline-block text-2xl font-bold tracking-wider uppercase text-primary-dark dark:text-light">
                            K-WD
                        </a>

                        <!-- Mobile sub menu button -->
                        <button @click="isMobileSubMenuOpen = !isMobileSubMenuOpen"
                            class="p-1 transition-colors duration-200 rounded-md text-primary-lighter bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark md:hidden focus:outline-none focus:ring">
                            <span class="sr-only">Open sub manu</span>
                            <span aria-hidden="true">
                                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                </svg>
                            </span>
                        </button>

                        <!-- Desktop Right buttons -->
                        <nav aria-label="Secondary" class="hidden space-x-2 md:flex md:items-center">
                            <!-- Toggle dark theme button -->
                            <button aria-hidden="true" class="relative focus:outline-none" x-cloak @click="toggleTheme">
                                <div
                                    class="w-12 h-6 transition rounded-full outline-none bg-primary-100 dark:bg-primary-lighter">
                                </div>
                                <div class="absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-150 transform scale-110 rounded-full shadow-sm"
                                    :class="{
                                        'translate-x-0 -translate-y-px  bg-white text-primary-dark': !
                                            isDark,
                                        'translate-x-6 text-primary-100 bg-primary-darker': isDark
                                    }">
                                    <svg x-show="!isDark" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                                    </svg>
                                    <svg x-show="isDark" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                </div>
                            </button>

                            <!-- User avatar button -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open; $nextTick(() => { if(open){ $refs.userMenu.focus() } })"
                                    type="button" aria-haspopup="true" :aria-expanded="open ? 'true' : 'false'"
                                    class="transition-opacity duration-200 rounded-full dark:opacity-75 dark:hover:opacity-100 focus:outline-none focus:ring dark:focus:opacity-100">
                                    <span class="sr-only">User menu</span>
                                    <img class="w-10 h-10 rounded-full"
                                        src="{{ asset('tailwinds') }}/public/build/images/avatar.jpg"
                                        alt="Ahmed Kamel" />
                                </button>

                                <!-- User dropdown menu -->
                                <div x-show="open" x-ref="userMenu"
                                    x-transition:enter="transition-all transform ease-out"
                                    x-transition:enter-start="translate-y-1/2 opacity-0"
                                    x-transition:enter-end="translate-y-0 opacity-100"
                                    x-transition:leave="transition-all transform ease-in"
                                    x-transition:leave-start="translate-y-0 opacity-100"
                                    x-transition:leave-end="translate-y-1/2 opacity-0" @click.away="open = false"
                                    @keydown.escape="open = false"
                                    class="absolute right-0 w-48 py-1 bg-white rounded-md shadow-lg top-12 ring-1 ring-black ring-opacity-5 dark:bg-dark focus:outline-none"
                                    tabindex="-1" role="menu" aria-orientation="vertical" aria-label="User menu">
                                    <a  role="menuitem"
                                        class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-primary"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </nav>
                    </div>
                </header>

                <!-- Main content -->
                <main>
                    <!-- Content header -->
                    <div
                        class="flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker">
                        <h1 class="text-2xl font-semibold">Dashboard</h1>
                        <a href="{{ route('create-loan', []) }}"
                            class="px-4 py-2 text-sm text-white rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring focus:ring-primary focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark"
                            id="btnPinjaman">
                            Ajukan Pinjaman
                        </a>
                    </div>

                    <!-- Content -->
                    <div class="mt-2">
                        <!-- State cards -->
                        <div class="grid grid-cols-1 gap-8 p-4 xl:grid-cols-4">
                            <!-- Value card -->


                            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <caption
                                        class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                                        Data Pinjaman
                                        {{-- <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse a
                                            list of Flowbite products designed to help you work and play, stay
                                            organized, get answers, keep in touch, grow your business, and more.</p> --}}
                                    </caption>
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="py-3 px-6">
                                                Total Pinjaman
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                Total Angsuran
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                Tunggakan
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                Tanggal Pinjam
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                Tenor
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                Suku Bunga
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                Status
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pinjaman as $item)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row"
                                                class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ number_format($item->total_pinjaman )}}
                                            </th>
                                            <td class="py-4 px-6">
                                                {{ number_format($item->total_angsuran )}}
                                            </td>
                                            <td class="py-4 px-6">
                                                {{ number_format($item->arrears )}}
                                            </td>
                                            <td class="py-4 px-6">
                                                {{ $item->tanggal_pinjam ? date('d-m-Y', strtotime($item->tanggal_pinjam)) : '' }}
                                            </td>
                                            <td class="py-4 px-6">
                                                {{ $item->tenor }} bln
                                             </td>
                                             <td class="py-4 px-6">
                                                {{ $item->suku_bunga }} %
                                             </td>
                                            <td class="py-4 px-6">
                                                @php
                                                    if ($item->status == null) {
                                                        echo 'Menunggu';
                                                    } elseif ($item->status == 1) {
                                                        echo 'Diterima';
                                                    } else {
                                                        echo 'Ditolak';
                                                    }
                                                @endphp
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Table ANgsuran -->
                            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <caption
                                        class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                                        Data Angsuran
                                        {{-- <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse a
                                            list of Flowbite products designed to help you work and play, stay
                                            organized, get answers, keep in touch, grow your business, and more.</p> --}}
                                    </caption>
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="py-3 px-6">
                                                No
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                Ke-
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                Pokok
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                Bunga
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                Total
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                Jatuh Tempo
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                Status
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                Bukti
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                Aksi
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($angsuran as $item)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row"
                                                class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $loop->iteration }}
                                            </th>
                                            <th scope="row"
                                                class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $item->angsuran_keberapa }}
                                            </th>
                                            <td class="py-4 px-6">
                                                {{ number_format($item->pokok )}}
                                            </td>
                                            <td class="py-4 px-6">
                                                {{ number_format($item->bunga )}}
                                            </td>
                                            <td class="py-4 px-6">
                                                {{ number_format($item->total )}}
                                            </td>
                                            <td class="py-4 px-6">
                                                {{ $item->jatuh_tempo ? date('d-m-Y', strtotime($item->jatuh_tempo)) : '' }}
                                            </td>
                                            <td class="py-4 px-6">
                                                @php
                                                    if ($item->status == 1) {
                                                        $status = '<a class="btn btn-sm btn-primary">Sudah bayar</a>';
                                                    } elseif ($item->status == 0 && \Carbon\Carbon::now() > $item->jatuh_tempo) {
                                                        $status = '<a class="btn btn-sm btn-danger">Telat</a>';
                                                    } else {
                                                        $status = '<a class="btn btn-sm btn-warning">Belum Bayar</a>';
                                                    }
                                                    echo $status;
                                                @endphp
                                            </td>
                                            <td><img src="{{ $item->takeImage }}" width="100"></td>
                                            <form action="{{ route('angsuran.upload', $item->id) }}"
                                                method="post" enctype="multipart/form-data">
                                                @csrf
                                                <td>
                                                    <button type="submit"
                                                        class="btn btn-sm btn-primary">Upload</button>
                                                </td>
                                                <td>
                                                    <input type="file" name="bukti_transaksi">
                                                </td>
                                            </form>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>

                <!-- Main footer -->
                <footer
                    class="flex items-center justify-between p-4 bg-white border-t dark:bg-darker dark:border-primary-darker">
                    <div>K-WD &copy; 2021</div>
                    <div>
                        Made by
                        <a href="https://github.com/Kamona-WD" target="_blank"
                            class="text-blue-500 hover:underline">Ahmed Kamel</a>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <!-- All javascript code in this project for now is just for demo DON'T RELY ON IT  -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.bundle.min.js"></script>
    <script src="{{ asset('tailwinds') }}/public/build/js/script.js"></script>
    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>

    <script>
        const setup = () => {
            const getTheme = () => {
                if (window.localStorage.getItem('dark')) {
                    return JSON.parse(window.localStorage.getItem('dark'))
                }

                return !!window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches
            }

            const setTheme = (value) => {
                window.localStorage.setItem('dark', value)
            }

            const getColor = () => {
                if (window.localStorage.getItem('color')) {
                    return window.localStorage.getItem('color')
                }
                return 'cyan'
            }

            const setColors = (color) => {
                const root = document.documentElement
                root.style.setProperty('--color-primary', `var(--color-${color})`)
                root.style.setProperty('--color-primary-50', `var(--color-${color}-50)`)
                root.style.setProperty('--color-primary-100', `var(--color-${color}-100)`)
                root.style.setProperty('--color-primary-light', `var(--color-${color}-light)`)
                root.style.setProperty('--color-primary-lighter', `var(--color-${color}-lighter)`)
                root.style.setProperty('--color-primary-dark', `var(--color-${color}-dark)`)
                root.style.setProperty('--color-primary-darker', `var(--color-${color}-darker)`)
                this.selectedColor = color
                window.localStorage.setItem('color', color)
                //
            }

            const updateBarChart = (on) => {
                const data = {
                    data: randomData(),
                    backgroundColor: 'rgb(207, 250, 254)',
                }
                if (on) {
                    barChart.data.datasets.push(data)
                    barChart.update()
                } else {
                    barChart.data.datasets.splice(1)
                    barChart.update()
                }
            }

            const updateDoughnutChart = (on) => {
                const data = random()
                const color = 'rgb(207, 250, 254)'
                if (on) {
                    doughnutChart.data.labels.unshift('Seb')
                    doughnutChart.data.datasets[0].data.unshift(data)
                    doughnutChart.data.datasets[0].backgroundColor.unshift(color)
                    doughnutChart.update()
                } else {
                    doughnutChart.data.labels.splice(0, 1)
                    doughnutChart.data.datasets[0].data.splice(0, 1)
                    doughnutChart.data.datasets[0].backgroundColor.splice(0, 1)
                    doughnutChart.update()
                }
            }

            const updateLineChart = () => {
                lineChart.data.datasets[0].data.reverse()
                lineChart.update()
            }

            return {
                loading: true,
                isDark: getTheme(),
                toggleTheme() {
                    this.isDark = !this.isDark
                    setTheme(this.isDark)
                },
                setLightTheme() {
                    this.isDark = false
                    setTheme(this.isDark)
                },
                setDarkTheme() {
                    this.isDark = true
                    setTheme(this.isDark)
                },
                color: getColor(),
                selectedColor: 'cyan',
                setColors,
                toggleSidbarMenu() {
                    this.isSidebarOpen = !this.isSidebarOpen
                },
                isSettingsPanelOpen: false,
                openSettingsPanel() {
                    this.isSettingsPanelOpen = true
                    this.$nextTick(() => {
                        this.$refs.settingsPanel.focus()
                    })
                },
                isNotificationsPanelOpen: false,
                openNotificationsPanel() {
                    this.isNotificationsPanelOpen = true
                    this.$nextTick(() => {
                        this.$refs.notificationsPanel.focus()
                    })
                },
                isSearchPanelOpen: false,
                openSearchPanel() {
                    this.isSearchPanelOpen = true
                    this.$nextTick(() => {
                        this.$refs.searchInput.focus()
                    })
                },
                isMobileSubMenuOpen: false,
                openMobileSubMenu() {
                    this.isMobileSubMenuOpen = true
                    this.$nextTick(() => {
                        this.$refs.mobileSubMenu.focus()
                    })
                },
                isMobileMainMenuOpen: false,
                openMobileMainMenu() {
                    this.isMobileMainMenuOpen = true
                    this.$nextTick(() => {
                        this.$refs.mobileMainMenu.focus()
                    })
                },
                updateBarChart,
                updateDoughnutChart,
                updateLineChart,
            }
        }
    </script>
</body>

</html>
