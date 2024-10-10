@extends('../layouts/main')

@section('content')
  <section id="content"
    class="max-w-[640px] w-full min-h-screen mx-auto flex flex-col bg-[#F8F8F8] overflow-x-hidden pb-[122px] relative">
    <div class="w-full h-[203px] absolute top-0 bg-[linear-gradient(244.6deg,_#7545FB_14.17%,_#2A3FCC_92.43%)]">
    </div>
    <div class="relative z-10 px-[18px] flex flex-col gap-6 mt-[60px] flex-1">
      <div class="top-menu flex items-center justify-between">
        <a href="{{ route('frontend.index') }}">
          <div class="w-[42px] h-[42px] flex shrink-0">
            <img src="{{ asset('assets/images/icons/back.svg') }}" alt="icon">
          </div>
        </a>
        <!-- Flex-grow digunakan untuk memberikan ruang pada teks agar bisa berada di tengah -->
        <p class="font-semibold text-lg leading-[28px] text-white text-center flex-grow">
          Lainnya
        </p>
        <!-- Elemen ini digunakan untuk memberikan placeholder agar teks tetap berada di tengah -->
        <div class="w-[42px] h-[42px] flex shrink-0"></div>
      </div>
      <div class="bg-white p-4 flex flex-col gap-4 rounded-xl">
        <div class="text-center mx-auto my-4">
          <p class="font-semibold text-lg leading-[28px] text-gray-800 text-center flex-grow">
            Profile
          </p>
          <div class="w-full h-full flex justify-center items-center mb-4 mt-4">
            <div class="w-[100px] h-[100px] flex shrink-0 overflow-hidden rounded-full items-center justify-center">
              @guest
                <img src="assets/images/icons/user.svg" class="w-full h-full object-cover" alt="icon"
                  style="aspect-ratio: 1/1;">
              @endguest

              @auth
                <img src="{{ Auth::user()->avatar }}" class="w-full h-full object-cover" alt="icon"
                  style="aspect-ratio: 1/1;">
              @endauth
            </div>
          </div>

          <h3 class="font-bold text-2xl text-gray-800 dark:text-white mb-1">{{ $user->name }}</h3>
          <h5 class="font-normal text-xl text-gray-800 dark:text-white mb-1">{{ $user->email }}</h5>
        </div>
        <div class="py-2">
          <div class="flex justify-center">
            <div class="flex flex-row justify-between items-center gap-3">
              {{-- <div>
                <i class="fa-solid fa-key fa-lg"></i>
                <button class=" align-middle ">
                  Change Password
                </button>
              </div> --}}
              <div>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <i class="fa-solid fa-sign-out fa-lg"></i>
                  <button type="submit" class="align-middle">
                    Logout
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-white p-4 flex flex-col gap-4 rounded-xl">
        <form action="{{ route('password.update') }}" method="POST" class="flex flex-col gap-4">
          @csrf
          @method('put')
          <p class="font-semibold mb-4">Update Password</p>
          <div class="flex flex-col ">
            <p class="font-normal text-sm text-gray-500">Current Password</p>
            <div class="group flex items-center gap-2 p-[12px_16px] border border-[#DCDFE6] rounded-lg overflow-hidden">
              <input type="password" name="current_password" id="update_password_current_password"
                class="appearance-none outline-none w-full bg-white placeholder:text-[#757C98] placeholder:font-medium text-sm font-semibold"
                required>
            </div>
          </div>
          <div class="flex flex-col ">
            <p class="font-normal text-sm text-gray-500">New Password</p>
            <div class="group flex items-center gap-2 p-[12px_16px] border border-[#DCDFE6] rounded-lg overflow-hidden">
              <input type="password" name="password" id="update_password_password"
                class="appearance-none outline-none w-full bg-white placeholder:text-[#757C98] placeholder:font-medium text-sm font-semibold"
                required>
            </div>
          </div>
          <div class="flex flex-col ">
            <p class="font-normal text-sm text-gray-500">Confirm Password</p>
            <div class="group flex items-center gap-2 p-[12px_16px] border border-[#DCDFE6] rounded-lg overflow-hidden">
              <input type="password" name="password_confirmation" id="update_password_password_confirmation"
                class="appearance-none outline-none w-full bg-white placeholder:text-[#757C98] placeholder:font-medium text-sm font-semibold"
                required>
            </div>
          </div>

          <button type="submit"
            class="!bg-[#4041DA] p-[12px_24px] h-12 flex items-center gap-3 rounded-lg justify-center">
            <p class="font-semibold text-sm leading-[21px] text-white">Save</p>
          </button>
        </form>
      </div>




  </section>
@endsection
