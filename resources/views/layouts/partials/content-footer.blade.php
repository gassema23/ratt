<footer class="text-slate-400 pt-4 mt-2">
    <div class="mt-2 pt-2 mx-auto flex items-center sm:flex-row flex-col border-t border-slate-200 align-middle px-8">
        <div class="flex title-font font-medium items-center md:justify-start justify-center text-slate-400">
            <span class="ml-3 mr-1 text-lg">{{ settings()->get('title_'. App::getLocale()) }}</span>
            <span class="text-sm mx-1 text-slate-400 pt-2">{{ config('biri.App_phase') }}</span>
            <span class="text-sm mx-1 text-slate-400 pt-2">{{ config('biri.App_version') }}
        </div>
        <p class="text-sm text-slate-400 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-slate-200 sm:py-2 sm:mt-0 mt-4">
            © {{ date('Y') }} — <a class="text-slate-400 hover:text-teal-500 transition ease-in-out duration-500" href="{{ settings()->get('compagny_link') }}" target="_blank">
                {{ settings()->get('compagny') }}
            </a>
        </p>
        <span class="inline-flex sm:ml-auto sm:mt-0 mt-4 justify-center sm:justify-start space-x-3">
            @foreach(settings()->get('socials') as $k_social => $v_social)
            <a class="text-slate-400 hover:text-teal-500 transition ease-in-out duration-500" href="{{ $v_social }}" target="_blank">
                <x-icon name="{{ strtolower($k_social) }}" class="w-5 h-5"/>
            </a>
            @endforeach
        </span>
    </div>
</footer>
