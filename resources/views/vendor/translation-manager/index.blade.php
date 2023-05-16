<x-app-layout :header="__('Translations')">
    <style>
        a.status-1 {
            font-weight: bold;
        }
    </style>
    @push('scripts')
        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="{{ asset('editables/bootstrap-editable.js') }}"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
        <script src="{{ asset('editables/ajax.js') }}"></script>
        <script>
            jQuery(document).ready(function($) {

                $.ajaxSetup({
                    beforeSend: function(xhr, settings) {
                        console.log('beforesend');
                        settings.data += "&_token=<?php echo csrf_token(); ?>";
                    }
                });

                $('.editable').editable().on('hidden', function(e, reason) {
                    var locale = $(this).data('locale');
                    if (reason === 'save') {
                        $(this).removeClass('status-0').addClass('status-1');
                    }
                    if (reason === 'save' || reason === 'nochange') {
                        var $next = $(this).closest('tr').next().find('.editable.locale-' + locale);
                        setTimeout(function() {
                            $next.editable('show');
                        }, 300);
                    }
                });

                $('.group-select').on('change', function() {
                    var group = $(this).val();
                    if (group) {
                        window.location.href =
                            '{{ action('\Barryvdh\TranslationManager\Controller@getView') }}/' + $(this).val();
                    } else {
                        window.location.href =
                            '{{ action('\Barryvdh\TranslationManager\Controller@getIndex') }}';
                    }
                });

                $("a.delete-key").on('confirm:complete', function(event, result) {
                    if (result) {
                        var row = $(this).closest('tr');
                        var url = $(this).attr('href');
                        var id = row.attr('id');
                        $.post(url, {
                            id: id
                        }, function() {
                            row.remove();
                        });
                    }
                    return false;
                });

                $('.form-import').on('ajax:success', function(e, data) {
                    $('div.success-import strong.counter').text(data.counter);
                    $('div.success-import').slideDown();
                    window.location.reload();
                });

                $('.form-find').on('ajax:success', function(e, data) {
                    $('div.success-find strong.counter').text(data.counter);
                    $('div.success-find').slideDown();
                    window.location.reload();
                });

                $('.form-publish').on('ajax:success', function(e, data) {
                    $('div.success-publish').slideDown();
                });

                $('.form-publish-all').on('ajax:success', function(e, data) {
                    $('div.success-publish-all').slideDown();
                });
                $('.enable-auto-translate-group').click(function(event) {
                    event.preventDefault();
                    $('.autotranslate-block-group').removeClass('hidden');
                    $('.enable-auto-translate-group').addClass('hidden');
                })
                $('#base-locale').change(function(event) {
                    console.log($(this).val());
                    $.cookie('base_locale', $(this).val());
                })
                if (typeof $.cookie('base_locale') !== 'undefined') {
                    $('#base-locale').val($.cookie('base_locale'));
                }

            })
        </script>
    @endpush
    <p>@lang('Warning, translations are not visible until they are exported back to the app/lang file, using')
        <code class="bg-slate-200 text-slate-500 px-3 py-1">php artisan translation:export</code>
        @lang('command or publish button.')
    </p>
    <div class="alert alert-success success-import" style="display:none;">
        <p>Done importing, processed <strong class="counter">N</strong> items! Reload this page to refresh the groups!</p>
    </div>
    <div class="alert alert-success success-find" style="display:none;">
        <p>Done searching for translations, found <strong class="counter">N</strong> items!</p>
    </div>
    <div class="alert alert-success success-publish" style="display:none;">
        <p>Done publishing the translations for group {{ $group }}'!</p>
    </div>
    <div class="alert alert-success success-publish-all" style="display:none;">
        <p>Done publishing the translations for all group!</p>
    </div>
    @if (Session::has('successPublish'))
        <div class="alert alert-info">
            {{ Session::get('successPublish') }}
        </div>
    @endif
    <p>
        @if (!isset($group))
            <form class="form-import my-4" method="POST"
                action="{{ action('\Barryvdh\TranslationManager\Controller@postImport') }}" data-remote="true"
                role="form">
                @csrf
                <div class="form-group">
                    <div class="grid grid-cols-8 gap-4 items-center justify-center">
                        <div class="col-span-7">
                            <x-native-select label="Select Status" placeholder="Select one status" :options="['Append new translations', 'Replace existing translations']"
                                wire:model.defer="replace" name="replace" />
                        </div>
                        <div class="col-span-1 mt-5 text-right">
                            <x-button type="submit" positive squared label="Import groups"
                                data-disable-with="Loading.." />
                        </div>
                    </div>
                </div>
            </form>
            <form class="form-find my-4" method="POST"
                action="{{ action('\Barryvdh\TranslationManager\Controller@postFind') }}" data-remote="true"
                role="form"
                data-confirm="Are you sure you want to scan you app folder? All found translation keys will be added to the database.">
                <div class="form-group">
                    @csrf
                    <x-button type="submit" positive squared label="Find translations in files"
                        data-disable-with="Searching.." />
                </div>
            </form>
        @endif
        @if (isset($group))
            <form class="form-inline form-publish my-4" method="POST"
                action="{{ action('\Barryvdh\TranslationManager\Controller@postPublish', $group) }}" data-remote="true"
                role="form"
                data-confirm="Are you sure you want to publish the translations group '{{ $group }}? This will overwrite existing language files.">
                @csrf
                <x-button type="submit" positive squared label="Publish translations"
                    data-disable-with="Publishing.." />
                <a href="{{ action('\Barryvdh\TranslationManager\Controller@getIndex') }}"
                    class="text-teal-500 underline">Back</a>
            </form>
        @endif
    </p>
    <form role="form" method="POST" action="{{ action('\Barryvdh\TranslationManager\Controller@postAddGroup') }}">
        @csrf
        <div class="form-group my-4">
            <p>Choose a group to display the group translations. If no groups are visisble, make sure
                you have run the migrations and imported the translations.</p>
            <x-native-select label="Select groups" class=" group-select" :options="$groups" wire:model.defer="group"
                name="group" id="group" />
        </div>
        <div class="form-group my-4">
            <x-input wire:model.defer="new-group" name="new-group"
                label="Enter a new group name and start edit translations in that group" />
        </div>
        <div class="form-group my-4">
            <x-button type="submit" positive squared label="Add and edit keys" name="add-group" />
        </div>
    </form>
    @if ($group)
        <form action="{{ action('\Barryvdh\TranslationManager\Controller@postAdd', [$group]) }}" method="POST"
            role="form">
            @csrf
            <div class="form-group my-4">
                <x-textarea wire:model.defer="keys" name="keys" label="Add new keys to this group"
                    placeholder="Add 1 key per line, without the group prefix" />
            </div>
            <div class="form-group my-4">
                <x-button type="submit" positive squared label="Add keys" />
            </div>
        </form>
        <div class="row my-4">
            <div class="col-sm-2">
                <x-button positive squared label="Use Auto Translate" class=" enable-auto-translate-group" />

            </div>
        </div>
        <form class="my-4 form-add-locale autotranslate-block-group hidden" method="POST" role="form"
            action="<?php echo action('\Barryvdh\TranslationManager\Controller@postTranslateMissing'); ?>">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="grid grid-cols-1">
                <div>
                    <div class="form-group my-4">
                        <x-native-select label="Base Locale for Auto Translations" class="group-select"
                            :options="$locales" wire:model.defer="group" name="base-locale" id="base-locale" />
                    </div>
                    <div class="form-group my-4">
                        <x-input wire:model="new-locale" name="new-locale" id="new-locale"
                            label="Enter target locale key" placeholder="Enter target locale key" />
                    </div>
                    @if (!config('laravel_google_translate.google_translate_api_key'))
                        <p>
                            <code class="bg-slate-200 text-slate-500 px-3 py-1">
                                If you would like to use Google Translate API, install
                                tanmuhittin/laravel-google-translate and enter your Google Translate API
                                key to config file laravel_google_translate
                            </code>
                        </p>
                    @endif
                    <div class="form-group my-4">
                        <input type="hidden" name="with-translations" value="1">
                        <input type="hidden" name="file" value=" {{ $group }}">
                        <x-button type="submit" positive squared label="Auto translate missing translations"
                            data-disable-with="Adding.." />
                    </div>
                </div>
            </div>
        </form>
        <h4>Total: {{ $numTranslations }}, changed: {{ $numChanged }}</h4>
        <table class="min-w-full border-collapse block md:table shadow-sm">
            <thead class="block md:table-header-group">
                <tr
                    class="border border-slate-200 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
                    <th
                        class="bg-slate-100 p-2 text-slate-800 font-bold md:border md:border-slate-200 text-left block md:table-cell">
                        Key
                    </th>
                    @foreach ($locales as $locale)
                        <th
                            class="bg-slate-100 p-2 text-slate-800 font-bold md:border md:border-slate-200 text-left block md:table-cell">
                            {{ $locale }}
                        </th>
                    @endforeach
                    @if ($deleteEnabled)
                        <th
                            class="bg-slate-100 p-2 text-slate-800 font-bold md:border md:border-slate-200 text-left block md:table-cell">
                            &nbsp;
                        </th>
                    @endif
                </tr>
            </thead>
            <tbody class="block md:table-row-group">
                @foreach ($translations as $key => $translation)
                    <tr id="{{ htmlentities($key, ENT_QUOTES, 'UTF-8', false) }}">
                        <td class="p-2 md:border md:border-slate-200 block md:table-cell">
                            {{ htmlentities($key, ENT_QUOTES, 'UTF-8', false) }}
                        </td>
                        @foreach ($locales as $locale)
                            <?php $t = isset($translation[$locale]) ? $translation[$locale] : null; ?>
                            <td class="p-2 md:border md:border-slate-200 block md:table-cell">
                                <a href="#edit"
                                    class="text-teal-500 underline editable status-{{ $t ? $t->status : 0 }} locale-{{ $locale }}"
                                    data-locale="{{ $locale }}"
                                    data-name="{{ $locale . '|' . htmlentities($key, ENT_QUOTES, 'UTF-8', false) }}"
                                    id="username" data-type="textarea" data-pk="{{ $t ? $t->id : 0 }}"
                                    data-url="<?php echo $editUrl; ?>"
                                    data-title="Enter translation">{{ $t ? htmlentities($t->value, ENT_QUOTES, 'UTF-8', false) : '' }}</a>
                            </td>
                        @endforeach
                        @if ($deleteEnabled)
                            <td class="p-2 md:border md:border-slate-200 block md:table-cell">
                                <a href="{{ action('\Barryvdh\TranslationManager\Controller@postDelete', [$group, $key]) }}"
                                    class="delete-key text-teal-500 underline"
                                    data-confirm="Are you sure you want to delete the translations for '{{ htmlentities($key, ENT_QUOTES, 'UTF-8', false) }}?">
                                    <x-icon name="trash" class="w-5 h-5" />
                                </a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <fieldset class="border-1 border-slate-200 p-2 my-2">
            <legend class="font-bold text-slate-600">Supported locales</legend>
            <p>Current supported locales:</p>
            <form class="form-remove-locale my-4" method="POST" role="form"
                action="{{ action('\Barryvdh\TranslationManager\Controller@postRemoveLocale') }}"
                data-confirm="Are you sure to remove this locale and all of data?">
                @csrf
                <ul class="list-locales border border-slate-200 overflow-hidden shadow my-4">
                    @foreach ($locales as $locale)
                        <li
                            class="px-4 py-2 bg-white hover:bg-slate-100 hover:text-slate-600 border-b last:border-none border-slate-200 transition-all duration-300 ease-in-out">
                            <div class="flex justify-between">
                                <div>{{ $locale }}</div>
                                <div>
                                    <x-button.circle negative icon="x" xs data-disable-with="..."
                                        type="submit" name="remove-locale[{{ $locale }}]" />
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </form>
            <form class="form-add-locale my-4" method="POST" role="form"
                action="{{ action('\Barryvdh\TranslationManager\Controller@postAddLocale') }}">
                @csrf
                <div class="form-group">
                    <p>Enter new locale key:</p>
                    <div class="grid grid-cols-8">
                        <div class="col-span-7">
                            <x-input wire:model.defer="new-locale" name="new-locale"
                                placeholder="Enter new locale key" />
                        </div>
                        <div class="col-span-1 text-right">
                            <x-button type="submit" positive squared label="Add new locale"
                                data-disable-with="Adding.." />
                        </div>
                    </div>
                </div>
            </form>
        </fieldset>
        <fieldset class="border-1 border-slate-200 p-2 my-2">
            <legend class="font-bold text-slate-600">Export all translations</legend>
            <form class="form-inline form-publish-all" method="POST"
                action="{{ action('\Barryvdh\TranslationManager\Controller@postPublish', '*') }}" data-remote="true"
                role="form"
                data-confirm="Are you sure you want to publish all translations group? This will overwrite existing language files.">
                @csrf
                <x-button type="submit" positive squared label="Publish all" data-disable-with="Publishing.." />
            </form>
        </fieldset>
    @endif
    <script defer>
        function sidebar() {
            const breakpoint = 1280
            return {
                open: {
                    above: true,
                    below: false,
                },
                isAboveBreakpoint: window.innerWidth > breakpoint,

                handleResize() {
                    this.isAboveBreakpoint = window.innerWidth > breakpoint
                },

                isOpen() {
                    console.log(this.isAboveBreakpoint)
                    if (this.isAboveBreakpoint) {
                        return this.open.above
                    }
                    return this.open.below
                },
                handleOpen() {
                    if (this.isAboveBreakpoint) {
                        this.open.above = true
                    }
                    this.open.below = true
                },
                handleClose() {
                    if (this.isAboveBreakpoint) {
                        this.open.above = false
                    }
                    this.open.below = false
                },
                handleAway() {
                    if (!this.isAboveBreakpoint) {
                        this.open.below = false
                    }
                },
            }
        }
    </script>
</x-app-layout>
