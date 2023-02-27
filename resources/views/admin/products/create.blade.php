@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.product.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.products.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.product.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="categories">{{ trans('cruds.product.fields.category') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}" name="categories[]" id="categories" multiple>
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ in_array($id, old('categories', [])) ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('categories'))
                    <div class="invalid-feedback">
                        {{ $errors->first('categories') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="etalase_id">{{ trans('cruds.product.fields.etalase') }}</label>
                <select class="form-control select2 {{ $errors->has('etalase') ? 'is-invalid' : '' }}" name="etalase_id" id="etalase_id">
                    @foreach($etalases as $id => $entry)
                        <option value="{{ $id }}" {{ old('etalase_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('etalase'))
                    <div class="invalid-feedback">
                        {{ $errors->first('etalase') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.etalase_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.product.fields.condition') }}</label>
                @foreach(App\Models\Product::CONDITION_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('condition') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="condition_{{ $key }}" name="condition" value="{{ $key }}" {{ old('condition', 'new') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="condition_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('condition'))
                    <div class="invalid-feedback">
                        {{ $errors->first('condition') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.condition_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.product.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="price">{{ trans('cruds.product.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', '') }}" step="0.01" required>
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tags">{{ trans('cruds.product.fields.tag') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                    @foreach($tags as $id => $tag)
                        <option value="{{ $id }}" {{ in_array($id, old('tags', [])) ? 'selected' : '' }}>{{ $tag }}</option>
                    @endforeach
                </select>
                @if($errors->has('tags'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tags') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.tag_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photo">{{ trans('cruds.product.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="video_product">{{ trans('cruds.product.fields.video_product') }}</label>
                <input class="form-control {{ $errors->has('video_product') ? 'is-invalid' : '' }}" type="text" name="video_product" id="video_product" value="{{ old('video_product', '') }}">
                @if($errors->has('video_product'))
                    <div class="invalid-feedback">
                        {{ $errors->first('video_product') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.video_product_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.product.fields.status_product') }}</label>
                @foreach(App\Models\Product::STATUS_PRODUCT_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('status_product') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="status_product_{{ $key }}" name="status_product" value="{{ $key }}" {{ old('status_product', 'active') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="status_product_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('status_product'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status_product') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.status_product_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="stock">{{ trans('cruds.product.fields.stock') }}</label>
                <input class="form-control {{ $errors->has('stock') ? 'is-invalid' : '' }}" type="number" name="stock" id="stock" value="{{ old('stock', '') }}" step="1">
                @if($errors->has('stock'))
                    <div class="invalid-feedback">
                        {{ $errors->first('stock') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.stock_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sku">{{ trans('cruds.product.fields.sku') }}</label>
                <input class="form-control {{ $errors->has('sku') ? 'is-invalid' : '' }}" type="text" name="sku" id="sku" value="{{ old('sku', '') }}">
                @if($errors->has('sku'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sku') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.sku_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="minimum_order">{{ trans('cruds.product.fields.minimum_order') }}</label>
                <input class="form-control {{ $errors->has('minimum_order') ? 'is-invalid' : '' }}" type="number" name="minimum_order" id="minimum_order" value="{{ old('minimum_order', '') }}" step="1">
                @if($errors->has('minimum_order'))
                    <div class="invalid-feedback">
                        {{ $errors->first('minimum_order') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.minimum_order_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="unit_price">{{ trans('cruds.product.fields.unit_price') }}</label>
                <input class="form-control {{ $errors->has('unit_price') ? 'is-invalid' : '' }}" type="number" name="unit_price" id="unit_price" value="{{ old('unit_price', '') }}" step="0.01">
                @if($errors->has('unit_price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('unit_price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.unit_price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="wholesale_price">{{ trans('cruds.product.fields.wholesale_price') }}</label>
                <input class="form-control {{ $errors->has('wholesale_price') ? 'is-invalid' : '' }}" type="number" name="wholesale_price" id="wholesale_price" value="{{ old('wholesale_price', '') }}" step="0.01">
                @if($errors->has('wholesale_price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('wholesale_price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.wholesale_price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="weight">{{ trans('cruds.product.fields.weight') }}</label>
                <input class="form-control {{ $errors->has('weight') ? 'is-invalid' : '' }}" type="number" name="weight" id="weight" value="{{ old('weight', '') }}" step="0.01">
                @if($errors->has('weight'))
                    <div class="invalid-feedback">
                        {{ $errors->first('weight') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.weight_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="long">{{ trans('cruds.product.fields.long') }}</label>
                <input class="form-control {{ $errors->has('long') ? 'is-invalid' : '' }}" type="number" name="long" id="long" value="{{ old('long', '') }}" step="0.01">
                @if($errors->has('long'))
                    <div class="invalid-feedback">
                        {{ $errors->first('long') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.long_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="width">{{ trans('cruds.product.fields.width') }}</label>
                <input class="form-control {{ $errors->has('width') ? 'is-invalid' : '' }}" type="number" name="width" id="width" value="{{ old('width', '') }}" step="0.01">
                @if($errors->has('width'))
                    <div class="invalid-feedback">
                        {{ $errors->first('width') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.width_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="height">{{ trans('cruds.product.fields.height') }}</label>
                <input class="form-control {{ $errors->has('height') ? 'is-invalid' : '' }}" type="number" name="height" id="height" value="{{ old('height', '') }}" step="0.01">
                @if($errors->has('height'))
                    <div class="invalid-feedback">
                        {{ $errors->first('height') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.height_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.product.fields.insurance') }}</label>
                @foreach(App\Models\Product::INSURANCE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('insurance') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="insurance_{{ $key }}" name="insurance" value="{{ $key }}" {{ old('insurance', 'optional') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="insurance_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('insurance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('insurance') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.insurance_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.product.fields.pre_order') }}</label>
                <select class="form-control {{ $errors->has('pre_order') ? 'is-invalid' : '' }}" name="pre_order" id="pre_order">
                    <option value disabled {{ old('pre_order', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Product::PRE_ORDER_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('pre_order', 'active') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('pre_order'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pre_order') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.pre_order_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    var uploadedPhotoMap = {}
Dropzone.options.photoDropzone = {
    url: '{{ route('admin.products.storeMedia') }}',
    maxFilesize: 9, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 9,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="photo[]" value="' + response.name + '">')
      uploadedPhotoMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPhotoMap[file.name]
      }
      $('form').find('input[name="photo[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($product) && $product->photo)
      var files = {!! json_encode($product->photo) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="photo[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}

</script>
@endsection
