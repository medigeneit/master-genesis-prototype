<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <title>{{ $title ?? 'Master Genesis Prototype v1' }}</title>
        @vite('resources/css/app.css')
    </head>
    <body class="dark:text-white">

        <div id="app">

            <header class="h-12 shadow dark:bg-gray-800">
                <h2 class="text-center leading-[45px]">{{$heading ?? ""}}</h2>
            </header> 

            <div class="flex">
                <aside class="w-64 dark:text-white dark:bg-gray-700">
                    <ul>

                        <li>
                            <a href="/institutes" class="px-4 py-2 hover:bg-gray-900 inline-block w-full border-b border-gray-800" >Institute & Courses</a>
                            <ul class="ml-4">
                                <li class="">
                                    <a href="/institutes" class="px-4 py-2 hover:bg-gray-900 inline-block text-sm w-full border-b border-gray-600" >Institutes</a>
                                </li>
                                <li class="">
                                    <a href="/courses" class="px-4 py-2 hover:bg-gray-900 inline-block text-sm w-full border-b border-gray-600">Courses</a>
                                </li>
                                <li class="">
                                    <a href="/sessions" class="px-4 py-2 hover:bg-gray-900 inline-block text-sm w-full border-b border-gray-600">Sessions</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="/bookings" class="px-4 py-2 hover:bg-gray-900 inline-block w-full border-b border-gray-800" >Room/Mentor Booking</a>
                            <ul class="ml-4">
                                <li class="">
                                    <a href="/rooms" class="px-4 py-2 hover:bg-gray-900 inline-block text-sm w-full border-b border-gray-600" >Rooms</a>
                                </li>
                                <li class="">
                                    <a href="/mentors" class="px-4 py-2 hover:bg-gray-900 inline-block text-sm w-full border-b border-gray-600">Mentors</a>
                                </li>
                                <li class="">
                                    <a href="/departments" class="px-4 py-2 hover:bg-gray-900 inline-block text-sm w-full border-b border-gray-600">Departments</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="/clinical-session-topics" class="px-4 py-2 hover:bg-gray-900 inline-block w-full border-b border-gray-800" >Clinical Session Topics</a>
                            <ul class="ml-4">
                                <li class="">
                                    <a href="/sessions" class="px-4 py-2 hover:bg-gray-900 inline-block text-sm w-full border-b border-gray-600" >Session</a>
                                </li>
                                <li class="">
                                    <a href="/topics" class="px-4 py-2 hover:bg-gray-900 inline-block text-sm w-full border-b border-gray-600">Topics</a>
                                </li>
                                <li class="">
                                    <a href="/faculty-disciplines" class="px-4 py-2 hover:bg-gray-900 inline-block text-sm w-full border-b border-gray-600">Faculty/Discipline</a>
                                </li>
                            </ul>
                        </li>

                        
                        <li>
                            <a href="/batches" class="px-4 py-2 hover:bg-gray-900 inline-block w-full border-b border-gray-800" >Batches, Modules & contents</a>
                            <ul class="ml-4">
                                <li class="">
                                    <a href="/modules" class="px-4 py-2 hover:bg-gray-900 inline-block text-sm w-full border-b border-gray-600" >Modules</a>
                                </li>
                                <li class="">
                                    <a href="/module-topics" class="px-4 py-2 hover:bg-gray-900 inline-block text-sm w-full border-b border-gray-600">Module Topics</a>
                                </li>
                                <li class="">
                                    <a href="/contents" class="px-4 py-2 hover:bg-gray-900 inline-block text-sm w-full border-b border-gray-600">Contents</a>
                                </li>
                            </ul>
                        </li>
                    
                        

                    </ul>
                </aside>
                
                <main class="flex-grow p-4  dark:bg-gray-600 h-screen">
                    {{ $slot }}
                </main>
            </div>
        </div>

        @yield('scripts')

    </body>
</html>
<!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->

