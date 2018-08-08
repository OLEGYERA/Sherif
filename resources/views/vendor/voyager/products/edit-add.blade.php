@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('voyager::generic.'.(!is_null($dataTypeContent->getKey()) ? 'edit' : 'add')).' '.$dataType->display_name_singular)

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.(!is_null($dataTypeContent->getKey()) ? 'edit' : 'add')).' '.$dataType->display_name_singular }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">
            <form role="form"
                            class="form-edit-add"
                            action="@if(!is_null($dataTypeContent->getKey())){{ route('voyager.'.$dataType->slug.'.update', $dataTypeContent->getKey()) }}@else{{ route('voyager.'.$dataType->slug.'.store') }}@endif"
                            method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                        @if(!is_null($dataTypeContent->getKey()))
                            {{ method_field("PUT") }}
                        @endif

                        <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Adding / Editing -->
                            @php
                                $dataTypeRows = $dataType->{(!is_null($dataTypeContent->getKey()) ? 'editRows' : 'addRows' )};
                            @endphp

                            
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab1">Описание</a></li>
                    <li><a data-toggle="tab" href="#tab2">Информация о товаре</a></li>
                    <li><a data-toggle="tab" href="#tab3">Фото</a></li>
                    <li><a data-toggle="tab" href="#tab4">Характеристики</a></li>
                    <li><a data-toggle="tab" href="#tab5">Сопутствующий</a></li>
                    <li><a data-toggle="tab" href="#tab6">Похожие товары</a></li>
                </ul>

                <div class="tab-content">
                    <div id="tab1" class="tab-pane fade in active">
                        <div class="panel panel-bordered col-lg-12">
                            <div class="panel-body">
                                <div class="form-group @if($dataTypeRows[12]->type == 'hidden') hidden @endif col-md-{{ $display_options->width or 12 }}" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                    {{ $dataTypeRows[12]->slugify }}
                                    <label for="name">{{ $dataTypeRows[12]->display_name }}</label>
                                        {!! app('voyager')->formField($dataTypeRows[12], $dataType, $dataTypeContent) !!}

                                    @foreach (app('voyager')->afterFormFields($dataTypeRows[12], $dataType, $dataTypeContent) as $after)
                                        {!! $after->handle($dataTypeRows[12], $dataType, $dataTypeContent) !!}
                                    @endforeach

                                </div>
                            </div>
                            <div class="panel-footer">
                                <button type="submit" class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
                            </div>
                        </div>
                    </div>
                    <div id="tab2" class="tab-pane fade">
                        <div class="col-lg-6">
                            <div class="panel panel-bordered col-lg-12">
                                <div class="panel-body">
                                    <table class="table table-hover">
                                        <tbody>
                                            @foreach($dataTypeRows as $row)
                                                <tr>
                                                @if($row->field == 'description' || 
                                                    $row->field == 'characteristics' || 
                                                    $row->field == 'USD' || 
                                                    $row->field == 'EUR' || 
                                                    $row->field == 'UAH' || 
                                                    $row->field == 'URL' ||
                                                    $row->field == 'code' ||
                                                    $row->field == 'price_final' || 
                                                    $row->field == 'product_hasone_currency_relationship' ||
                                                    $row->field == 'profitability')
                                                        <?php continue; ?>
                                                @endif
                                                <!-- GET THE DISPLAY OPTIONS -->
                                                @php
                                                    $options = json_decode($row->details);
                                                    $display_options = isset($options->display) ? $options->display : NULL;
                                                @endphp

                                                @if ($options && isset($options->formfields_custom))
                                                    @include('voyager::formfields.custom.' . $options->formfields_custom)
                                                @else
                                                    {{ $row->slugify }}
                                                            <td><label for="name">{{ $row->display_name }}</label></td>
                                                        @include('voyager::multilingual.input-hidden-bread-edit-add')
                                                        @if($row->type == 'relationship')
                                                            <td>@include('voyager::formfields.relationship')</td>
                                                        @else
                                                            <td>{!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}</td>
                                                        @endif
                                                        @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                                                            <td>{!! $after->handle($row, $dataType, $dataTypeContent) !!}</td>
                                                        @endforeach
                                                @endif
                                                </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div><!-- panel-body -->
                                <div class="panel-footer">
                                    <button type="submit" class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="panel panel-bordered col-lg-12">
                                <div class="panel-body">
                                    <tr>
                                        @foreach($dataTypeRows as $row)
                                            @if($row->field == 'description' || 
                                                $row->field == 'characteristics' || 
                                                $row->field == 'name' || 
                                                $row->field == 'slug' || 
                                                $row->field == 'vendor_code' || 
                                                $row->field == 'product_belongstomany_subcategory_relationship' || 
                                                $row->field == 'color' ||
                                                $row->field == 'manufacturer' ||
                                                $row->field == 'URL' ||
                                                $row->field == 'code' ||
                                                $row->field == 'publication' ||
                                                $row->field == 'product_belongsto_product_status_relationship' ||
                                                $row->field == 'product_belongsto_product_label_relationship')
                                                    <?php continue; ?>
                                            @endif
                                            <!-- GET THE DISPLAY OPTIONS -->
                                            @php
                                                $options = json_decode($row->details);
                                                $display_options = isset($options->display) ? $options->display : NULL;
                                            @endphp

                                            @if ($options && isset($options->formfields_custom))
                                                @include('voyager::formfields.custom.' . $options->formfields_custom)
                                            @else
                                                 {{ $row->slugify }}
                                                        <td><label for="name">{{ $row->display_name }}</label></td>
                                                    @include('voyager::multilingual.input-hidden-bread-edit-add')
                                                    @if($row->type == 'relationship')
                                                        <td>@include('voyager::formfields.relationship')</td>
                                                    @else
                                                        <td>{!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}</td>
                                                    @endif
                                                    @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                                                        <td>{!! $after->handle($row, $dataType, $dataTypeContent) !!}</td>
                                                    @endforeach
                                            @endif
                                        @endforeach
                                    </tr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab3" class="tab-pane fade"></div>
                    <div id="tab4" class="tab-pane fade">
                        <div class="panel panel-bordered col-lg-12">
                            <div class="panel-body">
                                <div class="form-group @if($dataTypeRows[14]->type == 'hidden') hidden @endif col-md-{{ $display_options->width or 12 }}" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                    {{ $dataTypeRows[14]->slugify }}
                                    <label for="name">{{ $dataTypeRows[14]->display_name }}</label>
                                        {!! app('voyager')->formField($dataTypeRows[14], $dataType, $dataTypeContent) !!}

                                    @foreach (app('voyager')->afterFormFields($dataTypeRows[14], $dataType, $dataTypeContent) as $after)
                                        {!! $after->handle($dataTypeRows[14], $dataType, $dataTypeContent) !!}
                                    @endforeach
                                </div>
                            </div>
                            <div class="panel-footer">
                                <button type="submit" class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
                            </div>
                        </div>
                    </div>
                    <div id="tab5" class="tab-pane fade"></div>
                    <div id="tab6" class="tab-pane fade"></div>
                </div>


                       
                    </form>

                    <iframe id="form_target" name="form_target" style="display:none"></iframe>
                    <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
                            enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
                        <input name="image" id="upload_file" type="file"
                                 onchange="$('#my_form').submit();this.value='';">
                        <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
                        {{ csrf_field() }}
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-danger" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}</h4>
                </div>

                <div class="modal-body">
                    <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                    <button type="button" class="btn btn-danger" id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete File Modal -->
@stop

@section('javascript')
    <script>
        var params = {}
        var $image

        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();

            //Init datepicker for date fields if data-datepicker attribute defined
            //or if browser does not handle date inputs
            $('.form-group input[type=date]').each(function (idx, elt) {
                if (elt.type != 'date' || elt.hasAttribute('data-datepicker')) {
                    elt.type = 'text';
                    $(elt).datetimepicker($(elt).data('datepicker'));
                }
            });

            @if ($isModelTranslatable)
                $('.side-body').multilingual({"editing": true});
            @endif

            $('.side-body input[data-slug-origin]').each(function(i, el) {
                $(el).slugify();
            });

            $('.form-group').on('click', '.remove-multi-image', function (e) {
                e.preventDefault();
                $image = $(this).siblings('img');

                params = {
                    slug:   '{{ $dataType->slug }}',
                    image:  $image.data('image'),
                    id:     $image.data('id'),
                    field:  $image.parent().data('field-name'),
                    _token: '{{ csrf_token() }}'
                }

                $('.confirm_delete_name').text($image.data('image'));
                $('#confirm_delete_modal').modal('show');
            });

            $('#confirm_delete').on('click', function(){
                $.post('{{ route('voyager.media.remove') }}', params, function (response) {
                    if ( response
                        && response.data
                        && response.data.status
                        && response.data.status == 200 ) {

                        toastr.success(response.data.message);
                        $image.parent().fadeOut(300, function() { $(this).remove(); })
                    } else {
                        toastr.error("Error removing image.");
                    }
                });

                $('#confirm_delete_modal').modal('hide');
            });
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@stop