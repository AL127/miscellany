@inject('formService', 'App\Services\FormService')

{{ csrf_field() }}
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>{{ trans('crud.panels.general_information') }}</h4>
            </div>
            <div class="panel-body">
                <div class="form-group required">
                    <label>{{ trans('quests.fields.name') }}</label>
                    {!! Form::text('name', $formService->prefill('name', $source), ['placeholder' => trans('quests.placeholders.name'), 'class' => 'form-control', 'maxlength' => 191]) !!}
                </div>
                <div class="form-group">
                    <label>{{ trans('quests.fields.type') }}</label>
                    {!! Form::text('type', $formService->prefill('type', $source), ['placeholder' => trans('quests.placeholders.type'), 'class' => 'form-control', 'maxlength' => 191]) !!}
                </div>
                <div class="form-group">
                    {!! Form::select2(
                        'quest_id',
                        (isset($model) && $model->quest ? $model->quest : $formService->prefillSelect('quest', $source)),
                        App\Models\Quest::class,
                        true,
                        'quests.fields.quest',
                        null,
                        'quests.placeholders.quest'
                    ) !!}
                </div>
                @include('cruds.fields.character')
                @include('cruds.fields.tags')
                @include('cruds.fields.attribute_template')

                <div class="form-group">
                    {!! Form::hidden('is_completed', 0) !!}
                    <label>{!! Form::checkbox('is_completed', 1, (!empty($model) ? $model->is_completed : (!empty($source) ? $formService->prefill('is_completed', $source) : 0))) !!}
                        {{ trans('quests.fields.is_completed') }}
                    </label>
                </div>

                @if (Auth::user()->isAdmin())
                    <hr>
                    @include('cruds.fields.private')
                @endif
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>{{ trans('crud.panels.appearance') }}</h4>
            </div>
            <div class="panel-body">
                @include('cruds.fields.image')
            </div>
        </div>
    </div>
    <div class="col-md-6">
        @include('cruds.fields.entry')
        @include('cruds.fields.copy')
    </div>

    <div class="col-md-6">
        @include('cruds.fields.calendar')
    </div>
</div>

@include('cruds.fields.save')