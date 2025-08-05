# City Module Documentation

## 1. Models

### City
- **Fields:**  
  - `id`: Primary key  
  - `slug`: Unique identifier for URL  
  - `rank`: Display order  
  - `image`: Uploaded image URL  
  - `image_link`: External image URL  
  - `status`: City status (`active`, `inactive`, `maintenance`)  
  - `created_at`, `updated_at`: Timestamps
- **Features:**  
  - Uses `Astrotomic\Translatable` for multilingual fields.
  - Has constants and helper methods for status labels/colors.
  - Relationships:  
    - `translations`: All language versions  
    - `restaurants`: (optional, for future extension)

### CityTranslation
- **Fields:**  
  - `id`: Primary key  
  - `city_id`: Foreign key to `cities`  
  - `locale`: Language code  
  - `name`: City name in given language  
  - `description`: Description in given language  
  - `meta_title`, `meta_description`, `meta_keywords`: SEO fields  
  - `created_at`, `updated_at`: Timestamps
- **Features:**  
  - Unique per city/locale.
  - Used for all multilingual content.

---

## 2. Requests

### StoreCityRequest / UpdateCityRequest
- **Validation:**
  - `slug`: unique, max 255 chars, optional
  - `status`: required, must be one of allowed values
  - `rank`: optional, integer, min 1
  - `image_file`: optional, must be image, max 4MB
  - `image_link`: optional, string, max 255 chars
  - For each locale:
    - `name`: required for default locale, optional for others
    - `description`, `meta_title`, `meta_description`, `meta_keywords`: optional, max length
- **Custom attributes/messages:**  
  - Human-readable field names for errors.
  - Custom error for slug uniqueness and required name.

- **Data Handling:**  
  - `validatedData()` returns only validated fields, excludes file uploads.

---

## 3. Controller

### CityController
- **index:**  
  - Lists cities, supports search/filter/sort, paginates results.
- **create:**  
  - Shows form for new city.
- **store:**  
  - Validates and saves new city and translations.
  - Handles image upload via CloudinaryService.
  - Auto-generates slug if empty.
  - Uses DB transaction for safety.
- **show:**  
  - Displays city details, all translations, images.
- **edit:**  
  - Shows edit form with current data.
- **update:**  
  - Validates and updates city and translations.
  - Handles image replacement and deletion.
  - Uses DB transaction for safety.
- **destroy:**  
  - Deletes city and related translations/images.
- **deleteImage:**  
  - Deletes only the image from Cloudinary and DB.

---

## 4. Routes

- **CRUD:**  
  ```php
  Route::resource('cities', CityController::class)
      ->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);
  ```
- **Image delete:**  
  ```php
  Route::delete('cities/{city}/image', [CityController::class, 'deleteImage'])
      ->name('cities.image.delete');
  ```
- **City-Restaurant:**  
  - Prepared for future, currently commented.

---

## 5. Blade Views

- **index.blade.php:**  
  - Table of cities, search/filter, pagination, action buttons.
- **create.blade.php / edit.blade.php:**  
  - Form with multilingual tabs, meta fields, image upload, status/rank.
  - Uses shared `form.blade.php`.
- **form.blade.php:**  
  - All input fields, tabs for languages, error handling, submit/cancel.
- **show.blade.php:**  
  - Displays all city info, translations, images, meta fields, action buttons.

---

## 6. Migrations

- **cities table:**  
  - All main fields, unique slug, status, rank, image fields.
- **city_translations table:**  
  - Foreign key to cities, locale, name, description, meta fields.
  - Unique constraint on city_id + locale.

---

## 7. Services

- **SlugService:**  
  - Generates unique slugs from name.
- **RankService:**  
  - Assigns rank if not provided.
- **CloudinaryService:**  
  - Uploads and deletes images from Cloudinary.

---

## Usage Steps (Expanded)

1. **Create migrations and migrate database.**
   - Run `php artisan make:migration ...` for both tables.
   - Add all required fields and constraints.
   - Run `php artisan migrate`.

2. **Implement models and relationships.**
   - Create City and CityTranslation models.
   - Add fillable fields, translatedAttributes, relationships.

3. **Create request classes for validation.**
   - StoreCityRequest and UpdateCityRequest with all rules, attributes, messages.

4. **Build CityController with all CRUD logic.**
   - Implement all methods, use services, handle translations and images.

5. **Define routes in `web.php`.**
   - Add resource and image delete routes.
   - Comment future restaurant routes if not needed yet.

6. **Create Blade views for admin panel.**
   - Scaffold index, create, edit, show, and shared form views.
   - Use Tailwind for UI, tabs for languages.

7. **Test all CRUD operations and translations.**
   - Add, edit, delete cities in all languages.
   - Test image upload and deletion.
   - Check validation and error messages.

8. **Document any custom logic or business rules.**
   - Note any special requirements (e.g. slug auto-generation, rank logic, image handling).

---

## Notes

- All forms and views support multiple languages via config.
- SEO meta fields are included for each translation.
- Image can be uploaded or linked via URL.
- Status and rank fields allow flexible city management.
- Easily extendable for future features (e.g. restaurants per city).
- Uses transactions for safe data changes.
- Custom error messages for better UX.

---

## Example Workflow

1. **Admin visits "Cities" in panel.**
2. **Clicks "Add City", fills out form in multiple languages, uploads image.**
3. **City is saved, translations and image handled automatically.**
4. **Admin can edit, view, or delete city.**
5. **All changes reflected in multilingual frontend.**

---

## Troubleshooting

- **Slug uniqueness error:**  
  - Make sure Rule::unique()->ignore(ID) is used in UpdateCityRequest.
- **Image upload fails:**  
  - Check Cloudinary credentials and file size/type.
- **Translations not saving:**  
  - Ensure all locales are present in config and form.

---

## Extending

- Add restaurant management per city.
- Add more SEO fields or custom attributes.
- Integrate with API