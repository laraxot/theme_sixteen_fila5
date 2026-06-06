        <x-pub_theme::rating 
            name="validation_rating"
            legend="La tua valutazione (obbligatoria)"
            x-model="rating"
            :required="true" />
        
        <div x-show="submitted && rating === 0" class="invalid-feedback d-block">
            Per favore seleziona una valutazione prima di procedere.
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary" @click="submitted = true">
        Invia
    </button>
</form>

Accessibility Features:
- Proper fieldset and legend structure for screen readers
- Descriptive visually-hidden text for each star rating
- ARIA-compliant form controls
- Keyboard navigation support for interactive ratings
- Screen reader announcements for rating changes
- High contrast support with distinct filled/empty states

Bootstrap Italia Integration:
- Uses official rating classes and structure
- Compatible with Bootstrap Italia icon set (it-star-full, it-star-outline)
- Follows PA design system patterns and accessibility guidelines
- Supports all documented variants (with/without labels, readonly)
- Maintains consistency with other form components

Form Integration:
- Standard radio button behavior for form submission
- Compatible with Laravel form validation
- Supports required field validation
- Easy integration with Alpine.js for dynamic behavior
- Standard HTML form submission handling
--}}
