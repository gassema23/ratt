<div class="js-cookie-consent cookie-consent pb-2 z-30">
    <div class="p-4 border rounded-lg shadow-soft bg-yellow-50">
        <div class="flex items-center justify-between flex-wrap">
            <div class="w-0 flex-1 items-center hidden lg:inline">
                <p class="ml-3 text-slate-700 cookie-consent__message">
                    {!! trans('cookie-consent::texts.message') !!}
                </p>
            </div>
            <div class="mt-2 flex-shrink-0 w-full sm:mt-0 sm:w-auto">
                <x-button warning squared :label="trans('cookie-consent::texts.agree')" class="js-cookie-consent-agree cookie-consent__agree" />
            </div>
        </div>
    </div>
</div>
