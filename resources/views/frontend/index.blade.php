@push('after-styles')
  <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
@endpush

@extends('../layouts/main')
@section('content')
  <section id="content"
    class="max-w-[640px] w-full min-h-screen mx-auto flex flex-col bg-[#fff] overflow-x-hidden pb-[122px] ">
    {{-- <div class=" w-full max-w-[640px] px-[18px]">
      <nav
        class="bg-white p-[10px_16px] h-fit w-full flex items-center justify-between rounded-full shadow-[0_8px_30px_0_#0A093212] z-10 mt-[20px]">
        <a href="signup.html">
          <div class="w-[54px] h-[54px] flex shrink-0 overflow-hidden rounded-full items-center justify-center">
            @guest
              <img src="assets/images/icons/user.svg" class="w-full h-full object-cover" alt="icon">
            @endguest
            @auth
              <img src="{{ Storage::url(Auth::user()->avatar) }}" class="w-full h-full object-cover" alt="icon">
            @endauth
          </div>
        </a>
        <div class="flex flex-col gap-[2px] text-center">
          <p class="font-medium text-sm text-[#757C98] leading-[21px]">Current location</p>
          <div class="flex items-center justify-between gap-1">
            <div class="flex shrink-0">
              <img src="assets/images/icons/location.svg" alt="icon">
              <p class="font-semibold text-sm leading-[21px]">Wakanda, West Java</p>
            </div>
          </div>
        </div>
        <a href="">
          <div class="w-[54px] h-[54px] flex shrink-0 overflow-hidden rounded-full items-center justify-center">
            <img src="assets/images/icons/Notifcations.svg" alt="icon">
          </div>
        </a>
      </nav>
    </div> --}}

    <div class="flex justify-between w-full max-w-[640px] pt-[20px] px-[18px] mt-3 mb-3 items-center">
      <div class="flex flex-col">
        @auth
          <h2 class="text-[24px] font-semibold leading-[32px]">Hi, {{ Auth::user()->name }}</h2>
          <p class="text-[#757C98] font-normal text-sm leading-[21px]">Let's Discover</p>
          @elseguest
          <h2 class="text-[24px] font-semibold leading-[32px]">Welcome, Guest</h2>
          <p class="text-[#757C98] font-normal text-sm leading-[21px]">Please log in to explore more</p>
        @endauth
      </div>
      <a href="{{ route('frontend.settings') }}"
        class="w-[48px] h-[48px] flex shrink-0 overflow-hidden rounded-full items-center justify-center">
        @auth
          <img src="{{ Auth::user()->avatar }}" class="w-full h-full object-cover" alt="avatar">
          @elseguest
          <img src="assets/images/icons/user.svg" class="w-full h-full object-cover" alt="default avatar">
        @endauth
      </a>

    </div>


    {{-- <div class="flex justify-between w-full max-w-[640px] pt-[20px] px-[18px] mt-4 items-center">
      <div class="group flex items-center gap-2 p-[12px_16px] border border-[#DCDFE6] rounded-xl overflow-hidden">
        <div class="size-auto flex shrink-0 group-has-[:invalid]:text-[#757C98]">
          <i class="fa-regular fa-map fa-lg size-16"></i>
        </div>
        <input type="text" name="keyword" id=""
          class="appearance-none outline-none w-full bg-white placeholder:text-[#757C98] placeholder:font-medium text-sm font-semibold"
          placeholder="Mau ke mana?" required>
      </div>
    </div> --}}



    {{-- <div
      class="group flex gap-2 p-[12px_16px] border border-[#DCDFE6] rounded-lg overflow-hidden w-full max-w-[640px] px-[18px] items-center">
      <div class="size-auto flex shrink-0 group-has-[:invalid]:text-[#757C98]">
        <i class="fa-regular fa-map fa-lg size-16"></i>
      </div>
      <input type="text" name="keyword" id=""
        class="appearance-none outline-none w-full bg-white placeholder:text-[#757C98] placeholder:font-medium text-sm font-semibold"
        placeholder="Mau ke mana?" required>
    </div> --}}
    {{-- <div id="Feature" class="px-[18px] relative z-10">
      <div class="bg-white p-[18px_16px] rounded-xl overflow-hidden grid grid-cols-4 gap-[27px]">
        <a href="{{ route('frontend.hotels') }}">
          <div class="flex flex-col items-center gap-2">
            <div class="w-[60px] h-[60px] flex shrink-0">
              <img src="assets/images/icons/Hotel.png" class="object-cover" alt="icon">
            </div>
            <p class="font-medium text-sm text-[#757C98] leading-[21px]">Hotel</p>
          </div>
        </a>
        <a href="">
          <div class="flex flex-col items-center gap-2">
            <div class="w-[60px] h-[60px] flex shrink-0">
              <img src="assets/images/icons/Flight.png" class="object-cover" alt="icon">
            </div>
            <p class="font-medium text-sm text-[#757C98] leading-[21px]">Flight</p>
          </div>
        </a>
        <a href="">
          <div class="flex flex-col items-center gap-2">
            <div class="w-[60px] h-[60px] flex shrink-0">
              <img src="assets/images/icons/Train.png" class="object-cover" alt="icon">
            </div>
            <p class="font-medium text-sm text-[#757C98] leading-[21px]">Train</p>
          </div>
        </a>
        <a href="">
          <div class="flex flex-col items-center gap-2">
            <div class="w-[60px] h-[60px] flex shrink-0">
              <img src="assets/images/icons/Bus.png" class="object-cover" alt="icon">
            </div>
            <p class="font-medium text-sm text-[#757C98] leading-[21px]">Bus</p>
          </div>
        </a>
        <a href="">
          <div class="flex flex-col items-center gap-2">
            <div class="w-[60px] h-[60px] flex shrink-0">
              <img src="assets/images/icons/Ferry.png" class="object-cover" alt="icon">
            </div>
            <p class="font-medium text-sm text-[#757C98] leading-[21px]">Ferry</p>
          </div>
        </a>
        <a href="">
          <div class="flex flex-col items-center gap-2">
            <div class="w-[60px] h-[60px] flex shrink-0">
              <img src="assets/images/icons/Finance.png" class="object-cover" alt="icon">
            </div>
            <p class="font-medium text-sm text-[#757C98] leading-[21px]">Finance</p>
          </div>
        </a>
        <a href="">
          <div class="flex flex-col items-center gap-2">
            <div class="w-[60px] h-[60px] flex shrink-0">
              <img src="assets/images/icons/Travel.png" class="object-cover" alt="icon">
            </div>
            <p class="font-medium text-sm text-[#757C98] leading-[21px]">Travel</p>
          </div>
        </a>
        <a href="">
          <div class="flex flex-col items-center gap-2">
            <div class="w-[60px] h-[60px] flex shrink-0">
              <img src="assets/images/icons/View All.png" class="object-cover" alt="icon">
            </div>
            <p class="font-medium text-sm text-[#757C98] leading-[21px]">View All</p>
          </div>
        </a>
      </div>
    </div> --}}
    <div class="mt-4 w-full bg-white overflow-hidden py-2 flex flex-col gap-3">
      <div class="main-carousel">
        @foreach ($cities as $city)
          <form method="POST" action="{{ route('frontend.search.hotel') }}"
            class="flex justify-center text-center city-form">
            @csrf
            <!-- Hidden input for keyword -->
            <input type="hidden" name="keyword" value="{{ $city->name }}">
            <input type="hidden" name="total_people" value="1">
            <!-- Sesuaikan dengan nilai default jika diperlukan -->

            <!-- Clickable city element -->
            <div class="w-fit flex flex-col items-center gap-2" style="cursor: pointer;"
              onclick="this.closest('form').submit()">
              <div class="w-[72px] h-[72px] flex justify-center items-center overflow-hidden rounded-full">
                <img src="{{ $city->photo }}" class="w-full h-full" alt="photo">
              </div>
              <div class="flex flex-col items-center gap-1 w-[100px]">
                <p class="text-[#757C98] font-normal text-sm leading-[21px]">{{ $city->name }}</p>
              </div>
            </div>
          </form>
        @endforeach
      </div>
    </div>


    <div class="flex flex-col justify-between w-full max-w-[640px] pt-[20px] px-[18px] mt-6 mb-3 gap-2 ">
      <h1 class="font-semibold text-lg leading-[27px] text-left">Recommended Hotels</h1>
      @foreach ($hotels as $hotel)
        <a href="{{ route('frontend.hotels.details', $hotel) }}">
          <div class="card-result bg-white mb-4 overflow-hidden flex flex-col">
            <div class="thumbnail-container rounded-xl w-full aspect-[360/140] overflow-hidden flex shrink-0">
              <img src="{{ $hotel->thumbnail }}" class="object-cover w-full h-full" alt="thumbnail">
            </div>
            <div class="content-container flex flex-col gap-2">
              <div class="details-container flex flex-col gap-[6px] ">
                <div class="ratings-container flex items-center gap-[2px] mt-2">
                  <div class="star-container flex items-center">
                    <div class="flex shrink-0 w-[18px] h-[18px] p-[2px]">
                      <img src="{{ asset('assets/images/icons/Star.svg') }}" alt="star">
                    </div>
                  </div>
                  <p class="rating font-medium text-sm leading-[21px]">4.5</p>
                  <p class="reviewers font-thin text-sm leading-[21px] text-[#757C98]">(2209)</p>
                </div>
                <p class="hotel-name font-medium">{{ $hotel->name }}</p>
                <div class="badge flex items-center gap-3">
                  <div class="flex items-center gap-1">
                    <div class="flex shrink-0">
                      <img src="{{ asset('assets/images/icons/location-grey.svg') }}" alt="icon">
                    </div>
                    <p class="font-normal text-sm leading-[21px] text-[#757C98]">{{ $hotel->city->name }},
                      {{ $hotel->country->name }}</p>
                  </div>
                  <div class="flex items-center gap-1">
                    <div class="flex shrink-0">
                      <img src="{{ asset('assets/images/icons/star-outline-grey.svg') }}" alt="icon">
                    </div>
                    <p class="font-normal text-sm leading-[21px] text-[#757C98]">{{ $hotel->star_level }} Star</p>
                  </div>
                  <div class="flex items-center gap-1">
                    <div class="flex shrink-0">
                      <img src="{{ asset('assets/images/icons/wifi-grey.svg') }}" alt="icon">
                    </div>
                    <p class="font-normal text-sm leading-[21px] text-[#757C98]">Free Wifi</p>
                  </div>
                </div>
              </div>
              <div class="total-price flex gap-[2px] items-center">
                <p class="text-[#000] font-semibold text-lg leading-[27px]">
                  Rp {{ number_format($hotel->getLowestRoomPrice(), 0, ',', '.') }}
                </p>
                <p class="text-[#757C98] font-semibold text-xs leading-[18px]">/night</p>
              </div>
            </div>
          </div>
        </a>
      @endforeach
    </div>

    <div id="Promo" class=" w-full bg-white overflow-hidden py-6 flex flex-col gap-3">
      <div class="flex justify-between items-center px-[18px]">
        <h1 class="font-semibold text-lg leading-[27px]">Promo Special For You✨</h1>
        <a href="" class="font-semibold text-sm leading-[21px] text-[#4041DA]">See All</a>
      </div>
      <div class="main-carousel">
        <a href="" class="pl-[18px] last:pr-[18px]">
          <div class="w-fit flex flex-col gap-4">
            <div class="w-[310px] h-[160px] flex shrink-0 overflow-hidden rounded-xl">
              <img src="assets/images/thumbnails/thumbnail1.png" class="object-cover w-full h-full" alt="thumbnail">
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
              <img src="assets/images/thumbnails/thumbnail2.png" class="object-cover w-full h-full" alt="thumbnail">
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
              <img src="assets/images/thumbnails/thumbnail3.png" class="object-cover w-full h-full" alt="thumbnail">
            </div>
            <div class="flex flex-col gap-1">
              <p class="font-semibold">Amazing Singapore</p>
              <p class="text-[#757C98] font-semibold text-sm leading-[21px]">Available 22 Promos</p>
            </div>
          </div>
        </a>
      </div>
    </div>
    <div id="Menu-bar" class="fixed bottom-[24px] px-[18px] max-w-[640px] w-full z-30">
      <div
        class="bg-white p-[14px_12px] rounded-full flex items-center justify-center gap-8 shadow-[0_8px_30px_0_#0A093212]">
        <a href="{{ route('frontend.index') }}">
          <div class="flex flex-col gap-1 items-center">
            <div class="w-6 h-6 flex shrink-0">
              <img src="assets/images/icons/home-active.svg" alt="icon">
            </div>
            <p class="text-xs leading-[18px] font-semibold text-[#4041DA]">Home</p>
          </div>
        </a>
        <a href="{{ route('frontend.search') }}">
          <div class="flex flex-col gap-1 items-center">
            <div class="w-6 h-6 flex shrink-0">
              <img src="assets/images/icons/search-nonactive.svg" alt="icon">
            </div>
            <p class="text-xs leading-[18px] font-medium text-[#757C98]">Search</p>
          </div>
        </a>
        <a href="{{ route('frontend.my-bookings') }}">
          <div class="flex flex-col gap-1 items-center">
            <div class="w-6 h-6 flex shrink-0">
              <img src="assets/images/icons/activity-nonactive.svg" alt="icon">
            </div>
            <p class="text-xs leading-[18px] font-medium text-[#757C98]">Activity</p>
          </div>
        </a>
        <a href="{{ route('frontend.settings') }}">
          <div class="flex flex-col gap-1 items-center">
            <div class="w-6 h-6 flex shrink-0">
              <img src="assets/images/icons/settings-nonactive.svg" alt="icon">
            </div>
            <p class="text-xs leading-[18px] font-medium text-[#757C98]">Settings</p>
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

  <script src="{{ asset('js/carousel.js') }}"></script>
@endpush
