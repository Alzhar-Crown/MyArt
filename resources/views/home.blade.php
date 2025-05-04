<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Alumni+Sans:ital,wght@0,100..900;1,100..900&family=Onest:wght@100..900&display=swap"
        rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=manage_accounts,search,shopping_cart" />
    </head>

<body>
    <div class="base bg-white" style="height:100vh">
        <nav class="bg-white">
            <div class="flex items-center">
                <!-- Logo -->
                <a href="#">
                    <img class="w-40" src="{{ asset('images/logo.png') }}" alt="MyArtLogo">
                </a>

                <!-- Nav Links (Hidden on mobile) -->
                <div class="hidden md:flex space-x-36 ">
                    <a href="#" class="text-[rgba(115,159,99,1)] hover:underline translate-y-2">Portofolio</a>
                    <a href="#" class="text-[rgba(115,159,99,1)] hover:underline translate-y-2">Shop</a>
                    <a href="#" class="text-[rgba(115,159,99,1)] hover:underline translate-y-2">Discussion</a>

                    <div class="si">
                      <form>
                        <input
                            type="text"
                            class="bg-gray-200 focus:outline-none p-1 rounded-sm placeholder:text-[10px] text-[12px] placeholder:text-left text-center text-black placeholder-black"
                            placeholder="What Are you looking for?" name="search" required>
                            <button><span class="material-symbols-outlined text-black text-[12px] translate-y-2 -translate-x-0.5 rounded-sm bg-gray-200 py-0 ">search</span></button>
                      </form>
                  </div>

                  <div class="manage flex items-center space-x-2 relative">
                    <a href='#' class=" translate-y-1 -translate-x-12 absolute left-0"><span class="material-symbols-outlined text-[30px] text-black">manage_accounts</span></a>
                     <span class="text-black text-[12px] translate-y-1.5 -translate-x-6 absolute left-0 ">Setting</span>
                  </div>
                  <div class="manage flex items-center space-x-2 relative">
                   <button class="translate-y-1 -translate-x-10 absolute left-0"> <span class="material-symbols-outlined text-black ">shopping_cart</span></button>
                    <span class="text-black text-[12px] translate-y-1.5 -translate-x-4 absolute left-0 ">Cart</span>
                  </div>
                  


                </div>
            </div>
        </nav>

        <div class="swiper w-full" style="height: 75vh">
            <div class="swiper-wrapper">

                <div class="swiper-slide">
                    <img src="{{ asset('images/dummy-1 1.png') }}" class="w-full h-full object-cover" />
                    <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-40 text-white p-2 text-[20px]">
                        Mobile App Design
                    </div>
                    <div
                        class="absolute bottom-0 ml-48 mb-[13px] tracking-wide bg-black bg-opacity-100 text-white text-[12px]">
                        Portofolio
                    </div>
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('images/dummy-3 1.png') }}" class="w-full h-full object-cover" />
                    <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-40 text-white p-2 text-[20px]">
                        E-Commers Design
                        <div
                            class="absolute bottom-0 ml-48 mb-[13px] tracking-wide bg-black bg-opacity-100 text-white text-[12px]">
                            Portofolio
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('images/dummy-4 1.png') }}" class="w-full h-full object-cover" />
                    <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-40 text-white p-2 text-[20px]">
                        3D Ilustration
                        <div
                            class="absolute bottom-0 ml-36 mb-[13px] tracking-wide bg-black bg-opacity-100 text-white text-[12px]">
                            Portofolio
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('user.logout') }}">
        @csrf
        <button type="submit" class="text-black">Logout</button>
    </form>

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
</body>

</html>
