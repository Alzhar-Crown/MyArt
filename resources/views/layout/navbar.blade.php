<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alumni+Sans:ital,wght@0,100..900;1,100..900&family=Onest:wght@100..900&family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Righteous&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Alumni+Sans:ital,wght@0,100..900;1,100..900&family=Onest:wght@100..900&family=Righteous&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Alumni+Sans:ital,wght@0,100..900;1,100..900&family=Onest:wght@100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"  rel="stylesheet" />
    
</head>

<body>
    <div class="base bg-white  overflow-y-auto  overflow-x-hidden h-screen" style="">
        <nav class="bg-white sticky top-0 z-40">
            <div class="flex items-center">
                <!-- Logo -->
                <a href="/home">
                    <img class="w-40" src="{{ asset('images/logo.png') }}" alt="MyArtLogo">
                </a>

                <!-- Nav Links (Hidden on mobile) -->
                <div class="hidden md:flex space-x-36  flex-grow ">
                    <a href="{{ route('porto.index') }}" class="text-[rgba(115,159,99,1)] hover:underline translate-y-2">Portofolio</a>
                    <a href="#" class="text-[rgba(115,159,99,1)] hover:underline translate-y-2">Shop</a>
                    <a href="#" class="text-[rgba(115,159,99,1)] hover:underline translate-y-2">Discussion</a>

                    <div class="si ">
                        <form class="flex-grow max-w-xs" action="search" method="post">
                            @csrf
                            <input type="text"
                                class="bg-white focus:outline focus:outline-[rgba(115,159,99,1)] focus:w-[200px] transition-all duration-300 ease-in-out outline outline-1 outline-black p-1 rounded-sm placeholder:text-[10px] text-[12px] placeholder:text-left text-center text-black placeholder-black"
                                placeholder="What Are you looking for?" name="search_input" required>
                            <button type="submit"><span
                                    class="material-symbols-outlined text-black text-[12px] ml-3  focus:outline  outline outline-1 outline-black  translate-y-2 -translate-x-2 rounded-sm bg-white py-0 ">search</span></button>
                        </form>
                    </div>

                    <div class="manage flex items-center space-x-2 relative">
                        <a href='#' class=" translate-y-1.5 -translate-x-12 absolute left-0"><span
                                class="material-symbols-outlined text-[30px] text-black">manage_accounts</span></a>
                        <span
                            class="text-black text-[12px] translate-y-1.5 -translate-x-6 absolute left-0 ">Setting</span>
                    </div>
                    <div class="manage flex items-center space-x-2 relative">
                        <button class="translate-y-1 -translate-x-10 absolute left-0"> <span
                                class="material-symbols-outlined text-black ">shopping_cart</span></button>
                        <span class="text-black text-[12px] translate-y-1.5 -translate-x-4 absolute left-0 ">Cart</span>
                    </div>



                </div>
            </div>
        </nav>

        
        @yield('main')

        <footer class="w-full bg-white-300 h-[180px] mt-5 flex flex-row border-t">
            <div class="flex flex-col w-[25%] bg-white  h-full">
                <div class="flex flex-col ml-7">
                    <img src="{{ asset('images/logo.png') }}" class="h-[40px] w-[200px] mt-5 object-cover"></img>
                    <span class="text-[#537348] ml-6">@2025 MyProduction</span>
                </div>
            </div>
            <div class="flex flex-col w-[25%] bg-green-500 h-full"></div>
            <div class="flex flex-col w-[25%] bg-red-500 h-full"></div>
            <div class="flex flex-col w-[25%] bg-slate-300 h-full" ></div>
        </footer>
        <form method="POST" action="{{ route('user.logout') }}">
            @csrf
            <button type="submit" class="text-black">Logout</button>
        </form>  

    </div>
     {{-- @if (session('dataProfil'))
        <h1>Halo, {{ session('dataProfil')['nama_depan'] }} {{ session('dataProfil')['nama_belakang'] }}</h1>
    @else
        <h1>Profil tidak ditemukan</h1>
    @endif --}}

    

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.swiper', {
            loop: true,
            autoplay: {
                delay: 3000, // 3 detik = 3000 ms
                disableOnInteraction: false,
            },
        });
    </script>
    <script>
        const container = document.getElementById("autoScrollContainer");
      
        let scrollAmount = 1;
        let direction = 1; // 1 = ke kanan, -1 = ke kiri
      
        function autoScroll() {
          container.scrollLeft += scrollAmount * direction;
      
          // Ubah arah kalau sudah mentok kanan/kiri
          if (
            container.scrollLeft + container.clientWidth >= container.scrollWidth ||
            container.scrollLeft <= 0
          ) {
            direction *= -1;
          }
      
          requestAnimationFrame(autoScroll);
        }
      
        requestAnimationFrame(autoScroll);
      </script>
      
</body>

</html>
