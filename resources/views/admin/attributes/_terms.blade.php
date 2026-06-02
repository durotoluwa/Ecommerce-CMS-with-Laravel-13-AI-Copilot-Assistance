<div class="d-flex flex-wrap term-list">
    @foreach($attribute->terms as $term)
        <div class="form-check me-3">
            <input class="form-check-input"
                   type="checkbox"
                   name="attribute_terms[{{ $attribute->id }}][]"
                   value="{{ $term->id }}"
                   id="term-{{ $term->id }}">
            <label class="form-check-label" for="term-{{ $term->id }}">
                {{ $term->name }}
            </label>
        </div>
    @endforeach
</div>
