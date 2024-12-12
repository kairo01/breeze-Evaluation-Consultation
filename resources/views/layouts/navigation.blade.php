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
                                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                                </a>
                            @elseif(Auth::user()->student_type == 'HighSchool')
                                <a href="{{ route('Student.HighSchoolDashboard') }}">
                                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                                </a>
                            @endif
                        @elseif(Auth::user()->role == 'HumanResources')
                            <a href="{{ route('HrDashboard') }}">
                                <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                            </a>
                        @elseif(Auth::user()->role == 'Guidance')
                            <a href="{{ route('Consultation.CtDashboard') }}">
                                <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                            </a>
                        @elseif(Auth::user()->role == 'ComputerDepartment')
                            <a href="{{ route('DepartmentHead.DpDashboard') }}">
                                <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                            </a>
                        @endif
                    @else
                        <a href="{{ route('welcome') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
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
                                <x-nav-link :href="route('Student.evaluation.evaluationform')" :active="request()->routeIs('Student.evaluation.evaluationform')">
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
                            <x-nav-link :href="route('Consultation.CtMessages')" :active="request()->routeIs('Consultation.CtMessages')">
                                {{ __('Messages') }}
                            </x-nav-link>

                        @elseif(Auth::user()->role == 'ComputerDepartment')
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
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
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
            @if(Auth::check())
                @if(Auth::user()->role == 'HumanResources')
                    <x-responsive-nav-link :href="('HrDasboard')" :active="request()->routeIs('Evaluation.HrDasboard')">
                        {{ __('Hr Dashboard') }}
                    </x-responsive-nav-link>
                    <x-nav-link :href="('Evaluation.HrFacultylist')" :active="request()->routeIs('Evaluation.HrFaculitylist')">
                        {{ __('HrFacultylist') }}
                    </x-nav-link>
                    <x-responsive-nav-link :href="('Evaluation.HrCalendar')" :active="request()->routeIs('Evaluation.HrCalendar')">
                        {{ __('HrCalendar') }}
                    </x-responsive-nav-link>
                @elseif(Auth::user()->role == 'Student')
                   
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
                    
                @endif
            @endif
        </div>
    </div>
</nav>
