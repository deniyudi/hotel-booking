@extends('../layouts/main')

@section('content')
  <section id="content"
    class="max-w-[640px] w-full min-h-screen mx-auto flex flex-col bg-[#F8F8F8] overflow-x-hidden pb-[122px] relative">
    <div class="w-full h-[233px] absolute top-0 overflow-hidden">
      <img src="{{ asset('assets/images/backgrounds/BG-1.png') }}" class="w-full h-full object-cover" alt="backgrounds">
    </div>
    <div class="relative z-10 px-[18px] flex flex-col gap-6 mt-[60px]">
      <div class="top-menu flex justify-between items-center">
        <a href="{{ route('frontend.index') }}" class="">
          <div class="w-[42px] h-[42px] flex shrink-0">
            <img src="{{ asset('assets/images/icons/back.svg') }}" alt="icon">
          </div>
        </a>
      </div>
      <form method="POST" action="{{ route('frontend.search.hotel') }}"
        class="bg-white p-4 flex flex-col gap-4 rounded-xl">
        @csrf
        <div class="input-container flex flex-col gap-2">
          <p class="font-semibold">Search Hotel</p>
          <div class="group flex items-center gap-2 p-[12px_16px] border border-[#DCDFE6] rounded-lg overflow-hidden">
            <div class="size-auto flex shrink-0 group-has-[:invalid]:text-[#757C98]">
              <i class="fa-regular fa-map fa-lg size-16"></i>
            </div>
            <input type="text" name="keyword" id=""
              class="appearance-none outline-none w-full bg-white placeholder:text-[#757C98] placeholder:font-medium text-sm font-semibold"
              placeholder="Mau ke mana?" required>
          </div>
        </div>
        <div class="grid grid-cols-2 gap-4 justify-between">
          <div class="input-container flex flex-col  gap-2">
            <p class="font-semibold">Check-In</p>
            <div
              class="relative group flex items-center gap-2 p-[12px_16px] border border-[#DCDFE6] rounded-lg overflow-hidden">
              <div class="size-auto flex shrink-0 group-has-[:invalid]:text-[#757C98]">
                <i class="fa-regular fa-calendar fa-lg size-16"></i>
              </div>
              <button type="button"
                class="checkInBtn w-full text-left text-sm text-[#757C98] !leading-[21px] font-medium relative z-10"
                onclick="handleDateButtonClick('checkIn')">
                dd/mm/yyyy
              </button>
              <input type="date" name="checkin_at" id="checkIn" class="opacity-0 absolute bottom-0" required>
            </div>
          </div>
          <div class="input-container flex flex-col gap-2">
            <p class="font-semibold">Check-Out</p>
            <div
              class="relative group flex items-center gap-2 p-[12px_16px] border border-[#DCDFE6] rounded-lg overflow-hidden">
              <div class="size-auto flex shrink-0 group-has-[:invalid]:text-[#757C98]">
                <i class="fa-regular fa-calendar fa-lg size-16"></i>
              </div>
              <button type="button"
                class="checkOutBtn w-full text-left text-sm text-[#757C98] !leading-[21px] font-medium relative z-10"
                onclick="handleDateButtonClick('checkOut')">
                dd/mm/yyyy
              </button>
              <input type="date" name="checkout_at" id="checkOut" class="opacity-0 absolute bottom-0" required>
            </div>
          </div>
        </div>

        <div class="input-container flex flex-col gap-2">
          <p class="font-semibold">Guest</p>
          <div class="group flex items-center gap-2 p-[12px_16px] border border-[#DCDFE6] rounded-lg overflow-hidden">
            <div class="size-auto flex shrink-0 group-has-[:invalid]:text-[#757C98]">
              <i class="fa-regular fa-user fa-lg size-16"></i>
            </div>

            <input type="number" id="total_people" name="total_people"
              class="appearance-none outline-none w-full bg-white placeholder:text-[#757C98] placeholder:font-medium text-sm font-semibold"
              value="1" min="1" max="20" aria-label="Select guest number" />
          </div>
        </div>
        <button type="submit" class="!bg-[#4041DA] p-[12px_24px] h-12 flex items-center gap-3 rounded-lg justify-center">
          <div class="flex shrink-0">
            <img src="{{ asset('assets/images/icons/search-normal.svg') }}" alt="icon">
          </div>
          <p class="font-semibold text-sm leading-[21px] text-white">Take a Look</p>
        </button>
      </form>
    </div>

    <div id="Promo" class="mt-6 w-full bg-[#F8F8F8] overflow-hidden py-6 flex flex-col gap-3">
      <div class="flex justify-between items-center px-[18px]">
        <h1 class="font-semibold text-lg leading-[27px]">Promo Special For You✨</h1>
        <a href="" class="font-semibold text-sm leading-[21px] text-[#4041DA]">See All</a>
      </div>
      <div class="main-carousel">
        <a href="" class="pl-[18px] last:pr-[18px]">
          <div class="w-fit flex flex-col gap-4">
            <div class="w-[310px] h-[160px] flex shrink-0 overflow-hidden rounded-xl">
              <img src="{{ asset('assets/images/thumbnails/thumbnail1.png') }}" class="object-cover w-full h-full"
                alt="thumbnail">
            </div>
            <div class="flex flex-col gap-1">
              <p class="font-semibold">Wonderful Indonesia</p>
              <p class="text-[#757C98] font-semibold text-sm leading-[21px]">Available 9 Promos</p>
            </div>
          </div>
        </a>
        <a href="" class="pl-[18px] last:pr-[18px]">
          <div class="w-fit flex flex-col gap-4">
            <div class="w-[310px] h-[160px] flex shrink-0 overflow-hidden rounded-xl">
              <img src="{{ asset('assets/images/thumbnails/thumbnail2.png') }}" class="object-cover w-full h-full"
                alt="thumbnail">
            </div>
            <div class="flex flex-col gap-1">
              <p class="font-semibold">Majestic Thailand</p>
              <p class="text-[#757C98] font-semibold text-sm leading-[21px]">Available 25 Promos</p>
            </div>
          </div>
        </a>
        <a href="" class="pl-[18px] last:pr-[18px]">
          <div class="w-fit flex flex-col gap-4">
            <div class="w-[310px] h-[160px] flex shrink-0 overflow-hidden rounded-xl">
              <img src="{{ asset('assets/images/thumbnails/thumbnail3.png') }}" class="object-cover w-full h-full"
                alt="thumbnail">
            </div>
            <div class="flex flex-col gap-1">
              <p class="font-semibold">Amazing Singapore</p>
              <p class="text-[#757C98] font-semibold text-sm leading-[21px]">Available 22 Promos</p>
            </div>
          </div>
        </a>
      </div>
    </div>
  </section>
@endsection

@push('after-scripts')
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
  <script src="{{ asset('js/search.js') }}"></script>
  <script src="{{ asset('js/carousel.js') }}"></script>
  {{-- <script>
    const guestInput = document.getElementById('guest-input');
    const increaseBtn = document.getElementById('increase-btn');
    const decreaseBtn = document.getElementById('decrease-btn');

    // Fungsi untuk menambah jumlah orang
    increaseBtn.addEventListener('click', () => {
      let currentValue = parseInt(guestInput.value);
      if (currentValue < 10) { // Batas maksimal jumlah orang
        guestInput.value = currentValue + 1;
      }
    });

    // Fungsi untuk mengurangi jumlah orang
    decreaseBtn.addEventListener('click', () => {
      let currentValue = parseInt(guestInput.value);
      if (currentValue > 1) { // Batas minimal jumlah orang
        guestInput.value = currentValue - 1;
      }
    });
  </script> --}}
@endpush
