<div class="form-input {{ $css }} @error($id) is-invalid @enderror">
  <label for="form-link-{{ $id }}" class="">{{ $title }}</label>
  <select type="{{ $type }}" required id="form-link-{{ $id }}" name="{{ $id }}" selected="{{ old($id) ?: $defaultValue }}" class="input" style="padding-top: 0.65em; padding-bottom: 0.65em;">
    <option value="null">Please select an option...</option>
    @foreach ($options as $option)
    <option value="{{ $option->id }}" @if($option->id == old($id)) selected='selected' @endif >{{ $option->name }}</option>
    @endforeach
  </select>
  @error($id)
  <small class="text-red-600">{{ $message }}</small>
  @enderror
</div>