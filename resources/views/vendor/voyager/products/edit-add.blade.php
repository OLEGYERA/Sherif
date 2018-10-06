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
    <a href="{{ route('voyager.interests.create') }}" class="btn btn-success">
        <span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;
        Интересовались
    </a>
    @php $s = DB::table('product_statuses')->where('id', $dataTypeContent->status)->first()->name; @endphp
    @if($s != "Снят с производства" && $s != "Нет в наличии")
    <a href="#" class="btn btn-success">
        <span class="glyphicon glyphicon-envelope"></span>&nbsp;
        Сообщить о снижении цены
    </a>
    @endif
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
                        <div class="panel panel-default col-lg-12">
                            <button class="btn btn-success save" id="submit_read">Сохранить</button>
                            <button class="btn btn-warning save" id="submit_exit">Сохранить и закрыть</button>
                            <button class="btn btn-primary save" id="submit_add">Сохранить и добавить ещё</button>   
                        </div><br /><br /><br />
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab2">Информация о товаре</a></li>
                            <li><a data-toggle="tab" href="#tab3">Фото</a></li>
                            <li><a data-toggle="tab" href="#tab4">Характеристики</a></li>
                            <li><a data-toggle="tab" href="#tab5">Сопутствующий</a></li>
                            <li><a data-toggle="tab" href="#tab6">Похожие товары</a></li>
                            <li><a data-toggle="tab" href="#tab8">Мета-теги</a></li>
                            @if($dataTypeContent->exists)
                            <li><a data-toggle="tab" href="#tab7">История изменений</a></li>
                            @endif
                        </ul>
                        <div class="tab-content">
                            <div id="tab2" class="tab-pane fade in active">
                                <div class="col-lg-6">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <h4>Основная информация</h4>
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
                                                        $row->field == 'profitability'||
                                                        $row->field == 'sale_discount' ||
                                                        $row->field == 'sale_price' ||
                                                        $row->field == 'profitability' ||
                                                        $row->field == 'mainimage' ||
                                                        $row->field == 'addimage' ||
                                                        $row->field == 'similar' ||
                                                        $row->field == 'concomitant' ||
                                                        $row->field == 'addimage' ||
                                                        $row->field == 'product_belongstomany_attribute_relationship' ||
                                                        $row->field == 'provider' ||
                                                        $row->field == 'concomitant_subcategory' ||
                                                        $row->field == 'maincategory' ||
                                                        $row->field == 'meta_heading' ||
                                                        $row->field == 'meta_title' ||
                                                        $row->field == 'meta_description' ||
                                                        $row->field == 'meta_keywords')
                                                        <?php continue ?>
                                                    @endif
                                                    <!-- GET THE DISPLAY OPTIONS -->
                                                        @php
                                                            $options = json_decode($row->details);
                                                            $display_options = isset($options->display) ? $options->display : NULL;
                                                        @endphp
                                                        @if ($options && isset($options->legend) && isset($options->legend->text))
                                                            <legend class="text-{{$options->legend->align or 'center'}}" style="background-color: {{$options->legend->bgcolor or '#f0f0f0'}};padding: 5px;">{{$options->legend->text}}</legend>
                                                        @endif
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
                                                <tr><td><label for="sel1">Главная подкатегория</label></td>
                                                <td><select class="form-control" name='maincategory'>
                                                    @foreach($categories_list as $item)
                                                    <option value="{{$item->id}}" {{ old('maincategory') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                                    @endforeach
                                                </select></td></tr>
                                                </tbody>
                                            </table>
                                        </div><!-- panel-body -->
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <h4>Цена</h4>
                                            <table class="table table-hover">
                                                <tbody>
                                                @foreach($dataTypeRows as $row)
                                                    <tr>
                                                    @if($row->field == 'EUR' ||
                                                        $row->field == 'USD' ||
                                                        $row->field == 'UAH' ||
                                                        $row->field == 'product_hasone_currency_relationship')
                                                        <!-- GET THE DISPLAY OPTIONS -->
                                                            @php
                                                                $options = json_decode($row->details);
                                                                $display_options = isset($options->display) ? $options->display : NULL;
                                                            @endphp
                                                            @if ($options && isset($options->legend) && isset($options->legend->text))
                                                                <legend class="text-{{$options->legend->align or 'center'}}" style="background-color: {{$options->legend->bgcolor or '#f0f0f0'}};padding: 5px;">{{$options->legend->text}}</legend>
                                                            @endif
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
                                                        @endif
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <h4>Розничная цена</h4>
                                            <table class="table table-hover">
                                                <tbody>
                                                @foreach($dataTypeRows as $row)
                                                    <tr>
                                                    @if($row->field == 'profitability' ||
                                                        $row->field == 'price_final' ||
                                                        $row->field == 'sale_discount' ||
                                                        $row->field == 'sale_price' )
                                                        <!-- GET THE DISPLAY OPTIONS -->
                                                            @php
                                                                $options = json_decode($row->details);
                                                                $display_options = isset($options->display) ? $options->display : NULL;
                                                            @endphp
                                                            @if ($options && isset($options->legend) && isset($options->legend->text))
                                                                <legend class="text-{{$options->legend->align or 'center'}}" style="background-color: {{$options->legend->bgcolor or '#f0f0f0'}};padding: 5px;">{{$options->legend->text}}</legend>
                                                            @endif
                                                            @if ($options && isset($options->formfields_custom))
                                                                @include('voyager::formfields.custom.' . $options->formfields_custom)
                                                            @else
                                                                {{ $row->slugify }}
                                                                <td><label for="name">{{ $row->display_name }}</label> </td>
                                                                
                                                                @include('voyager::multilingual.input-hidden-bread-edit-add')
                                                                @if($row->type == 'relationship')
                                                                    <td>@include('voyager::formfields.relationship') </td>
                                                                @else
                                                                    <td>{!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!} </td>
                                                                @endif
                                                                @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                                                                    <td>{!! $after->handle($row, $dataType, $dataTypeContent) !!} </td>
                                                                @endforeach
                                                            @endif
                                                        @endif
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="panel panel-default">
                                        <div class="panel-body dynamic">
                                            <table class="table table-default" id="dynamic_table">

                                                <tr>
                                                    <td colspan="3"><h4>Оптовая цена</h4></td>
                                                    <td><button type="button" id="add" class="btn btn-success">Добавить</button></td>
                                                </tr>
                                                @if(isset($wholesales))
                                                    @foreach($wholesales as $wholesale)
                                                        <table class="table table-hover">
                                                            <tr>
                                                                <td>Скидка %</td>
                                                                <td colspan="2"><input type="text" name="sale[]" id="sale" class="form-control" value="{{$wholesale->discount}}" placeholder="% скидки" required></td>
                                                                <td><button type="button" id="remove" class="btn btn-danger">Удалить</button></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Количество от</td>
                                                                <td><input type="text" name="quantity[]" id="quantity" class="form-control" value="{{$wholesale->quantity}}" placeholder="Количество от" required></td>
                                                                <td><input type="text" name="unit[]" id="unit" class="form-control" value="{{$wholesale->unit}}" readonly></td>
                                                                <td>(единицы)</td>
                                                            </tr>
                                                        </table>
                                                    @endforeach
                                                @endif
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-bordered col-lg-12">
                                    <div class="panel-body">
                                        <div class="form-group @if($dataTypeRows[13]->type == 'hidden') hidden @endif col-md-{{ $display_options->width or 12 }}" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                            {{ $dataTypeRows[13]->slugify }}
                                            <label for="name">Описание</label>
                                            {!! app('voyager')->formField($dataTypeRows[13], $dataType, $dataTypeContent) !!}

                                            @foreach (app('voyager')->afterFormFields($dataTypeRows[13], $dataType, $dataTypeContent) as $after)
                                                {!! $after->handle($dataTypeRows[13], $dataType, $dataTypeContent) !!}
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab3" class="tab-pane fade">
                                <!-- ### IMAGE ### -->
                                <div class="panel panel-bordered panel-primary col-lg-12">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><i class="icon wb-image"></i> {{ __('voyager::post.image') }}</h3>
                                        <div class="panel-actions">
                                            <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                                        </div>
                                    </div>
                                    @php
                                        $imagesjson = json_decode($dataTypeContent->addimage);
                                        $images = array();
                                        if(isset($imagesjson)) {
                                            foreach ($imagesjson as $key => $image) {
                                                $images[] = [
                                                    'image' => $image,
                                                    'order' => $key,
                                                ];
                                            }
                                        }
                                    @endphp
                                    <table id="image" class="table table-striped table-bordered table-hover panel-body">
                                        <thead>
                                        <tr>
                                            <td class="text-left">Главное зображение</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <div class="file-preview-thumbnails" data-field-name="addimage" style="float:left;padding-right:15px;">
                                                    @if(isset($dataTypeContent->mainimage))
                                                        <img src="@if( !filter_var($dataTypeContent->mainimage, FILTER_VALIDATE_URL)){{ Voyager::image( $dataTypeContent->mainimage ) }}@else '/storage/placeholder.png' @endif"
                                                             style="max-width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                                    @else
                                                        <img src="/storage/placeholder.png" style="max-width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                                    @endif
                                                </div>

                                                <input class="btn-image" id="mainimage" type="file" name="mainimage" accept="image/*">
                                                <script>
                                                    $(document).ready(function() {
                                                        $("#mainimage").fileinput({
                                                            showUpload: false,
                                                            maxFileCount: 1,
                                                            showRemove: false,
                                                            previewFileType: 'image',
                                                            initialPreviewCount: 1,
                                                            autoReplace: true,
                                                            browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
                                                            removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
                                                            allowedFileTypes: ['image'],
                                                            previewTemplates: {
                                                                image: '<div class="img_settings_container" id="{previewId}" data-fileindex="{fileindex}">\n' +
                                                                '   <img src="{data}" style="max-width: 20%;" class="" title="{caption}" alt="{caption}">\n' +
                                                                '</div>\n',
                                                                generic: '<div class="img_settings_container" id="{previewId}" data-fileindex="{fileindex}">\n' +
                                                                '   {content}\n' +
                                                                '</div>\n'
                                                            }
                                                        });
                                                    });
                                                </script>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>


                                    <table id="images" class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <td class="text-left">Изображение</td>
                                            <td class="text-right">Сортировка</td>
                                            <td></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $image_row = 0; ?>
                                        <?php foreach ($images as $image) { ?>
                                        <tr id="image-row<?php echo $image_row; ?>">
                                            <td class="text-left">
                                                <div class="img_settings_container" data-field-name="addimage" style="float:left;padding-right:15px;">
                                                    <img src="{{ Voyager::image( $image['image'] ) }}" data-image="{{ $image['image'] }}" data-id="{{ $dataTypeContent->id }}" style="max-width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:5px;">
                                                </div>
                                                <input id="inputImg<?php echo $image_row; ?>" type="file" name="addimage[<?php echo $image_row; ?>]">
                                                <script>
                                                    $(document).ready(function() {
                                                        $("#inputImg<?php echo $image_row; ?>").fileinput({
                                                            showUpload: false,
                                                            maxFileCount: 1,
                                                            showRemove: false,
                                                            previewFileType: 'image',
                                                            initialPreviewCount: 1,
                                                            autoReplace: true,
                                                            allowedFileTypes: ['image'],
                                                            previewTemplates: {
                                                                image: '<div class="img_settings_container" id="{previewId}" data-fileindex="{fileindex}">\n' +
                                                                '   <img src="{data}" style="max-width: 20%;" class="" title="{caption}" alt="{caption}">\n' +
                                                                '</div>\n',
                                                                generic: '<div class="img_settings_container" id="{previewId}" data-fileindex="{fileindex}">\n' +
                                                                '   {content}\n' +
                                                                '</div>\n'
                                                            }
                                                        });
                                                    });
                                                </script>

                                                <input type="hidden" name="addimage[<?php echo $image_row; ?>][image]" value="<?php echo $image['image']; ?>" id="input-image<?php echo $image_row; ?>" />
                                            </td>
                                            <td class="text-right" style="width: 10%;"><input type="text"
                                                                                              name="addimage[<?php echo $image_row; ?>][order]"
                                                                                              value="{{$image['order'] }}"
                                                                                              placeholder="сортировка"
                                                                                              class="form-control"/></td>
                                            <td class="text-left">
                                                <button type="button"
                                                        onclick="$('#image-row<?php echo $image_row; ?>, .tooltip').remove();"
                                                        data-toggle="tooltip" title="{{ trans('admin.button_remove')}}"
                                                        class="btn btn-danger"><i class="voyager-trash"></i></button>
                                            </td>
                                        </tr>
                                        <?php $image_row++; ?>
                                        <?php } ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td class="text-left">
                                                <button type="button" onclick="addImage();" data-toggle="tooltip"
                                                        title="Добавить" class="btn btn-primary"><i class="voyager-plus"></i></button>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                    <script type="text/javascript">
                                        // $(document).ready(function () {
                                        var image_row = <?php echo $image_row; ?>;

                                        function addImage() {
                                            console.log(image_row);
                                            html = '<tr id="image-row' + image_row + '">';
                                            html +=  '    <td class="text-left">  '  +
                                                '     <div class="img_settings_container" data-field-name="addimage" style="float:left;padding-right:15px;">  '  +
                                                '      <img src="/storage/placeholder.png" data-id="" style="max-width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:5px;"> ' +
                                                '    </div>' +
                                                '    <input id="inputImg' +image_row +'" type="file" name="addimage[' +image_row +']"> ' +
                                                '    <script>'  +
                                                '  $(document).ready(function() {' + '\n' +
                                                '    $("#inputImg' + image_row + '").fileinput({ ' + '\n' +
                                                '            showUpload: false, '  + '\n' +
                                                '            maxFileCount: 1, '  + '\n' +
                                                '            showRemove: false, '  + '\n' +
                                                '            previewFileType: "image", '  + '\n' +
                                                '            initialPreviewCount: 1, '  + '\n' +
                                                '            autoReplace: true, '  + '\n' +
                                                '            allowedFileTypes: ["image"], '  + '\n' +
                                                '            previewTemplates: { '  + '\n' +
                                                '                image: \'<div class="" id="{previewId}" data-fileindex="{fileindex}"><img src="{data}" style="max-width: 100%;" class="" title="{caption}" alt="{caption}"></div>\',' +
                                                '               generic: \'<div class="" id="{previewId}" data-fileindex="{fileindex}">{content}</div>\'' +
                                                '            } '  + '\n' +
                                                '        }); '  + '\n' +
                                                '   }); '  + '\n' +
                                                '    <\/script> '  +
                                                '  </td>  ' ;
                                            html += '  <td class="text-right"><input type="text" name="addimage[' + image_row + '][order]" value="0" placeholder="Сортировка" class="form-control" /></td>';
                                            html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="Удалить" class="btn btn-danger"><i class="voyager-trash"></i></button></td>';


                                            //  '       <input type="hidden" name="banner_image[' + image_row + '][image]" value="" id="input-image' + image_row + '" />' ;
                                            html += '</tr>';

                                            $('#images tbody').append(html);
                                            image_row++;
                                        }
                                        // });
                                    </script>
                                </div>
                            </div>
                            <div id="tab4" class="tab-pane fade">
                                <div class="panel panel-bordered col-lg-12">
                                <!--<div class="panel-body">
                                <div class="form-group @if($dataTypeRows[15]->type == 'hidden') hidden @endif col-md-{{ $display_options->width or 12 }}" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                    {{ $dataTypeRows[15]->slugify }}
                                        <label for="name">{{ $dataTypeRows[15]->display_name }}</label>
                                        {!! app('voyager')->formField($dataTypeRows[15], $dataType, $dataTypeContent) !!}

                                @foreach (app('voyager')->afterFormFields($dataTypeRows[15], $dataType, $dataTypeContent) as $after)
                                    {!! $after->handle($dataTypeRows[15], $dataType, $dataTypeContent) !!}
                                @endforeach
                                        </div>
                                    </div>-->
                                    <div class="panel-body panel-bordered col-lg-12">

                                        @if (isset($dataTypeRows[25])) {{-- product_belongstomany_attribute_relationship --}}
                                        @php

                                            $row = $dataTypeRows[25];
                                            $options = json_decode($row->details);
                                            $display_options = isset($options->display) ? $options->display : NULL;
                                            //$selected_values = isset($dataTypeContent) ? $dataTypeContent->belongsToMany($options->model, $options->pivot_table)->pluck($options->table.'.'.$options->key)->all() : array();
                                            $relationshipOptions = app($options->model)->all();
                                            $relationshipField = $row->field;
                                            $relationshipData = (isset($data)) ? $data : $dataTypeContent;
                                            $selected_values = isset($relationshipData) ? $relationshipData->belongsToMany($options->model, $options->pivot_table)->withPivot('value')->get() : array();
                                            //dd($relationshipData);
                                        @endphp

                                        <div id="table-attr" class="table-editable">
                                            <div id="tab5" class="tab-pane">
                                                <table id="attribute" class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-left">{!! trans('admin.product-attributes') !!}</td>
                                                        <td class="text-left">{!! trans('admin.product-attributes-text') !!}
                                                            <div class="pull-right">
                                                                <div class="btn-group">
                                                                    <!--<button type="button" id="template-view" class="btn btn-default btn-info"><i class="fa fa-th-list"></i> Шаблоны</button>
                                                                    <button type="button" id="values-view" class="btn btn-default"><i class="fa fa-th"></i> Значения</button>-->
                                                                    <button type="button" id="appendAttr" class="btn btn-default"><i class="fa fa-th"></i> Заполнить атрибуты</button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php $r = 0; @endphp
                                                    <?php $attribute_row = 0;  ?>
                                                    <?php foreach ($selected_values as $k => $key) { ?>
                                                    <tr id="attribute-row{{$attribute_row}}">
                                                        <td contenteditable="true">
                                                            @if(isset($options->model) && isset($options->type))
                                                                @if(class_exists($options->model))
                                                                    <select class="attrselect form-control select2 select-{{$r}}" name="{{ $relationshipField }}[{{$k }}][attribute_id]">

                                                                        @foreach($relationshipOptions as $relationshipOption)

                                                                            <option value="{{ $relationshipOption->{$options->key} }}" @if($relationshipOption->{$options->key} === $key->{$options->key}){{ 'selected="selected"' }}@endif>{{ $relationshipOption->{$options->label} }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                @endif
                                                            @endif
                                                        </td>
                                                        <td class="text-left">
                                                            @php
                                                                $key->pivot->value = explode('/',$key->pivot->value);
                                                                $attribvalue = app('\App\Models\Attribute')::i()->getAttributesValue($key->id)->toArray();

                                                            @endphp

                                                            @if ($key->type == 'selectmultilpy')
                                                                <select class="form-control select2" name="{{ $relationshipField }}[{{$k}}][value][]" multiple>
                                                                    @foreach($attribvalue as $aval)
                                                                        <option value="{{$aval->value}}"
                                                                            @if(in_array($aval->value,$key->pivot->value)) {{'selected="selected"' }}
                                                                        @endif>{{$aval->value}}</option>
                                                                    @endforeach
                                                                </select>
                                                            @elseif ($key->type == 'select' )
                                                                <select class="form-control select2" name="{{ $relationshipField }}[{{$k}}][value]">
                                                                    @foreach($attribvalue as $aval)
                                                                        <option value="{{$aval->value}}"
                                                                        @if(in_array($aval->value,$key->pivot->value)) {{'selected="selected"' }}
                                                                                @endif>{{$aval->value}}</option>
                                                                    @endforeach
                                                                </select>
                                                            @else

                                                               <input  class="form-control" name="{{ $relationshipField }}[{{$k}}][value]" value="{{ $key->pivot->value[0] }}">
                                                            @endif
                                                        </td>
                                                        <td class="text-left"><button type="button" onclick="$('#attribute-row<?php echo $attribute_row; ?>').remove(); console.log('#attribute-row<?php echo $attribute_row; ?>');" data-toggle="tooltip" title="Удалить" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                                                    </tr>
                                                    <?php $attribute_row++; ?>
                                                    <?php } ?>
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="2"></td>
                                                        <td class="text-left"><button type="button" onclick="addAttribute();" data-toggle="tooltip" title="{!! trans('admin.button-attribute-add') !!}" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        </div>

                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div id="tab5" class="tab-pane fade">
                                <div class="panel panel-bordered col-lg-12">

                                    @if (isset($dataTypeRows[26])) {{-- concomitant --}}
                                    @php

                                        $row = $dataTypeRows[26];

                                        $options = json_decode($row->details);
                                        $display_options = isset($options->display) ? $options->display : NULL;

                                        $selected_values = isset($dataTypeContent) ? stripslashes($dataTypeContent->{$row->field}) : null;
                                        $selected_values = (json_decode($selected_values));
                                        if(!$selected_values) {
                                            $selected_values = array();
                                        }

                                        $relationshipOptions = app('App\Product')->all();
                                        $relationshipData = (isset($data)) ? $data : $dataTypeContent;
                                        //$selected_values = isset($relationshipData) ? $relationshipData->belongsToMany($options->model, $options->pivot_table)->withPivot('value')->get() : array();
                                       // dd($dataTypeContent->belongsToMany($options->model, $options->pivot_table)->get());
                                        //dd();
                                    @endphp

                                    <div id="tableconcomitant" class="table-editable">
                                        <span class="table-add-concomitant glyphicon glyphicon-plus"></span>
                                        <table class="table">
                                            <tr>
                                                <th>Товар</th>
                                                <th></th>
                                            </tr>
                                            @php $c = 0; @endphp
                                            @if (isset($selected_values))
                                                @foreach($selected_values as $k => $key)
                                                    <tr>
                                                        <td contenteditable="true">
                                                            @if(class_exists('App\Product'))

                                                                <select class="form-control select2 selectconcomitant-{{$r}}" name="{{ $row->field }}[{{$k}}]">

                                                                    @foreach($relationshipOptions as $relationshipOption)
                                                                        <option value="{{ $relationshipOption->id }}" @if($relationshipOption->id == $key){{ 'selected="selected"' }}@endif>{{ $relationshipOption->name }}</option>
                                                                    @endforeach

                                                                </select>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <span class="table-remove glyphicon glyphicon-remove"></span>
                                                        </td>
                                                    </tr>
                                                @php $c++; @endphp
                                            @endforeach
                                        @endif
                                        <!-- This is our clonable table line -->
                                            <tr class="hide">
                                                <td contenteditable="true">
                                                    @if(class_exists('App\Product'))
                                                        <select class="form-control hiddenatr select_new_row_concomitant">
                                                            @foreach($relationshipOptions as $relationshipOption)
                                                                <option value="{{ $relationshipOption->id }}">{{ $relationshipOption->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="table-remove glyphicon glyphicon-remove"></span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <script type="text/javascript">
                                        var $TABLECON = $('#tableconcomitant');
                                        var $rowcon = {{ $c }} ;
                                        var $fieldnamecon = 'concomitant'//'{{ $row->field }}';
                                        // $('select.hiddenatr').select2({
                                        //    width: "100%"
                                        // });
                                        $(document).ready(function() {


                                            $('.table-add-concomitant').click(function () {
                                                var $clone = $TABLECON.find('tr.hide').clone(true).removeClass('hide table-line').addClass('addconcom'+$rowcon);
                                                console.log($clone);
                                                $clone.find('select.select_new_row_concomitant').attr("name",$fieldnamecon+'['+$rowcon+']');
                                                $TABLECON.find('table').append($clone);
                                                $('tr.addconcom'+$rowcon+' select.select_new_row_concomitant').select2({
                                                    width: "100%"
                                                });
                                                $rowcon++;
                                            });

                                            $('.table-remove').click(function () {
                                                $(this).parents('tr').detach();
                                            });

                                            $('.table-up').click(function () {
                                                var $row = $(this).parents('tr');
                                                if ($row.index() === 1) return; // Don't go above the header
                                                $row.prev().before($row.get(0));
                                            });

                                            $('.table-down').click(function () {
                                                var $row = $(this).parents('tr');
                                                $row.next().after($row.get(0));
                                            });
                                        });

                                    </script>
                                    @endif
                                </div>

                            </div>
                            <div id="tab6" class="tab-pane fade">
                                <div class="panel panel-default col-lg-12">

                                    @if (isset($dataTypeRows[27])) {{-- similar --}}
                                    @php

                                        $row = $dataTypeRows[27];

                                        $options = json_decode($row->details);
                                        $display_options = isset($options->display) ? $options->display : NULL;

                                        $selected_values = isset($dataTypeContent) ? stripslashes($dataTypeContent->{$row->field}) : null;
                                        $selected_values = (json_decode($selected_values));
                                        if(!$selected_values) {
                                            $selected_values = array();
                                        }

                                        //$relationshipOptions = app('App\Product')->all();
                                        $relationshipData = (isset($data)) ? $data : $dataTypeContent;
                                        //$selected_values = isset($relationshipData) ? $relationshipData->belongsToMany($options->model, $options->pivot_table)->withPivot('value')->get() : array();
                                       // dd($dataTypeContent->belongsToMany($options->model, $options->pivot_table)->get());
                                    @endphp

                                    <div id="tablesimilar" class="table-editable">
                                        <span class="table-add-similar glyphicon glyphicon-plus"></span>
                                        <table class="table">
                                            <tr>
                                                <th>Товар</th>
                                                <th></th>
                                            </tr>
                                            @php $s = 0; @endphp
                                            @if (isset($selected_values))
                                                @foreach($selected_values as $k => $key)
                                                    <tr>
                                                        <td contenteditable="true">
                                                            @if(class_exists('App\Product'))

                                                                <select class="form-control select2 selectsimilar-{{$r}}" name="{{ $row->field }}[{{$k}}]">

                                                                    @foreach($relationshipOptions as $relationshipOption)
                                                                        <option value="{{ $relationshipOption->id }}" @if($relationshipOption->id == $key){{ 'selected="selected"' }}@endif>{{ $relationshipOption->name }}</option>
                                                                    @endforeach

                                                                </select>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <span class="table-remove glyphicon glyphicon-remove"></span>
                                                        </td>
                                                    </tr>
                                                @php $s++; @endphp
                                            @endforeach
                                        @endif
                                        <!-- This is our clonable table line -->
                                            <tr class="hide">
                                                <td contenteditable="true">
                                                    @if(class_exists('App\Product'))
                                                        <select class="form-control hiddenatr select_new_row_similar">
                                                            @foreach($relationshipOptions as $relationshipOption)
                                                                <option value="{{ $relationshipOption->id }}">{{ $relationshipOption->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="table-remove glyphicon glyphicon-remove"></span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <script type="text/javascript">
                                        var $TABLESIM = $('#tablesimilar');
                                        var $rowsim = {{ $c }} ;
                                        var $fieldnamesim = 'similar'//'{{ $row->field }}';
                                        // $('select.hiddenatr').select2({
                                        //    width: "100%"
                                        // });
                                        $(document).ready(function() {


                                            $('.table-add-similar').click(function () {
                                                var $clone = $TABLESIM.find('tr.hide').clone(true).removeClass('hide table-line').addClass('addsim'+$rowsim);
                                                //console.log($clone);
                                                $clone.find('select.select_new_row_similar').attr("name",$fieldnamesim+'['+$rowsim+']');
                                                $TABLESIM.find('table').append($clone);
                                                $('tr.addsim'+$rowsim+' select.select_new_row_similar').select2({
                                                    width: "100%"
                                                });
                                                $rowsim++;
                                            });

                                            $('.table-remove').click(function () {
                                                $(this).parents('tr').detach();
                                            });

                                            $('.table-up').click(function () {
                                                var $row = $(this).parents('tr');
                                                if ($row.index() === 1) return; // Don't go above the header
                                                $row.prev().before($row.get(0));
                                            });

                                            $('.table-down').click(function () {
                                                var $row = $(this).parents('tr');
                                                $row.next().after($row.get(0));
                                            });
                                        });

                                    </script>
                                    @endif
                                </div>
                        </div>
                        @if($dataTypeContent->exists)
                        <div id="tab7" class="tab-pane fade">
                    <div class="col-lg-6">
                        <div class="panel panel-bordered" style="padding-bottom:5px;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td colspan="3">
                                            <h4>История публикаций</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><b>Дата</b></th>
                                        <th><b>Пользователь</b></th>
                                        <th><b>Примечание</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$edit_info->publication_updated_at}}</td>
                                        <td>{{$edit_info->publication_user}}</td>
                                        <td>{{$edit_info->publication_action}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="panel panel-bordered" style="padding-bottom:5px;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td colspan="2">
                                            <h4>История правок</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><b>Дата</b></th>
                                        <th><b>Пользователь</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$edit_info->editing_updated_at}}</td>
                                        <td>{{$edit_info->editing_user}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="panel panel-bordered" style="padding-bottom:5px;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td colspan="2">
                                            <h4>История описания</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><b>Дата</b></th>
                                        <th><b>Пользователь</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$edit_info->description_updated_at}}</td>
                                        <td>{{$edit_info->description_user}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="panel panel-bordered" style="padding-bottom:5px;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td colspan="3">
                                            <h4>История статуса</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><b>Пользователь</b></th>
                                        <th><b>Установлен статус</b></th>
                                        <th><b>Дата</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$edit_info->status_user}}</td>
                                        <td>{{$edit_info->status}}</td>
                                        <td>{{$edit_info->status_updated_at}}</td>
                                    </tr>
                                    @if(isset($edit_info->status_to_change))
                                        <tr>
                                            <td colspan='2'> Статус будет изменен на "В Наличии"</td>
                                            <td>{{$edit_info->status_to_change}}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                    <div id="tab8" class="tab-pane fade">
                    <div class="col-lg-12">
                        <div class="panel panel-bordered" style="padding-bottom:5px;">
                            <div class="panel-body">
                            @foreach($dataTypeRows as $row)
                                @if($row->field == 'meta_title' ||
                                    $row->field == 'meta_heading' ||
                                    $row->field == 'meta_description' ||
                                    $row->field == 'meta_keywords')
                                
                                <!-- GET THE DISPLAY OPTIONS -->
                                @php
                                    $options = json_decode($row->details);
                                    $display_options = isset($options->display) ? $options->display : NULL;
                                @endphp
                                @if ($options && isset($options->legend) && isset($options->legend->text))
                                    <legend class="text-{{$options->legend->align or 'center'}}" style="background-color: {{$options->legend->bgcolor or '#f0f0f0'}};padding: 5px;">{{$options->legend->text}}</legend>
                                @endif
                                @if ($options && isset($options->formfields_custom))
                                    @include('voyager::formfields.custom.' . $options->formfields_custom)
                                @else
                                    <div class="form-group @if($row->type == 'hidden') hidden @endif col-md-{{ $display_options->width or 12 }}" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                        {{ $row->slugify }}
                                        <label for="name">{{ $row->display_name }}</label>
                                        @include('voyager::multilingual.input-hidden-bread-edit-add')
                                        @if($row->type == 'relationship')
                                            @include('voyager::formfields.relationship')
                                        @else
                                            {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
                                        @endif

                                        @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                                            {!! $after->handle($row, $dataType, $dataTypeContent) !!}
                                        @endforeach
                                    </div>
                                @endif
                                @endif
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endif
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
        //add trade options
        var additional_field = '<table class="table table-hover"><tr><td>Скидка %</td><td colspan="2"><input type="text" name="sale[]" id="sale" class="form-control" placeholder="% скидки" required></td><td><button type="button" id="remove" class="btn btn-danger">Удалить</button></td></tr><tr><td>Количество от</td><td><input type="text" name="quantity[]" id="quantity" class="form-control" placeholder="Количество от" required></td><td><select name="unit[]" id="unit" class="form-control" required><option value="шт.">шт.</option><option value="уп.">уп.</option><option value="кг.">кг.</option><option value="ящ.">ящ.</option></select></td><td>(единицы)</td></tr></table>';

        $(document).ready(function () {
            $('#add').click(function(e) {
                $('.panel-body.dynamic').append(additional_field);
            });
            
            
            $('#add_attributes').click(function (e) {

            })
        });

        $(document).ready(function () {
            $('.panel-body.dynamic').on('click', '#remove', function(e) {
                $(this).parents().eq(3).remove();

            });
        });



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

        /* Submit buttons */
        jQuery(document).ready(function(){
            jQuery('#submit_exit').click(function(e){
               var input = $("<input>")
                    .attr("type", "hidden")
                    .attr("name", "button_type").val("submit_exit");
                $('.form-edit-add').append(input);
            });
        });
        
        jQuery(document).ready(function(){
            jQuery('#submit_read').click(function(e){
               var input = $("<input>")
                    .attr("type", "hidden")
                    .attr("name", "button_type").val("submit_read");
                $('.form-edit-add').append(input);
            });
        });

        jQuery(document).ready(function(){
            jQuery('#submit_add').click(function(e){
               var input = $("<input>")
                    .attr("type", "hidden")
                    .attr("name", "button_type").val("submit_add");
                $('.form-edit-add').append(input);
            });
        });
            

        /*
         $(document).ready(function() {
         var i = 1;
         $('#add').click(function () {
         i++;
         $('#dynamic_field').append('<tr id="row'+i+'"><td>Скидка %</td><td colspan="2"><input type="text" name="sale[]" id="sale"  class="form-control name_list"></td><td><button name="remove" id="'+i+'" class="btn btn-danger btn_remove">Удалить</button></td></tr><tr><td>Количество от</td><td><input type="text" name="quantity[]" id="quantity"  class="form-control name_list"></td><td><input type="text" name="unit[]" id="unit"  class="form-control name_list"></td><td>(единицы)</td></tr>');
         });

         });

         $(document).on('click', '.btn_remove', function() {
         var button_id = $(this).attr("id");
         $("#row"+button_id+"").remove();
         });*/
    </script>




    <script type="text/javascript">

        var attribute_row = <?php echo $attribute_row?>;
        var $row = {!! $dataTypeRows[25] !!};
        var $options = JSON.parse($row['details']);
        var $relationshipOptions = {!! app('App\Models\Attribute')->all()!!};
        var $selected_values = {!! $relationshipData->belongsToMany('App\Models\Attribute', 'product_attributes_pivot')->withPivot('value')->get(); !!}
        console.log($selected_values);
       //  var $selected_values =
                @php

                   // $row = $dataTypeRows[25];
                   // $options = json_decode($row->details);
                  // $display_options = isset($options->display) ? $options->display : NULL;

                  //  $relationshipOptions = app($options->model)->all();
                  //  $relationshipField = $row->field;
                 //   $relationshipData = (isset($data)) ? $data : $dataTypeContent;
                  //  $selected_values = isset($relationshipData) ? $relationshipData->belongsToMany($options->model, $options->pivot_table)->withPivot('value')->get() : array();
                    //dd($relationshipData);
                @endphp

        var product_attribute_id = new Array();
        $('body').on('change', 'input[name=\'product_category[]\'], select[name=\'main_category_id\']', function(e) {
            if($(this).is(":checked") || (this.tagName == "SELECT" && $(this).val() != 0)) {
                newCategory($(this).val())
            }
        });

        function newCategory(category_id) {
            $.ajax({
                url: '/admin/ajax/get-attrib-category',
                data:{term:category_id},
                dataType: 'json',
                success: function(json) {
                    $.each(json, function(key, attribute) {
                        if (!in_array(attribute['attribute_id'],product_attribute_id)) {
                            //console.log(json);
                            var row = attribute_row;
                            addAttribute();
                            $('input[name="product_attribute[' + row + '][name]"]').val(attribute['name']);
                            $('input[name="product_attribute[' + row + '][attribute_id]"]').val(attribute['attribute_id']);
                            addAttributeValues(attribute['attribute_id'], row);
                            addAttributeDuty(attribute['attribute_id'], row);
                            product_attribute_id.push(attribute['attribute_id']);
                        }
                    });
                }
            });

        }
        function in_array(value, array) {
            for(var i = 0; i < array.length; i++) {
                if(array[i] == value) return true;
            }
            return false;
        }

        function addAttributeValues(attribute_id, attribute_row) {
            $.ajax({
                url: '/admin/ajax/get-attrib-values',// +  attribute_id + '&method=' + localStorage.getItem('display_attribute'),
                data:{term:attribute_id},
                dataType: 'json',
                success: function(json) {
                    $.each(json, function(language_id, select) {
                        console.log(json);
                        var textarea = $('textarea[name="product_attribute\[' + attribute_row + '\]\[product_attribute_description\]\[' + language_id + '\]\[text\]"]');
                        $('select[language_id="' + language_id + '"]', textarea.parent()).remove();
                        textarea.before(select);
                        textarea.attr('rows',1);
                    });
                }
            });
        }

        function addAttributeDuty(attribute_id, attribute_row) {
            $.ajax({
                url: '/admin/ajax/get-attrib-values-duty',// +  attribute_id,
                data: {term:attribute_id},
                dataType: 'json',
                success: function(json) {

                    $.each(json, function(language_id, duty) {
                        var textarea = $('textarea[name="product_attribute\[' + attribute_row + '\]\[product_attribute_description\]\[' + language_id + '\]\[text\]"]');
                        textarea.val(duty);
                    });
                }
            });
        }

        $('#attribute tbody').on('change', 'select',function(){

            var select = $(this);
            var textarea_val = select.next('textarea').val();
            textarea_val = (textarea_val == '') ? textarea_val : textarea_val + '/';

            if (localStorage.getItem('display_attribute') == 'template') {
                select.next('textarea').val(select.val());
            } else {
                select.next('textarea').val(textarea_val + select.val());
            }
        });
        $('#attribute tbody').on('change', 'select.attrselect',function() {
            var attribute_row = $(this).closest('tr').attr('id').split('attribute-row')[1];
            //console.log(attribute_row);
            attributeautocomplete(attribute_row);
        });


        if (localStorage.getItem('display_attribute') == 'template') {
            $('#values-view').removeClass('btn-info');
            $('#template-view').addClass('btn-info');
        } else {
            $('#values-view').addClass('btn-info');
            $('#template-view').removeClass('btn-info');
        }

        $('#template-view').click(function() {
            localStorage.setItem('display_attribute', 'template');
            $(this).addClass('btn-info');
            $('#values-view').removeClass('btn-info');
            $('#attribute tbody tr').each(function(index, element) {

                var	attribute_id = $('[name="product_attribute\[' + index + '\]\[attribute_id\]"]').val();
                addAttributeValues(attribute_id, index);
                product_attribute_id.push(attribute_id);


            });
        });

        // Attribute Values
        $('#values-view').click(function() {
            localStorage.setItem('display_attribute', 'values');
            $(this).addClass('btn-info');
            $('#template-view').removeClass('btn-info');
            $('#attribute tbody tr').each(function(index, element) {

                var	attribute_id = $('[name="product_attribute\[' + index + '\]\[attribute_id\]"]').val();
                addAttributeValues(attribute_id, index);
                product_attribute_id.push(attribute_id);

                var	attribute_id = $('[name="product_attribute\[' + index + '\]\[attribute_id\]"]').val();
                addAttributeValues(attribute_id, index);
            });
        });
        //append attributes
        $('#appendAttr').click(function(){
            //newCategory($('[name="main-category_id"]').val());
            //console.log($('[name="main-category_id"]').val());
            category_id = $('[name="main_category_id"]').val()
            product_attribute_id.length = 0;
            console.log('pr='+product_attribute_id.length);
            $('#attribute tbody tr').each(function(index, element) {
                //var	attribute_id = $('[name="product_attribute\[' + index + '\]\[attribute_id\]"]').val();
                var	attribute_id = $(element).find('input[type="hidden"]').val();
                product_attribute_id.push(attribute_id);
            });
            console.log('pr11='+product_attribute_id.length);
            // for
            $.ajax({
                url: '/admin/ajax/get-attrib-category',
                data:{term:category_id},
                dataType: 'json',
                success: function(json) {

                    $.each(json, function(key, attribute) {

                        if (!in_array(attribute['attribute_id'],product_attribute_id)) {
                            console.log('attribute_id='+attribute['attribute_id']);
                            var row = attribute_row;
                            addAttribute();
                            $('input[name="product_attribute[' + row + '][name]"]').val(attribute['name']);
                            $('input[name="product_attribute[' + row + '][attribute_id]"]').val(attribute['attribute_id']);
                            addAttributeValues(attribute['attribute_id'], row);
                            addAttributeDuty(attribute['attribute_id'], row);
                            product_attribute_id.push(attribute['attribute_id']);
                        }

                    });

                }
            });
        });

        function addAttribute() {

            var $r = 0;
           // console.log({{$options}});


                html  = '<tr id="attribute-row'+attribute_row+'"><td contenteditable="true">';
                            html += '<select class="attrselect form-control select2 select-'+attribute_row+'" name="product_belongstomany_attribute_relationship['+attribute_row +'][attribute_id]" multiply>';
                            $relationshipOptions.forEach(function ($relationshipOption) {
                                html += '<option value="'+$relationshipOption.id+'">'+$relationshipOption.name+'</option>';
                            });

                             html += '</select>';

            html += '</td>';
            html += '<td class="text-left">';
            html += '<input  class="form-control" name="{{ $relationshipField }}[{{$k}}][value]" value="">';
            html += '</td>';
            html += '<td class="text-left"><button type="button" onclick="$(\'#attribute-row'+attribute_row+'\').remove(); " data-toggle="tooltip" title="Удалить" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';


            $('#attribute tbody').append(html);

            attributeautocomplete(attribute_row);
            $('#attribute-row'+attribute_row + ' select.attrselect').select2({
                width: "100%",
                tags: true,
                tokenSeparators: [",", " "],
            });
            attribute_row++;
        }

        function attributeautocomplete(attribute_row) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '/admin/get_attributes_id',
                type: 'POST',
                data: {attr_id: $('#attribute-row' + attribute_row + ' select.attrselect').find("option:selected").attr('value'), token: CSRF_TOKEN},
                dataType: 'JSON',
                success: function (data) {

                    if (data.length>0) {
                        if (data[0]['type'] == 'selectmultilpy') {

                            $('#attribute-row' + attribute_row + ' td:nth-child(2)').html('');
                            html = '<select class="attrvalue form-control select2" multiple name="product_belongstomany_attribute_relationship[' + attribute_row + '][value][]">';
                            data.forEach(function ($option) {
                                console.log($option['value']);
                                html += '<option value="' + $option['value'] + '">' + $option['value'] + '</option>';
                            });
                            html += '</select>';
                            $('#attribute-row' + attribute_row + ' td:nth-child(2)').html(html);
                            $('#attribute-row' + attribute_row + ' td:nth-child(2) select.attrvalue').select2({
                                tags: true,
                                width: '100%',
                            });

                        }
                        else if (data[0]['type'] == 'select') {
                            $('#attribute-row' + attribute_row + ' td:nth-child(2)').html('');
                            html = '<select class="attrvalue form-control select2" name="product_belongstomany_attribute_relationship[' + attribute_row + '][value]">';
                            data.forEach(function ($option) {
                                html += '<option value="' + $option['value'] + '">' + $option['value'] + '</option>';
                            });
                            html += '</select>';
                            $('#attribute-row' + attribute_row + ' td:nth-child(2)').html(html);
                            $('#attribute-row' + attribute_row + ' td:nth-child(2) select.attrvalue').select2({
                                tags: false,
                                width: '100%',
                            });
                        } else {
                            html = '<input class="form-control" name="product_belongstomany_attribute_relationship['+attribute_row+'][value]" value="">'
                            $('#attribute-row' + attribute_row + ' td:nth-child(2)').html(html);
                        }
                    }
                }
            });

        }
        $(document).ready(function () {

            $('#attribute tbody tr').each(function(index, element) {

                //var	attribute_id = $('[name="product_attribute\[' + index + '\]\[attribute_id\]"]').val();
                //addAttributeValues(attribute_id, index);
                //product_attribute_id.push(attribute_id);

               // attributeautocomplete(index);

            });
        })


    </script>
@stop