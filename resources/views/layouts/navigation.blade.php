<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    @auth
                        @if(Auth::user()->role == 'Student') 
                            @if(Auth::user()->student_type == 'College')
                                <a href="{{ route('Student.CollegeDashboard') }}">
                                     <img src="{{ asset('css/GeneralResources/collegelogo.jpg') }}" 
                                         class="block h-10 w-10 border border-gray-500 rounded-full" 
                                          alt="College Logo" />
                                </a>
                            @elseif(Auth::user()->student_type == 'HighSchool')
                                <a href="{{ route('Student.HighSchoolDashboard') }}">
                                     <img src="{{ asset('css/GeneralResources/hslogo.jpg') }}" 
                                       class="block h-10 w-10 border border-gray-500 rounded-full" 
                                        alt="College Logo" />
                                </a>
                            @endif
                        @elseif(Auth::user()->role == 'HumanResources')
                             <a href="{{ route('HrDashboard') }}">
                                 <img src="{{ asset('css/GeneralResources/collegelogo.jpg') }}" 
                                  class="block h-10 w-10 border border-gray-500 rounded-full" 
                                    alt="College Logo" />
                            </a>
                        @elseif(Auth::user()->role == 'Guidance')
                            <a href="{{ route('Consultation.CtDashboard') }}">
                                 <img src="{{ asset('css/GeneralResources/collegelogo.jpg') }}" 
                                 class="block h-10 w-10 border border-gray-500 rounded-full" 
                                 alt="College Logo" />
                            </a>
                        @elseif(Auth::user()->role == 'ComputerDepartment')
                            <a href="{{ route('DepartmentHead.DpDashboard') }}">
                                 <img src="{{ asset('css/GeneralResources/collegelogo.jpg') }}" 
                                  class="block h-10 w-10 border border-gray-500 rounded-full" 
                                 alt="College Logo" />
                            </a>
                        @endif
                    @else
                        <a href="{{ route('welcome') }}">
                             <img src="{{ asset('css/GeneralResources/collegelogo.jpg') }}" 
                         class="block h-10 w-10 border border-gray-500 rounded-full" 
                         alt="College Logo" />
                        </a>
                    @endauth
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @if(Auth::check())
                        @if(Auth::user()->role == 'HumanResources')
                            <x-nav-link :href="route('HrDashboard')" :active="request()->routeIs('HrDashboard')">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                            <x-nav-link :href="route('Evaluation.HrFacultylist')" :active="request()->routeIs('Evaluation.HrFacultylist')">
                                {{ __('Facultylist') }}
                            </x-nav-link>
                            <x-nav-link :href="route('Evaluation.HrCalendar')" :active="request()->routeIs('Evaluation.HrCalendar')">
                                {{ __('Calendar') }}
                            </x-nav-link>
                        @elseif(Auth::user()->role == 'Student')
                            @if(Auth::user()->student_type == 'College')
                                <x-nav-link :href="route('Student.CollegeDashboard')" :active="request()->routeIs('Student.CollegeDashboard')">
                                    {{ __('Dashboard') }}
                                </x-nav-link>
                            @elseif(Auth::user()->student_type == 'HighSchool')
                                <x-nav-link :href="route('Student.HighSchoolDashboard')" :active="request()->routeIs('Student.HighSchoolDashboard')">
                                    {{ __('Dashboard') }}
                                </x-nav-link>
                            @endif
                               @if(Auth::user()->student_type == 'College' || Auth::user()->student_type == 'HighSchool')
                               <x-nav-link :href="route('Student.evaluation.StudentPicker')" :active="request()->routeIs('Student.evaluation.StudentPicker')">
                                    {{ __('Evaluation') }}
                                </x-nav-link>
                                <x-nav-link :href="route('Student.Consform.Appointment')" :active="request()->routeIs('Student.Consform.Appointment')">
                                {{ __('Appointment') }}
                            </x-nav-link>
                            <x-nav-link :href="route('Student.StudentHistory')" :active="request()->routeIs('Student.StudentHistory')">
                                {{ __('History') }}
                            </x-nav-link>
                            <x-nav-link :href="route('Student.StudentCalendar')" :active="request()->routeIs('Student.StudentCalendar')">
                                {{ __('Calendar') }}
                            </x-nav-link> 
                            <x-nav-link :href="route('Student.StudentNotification')" :active="request()->routeIs('Student.StudentNotification')">
                                {{ __('Notification') }}
                            </x-nav-link> 
                        
                                @endif
                          
                        @elseif(Auth::user()->role == 'Guidance')
                            <x-nav-link :href="route('Consultation.CtDashboard')" :active="request()->routeIs('Consultation.CtDashboard')">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                            <x-nav-link :href="route('Consultation.CtApproval')" :active="request()->routeIs('Consultation.CtApproval')">
                                {{ __('Approval') }}
                            </x-nav-link>
                            <x-nav-link :href="route('Consultation.CtHistory')" :active="request()->routeIs('Consultation.CtHistory')">
                                {{ __('History') }}
                            </x-nav-link>
                            <x-nav-link :href="route('Consultation.CtCalendar')" :active="request()->routeIs('Consultation.CtCalendar')">
                                {{ __('Calendar') }}
                            </x-nav-link>
                            @elseif(in_array(Auth::user()->role, ['ComputerDepartment', 'EngineeringDeparment', 'HighSchoolDepartment', 'TesdaDepartment', 'HmDepartment' ]))
        <x-nav-link :href="route('DepartmentHead.DpDashboard')" :active="request()->routeIs('DepartmentHead.DpDashboard')">
            {{ __('Dashboard') }}
        </x-nav-link>
        <x-nav-link :href="route('DepartmentHead.DpApproval')" :active="request()->routeIs('DepartmentHead.DpApproval')">
            {{ __('Approval') }}
        </x-nav-link>
        <x-nav-link :href="route('DepartmentHead.DpHistory')" :active="request()->routeIs('DepartmentHead.DpHistory')">
            {{ __('History') }}
        </x-nav-link>
        <x-nav-link :href="route('DepartmentHead.DpCalendar')" :active="request()->routeIs('DepartmentHead.DpCalendar')">
            {{ __('Calendar') }}
        </x-nav-link>
                        @endif
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                 <!-- Notification Dropdown -->
   @auth
    <div class="relative mr-4" x-data="{ open: false }">
        <button @click="open = !open" class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            @php
            $unreadCount = Auth::user()->notifies()->where('read', false)->count();
            @endphp
            @if($unreadCount > 0)
                <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">{{ $unreadCount }}</span>
            @endif
        </button>
        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg overflow-hidden z-20" style="max-height: 300px; overflow-y: auto;">
            <div class="py-2">
                @foreach(Auth::user()->notifies()->orderBy('created_at', 'desc')->take(5)->get() as $notify)
                    <a href="#" class="flex items-center px-4 py-3 border-b hover:bg-gray-100 {{ $notify->read ? 'opacity-50' : '' }}" onclick="event.preventDefault(); markAsRead({{ $notify->id }});">
                        <p class="text-gray-600 text-sm mx-2">
                            <span class="font-bold" href="#">{{ $notify->message }}</span>
                        </p>
                    </a>
                @endforeach
            </div>
            <a href="#" class="block bg-gray-800 text-white text-center font-bold py-2" onclick="event.preventDefault(); document.getElementById('show-all-notifications').submit();">See all notifications</a>
        </div>
    </div>
    <form id="show-all-notifications" action="{{ route('notifications.index') }}" method="GET" style="display: none;">
        @csrf
    </form>
    @endauth

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.2103 7.2103a1 1 0 011.414 0L10 10.586l3.2103-3.2103a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
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
            @if(Auth::check())
                @if(Auth::user()->role == 'HumanResources')
                    <x-responsive-nav-link :href="route('HrDashboard')" :active="request()->routeIs('HrDashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('Evaluation.HrFacultylist')" :active="request()->routeIs('Evaluation.HrFacultylist')">
                        {{ __('Facultylist') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('Evaluation.HrCalendar')" :active="request()->routeIs('Evaluation.HrCalendar')">
                        {{ __('Calendar') }}
                    </x-responsive-nav-link>
                @elseif(Auth::user()->role == 'Student')
                    <!-- Add student specific links here -->
                @elseif(Auth::user()->role == 'Guidance')
                    <x-responsive-nav-link :href="route('Consultation.CtDashboard')" :active="request()->routeIs('Consultation.CtDashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('Consultation.CtApproval')" :active="request()->routeIs('Consultation.CtApproval')">
                        {{ __('Approval') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('Consultation.CtHistory')" :active="request()->routeIs('Consultation.CtHistory')">
                        {{ __('History') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('Consultation.CtCalendar')" :active="request()->routeIs('Consultation.CtCalendar')">
                        {{ __('Calendar') }}
                    </x-responsive-nav-link>
                @elseif(Auth::user()->role == 'ComputerDepartment')
                    <x-responsive-nav-link :href="route('DepartmentHead.DpDashboard')" :active="request()->routeIs('DepartmentHead.DpDashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('DepartmentHead.DpApproval')" :active="request()->routeIs('DepartmentHead.DpApproval')">
                        {{ __('Approval') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('DepartmentHead.DpHistory')" :active="request()->routeIs('DepartmentHead.DpHistory')">
                        {{ __('History') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('DepartmentHead.DpCalendar')" :active="request()->routeIs('DepartmentHead.DpCalendar')">
                        {{ __('Calendar') }}
                    </x-responsive-nav-link>
                @endif
            @endif
        </div>
    </div>
</nav>
<script>
function markAsRead(id) {
    fetch(`/notifications/${id}/mark-as-read`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
    }).then(response => response.json())
      .then(data => {
          if (data.success) {
              // Refresh the page or update the UI as needed
              window.location.reload();
          }
      });
}
</script>