<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <title>{{ $title ?? 'Master Genesis Prototype v1' }}</title>
        @vite(['resources/css/app.css','resources/js/app.js'])

    </head>
    <body class="dark:text-white">

        <div id="app">



            <aside class="z-50 pt-16 w-64 dark:text-white dark:bg-gray-700 shadow-[5px_0_10px_0px_rgba(220,220,220,0.5)] dark:shadow-[5px_0_10px_0px_rgba(100,150,50,0.3)] fixed top-0 bottom-0 overflow-y-auto">
                <ul>

                    <li>
                        <a href="/institutes" class="px-4 py-2 bg-blue-50 dark:bg-gray-800 hover:bg-gray-200 hover:dark:bg-gray-900 inline-block w-full border-b border-gray-300 dark:border-gray-800" >Institute & Courses</a>
                        <ul class="ml-4">
                            <li class="">
                                <a href="/institutes" class="px-4 py-2 hover:bg-gray-100 hover:dark:bg-gray-900 inline-block text-sm w-full border-b dark:border-gray-600" >Institutes</a>
                            </li>
                            <li class="">
                                <a href="/courses" class="px-4 py-2 hover:bg-gray-100 hover:dark:bg-gray-900 inline-block text-sm w-full border-b dark:border-gray-600">Courses</a>
                            </li>
                            <li class="">
                                <a href="/sessions" class="px-4 py-2 hover:bg-gray-100 hover:dark:bg-gray-900 inline-block text-sm w-full border-b dark:border-gray-600">Sessions</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="/bookings" class="px-4 py-2 bg-blue-50 dark:bg-gray-800 hover:bg-gray-200 hover:dark:bg-gray-900 inline-block w-full border-b border-gray-300 dark:border-gray-800" >Room/Mentor Booking</a>
                        <ul class="ml-4">
                            <li class="">
                                <a href="/rooms" class="px-4 py-2 hover:bg-gray-100 hover:dark:bg-gray-900 inline-block text-sm w-full border-b dark:border-gray-600" >Rooms</a>
                            </li>
                            <li class="">
                                <a href="/mentors" class="px-4 py-2 hover:bg-gray-100 hover:dark:bg-gray-900 inline-block text-sm w-full border-b dark:border-gray-600">Mentors</a>
                            </li>
                            <li class="">
                                <a href="/departments" class="px-4 py-2 hover:bg-gray-100 hover:dark:bg-gray-900 inline-block text-sm w-full border-b dark:border-gray-600">Departments</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="/clinical-session-topics" class="px-4 py-2 bg-blue-50 dark:bg-gray-800 hover:bg-gray-200 hover:dark:bg-gray-900 inline-block w-full border-b border-gray-300 dark:border-gray-800" >Clinical Session Topics</a>
                        <ul class="ml-4">
                            <li class="">
                                <a href="/sessions" class="px-4 py-2 hover:bg-gray-100 hover:dark:bg-gray-900 inline-block text-sm w-full border-b dark:border-gray-600" >Session</a>
                            </li>
                            <li class="">
                                <a href="/topics" class="px-4 py-2 hover:bg-gray-100 hover:dark:bg-gray-900 inline-block text-sm w-full border-b dark:border-gray-600">Topics</a>
                            </li>
                            <li class="">
                                <a href="/faculty-disciplines" class="px-4 py-2 hover:bg-gray-100 hover:dark:bg-gray-900 inline-block text-sm w-full border-b dark:border-gray-600">Faculty/Discipline</a>
                            </li>
                            <li class="">
                                <a href="/contents" class="px-4 py-2 hover:bg-gray-100 hover:dark:bg-gray-900 inline-block text-sm w-full border-b dark:border-gray-600">Contents</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="/batches" class="px-4 py-2 bg-blue-50 dark:bg-gray-800 hover:bg-gray-200 hover:dark:bg-gray-900 inline-block w-full border-b border-gray-300 dark:border-gray-800" >Batches & Modules</a>
                        <ul class="ml-4">
                            <li class="">
                                <a href="/batches" class="px-4 py-2 hover:bg-gray-100 hover:dark:bg-gray-900 inline-block text-sm w-full border-b dark:border-gray-600" >Batches</a>
                            </li>
                            <li class="">
                                <a href="/modules" class="px-4 py-2 hover:bg-gray-100 hover:dark:bg-gray-900 inline-block text-sm w-full border-b dark:border-gray-600" >Modules</a>
                            </li>

                            <!-- <li class="">
                                <a href="/module-topics" class="px-4 py-2 hover:bg-gray-100 hover:dark:bg-gray-900 inline-block text-sm w-full border-b dark:border-gray-600">Module Topics</a>
                            </li> -->
                        </ul>
                    </li>
                
                </ul>
            </aside>

            <header class="top-header h-12 w-full shadow-lg dark:bg-gray-800 fixed z-50 shadow-[0_5px_10px_0px_rgba(220,220,220,0.5)] dark:shadow-[0_5px_10px_0px_rgba(220,220,220,0.2)]">
                <h2 class="text-center leading-[45px]">{{$heading ?? ""}}</h2>
            </header> 

            <div class="ml-64 pt-12">
                <main class="flex-grow p-4  dark:bg-gray-600 min-h-screen">
                    {{ $slot }}
                </main>
            </div>


        </div>

        <script>
            const theme = localStorage.getItem('document-theme');
            if( theme === 'dark' ) {
                document.querySelector('body').classList.add('dark');
            }


            document.querySelector('header.top-header').addEventListener('click', function(){

                document.querySelector('body').classList.toggle('dark');

                const theme = localStorage.getItem('document-theme');

                localStorage.setItem( 'document-theme', theme === 'dark' ? 'light':'dark' );
                
            })
        </script>

        @yield('scripts')

    </body>
</html>
<!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->

