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

                <div class="panel panel-bordered">
                    <!-- form start -->
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

                            @foreach($dataTypeRows as $row)
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
                            @endforeach

                            <!--start main form-->
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"><i class="fa fa-pencil"></i> {!! trans('admin.text-edit') !!}</h3>
                                            </div>
                                            <div class="panel-body">
                                                <form action="" method="post" enctype="multipart/form-data" id="form-banner" class="form-horizontal">
                                                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="banner_id" id="banner_id" value="{{$banner['banner_id']}}">
                                                    <div class="form-group required">
                                                        <label class="col-sm-2 control-label" for="input-name">{!! trans('admin.entry_name') !!}</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="name" value="{{$banner['name']}}" placeholder="{{ trans('admin.entry_name') }}" id="input-name" class="form-control" />
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="input-status">{{ trans('admin.entry_status') }}</label>
                                                        <div class="col-sm-10">
                                                            <select name="status" id="input-status" class="form-control">
                                                                <?php if ($banner['status']) { ?>
                                                                <option value="1" selected="selected">{{ trans('admin.enabled') }}</option>
                                                                <option value="0">{{ trans('admin.disabled') }}</option>
                                                                <?php } else { ?>
                                                                <option value="1">{{ trans('admin.enabled') }}</option>
                                                                <option value="0" selected="selected">{{ trans('admin.disabled') }}</option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <table id="images" class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                        <tr>
                                                            <td class="text-left">{{ trans('admin.entry_title') }}</td>
                                                            <td class="text-left" style="min-width: 40%;">{{ trans('admin.entry_link') }}</td>
                                                            <td class="text-left">{{ trans('admin.entry_image') }}</td>
                                                            <td class="text-left">Тип</td>
                                                            <td class="text-right">{{ trans('admin.entry_sort_order') }}</td>
                                                            <td></td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $image_row = 0; ?>
                                                        <?php foreach ($banner['banner_images'] as $banner_image) { ?>
                                                        <tr id="image-row<?php echo $image_row; ?>">
                                                            <td class="text-left">
                                                                <?php foreach (get_available_languages_data() as $language) { ?>
                                                                <div class="input-group pull-left"><span class="input-group-addon"><img src="{!! get_image_url('/uploads/flags/') . $language['lang_name']!!}.png" title="<?php echo $language['lang_name']; ?>" /> </span>
                                                                    <input type="text" name="banner_image[<?php echo $image_row; ?>][banner_image_description][<?php echo $language['id']; ?>][title]" value="<?php echo isset($banner_image['banner_image_description'][$language['id']]) ? $banner_image['banner_image_description'][$language['id']]['title'] : ''; ?>" placeholder="{{ trans('admin.entry_title') }}" class="form-control" />
                                                                </div>
                                                                <?php } ?>
                                                            </td>
                                                            <td class="text-left" style="width: 30%;">
                                                                <div class="form-group">
                                                                    @foreach($banner['banner_position'] as $key => $pos)
                                                                        <div class="col-md-10">
                                                                            <input type="text" name="banner_image[<?php echo $image_row; ?>][banner_link_position][{{$key}}][link]" value="<?php echo isset($banner_image['banner_link_position'][$key]) ? $banner_image['banner_link_position'][$key]['link'] : ''; ?>" placeholder="{{ trans('admin.entry_link') }}" class="form-control" />
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <span style="font-size: 10px;">{{$pos}}</span>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </td>
                                                            <td class="text-left">
                                                                <a href="" id="thumb-image<?php echo $image_row; ?>" data-toggle="image" class="img-thumbnail">
                                                                    <img id="thumb<?php echo $image_row; ?>" src="<?php echo $banner_image['thumb']; ?>" alt="" title="" data-placeholder="" />
                                                                </a>
                                                                <a id="lfm<?php echo $image_row; ?>" data-input="input-image<?php echo $image_row; ?>" data-preview="thumb<?php echo $image_row; ?>" class="btn btn-primary">
                                                                    <i class="fa fa-picture-o"></i> Choose
                                                                </a>
                                                                <div data-toggle="modal" data-dropzone_id="upload<?php echo $image_row; ?>" data-target="#productUploader<?php echo $image_row; ?>" class="btn btn-primary"><i class="fa fa-picture"></i>Upload Image</div>

                                                                <div class="modal fade" id="productUploader<?php echo $image_row; ?>" tabindex="-1" role="dialog" aria-labelledby="updater" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">✕</button>
                                                                                <br>
                                                                                <i class="icon-credit-card icon-7x"></i>
                                                                                <p class="no-margin">{!! trans('admin.you_can_upload_1_image') !!}</p>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="uploadform dropzone no-margin dz-clickable eb_dropzone_file_upload<?php echo $image_row; ?>" id="eb_dropzone_file_upload<?php echo $image_row; ?>" name="eb_dropzone_file_upload<?php echo $image_row; ?>">
                                                                                    <div class="dz-default dz-message">
                                                                                        <span>{!! trans('admin.drop_your_cover_picture_here') !!}</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-default attachtopost" data-dismiss="modal">{!! trans('admin.close') !!}</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <script>
                                                                    $(document).ready(function () {
                                                                        var banner_id  = 0;
                                                                        if ($('#banner_id').length > 0)
                                                                        {
                                                                            productdir = '/ban_'+$('#banner_id').val();
                                                                            product_id = $('#banner_id').val();
                                                                        }
                                                                        $('#lfm<?php echo $image_row; ?>').filemanager('image',{'id':product_id});
                                                                        var baseUrl = $('#hf_base_url').val();
                                                                        var token = $('meta[name="csrf-token"]').attr('content');
                                                                        var productdir = '';
                                                                        var id = <?php echo $image_row; ?>;

                                                                        new MyCustomDropZone({
                                                                            base_url: baseUrl,
                                                                            url: baseUrl + '/upload/product-related-image',// + productdir,
                                                                            token: token,
                                                                            id: id,
                                                                            product_id: banner_id,
                                                                            uploader: 'eb_dropzone_file_upload<?php echo $image_row; ?>',
                                                                            //paramName: 'input-image<?php echo $image_row; ?>',
                                                                            paramName: 'product_image',
                                                                            acceptedFiles: "image/*",
                                                                            uploadMultiple: false,
                                                                            maxFiles: 1
                                                                        });
                                                                    })
                                                                </script>
                                                                <input type="hidden" name="banner_image[<?php echo $image_row; ?>][image]" value="<?php echo $banner_image['image']; ?>" id="input-image<?php echo $image_row; ?>" /></td>
                                                            <td class="text-left">
                                                                <select name="banner_image[<?php echo $image_row; ?>][type]" class="form-control" id="input-type">
                                                                    <option value="">Выберите тип</option>
                                                                    @foreach($banner['banner_types'] as $type)
                                                                        @if ($banner_image['type'] == $type)
                                                                            <option value="{{$type}}" selected="selected">{{$type}}</option>
                                                                        @else
                                                                            <option value="{{$type}}">{{$type}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td class="text-right" style="width: 10%;"><input type="text" name="banner_image[<?php echo $image_row; ?>][sort_order]" value="<?php echo $banner_image['sort_order']; ?>" placeholder="{{ trans('admin.entry_sort_order')}}" class="form-control" /></td>
                                                            <td class="text-left"><button type="button" onclick="$('#image-row<?php echo $image_row; ?>, .tooltip').remove();" data-toggle="tooltip" title="{{ trans('admin.button_remove')}}" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                                                        </tr>
                                                        <?php $image_row++; ?>
                                                        <?php } ?>
                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <td colspan="4"></td>
                                                            <td class="text-left"><button type="button" onclick="addImage();" data-toggle="tooltip" title="{{ trans('admin.button_banner_add')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- end main form -->

                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
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
