<!DOCTYPE html>
<html class="light scroll-smooth group" data-content="fluid" data-layout="vertical" data-mode="light" data-navbar="sticky"
    data-sidebar-size="lg" data-sidebar="light" data-skin="default" data-topbar="light" dir="ltr" lang="en">

<head>

    <meta charset="utf-8">
    <title>Login</title>
    <meta content="width=device-width, initial-scale=1.0, user-scalable=no" name="viewport">
    <meta content="Minimal Admin & Dashboard Template" name="description">
    <meta content="StarCode Kh" name="author">
    <!-- App favicon -->
    <link href="{{ asset('admin') }}/assets/images/favicon.ico" rel="shortcut icon">
    <!-- Layout config Js -->
    <script src="{{ asset('admin') }}/assets/js/layout.js"></script>
    <!-- Icons CSS -->

    <!-- StarCode CSS -->


    <link href="{{ asset('admin') }}/assets/css/starcode2.css" rel="stylesheet">
</head>

<body
    class="flex items-center justify-center min-h-screen py-16 lg:py-10 bg-slate-50 dark:bg-zink-800 dark:text-zink-100 font-public">

    <div class="relative">
        <div class="absolute hidden opacity-50 ltr:-left-16 rtl:-right-16 -top-10 md:block">
            <svg height="316" version="1.2" viewbox="0 0 125 316" width="125" xmlns="http://www.w3.org/2000/svg">
                <title>&lt;Group&gt;</title>
                <g id="&lt;Group&gt;">
                    <path class="fill-custom-100/50 dark:fill-custom-950/50" d="m23.4 221.8l-1.3-3.1v-315.3l1.3 3.1z"
                        id="&lt;Path&gt;"></path>
                    <path class="fill-custom-100 dark:fill-custom-950" d="m31.2 229.6l-1.3-3.1v-315.3l1.3 3.1z"
                        id="&lt;Path&gt;"></path>
                    <path class="fill-custom-200/50 dark:fill-custom-900/50" d="m39 237.4l-1.3-3.1v-315.3l1.3 3.1z"
                        id="&lt;Path&gt;"></path>
                    <path class="fill-custom-200/75 dark:fill-custom-900/75" d="m46.8 245.2l-1.3-3.1v-315.3l1.3 3.1z"
                        id="&lt;Path&gt;"></path>
                    <path class="fill-custom-200 dark:fill-custom-900" d="m54.6 253.1l-1.3-3.1v-315.4l1.3 3.1z"
                        id="&lt;Path&gt;"></path>
                    <path class="fill-custom-300/50 dark:fill-custom-800/50" d="m62.4 260.9l-1.2-3.1v-315.4l1.2 3.1z"
                        id="&lt;Path&gt;"></path>
                    <path class="fill-custom-300/75 dark:fill-custom-800/75" d="m70.3 268.7l-1.3-3.1v-315.4l1.3 3.1z"
                        id="&lt;Path&gt;"></path>
                    <path class="fill-custom-300 dark:fill-custom-800" d="m78.1 276.5l-1.3-3.1v-315.3l1.3 3.1z"
                        id="&lt;Path&gt;"></path>
                    <path class="fill-custom-400/50 dark:fill-custom-700/50" d="m85.9 284.3l-1.3-3.1v-315.3l1.3 3.1z"
                        id="&lt;Path&gt;"></path>
                    <path class="fill-custom-400/75 dark:fill-custom-700/75" d="m93.7 292.1l-1.3-3.1v-315.3l1.3 3.1z"
                        id="&lt;Path&gt;"></path>
                    <path class="fill-custom-400 dark:fill-custom-700" d="m101.5 299.9l-1.3-3.1v-315.3l1.3 3.1z"
                        id="&lt;Path&gt;"></path>
                    <path class="fill-custom-500/50 dark:fill-custom-600/50" d="m109.3 307.8l-1.3-3.1v-315.4l1.3 3.1z"
                        id="&lt;Path&gt;"></path>
                </g>
            </svg>
        </div>

        <div class="absolute hidden -rotate-180 opacity-50 ltr:-right-16 rtl:-left-16 -bottom-10 md:block">
            <svg height="316" version="1.2" viewbox="0 0 125 316" width="125" xmlns="http://www.w3.org/2000/svg">
                <title>&lt;Group&gt;</title>
                <g id="&lt;Group&gt;">
                    <path class="fill-custom-100/50 dark:fill-custom-950/50" d="m23.4 221.8l-1.3-3.1v-315.3l1.3 3.1z"
                        id="&lt;Path&gt;"></path>
                    <path class="fill-custom-100 dark:fill-custom-950" d="m31.2 229.6l-1.3-3.1v-315.3l1.3 3.1z"
                        id="&lt;Path&gt;"></path>
                    <path class="fill-custom-200/50 dark:fill-custom-900/50" d="m39 237.4l-1.3-3.1v-315.3l1.3 3.1z"
                        id="&lt;Path&gt;"></path>
                    <path class="fill-custom-200/75 dark:fill-custom-900/75" d="m46.8 245.2l-1.3-3.1v-315.3l1.3 3.1z"
                        id="&lt;Path&gt;"></path>
                    <path class="fill-custom-200 dark:fill-custom-900" d="m54.6 253.1l-1.3-3.1v-315.4l1.3 3.1z"
                        id="&lt;Path&gt;"></path>
                    <path class="fill-custom-300/50 dark:fill-custom-800/50" d="m62.4 260.9l-1.2-3.1v-315.4l1.2 3.1z"
                        id="&lt;Path&gt;"></path>
                    <path class="fill-custom-300/75 dark:fill-custom-800/75" d="m70.3 268.7l-1.3-3.1v-315.4l1.3 3.1z"
                        id="&lt;Path&gt;"></path>
                    <path class="fill-custom-300 dark:fill-custom-800" d="m78.1 276.5l-1.3-3.1v-315.3l1.3 3.1z"
                        id="&lt;Path&gt;"></path>
                    <path class="fill-custom-400/50 dark:fill-custom-700/50" d="m85.9 284.3l-1.3-3.1v-315.3l1.3 3.1z"
                        id="&lt;Path&gt;"></path>
                    <path class="fill-custom-400/75 dark:fill-custom-700/75" d="m93.7 292.1l-1.3-3.1v-315.3l1.3 3.1z"
                        id="&lt;Path&gt;"></path>
                    <path class="fill-custom-400 dark:fill-custom-700" d="m101.5 299.9l-1.3-3.1v-315.3l1.3 3.1z"
                        id="&lt;Path&gt;"></path>
                    <path class="fill-custom-500/50 dark:fill-custom-600/50" d="m109.3 307.8l-1.3-3.1v-315.4l1.3 3.1z"
                        id="&lt;Path&gt;"></path>
                </g>
            </svg>
        </div>

        <div class="mb-0 w-screen lg:mx-auto lg:w-[500px] card shadow-lg border-none shadow-slate-100 relative">
            <div class="!px-10 !py-12 card-body">
                <a href="#!">
                    <img alt="" class="hidden h-6 mx-auto dark:block" src="assets/images/logo-light.png">
                    <img alt="" class="block h-6 mx-auto dark:hidden" src="assets/images/logo-dark.png">
                </a>

                <div class="mt-8 text-center">
                    <h4 class="mb-1 text-custom-500 dark:text-custom-500">Welcome Back !</h4>
                    <p class="text-slate-500 dark:text-zink-200">-</p>
                </div>

                <form action="{{ route('login.post') }}" class="mt-10" id="signInForm" method="POST">
                    @csrf
                    <div class="hidden px-4 py-3 mb-3 text-sm text-green-500 border border-green-200 rounded-md bg-green-50 dark:bg-green-400/20 dark:border-green-500/50"
                        id="successAlert">
                        You have <b>successfully</b> signed in.
                    </div>
                    <div class="mb-3">
                        <label class="inline-block mb-2 text-base font-medium" for="username">Username</label>
                        <input
                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            id="username" name="username" placeholder="Enter username or username" type="text">
                        <div class="hidden mt-1 text-sm text-red-500" id="username-error">Please enter a username.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="inline-block mb-2 text-base font-medium" for="password">Password</label>
                        <input
                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            name="password" placeholder="Enter password" type="password">
                        <div class="hidden mt-1 text-sm text-red-500" id="password-error">Password must be at least 8
                            characters long and contain both letters and numbers.</div>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <input
                                class="border rounded-sm appearance-none size-4 bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-custom-500 checked:border-custom-500 dark:checked:bg-custom-500 dark:checked:border-custom-500 checked:disabled:bg-custom-400 checked:disabled:border-custom-400"
                                id="checkboxDefault1" type="checkbox" value="">
                            <label class="inline-block text-base font-medium align-middle cursor-pointer"
                                for="checkboxDefault1">Remember me</label>
                        </div>
                        {{-- <div class="hidden mt-1 text-sm text-red-500" id="remember-error">Please check the "Remember
                            me" before submitting the form.</div> --}}
                    </div>
                    <div class="mt-10">
                        <button
                            class="w-full text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"
                            type="submit">Sign In</button>
                    </div>

                    {{-- <div
                        class="relative text-center my-9 before:absolute before:top-3 before:left-0 before:right-0 before:border-t before:border-t-slate-200 dark:before:border-t-zink-500">
                        <h5
                            class="inline-block px-2 py-0.5 text-sm bg-white text-slate-500 dark:bg-zink-600 dark:text-zink-200 rounded relative">
                            Sign In with</h5>
                    </div> --}}

                    {{-- <div class="flex flex-wrap justify-center gap-2">
                        <button
                            class="flex items-center justify-center size-[37.5px] transition-all duration-200 ease-linear p-0 text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 active:text-white active:bg-custom-600 active:border-custom-600"
                            type="button"><i class="size-4" data-lucide="facebook"></i></button>
                        <button
                            class="flex items-center justify-center size-[37.5px] transition-all duration-200 ease-linear p-0 text-white btn bg-orange-500 border-orange-500 hover:text-white hover:bg-orange-600 hover:border-orange-600 focus:text-white focus:bg-orange-600 focus:border-orange-600 active:text-white active:bg-orange-600 active:border-orange-600"
                            type="button"><i class="size-4" data-lucide="mail"></i></button>
                        <button
                            class="flex items-center justify-center size-[37.5px] transition-all duration-200 ease-linear p-0 text-white btn bg-sky-500 border-sky-500 hover:text-white hover:bg-sky-600 hover:border-sky-600 focus:text-white focus:bg-sky-600 focus:border-sky-600 active:text-white active:bg-sky-600 active:border-sky-600"
                            type="button"><i class="size-4" data-lucide="twitter"></i></button>
                        <button
                            class="flex items-center justify-center size-[37.5px] transition-all duration-200 ease-linear p-0 text-white btn bg-slate-500 border-slate-500 hover:text-white hover:bg-slate-600 hover:border-slate-600 focus:text-white focus:bg-slate-600 focus:border-slate-600 active:text-white active:bg-slate-600 active:border-slate-600"
                            type="button"><i class="size-4" data-lucide="github"></i></button>
                    </div> --}}

                    {{-- <div class="mt-10 text-center">
                        <p class="mb-0 text-slate-500 dark:text-zink-200">Don't have an account ? <a
                                class="font-semibold underline transition-all duration-150 ease-linear text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500"
                                href="auth-register-basic.html"> SignUp</a> </p> --}}
                    {{-- </div> --}}
                </form>
            </div>
        </div>
    </div>

    <script src='{{ asset('admin') }}/assets/libs/choices.js/public/assets/scripts/choices.min.js'></script>
    <script src="{{ asset('admin') }}/assets/libs/%40popperjs/core/umd/popper.min.js"></script>
    <script src="{{ asset('admin') }}/assets/libs/tippy.js/tippy-bundle.umd.min.js"></script>
    <script src="{{ asset('admin') }}/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ asset('admin') }}/assets/libs/prismjs/prism.js"></script>
    <script src="{{ asset('admin') }}/assets/libs/lucide/umd/lucide.js"></script>
    <script src="{{ asset('admin') }}/assets/js/starcode.bundle.js"></script>
    {{-- <script src="{{ asset('admin') }}/assets/js/pages/auth-login.init.js"></script> --}}

</body>

</html>
