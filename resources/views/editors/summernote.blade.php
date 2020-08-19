
@section('scripts')
    @parent
    <script src="/vendor/summernote/summernote.min.js" defer></script>
    <script src="{{ mix('js/editors/summernote.js') }}" defer></script>
    <script src="/vendor/summernote/plugin/embed/summernote-embed-plugin.js" defer></script>
    <script src="/vendor/summernote/plugin/summernote-table-headers/summernote-table-headers.js" defer></script>
    @if (app()->getLocale() == 'he')
        <script src="/vendor/summernote/lang/summernote-he-IL.js" defer></script>
    @elseif (!in_array(app()->getLocale(), ['en-US', 'en']))
        <script src="/vendor/summernote/lang/summernote-{{ app()->getLocale() }}-{{ strtoupper(app()->getLocale()) }}.js" defer></script>
    @endif
@endsection

@section('styles')
@parent
<link href="/vendor/summernote/summernote.min.css" rel="stylesheet">
@endsection

@section('modals')
    @parent
    <div
            id="summernote-config"
            data-mention="{{ route('search.live') }}"
            data-advanced-mention="{{ Auth::user()->advancedMentions }}"
            data-months="{{ route('search.calendar-months') }}"
            data-locale="{{ app()->getLocale() }}"></div>
@endsection
