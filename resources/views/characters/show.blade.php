<div class="row">
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box">
            <div class="box-body box-profile">
                @include ('cruds._image')

                <h3 class="profile-username text-center">{{ $model->name }}
                @if ($model->is_private)
                     <i class="fa fa-lock" title="{{ trans('crud.is_private') }}"></i>
                @endif
                @if ($model->is_dead)
                     <span class="fa fa-cross" title="{{ trans('characters.hints.is_dead') }}">†</span>
                @endif
                </h3>

                @if ($model->title)
                    <p class="text-muted text-center">{{ $model->title }}</p>
                @endif

                <ul class="list-group list-group-unbordered">
                    @if ($campaign->enabled('families') && $model->family)
                        <li class="list-group-item">
                            <b>{{ trans('characters.fields.family') }}</b>
                            <a class="pull-right" href="{{ route('families.show', $model->family_id) }}" data-toggle="tooltip" title="{{ $model->family->tooltip() }}">{{ $model->family->name }}</a>
                            <br class="clear" />
                        </li>
                    @endif
                    @if ($campaign->enabled('locations') && $model->location)
                        <li class="list-group-item">
                            <b>{{ trans('characters.fields.location') }}</b>
                            <span  class="pull-right">
                                <a href="{{ route('locations.show', $model->location_id) }}" data-toggle="tooltip" title="{{ $model->location->tooltip() }}">{{ $model->location->name }}</a>@if ($model->location->parentLocation),
                                <a href="{{ route('locations.show', $model->location->parentLocation->id) }}" data-toggle="tooltip" title="{{ $model->location->parentLocation->tooltip() }}">{{ $model->location->parentLocation->name }}</a>
                                @endif
                            </span>
                            <br class="clear" />
                        </li>
                    @endif
                    @if (!empty($model->race))
                    <li class="list-group-item">
                        <b>{{ trans('characters.fields.race') }}</b> <span class="pull-right">{{ $model->race }}</span>
                        <br class="clear" />
                    </li>
                    @endif
                    @if (!empty($model->type))
                    <li class="list-group-item">
                        <b>{{ trans('characters.fields.type') }}</b> <span class="pull-right">{{ $model->type }}</span>
                        <br class="clear" />
                    </li>
                    @endif

                    @if ($campaign->enabled('organisations'))
                        @if ($model->organisations->count() > 0)

                                <li class="list-group-item">
                                    <b>{{ trans('characters.show.tabs.organisations') }}</b> <span class="pull-right">
                                    <?php $orgs = []; foreach ($model->organisations()->has('organisation')->with('organisation')->limit(3)->get() as $org) {
                                        $orgs[] = '<a href="' . route('organisations.show', $org->organisation) . '" data-toggle="tooltip" title="' . $org->organisation->tooltip() . '">' . $org->organisation->name . '</a>';
                                    } echo implode(', ', $orgs); ?>
                                    </span>
                                    <br class="clear" />
                                </li>
                        @endif
                    @endif
                    @include('cruds.layouts.section')
                </ul>

                @include('.cruds._actions')
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <!-- About Me Box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('characters.fields.physical') }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <ul class="list-group list-group-unbordered">
                    @if ($model->age)
                    <li class="list-group-item">
                        <b>{{ trans('characters.fields.age') }}</b> <span class="pull-right">{{ $model->age }}</span>
                        <br class="clear" />
                    </li>
                    @endif
                    @if ($model->sex)
                    <li class="list-group-item">
                        <b>{{ trans('characters.fields.sex') }}</b> <span class="pull-right">{{ $model->sex }}</span>
                        <br class="clear" />
                    </li>
                    @endif
                    @foreach ($model->characterTraits()->appearance()->get() as $trait)
                    <li class="list-group-item">
                        <b>{{ $trait->name }}</b> <span class="pull-right">{{ $trait->entry }}</span>
                        <br class="clear" />
                    </li>
                    @endforeach
                </ul>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>

    <div class="col-md-9">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="{{ (request()->get('tab') == null ? ' active' : '') }}">
                    <a href="#history" title="{{ trans('characters.show.tabs.history') }}" data-toggle="tooltip">
                        <i class="fa fa-align-justify"></i> <span class="hidden-sm hidden-xs">{{ trans('characters.show.tabs.history') }}</span>
                    </a>
                </li>
                @if (Auth::user()->can('personality', $model))
                    <li class="{{ (request()->get('tab') == 'personality' ? ' active' : '') }}">
                        <a href="#personality" title="{{ trans('characters.show.tabs.personality') }}" data-toggle="tooltip">
                            <i class="fa fa-heart"></i> <span class="hidden-sm hidden-xs">{{ trans('characters.show.tabs.personality') }}</span>
                        </a>
                    </li>
                @endif
                @if ($campaign->enabled('organisations'))
                    @can('organisation', $model)
                <li class="{{ (request()->get('tab') == 'organisation' ? ' active' : '') }}">
                    <a href="#organisation" title="{{ trans('characters.show.tabs.organisations') }}" data-toggle="tooltip">
                        <i class="fa fa-user-secret"></i> <span class="hidden-sm hidden-xs">{{ trans('characters.show.tabs.organisations') }}</span>
                    </a>
                </li>
                    @endcan
                @endif
                @if ($campaign->enabled('items'))
                    <li class="{{ (request()->get('tab') == 'items' ? ' active' : '') }}">
                        <a href="#items" title="{{ trans('characters.show.tabs.items') }}" data-toggle="tooltip">
                            <i class="fa fa-shield"></i> <span class="hidden-sm hidden-xs">{{ trans('characters.show.tabs.items') }}</span>
                        </a>
                    </li>
                @endif
                @if ($campaign->enabled('dice_rolls'))
                    <li class="{{ (request()->get('tab') == 'dice_rolls' ? ' active' : '') }}">
                        <a href="#dice_rolls" title="{{ trans('characters.show.tabs.dice_rolls') }}" data-toggle="tooltip">
                            <i class="fa fa-square"></i> <span class="hidden-sm hidden-xs">{{ trans('characters.show.tabs.dice_rolls') }}</span>
                        </a>
                    </li>
                @endif
                @include('cruds._tabs')
            </ul>

            <div class="tab-content">
                <div class="tab-pane {{ (request()->get('tab') == null ? ' active' : '') }}" id="history">
                    <div class="post">
                        <p>{!! $model->history !!}</p>
                    </div>
                </div>
                @if (Auth::user()->can('personality', $model))
                <div class="tab-pane {{ (request()->get('tab') == 'personality' ? ' active' : '') }}" id="personality">
                    @foreach ($model->characterTraits()->personality()->get() as $trait)
                        <p><b>{{ $trait->name }}</b><br />{!! nl2br(e($trait->entry)) !!}</p>
                    @endforeach
                    <p class="help-block export-hidden">{{ trans('characters.hints.hide_personality') }}</p>
                </div>
                @endif
                @if ($campaign->enabled('organisations'))
                    @can('organisation', $model)
                <div class="tab-pane {{ (request()->get('tab') == 'organisation' ? ' active' : '') }}" id="organisation">
                    @include('characters._organisations')
                </div>
                    @endcan
                @endif
                @if ($campaign->enabled('items'))
                    <div class="tab-pane {{ (request()->get('tab') == 'items' ? ' active' : '') }}" id="items">
                        @include('characters._items')
                    </div>
                @endif
                @if ($campaign->enabled('dice_rolls'))
                    <div class="tab-pane {{ (request()->get('tab') == 'dice_rolls' ? ' active' : '') }}" id="dice_rolls">
                        @include('characters._dice_rolls')
                    </div>
                @endif
                @include('cruds._panes')
            </div>
        </div>

        <!-- actions -->
    </div>
</div>
