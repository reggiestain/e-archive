<!-- Name Field -->
<div class="row">
<div class="form-group col-md-6">    
{!! Form::bsText('name',null, ['class' => 'form-control','style'=>'width:250px']) !!}
</div>
{{--if in edit mode--}}
@if ($document)
    @if (auth()->user()->can('update document '.$document->id) && !auth()->user()->is_super_admin)
    <div class="form-group col-sm-6">
        @foreach($document->tags->pluck('id')->toArray() as $tagId)
            <input type="hidden" name="tags[]" value="{{$tagId}}">
        @endforeach
    </div>    
    @else
        <div class="form-group col-md-6">
            {{--<label for="tags[]">{{ucfirst(config('settings.tags_label_plural'))}}</label>--}}
            <label for="tags[]">Tags</label>
            <select class="form-control select2" id="tags"
                    name="tags[]"
                    multiple>
                @foreach($tags as $tag)
                    @canany (['update documents','update documents in tag '.$tag->id])
                        <option
                            value="{{$tag->id}}" {{(in_array($tag->id,old('tags', optional(optional(optional($document)->tags)->pluck('id'))->toArray() ?? [] )))?"selected":"" }}>{{$tag->name}}</option>
                    @endcanany
                @endforeach
            </select>
        </div>
    @endif
@else
    <div class="form-group col-md-6 {{ $errors->has("tags") ? 'has-error' :'' }}" style="margin-top:20px">
         {{--<label for="tags[]">{{ucfirst(config('settings.tags_label_plural'))}}</label>--}}
         <label for="tags[]">Tags</label>
        <select class="form-control select2" id="tags" name="tags[]" multiple>
            @foreach($tags as $tag)
                @canany (['create documents','create documents in tag '.$tag->id])
                    <option
                        value="{{$tag->id}}" {{(in_array($tag->id,old('tags', optional(optional(optional($document)->tags)->pluck('id'))->toArray() ?? [] )))?"selected":"" }}>{{$tag->name}}</option>
                @endcanany
            @endforeach
        </select><br>
        {!! $errors->first("tags",'<span class="help-block">:message</span>') !!}
    </div>
@endif
</div>

<div class="row">
<div class="form-group col-md-12">
{!! Form::bsTextarea('description',null,['class'=>'form-control',"id"=>"summernote","row"=>"5"]) !!}
</div>
</div>
{{--additional Attributes--}}
@foreach ($customFields as $customField)
    <div class="form-group col-sm-6 {{ $errors->has("custom_fields.$customField->name") ? 'has-error' :'' }}">
        {!! Form::label("custom_fields[$customField->name]", Str::title(str_replace('_',' ',$customField->name)).":") !!}
        {!! Form::text("custom_fields[$customField->name]", null, ['class' => 'form-control typeahead','data-source'=>json_encode($customField->suggestions),'autocomplete'=>is_array($customField->suggestions)?'off':'on']) !!}
        {!! $errors->first("custom_fields.$customField->name",'<span class="help-block">:message</span>') !!}
    </div>
@endforeach
{{--end additional attributes--}}

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    {!! Form::submit('Save & Upload', ['class' => 'btn btn-primary','name'=>'savnup']) !!}
    <a href="{!! route('documents.index') !!}" class="btn btn-default">Cancel</a>
</div>
@section('scripts')
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
  </script>
  @stop