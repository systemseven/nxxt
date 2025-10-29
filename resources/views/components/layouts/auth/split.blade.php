<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
        <div class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">
{{--            <div class="bg-muted relative hidden h-full flex-col p-10 text-white lg:flex dark:border-e dark:border-neutral-800">--}}
{{--                <div class="absolute inset-0 bg-linear-to-b from-neutral-950 to-neutral-900"></div>--}}
{{--                <span class="text-white z-20">Vertically Centered logo here...</span>--}}
{{--            </div>--}}
            <div class="bg-muted relative hidden h-full flex-col items-center justify-center p-10 text-white lg:flex dark:border-e dark:border-neutral-800">
                <div class="absolute inset-0 bg-linear-to-b from-neutral-950 to-neutral-900"></div>

                <img
                    src="{{ asset('img/nxxt_logo_login_splash.png') }}"
                    alt="{{ config('app.name') }} Splash Screen Image"
                    class="z-20 mx-auto h-48 w-auto object-contain invert opacity-25"
                />
            </div>

            <div class="w-full lg:p-8">
                <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]">
                    <a href="{{ route('home') }}" class="z-20 flex flex-col items-center gap-2 font-medium lg:hidden" wire:navigate>
                        <span class="flex h-9 w-9 items-center justify-center rounded-md">
                            <x-app-logo-icon class="size-9 fill-current text-black dark:text-white" />
                        </span>

                        <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                    </a>
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
