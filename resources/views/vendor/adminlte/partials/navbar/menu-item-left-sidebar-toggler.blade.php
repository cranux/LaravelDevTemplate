<li class="nav-item">
    <a class="nav-link" data-widget="pushmenu" href="#"
        @if(config('adminlte.sidebar_collapse_remember'))
            data-enable-remember="true"
        @endif
        @if(!config('adminlte.sidebar_collapse_remember_no_transition'))
            data-no-transition-after-reload="false"
        @endif
        @if(config('adminlte.sidebar_collapse_auto_size'))
            data-auto-collapse-size="{{ config('adminlte.sidebar_collapse_auto_size') }}"
        @endif>
        <i class="fas fa-bars"></i>
        <span class="sr-only">{{ __('adminlte::adminlte.toggle_navigation') }}</span>
    </a>
</li>

@if (is_array(config('adminlte.topLeftNav')))
    <!-- Left navbar links -->
    @foreach(config('adminlte.topLeftNav') as $item)
        <li class="nav-item">
            <a href="{{$item['url'] ?? ''}}" class="nav-link"
               @if (isset($item['target'])) target="{{ $item['target'] }}" @endif
            >{{$item['text'] ?? ''}}</a>
        </li>
    @endforeach
@endif
