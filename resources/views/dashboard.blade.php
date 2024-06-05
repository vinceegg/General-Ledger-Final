<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css"  rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href ="/css/main.css" rel ="stylesheet">
    <link rel="icon" href="/images/PLM-LOGO.png" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>

    <title>PLM | General Ledger</title>
    @livewireStyles
    @vite('resources/css/app.css')
</head>
<body>
@csrf
<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
               <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
         </button>
        @foreach([''] as $route) {{ $route }}
        <a href="{{ url('/dashboard' . $route) }}" class="flex ms-2 md:me-24">
        @endforeach
        <img src="/images/PLM-LOGO.png" class="h-8 me-3" alt="FlowBite Logo" />
          <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-blue-800">PLM LEDGER</span>
        </a>
      </div>
      <!-- Settings Dropdown -->
          <div class="hidden sm:flex sm:items-center sm:ms-6">
              <x-dropdown align="right" width="48">
                  <x-slot name="trigger">
                      <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                          <div>{{ Auth::user()->email }}</div> <!-- Updated to show email -->
                          <div class="ms-1">
                              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                  <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                              </svg>
                          </div>
                      </button>
                  </x-slot>

                  <x-slot name="content">
                      <x-dropdown-link :href="route('profile.edit')">
                          {{ __('Profile') }}
                      </x-dropdown-link>
                      <!-- Authentication -->
                      <form method="POST" action="{{ route('logout') }}">
                          @csrf
                          <x-dropdown-link :href="route('logout')"
                                  onclick="event.preventDefault();
                                              this.closest('form').submit();">
                              {{ __('Log Out') }}
                          </x-dropdown-link>
                      </form>
                  </x-slot>
              </x-dropdown>
          </div>

          <!-- Hamburger -->
          <div class="-me-2 flex items-center sm:hidden">
              <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                  <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                      <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                      <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                  </svg>
              </button>
          </div>
      </div>
  </div>

  <!-- Responsive Navigation Menu -->
  <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
      <div class="pt-2 pb-3 space-y-1">
          {{-- <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
              {{ __('Dashboard') }}
          </x-responsive-nav-link> --}}
      </div>

      <!-- Responsive Settings Options -->
      <div class="pt-4 pb-1 border-t border-gray-200">
          <div class="px-4">
              <div class="font-medium text-base text-gray-800">{{ Auth::user()->email }}</div> <!-- Also updated here for mobile view -->
              <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
          </div>

          <div class="mt-3 space-y-1">
              <x-responsive-nav-link :href="route('profile.edit')">
                  {{ __('Profile') }}
              </x-responsive-nav-link>
              <!-- Authentication -->
              <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <x-responsive-nav-link :href="route('logout')"
                          onclick="event.preventDefault();
                                      this.closest('form').submit();">
                      {{ __('Log Out') }}
                  </x-responsive-nav-link>
              </form>
          </div>
      </div>
  </div>
</nav>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-blue-800 border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
   <div class="h-full px-3 pb-4 overflow-y-auto bg-blue-800 dark:bg-gray-800">
      <ul class="space-y-2 font-medium">
         <li>
            <a href="dashboard" class="flex items-center p-2 text-white rounded-lg dark:text-white bg-blue-700 dark:hover:bg-gray-700 group">
            <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8v10a1 1 0 0 0 1 1h4v-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v5h4a1 1 0 0 0 1-1V8M1 10l9-9 9 9"/>
            </svg>
            <span class="ms-3">Home</span>
            </a>
         </li>
         <li>
            <button type="button" class="flex items-center w-full p-2 text-base text-white transition duration-75 rounded-lg group hover:bg-blue-900 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M17 10H4a1 1 0 0 0-1 1v9m14-10a1 1 0 0 1 1 1m-1-1h-5.057M17 10a1 1 0 0 1 1 1m0 0v9m0 0a1 1 0 0 1-1 1m1-1a1 1 0 0 1-1 1m0 0H4m0 0a1 1 0 0 1-1-1m1 1a1 1 0 0 1-1-1m0 0V7m0 0a1 1 0 0 1 1-1h4.443a1 1 0 0 1 .8.4l2.7 3.6M3 7v3h8.943M18 18h2a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1h-5.057l-2.7-3.6a1 1 0 0 0-.8-.4H7a1 1 0 0 0-1 1v1"/>
                </svg>
                <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Journals</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
            </button>
            <ul id="dropdown-example" class="py-2 space-y-2">
                <li>
                    @foreach(['CKDJ'] as $route)
                        <a href="{{ url('/' . $route) }}" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-blue-900 dark:text-white dark:hover:bg-gray-700">Check Disbursements</a>
                    @endforeach
                </li>
                <li>
                    @foreach(['CDJ'] as $route)
                        <a href="{{ url('/' . $route) }}" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-blue-900 dark:text-white dark:hover:bg-gray-700">Cash Disbursements</a>
                    @endforeach
                </li>
                <li>
                    @foreach(['CRJ'] as $route)
                        <a href="{{ url('/' . $route) }}" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-blue-900 dark:text-white dark:hover:bg-gray-700">Cash Receipt</a>
                    @endforeach
                </li>
                <li>
                    @foreach(['GJ'] as $route)
                        <a href="{{ url('/' . $route) }}" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-blue-900 dark:text-white dark:hover:bg-gray-700">General Journal</a>
                    @endforeach
                </li>
            </ul>
        </li>        
         <li>
            <button type="button" class="flex items-center w-full p-2 text-base text-white transition duration-75 rounded-lg group hover:bg-blue-900 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example2" data-collapse-toggle="dropdown-example2">
                <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M17 10H4a1 1 0 0 0-1 1v9m14-10a1 1 0 0 1 1 1m-1-1h-5.057M17 10a1 1 0 0 1 1 1m0 0v9m0 0a1 1 0 0 1-1 1m1-1a1 1 0 0 1-1 1m0 0H4m0 0a1 1 0 0 1-1-1m1 1a1 1 0 0 1-1-1m0 0V7m0 0a1 1 0 0 1 1-1h4.443a1 1 0 0 1 .8.4l2.7 3.6M3 7v3h8.943M18 18h2a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1h-5.057l-2.7-3.6a1 1 0 0 0-.8-.4H7a1 1 0 0 0-1 1v1"/>
                </svg>
                <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">General Ledger</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
            </button>
            <ul id="dropdown-example2" class="py-2 space-y-2">
                <li>
                    @foreach(['LedgerSheets'] as $route)
                        <a href="{{ url('/' . $route) }}" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-blue-900 dark:text-white dark:hover:bg-gray-700">Ledger Sheets</a>
                    @endforeach
                </li>
            </ul>
        </li>  
        <ul class="fixed bottom-0 pb-10 left-2 w-56 pt-4 mt-4 space-y-2 font-small border-t border-gray-200 dark:border-gray-700">
         <li>
             @foreach([''] as $route) {{ $route }}
             <a href="{{ url('/faqs' . $route) }}" class="flex items-center p-2 text-white transition duration-75 rounded-lg hover:bg-blue-900 dark:hover:bg-gray-700 dark:text-white group">
                 <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7.529 7.988a2.502 2.502 0 0 1 5 .191A2.441 2.441 0 0 1 10 10.582V12m-.01 3.008H10M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                 </svg>
                 <span class="ms-3">Help / FAQ</span>
             </a>
             @endforeach
         </li>
         <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="flex items-center p-2 text-white transition duration-75 rounded-lg hover:bg-blue-900 dark:hover:bg-gray-700 dark:text-white group"
                    onclick="event.preventDefault();
                             this.closest('form').submit();">
                    <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 8h6m-9-3.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0ZM5 11h3a4 4 0 0 1 4 4v2H1v-2a4 4 0 0 1 4-4Z"/>
                    </svg>
                    <span class="ms-3">{{ __('Log Out') }}</span>
                </a>
            </form>
        </li>        
     </ul>     
   </div>
</aside>

{{-- ROW 1 --}}
<div class="p-5 sm:ml-64">
    <div class="p-4 rounded-lg dark:border-gray-700 mt-14">
    <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com --> 
 <!-- Grid wrapper -->
 
 <div class="grid sm:grid-cols-1 md:grid-cols-1 mb-3 gap-4 ">
   <div class="header-item  col-span-2 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">  
     <div class="flex gap-2">
       <text class="white-card-title-lg">Welcome</text>
     </div>
     
     <div class="flex gap-2 pb-3 pt-3">
       <svg class="w-6 h-6 text-blue-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
         <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z"/>
       </svg>
       
       <text id="current-date" class="white-card-title-sm"> --/--/----</text>
       <text id="current-time" class="white-card-title-sm"> --:--:--</text>
     </div>
     
     <div class="flex gap-2 pb-3">
 
     </div>
   </div>
 </div>
 
 {{-- TIME DATE JS LOGIC --}}
 <script>
   function updateTimeAndDate() {
     const currentTimeElement = document.getElementById('current-time');
     const currentDateElement = document.getElementById('current-date');
     const now = new Date();
     
     const hours = String(now.getHours()).padStart(2, '0');
     const minutes = String(now.getMinutes()).padStart(2, '0');
     const seconds = String(now.getSeconds()).padStart(2, '0');
     currentTimeElement.textContent = ` ${hours}:${minutes}:${seconds}`;
     
     const year = now.getFullYear();
     const monthNames = [
       "January", "February", "March", "April", "May", "June",
       "July", "August", "September", "October", "November", "December"
     ];
     const month = monthNames[now.getMonth()];
     const day = now.getDate();
     currentDateElement.textContent = ` ${month} ${day}, ${year}`;
   }
 
   setInterval(updateTimeAndDate, 1000);
   updateTimeAndDate();  // Initial call to set the time and date immediately when the page loads
 </script>
 
 <div class="grid sm:grid-cols-1 md:grid-cols-3 gap-4">
   <div class="col-span-2 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">  
    <div class="flex gap-2 pb-3">
       <div class="">
          <svg class="w-6 h-6 text-blue-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M17 10H4a1 1 0 0 0-1 1v9m14-10a1 1 0 0 1 1 1m-1-1h-5.057M17 10a1 1 0 0 1 1 1m0 0v9m0 0a1 1 0 0 1-1 1m1-1a1 1 0 0 1-1 1m0 0H4m0 0a1 1 0 0 1-1-1m1 1a1 1 0 0 1-1-1m0 0V7m0 0a1 1 0 0 1 1-1h4.443a1 1 0 0 1 .8.4l2.7 3.6M3 7v3h8.943M18 18h2a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1h-5.057l-2.7-3.6a1 1 0 0 0-.8-.4H7a1 1 0 0 0-1 1v1"/>
          </svg>
       </div>
       <div class="">
          <text class="white-card-title">  Journals </text> 
       </div>
    </div>
 <div class="grid sm:grid-cols-1 md:grid-cols-4 gap-4">
    <div>
       @foreach([''] as $route)
          <a href="{{ url('/CKDJ' . $route) }}" target="_blank" class="text-decoration-none">
       <div class="journal-item">
       <div class="journal-title">
             <div class="journal-title">CKDJ</div>
             <div class="journal-subtitle"><br>Check Disbursement</div>
       </div>
          </a>
       @endforeach
    </div> 
       </div>     
       <div>
       @foreach([''] as $route)
         <a href="{{ url('/CDJ' . $route) }}" target="_blank" class="text-decoration-none">
       <div class="journal-item">
             <div class="journal-title">
                 <div class="journal-title">CDJ</div>
                 <div class="journal-subtitle"><br>Cash Disbursement</div>
             </div>
         </a>
       @endforeach
       </div> 
       </div>
       <div>
       @foreach([''] as $route)
         <a href="{{ url('/CRJ' . $route) }}" target="_blank" class="text-decoration-none">
       <div class="journal-item">
 
             <div class="journal-title">
                 <div class="journal-title">CRJ</div>
                 <div class="journal-subtitle"><br>Cash Receipt</div>
             </div>
         </a>
       @endforeach
       </div> 
       </div>
       <div>
       @foreach([''] as $route)
         <a href="{{ url('/GJ' . $route) }}" target="_blank" class="text-decoration-none">
       <div class="journal-item">
 
             <div class="journal-title">
                 <div class="journal-title">GJ</div>
                 <div class="journal-subtitle"><br>General Journal</div>
             </div>
         </a>
       @endforeach
       </div> 
       </div>
       </div>
       </div>
   <div class="p-6 grid sm:col-span-1 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"> 
    <div class="flex gap-2 pb-3">
       <div class="">
          <svg class="w-6 h-6 text-blue-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M17 10H4a1 1 0 0 0-1 1v9m14-10a1 1 0 0 1 1 1m-1-1h-5.057M17 10a1 1 0 0 1 1 1m0 0v9m0 0a1 1 0 0 1-1 1m1-1a1 1 0 0 1-1 1m0 0H4m0 0a1 1 0 0 1-1-1m1 1a1 1 0 0 1-1-1m0 0V7m0 0a1 1 0 0 1 1-1h4.443a1 1 0 0 1 .8.4l2.7 3.6M3 7v3h8.943M18 18h2a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1h-5.057l-2.7-3.6a1 1 0 0 0-.8-.4H7a1 1 0 0 0-1 1v1"/>
          </svg>
       </div>
       <div class="">
          <text class="white-card-title">  General Ledger </text> 
       </div>
    </div>
       <div>
       @foreach([''] as $route)
         <a href="{{ url('/LedgerSheets' . $route) }}" target="_blank" class="text-decoration-none">
       <div class="journal-item">
 
             <div class="journal-title">
                 <div class="journal-title">LS</div>
                 <div class="journal-subtitle"><br>Ledger Sheets</div>
             </div>
         </a>
       @endforeach
       </div> 
       </div>
    </div>
</div>

{{-- ROW 3 --}}
<div class="grid sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3 gap-4 mt-5">
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
      <div class="flex gap-2 pb-3">
        <div>
          <svg class="w-6 h-6 text-blue-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M17 10H4a1 1 0 0 0-1 1v9m14-10a1 1 0 0 1 1 1m-1-1h-5.057M17 10a1 1 0 0 1 1 1m0 0v9m0 0a1 1 0 0 1-1 1m1-1a1 1 0 0 1-1 1m0 0H4m0 0a1 1 0 0 1-1-1m1 1a1 1 0 0 1-1 1m0 0V7m0 0a1 1 0 0 1 1-1h4.443a1 1 0 0 1 .8.4l2.7 3.6M3 7v3h8.943M18 18h2a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1h-5.057l-2.7-3.6a1 1 0 0 0-.8-.4H7a1 1 0 0 0-1 1v1"/>
          </svg>
        </div>
        <div>
          <span class="white-card-title">2024 Ledger Sheet Debit Credit Balance</span>
        </div>
      </div>
              <!-- BAR CHART -->
              <div class="h-70 sm:w-auto md:w-auto pt-3 pt-6 p-6 grid bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700 flex justify-center">
                <canvas id="barChart"></canvas>
              </div>
    </div>
    
    
  
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
      <div class="flex gap-2 pb-3">
        <div>
          <svg class="w-6 h-6 text-blue-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M17 10H4a1 1 0 0 0-1 1v9m14-10a1 1 0 0 1 1 1m-1-1h-5.057M17 10a1 1 0 0 1 1 1m0 0v9m0 0a1 1 0 0 1-1 1m1-1a1 1 0 0 1-1 1m0 0H4m0 0a1 1 0 0 1-1-1m1 1a1 1 0 0 1-1 1m0 0V7m0 0a1 1 0 0 1 1-1h4.443a1 1 0 0 1 .8.4l2.7 3.6M3 7v3h8.943M18 18h2a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1h-5.057l-2.7-3.6a1 1 0 0 0-.8-.4H7a1 1 0 0 0-1 1v1"/>
          </svg>
        </div>
        <div>
          <span class="white-card-title">Debit and Credit Balance per Journal</span>
        </div>
      </div>
          <!-- LINE CHART -->
          <div class="h-70 sm:w-auto md:w-auto flex justify-center pt-3 pt-6 p-6 grid bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
            <canvas id="lineChart" style="flex:1;"></canvas>
          </div>
    </div>
  
    <div class="pt-6 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
      <div class="flex gap-2 pb-3">
        <div>
          <svg class="w-6 h-6 text-blue-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
          </svg>
  
        </div>
        <div>
          <span class="white-card-title">Quicklinks</span>
        </div>
  
      </div>
  
      
      @foreach([''] as $route)
      <a href="{{ url('https://drive.google.com/file/d/1trRAOXWNugDs-fZRGhTMzq6U4An-hZGY/view?usp=sharing' . $route) }}" target="_blank" class="text-decoration-none"> 
        <div class="mb-2 mt-2 pt-2 p-2 bg-white border-2 border rounded-md dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100">
          <div class="flex gap-2 items-center">
            <div class="p-2 text-xs text-white bg-blue-800 border-2 border rounded-md dark:bg-gray-800 dark:border-gray-700">
              COA
            </div>
            <div class="flex-col">
              <span class="text-gray-800 font-bold pl-2">Commission on Audit - Chart of Accounts</span>
            </div>
          </div>
        </div>
      </a>
      @endforeach
      
  
      @foreach([''] as $route)
      <a href="{{ url('/CheckDisbursementJournalArchived' . $route) }}" class="text-decoration-none">    
      <div class="mb-2 mt-2 pt-2 p-2 bg-white border-2 border rounded-md dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100">
        <div class="flex gap-2 items-center">
          <div class="p-2 text-xs text-white bg-blue-800 border-2 border rounded-md dark:bg-gray-800 dark:border-gray-700">
            CKD
          </div>
          <div class="flex-col">
            <span class="text-gray-800 font-bold pl-2">Check Disbursements Journal Archive</span>
          </div>
        </div>
      </div>
    </a>
    @endforeach
  
  
    @foreach([''] as $route)
    <a href="{{ url('/CashDisbursementJournalArchived' . $route) }}"  class="text-decoration-none">  
      <div class="mb-2 mt-2 pt-2 p-2 bg-white border-2 border rounded-md dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100">
        <div class="flex gap-2 items-center">
          <div class="p-2 text-xs text-white bg-blue-800 border-2 border rounded-md dark:bg-gray-800 dark:border-gray-700">
            CDJ
          </div>
          <div class="flex-col">
            <span class="text-gray-800 font-bold pl-2">Cash Disbursement Journal Archive</span>
          </div>
        </div>
      </div>
    </a>
    @endforeach
  
  
    @foreach([''] as $route)
    <a href="{{ url('/CashReceiptJournalArchived' . $route) }}" class="text-decoration-none">  
      <div class="mb-2 mt-2 pt-2 p-2 bg-white border-2 border rounded-md dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100">
        <div class="flex gap-2 items-center">
          <div class="p-2 text-xs text-white bg-blue-800 border-2 border rounded-md dark:bg-gray-800 dark:border-gray-700">
            CRJ
          </div>
          <div class="flex-col">
            <span class="text-gray-800 font-bold pl-2">Cash Receipt Journal Archive</span>
          </div>
        </div>
      </div>
    </a>
    @endforeach
  
  
    @foreach([''] as $route)
    <a href="{{ url('/GeneralJournalArchived' . $route) }}"  class="text-decoration-none"> 
      <div class="mb-2 mt-2 pt-2 p-2 bg-white border-2 border rounded-md dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100">
        <div class="flex gap-2 items-center">
          <div class="p-2 text-xs text-white bg-blue-800 border-2 border rounded-md dark:bg-gray-800 dark:border-gray-700">
            GJA
          </div>
          <div class="flex-col">
            <span class="text-gray-800 font-bold pl-2">General Journal Archive</span>
          </div>
        </div>
      </div>
    </a>
    @endforeach
</div> 
 
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Bar Chart
  var total_ls_debit = JSON.parse('{!! json_encode($ls_total_debit)!!}');
  var total_ls_credit = JSON.parse('{!! json_encode($ls_total_credit)!!}');
  var total_ckdj_debit = JSON.parse('{!! json_encode($ckdj_total_debit)!!}');
  var total_cdj_debit = JSON.parse('{!! json_encode($cdj_total_debit)!!}');
  var total_crj_debit = JSON.parse('{!! json_encode($crj_total_debit)!!}');
  var total_gj_debit = JSON.parse('{!! json_encode($gj_total_debit)!!}');
  var total_ckdj_credit = JSON.parse('{!! json_encode($ckdj_total_credit)!!}');
  var total_cdj_credit = JSON.parse('{!! json_encode($cdj_total_credit)!!}');
  var total_crj_credit = JSON.parse('{!! json_encode($crj_total_credit)!!}');
  var total_gj_credit = JSON.parse('{!! json_encode($gj_total_credit)!!}');

  const barCtx = document.getElementById('barChart').getContext('2d');
  new Chart(barCtx, {
type: 'bar',
data: {
  labels: ['Debit', 'Credit'],
  datasets: [{
    label: 'Debit and Credit',
    data: [total_ls_debit, total_ls_credit],
    backgroundColor: ['#ff4949', '#ffcc3d'],
    borderWidth: 1
  }]
},
options: {
  scales: {
    y: {
      beginAtZero: true
    }
  }
}
});


  // Line Chart
  const lineCtx = document.getElementById('lineChart').getContext('2d');
  new Chart(lineCtx, {
    type: 'line',
    data: {
      labels: ['CKDJ', 'CDJ', 'CRJ','GJ'],
      datasets: [{
          label: 'Debit',
          data: [total_ckdj_debit,total_cdj_debit,total_crj_debit,total_gj_debit],
          borderColor: '#ff4949',
          backgroundColor: '#ff4949',
        },
        {
          label: 'Credit',
          data: [total_ckdj_credit,total_cdj_credit,total_crj_credit,total_gj_credit],
          borderColor: '#ffcc3d',
          backgroundColor: '#ffcc3d',
        }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        },
        title: {
          display: true,
          text: 'Monthly Data Trends'
        }
      }
    }
  });

  // Pie Chart
  const pieCtx = document.getElementById('pieChart').getContext('2d');
  new Chart(pieCtx, {
    type: 'pie',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: 'Dataset 1',
        data: [12, 19, 3, 5, 2, 3],
        backgroundColor: [
          '#ff4949',
          '#36a2eb',
          '#ffcc3d',
          '#4bc0c0',
          '#9966ff',
          '#ff9f40'
        ]
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        },
        title: {
          display: true,
          text: 'Distribution of Colors'
        }
      }
    }
  });
</script>
</div>


<div class="grid sm:grid-cols-1 md:grid-cols-3 gap-4 mt-5">
<div class="col-span-2 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"> 
  <div class="flex gap-2 pb-3">
        <div class="">
        <svg class="w-6 h-6 text-blue-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
        <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M10 6v4l3.276 3.276M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
        </svg>
        </div>
        <div class="">
          <text class="white-card-title"> Recent Activities </text> 
        </div>
    </div>
    <div class="grid sm:grid-cols-1 mb-10 md:grid-cols-2 gap-4 h-30">
        <livewire:recent-activities />
        <!-- Second column content -->
        <div>
          <!-- Your content for the second column goes here -->
          <livewire:recent-activities />
        </div>
    </div>
</div>

<div>
    <livewire:todo-component />
</div>

@livewireScripts
@stack('scripts')
</body>
<script src="../path/to/flowbite/dist/flowbite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/datepicker.min.js"></script>
<script src="../path/to/flowbite/dist/datepicker.js"></script>
<!-- space for the logout code -->
</html>