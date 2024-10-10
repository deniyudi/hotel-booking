@extends('../layouts/main')

@section('content')
  <section id="content"
    class="max-w-[640px] w-full min-h-screen mx-auto flex flex-col bg-white overflow-x-hidden pb-[122px] relative">
    {{-- <div class="w-full h-[165px] absolute top-0 bg-[linear-gradient(244.6deg,_#7545FB_14.17%,_#2A3FCC_92.43%)]"> --}}
    </div>
    <div class="relative z-10 px-[18px] flex flex-col gap-6 mt-[60px]">
      <div class="top-menu flex justify-between items-center">
        <a href="{{ route('frontend.hotels.rooms', $hotel_room->hotel->slug) }}" class="bg-blue-500">
          <div class="w-[42px] h-[42px] flex shrink-0">
            <img src="{{ asset('assets/images/icons/back.svg') }}" alt="icon">
          </div>
        </a>
        <p class="font-semibold text-lg leading-[28px] text-center">Room Details</p>
        <div class="dummy-spacer w-[42px] h-[42px] flex shrink-0">
        </div>
      </div>

      <div class="room-details flex flex-col gap-[18px]">
        <div class="card-result bg-white overflow-hidden flex flex-col">
          <div class="thumbnail-container rounded-xl w-full aspect-[360/140] overflow-hidden flex shrink-0">
            <img src="{{ $hotel_room->photo }}" class="object-cover w-full h-full" alt="thumbnail">
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
              <p class="hotel-name font-medium">{{ $hotel_room->name }}</p>
              <div class="badge flex items-center gap-3">
                <div class="flex items-center gap-1">
                  <div class="flex shrink-0">
                    <img src="{{ asset('assets/images/icons/location-grey.svg') }}" alt="icon">
                  </div>
                  <p class="font-normal text-sm leading-[21px] text-[#757C98]">{{ $hotel_room->hotel->city->name }},
                    {{ $hotel_room->hotel->country->name }}</p>
                </div>
                <div class="flex items-center gap-1">
                  <div class="flex shrink-0">
                    <img src="{{ asset('assets/images/icons/star-outline-grey.svg') }}" alt="icon">
                  </div>
                  <p class="font-normal text-sm leading-[21px] text-[#757C98]">{{ $hotel_room->star_level }} Star</p>
                </div>
                <div class="flex items-center gap-1">
                  <div class="flex shrink-0">
                    <img src="{{ asset('assets/images/icons/wifi-grey.svg') }}" alt="icon">
                  </div>
                  <p class="font-normal text-sm leading-[21px] text-[#757C98]">Free Wifi</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="Facilities" class="bg-white flex flex-col gap-3">
        <div class="flex items-center justify-between">
          <h2 class="font-medium"> Facilities</h2>
        </div>
        <div class="card-container grid grid-cols-2 gap-[18px]">
          <a href="" class="card-facilities">
            <div class="border border-[#DCDFE6] bg-white p-4 rounded-lg flex flex-col gap-6">
              <div class="w-12 h-12 rounded-lg overflow-hidden flex shrink-0">
                <img src="{{ asset('assets/images/icons/gym.svg') }}" alt="icon">
              </div>
              <div class="flex flex-col gap-[2px]">
                <p class="font-semibold">Gym Center</p>
                <p class="font-medium text-xs leading-[18px] text-[#757C98]">Always stay fit.</p>
              </div>
            </div>
          </a>
          <a href="" class="card-facilities">
            <div class="border border-[#DCDFE6] bg-white p-4 rounded-lg flex flex-col gap-6">
              <div class="w-12 h-12 rounded-lg overflow-hidden flex shrink-0">
                <img src="{{ asset('assets/images/icons/free-wifi.svg') }}" alt="icon">
              </div>
              <div class="flex flex-col gap-[2px]">
                <p class="font-semibold">Free WiFi</p>
                <p class="font-medium text-xs leading-[18px] text-[#757C98]">WiFi with high speed.</p>
              </div>
            </div>
          </a>
          <a href="" class="card-facilities">
            <div class="border border-[#DCDFE6] bg-white p-4 rounded-lg flex flex-col gap-6">
              <div class="w-12 h-12 rounded-lg overflow-hidden flex shrink-0">
                <img src="{{ asset('assets/images/icons/room-service.svg') }}" alt="icon">
              </div>
              <div class="flex flex-col gap-[2px]">
                <p class="font-semibold">Room Services</p>
                <p class="font-medium text-xs leading-[18px] text-[#757C98]">Maximizing vacation.</p>
              </div>
            </div>
          </a>
          <a href="" class="card-facilities">
            <div class="border border-[#DCDFE6] bg-white p-4 rounded-lg flex flex-col gap-6">
              <div class="w-12 h-12 rounded-lg overflow-hidden flex shrink-0">
                <img src="{{ asset('assets/images/icons/swimming-pool.svg') }}" alt="icon">
              </div>
              <div class="flex flex-col gap-[2px]">
                <p class="font-semibold">Swimming Pool</p>
                <p class="font-medium text-xs leading-[18px] text-[#757C98]">Cool off by swimming</p>
              </div>
            </div>
          </a>
        </div>
      </div>
      <div id="Procedure" class="flex flex-col gap-3">
        <div class="flex justify-between items-center">
          <h2 class="font-medium">Procedure Check-In</h2>
        </div>
        <div class="grid grid-cols-2 gap-[13px]">
          <div class="flex flex-col p-3 gap-1 rounded border border-[#EEEEEE]">
            <p class="font-medium text-xs leading-[18px] text-[#757C98]">Check-In</p>
            <p class="font-semibold">14:00 AM</p>
          </div>
          <div class="flex flex-col p-3 gap-1 rounded border border-[#EEEEEE] text-right">
            <p class="font-medium text-xs leading-[18px] text-[#757C98]">Check-Out</p>
            <p class="font-semibold">12:00 AM</p>
          </div>
        </div>
      </div>
      <div id="Testimonials" class="w-full overflow-hidden flex flex-col gap-3">
        <div class="flex justify-between items-center">
          <h2 class="font-medium">Our Happy Customer</h2>
          <a href="" class="font-semibold text-sm leading-[21px] text-[#4041DA]">See All</a>
        </div>
        <div class="main-carousel">
          <a href="" class="testimonial-card pl-[18px] last:pr-[18px]">
            <div class="bg-white rounded-lg p-4 flex flex-col gap-4 w-[308px]">
              <div class="customer flex items-center justify-between gap-[18px]">
                <div class="customer-info flex items-center gap-2">
                  <div class="profile-pic w-9 h-9 rounded-full overflow-hidden flex shrink-0">
                    <img src="{{ asset('assets/images/photos/pic1.png') }}" class="object-cover w-full h-full"
                      alt="profile picture">
                  </div>
                  <div class="flex flex-col">
                    <p class="font-semibold text-xs leading-[18px]">Bimore Atreides</p>
                    <p class="font-medium text-xs leading-[18px] text-[#757C98]">Luxury Room</p>
                  </div>
                </div>
                <div class="ratings-container flex items-center gap-1">
                  <div class="star-container flex items-center">
                    <div class="flex shrink-0 w-[18px] h-[18px] p-[2px]">
                      <img src="{{ asset('assets/images/icons/Star.svg') }}" alt="star">
                    </div>
                    <div class="flex shrink-0 w-[18px] h-[18px] p-[2px]">
                      <img src="{{ asset('assets/images/icons/Star.svg') }}" alt="star">
                    </div>
                    <div class="flex shrink-0 w-[18px] h-[18px] p-[2px]">
                      <img src="{{ asset('assets/images/icons/Star.svg') }}" alt="star">
                    </div>
                    <div class="flex shrink-0 w-[18px] h-[18px] p-[2px]">
                      <img src="{{ asset('assets/images/icons/Star.svg') }}" alt="star">
                    </div>
                    <div class="flex shrink-0 w-[18px] h-[18px] p-[2px]">
                      <img src="{{ asset('assets/images/icons/Star-half.svg') }}" alt="star">
                    </div>
                  </div>
                </div>
              </div>
              <p class="review-text font-semibold text-xs leading-[18px]">
                “Had a great stay here! Clean and comfy rooms, very friendly staff.”
              </p>
              <hr class="border-[#DCDFE6]">
              <p class="font-medium text-xs leading-[18px] text-[#757C98]">1 days ago</p>
            </div>
          </a>
          <a href="" class="testimonial-card pl-[18px] last:pr-[18px]">
            <div class="bg-white rounded-lg p-4 flex flex-col gap-4 w-[308px]">
              <div class="customer flex items-center justify-between gap-[18px]">
                <div class="customer-info flex items-center gap-2">
                  <div class="profile-pic w-9 h-9 rounded-full overflow-hidden flex shrink-0">
                    <img src="{{ asset('assets/images/photos/pic2.png') }}" class="object-cover w-full h-full"
                      alt="profile picture">
                  </div>
                  <div class="flex flex-col">
                    <p class="font-semibold text-xs leading-[18px]">Rora Hikmah</p>
                    <p class="font-medium text-xs leading-[18px] text-[#757C98]">Regular Room</p>
                  </div>
                </div>
                <div class="ratings-container flex items-center gap-1">
                  <div class="star-container flex items-center">
                    <div class="flex shrink-0 w-[18px] h-[18px] p-[2px]">
                      <img src="{{ asset('assets/images/icons/Star.svg') }}" alt="star">
                    </div>
                    <div class="flex shrink-0 w-[18px] h-[18px] p-[2px]">
                      <img src="{{ asset('assets/images/icons/Star.svg') }}" alt="star">
                    </div>
                    <div class="flex shrink-0 w-[18px] h-[18px] p-[2px]">
                      <img src="{{ asset('assets/images/icons/Star.svg') }}" alt="star">
                    </div>
                    <div class="flex shrink-0 w-[18px] h-[18px] p-[2px]">
                      <img src="{{ asset('assets/images/icons/Star.svg') }}" alt="star">
                    </div>
                    <div class="flex shrink-0 w-[18px] h-[18px] p-[2px]">
                      <img src="{{ asset('assets/images/icons/Star-half.svg') }}" alt="star">
                    </div>
                  </div>
                </div>
              </div>
              <p class="review-text font-semibold text-xs leading-[18px]">
                “Enjoyed my stay here. Close proximity to tourist attractions.”
              </p>
              <hr class="border-[#DCDFE6]">
              <p class="font-medium text-xs leading-[18px] text-[#757C98]">1 days ago</p>
            </div>
          </a>
          <a href="" class="testimonial-card pl-[18px] last:pr-[18px]">
            <div class="bg-white rounded-lg p-4 flex flex-col gap-4 w-[308px]">
              <div class="customer flex items-center justify-between gap-[18px]">
                <div class="customer-info flex items-center gap-2">
                  <div class="profile-pic w-9 h-9 rounded-full overflow-hidden flex shrink-0">
                    <img src="{{ asset('assets/images/photos/pic2.png') }}" class="object-cover w-full h-full"
                      alt="profile picture">
                  </div>
                  <div class="flex flex-col">
                    <p class="font-semibold text-xs leading-[18px]">Rieruu Gaye</p>
                    <p class="font-medium text-xs leading-[18px] text-[#757C98]">Regular Room</p>
                  </div>
                </div>
                <div class="ratings-container flex items-center gap-1">
                  <div class="star-container flex items-center">
                    <div class="flex shrink-0 w-[18px] h-[18px] p-[2px]">
                      <img src="{{ asset('assets/images/icons/Star.svg') }}" alt="star">
                    </div>
                    <div class="flex shrink-0 w-[18px] h-[18px] p-[2px]">
                      <img src="{{ asset('assets/images/icons/Star.svg') }}" alt="star">
                    </div>
                    <div class="flex shrink-0 w-[18px] h-[18px] p-[2px]">
                      <img src="{{ asset('assets/images/icons/Star.svg') }}" alt="star">
                    </div>
                    <div class="flex shrink-0 w-[18px] h-[18px] p-[2px]">
                      <img src="{{ asset('assets/images/icons/Star.svg') }}" alt="star">
                    </div>
                    <div class="flex shrink-0 w-[18px] h-[18px] p-[2px]">
                      <img src="{{ asset('assets/images/icons/Star-half.svg') }}" alt="star">
                    </div>
                  </div>
                </div>
              </div>
              <p class="review-text font-semibold text-xs leading-[18px]">
                “Had a great stay here! Clean and comfy rooms, very friendly staff.”
              </p>
              <hr class="border-[#DCDFE6]">
              <p class="font-medium text-xs leading-[18px] text-[#757C98]">1 days ago</p>
            </div>
          </a>
        </div>
      </div>
    </div>
    <div id="Price-bar" class="fixed bottom-[24px] px-[18px] max-w-[640px] w-full z-30">
      <div class="flex flex-col rounded-xl bg-white p-4 shadow-[0_8px_30px_0_#0A093212]">
        <div class="grid grid-cols-2 gap-4 justify-between">
          <div class="input-container flex flex-col  gap-2">
            <p class="font-medium">Check-In</p>
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
            <p class="font-medium">Check-Out</p>
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
        <div class="bg-white mt-4 flex items-center justify-between ">
          <div class=" items-center">
            <p class="text-[#fff] font-medium leading-[18px]">Total</p>
            <p class="total-price text-[#000] font-semibold text-lg leading-[27px]">
              Rp {{ number_format($hotel_room->price, 0, ',', '.') }}
            </p>
          </div>
          <form method="POST"
            action="{{ route('frontend.hotel.room.book', ['hotel' => $hotel, 'hotel_room' => $hotel_room->slug]) }}">
            @csrf
            <input type="hidden" name="checkin_at" id="hiddenCheckIn">
            <input type="hidden" name="checkout_at" id="hiddenCheckOut">
            <button type="submit"
              class="w-[138px] h-[48px] bg-[#4041DA] p-[12px_24px] rounded-full text-nowrap text-white font-semibold text-sm leading-[21px] flex items-center justify-center">
              Booking
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('after-styles')
  <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
@endpush

@push('after-scripts')
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
  <script src="{{ asset('js/hotel-details.js') }}"></script>
  <script src="{{ asset('js/carousel.js') }}"></script>
  <script src="{{ asset('js/map.js') }}"></script>
  <script>
    function setDefaultDates() {
      const checkInInput = document.getElementById('checkIn');
      const checkOutInput = document.getElementById('checkOut');

      const today = new Date();
      const tomorrow = new Date(today);
      tomorrow.setDate(today.getDate() + 1);

      const formatDate = (date) => date.toISOString().split('T')[0];

      checkInInput.value = formatDate(today);
      checkOutInput.value = formatDate(tomorrow);

      updateButtonText(checkInInput);
      updateButtonText(checkOutInput);
    }

    function updateButtonText(dateInput) {
      const selectedDate = new Date(dateInput.value);
      const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September",
        "October", "November", "December"
      ];
      const formattedDate =
        `${selectedDate.getDate()} ${monthNames[selectedDate.getMonth()]} ${selectedDate.getFullYear()}`;

      dateInput.previousElementSibling.innerText = formattedDate;
      dateInput.previousElementSibling.classList.remove('text-[#757C98]', 'font-medium');
      dateInput.previousElementSibling.classList.add('font-semibold');
    }

    function updateHiddenFields() {
      const checkInValue = document.getElementById('checkIn').value;
      const checkOutValue = document.getElementById('checkOut').value;

      document.getElementById('hiddenCheckIn').value = checkInValue;
      document.getElementById('hiddenCheckOut').value = checkOutValue;
    }

    function handleDateButtonClick(inputId) {
      const dateInput = document.getElementById(inputId);
      dateInput.showPicker();

      dateInput.addEventListener("change", () => {
        updateButtonText(dateInput);
        validateDates();
        updateHiddenFields();
        updateTotalPrice();
      });
    }

    function validateDates() {
      const checkInInput = document.getElementById('checkIn');
      const checkOutInput = document.getElementById('checkOut');

      const checkInDate = new Date(checkInInput.value);
      const checkOutDate = new Date(checkOutInput.value);

      if (checkInDate >= checkOutDate) {
        const newCheckOutDate = new Date(checkInDate);
        newCheckOutDate.setDate(checkInDate.getDate() + 1);
        checkOutInput.value = newCheckOutDate.toISOString().split('T')[0];
        updateButtonText(checkOutInput);
      }
    }

    function updateTotalPrice() {
      const priceRoom = {{ $hotel_room->price }};
      const checkInInput = document.getElementById('checkIn');
      const checkOutInput = document.getElementById('checkOut');

      const checkInDate = checkInInput.value ? new Date(checkInInput.value) : null;
      const checkOutDate = checkOutInput.value ? new Date(checkOutInput.value) : null;

      let totalPrice;

      if (checkInDate && checkOutDate && checkOutDate > checkInDate) {
        const timeDifference = checkOutDate - checkInDate;
        const numberOfNights = Math.ceil(timeDifference / (1000 * 60 * 60 * 24));
        totalPrice = numberOfNights * priceRoom;
      } else {
        totalPrice = priceRoom;
      }

      document.querySelector('.total-price').innerText = `Rp ${totalPrice.toLocaleString('id-ID')}`;
    }

    window.onload = () => {
      setDefaultDates();
      updateHiddenFields();
      updateTotalPrice();
    };
  </script>
@endpush
