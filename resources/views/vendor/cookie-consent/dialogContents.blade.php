<div
    class="js-cookie-consent cookie-consent rounded-lg bg-warning-50 dark:bg-secondary-800 dark:border dark:border-warning-600 p-4">
    <div class="flex items-center justify-between align-middle">
        <div>
            <span class="text-sm font-semibold text-warning-800 dark:text-warning-600 cookie-consent__message">
                {!! trans('cookie-consent::texts.message') !!}
            </span>
        </div>
        <div>
            <x-button outline warning squared :label="trans('cookie-consent::texts.agree')" class="js-cookie-consent-agree cookie-consent__agree" />
        </div>
    </div>
</div>
