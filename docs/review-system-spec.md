# 📘 FOODLY Review System – Technical Specification (v1.0)

## 🔹 Purpose

Implement a flexible **review & rating system** for authenticated users, applicable to multiple model types:

- Restaurant
- Place (restaurant space/zone)
- Table
- Menu Category
- Menu Item

---

## ✅ MVP Scope

### 1. Database Structure

Create a single `reviews` table with a polymorphic relation:

```php
Schema::create('reviews', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('user_id');
    $table->morphs('reviewable'); // reviewable_id + reviewable_type
    $table->unsignedTinyInteger('rating'); // 1 to 5
    $table->text('comment')->nullable();
    $table->boolean('is_public')->default(true);
    $table->timestamps();

    $table->unique(['user_id', 'reviewable_id', 'reviewable_type']);
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
});
```

---

### 2. Eloquent Model: `Review.php`

```php
class Review extends Model
{
    protected $fillable = ['user_id', 'rating', 'comment', 'is_public'];

    public function reviewable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

---

### 3. Add `reviews()` to Reviewable Models

In `Restaurant`, `Place`, `Table`, `MenuCategory`, and `MenuItem` models:

```php
public function reviews()
{
    return $this->morphMany(Review::class, 'reviewable');
}
```

---

### 4. Routing

```php
Route::middleware('auth')->group(function () {
    Route::post('/reviews/{type}/{id}', [ReviewController::class, 'store'])->name('reviews.store');
});
```

> Examples:
> - POST `/reviews/menu-item/42`
> - POST `/reviews/restaurant/7`

---

### 5. ReviewController Logic

- Map `type` string to model class:
```php
$map = [
    'restaurant' => \App\Models\Restaurant::class,
    'place' => \App\Models\Place::class,
    'table' => \App\Models\Table::class,
    'menu-category' => \App\Models\MenuCategory::class,
    'menu-item' => \App\Models\MenuItem::class,
];
```

- Validate input: `rating` required, `comment` optional  
- Prevent duplicate reviews (update instead if exists)  
- Save review and return success response

---

### 6. Frontend UI Behavior

- Show **average rating** and **total review count**
```php
$avg = $model->reviews()->avg('rating');
$count = $model->reviews()->count();
```

- Show latest 5–10 public reviews  
- Display user’s own review with edit option

---

## 🔐 Validation & Rules

| Rule | Description |
|------|-------------|
| Auth required | Only logged-in users can review |
| One review per user per item | Enforced by unique index |
| Optional: block self-review | e.g. restaurant owner cannot rate own listing |
| Comment field optional | Rating is always required |
| Only public reviews are displayed | Admin can moderate in future |

---

## 🧪 Testing Checklist

| Test Case | Expected Result |
|-----------|-----------------|
| Guest tries to review | ❌ Unauthorized |
| Auth user reviews item once | ✅ Created |
| User updates review | ✅ Updated |
| Public reviews show avg/count | ✅ |
| Admin can view all reviews | ✅ |
| Same user can't review twice | ✅ |

---

## 📁 Affected Files

| File | Description |
|------|-------------|
| `database/migrations/xxxx_create_reviews.php` | Migration for reviews table |
| `app/Models/Review.php` | Review model |
| `ReviewController.php` | Controller |
| `routes/web.php` or `api.php` | Routing definition |
| `resources/views/...` | Optional UI rendering |
| `ReviewRequest.php` (optional) | Form validation class |
| `User.php`, `Restaurant.php`, etc. | Add `reviews()` relation |

---

## 🧱 Future Enhancements (v2+)

- Admin moderation (`approved_at`)
- Admin or restaurant reply to review
- Review reactions (👍👎)
- Review tags or categories (e.g. service, ambiance)
- Photo attachments to reviews
- Push/email notification to restaurant owner

---

## ✅ Summary

- Single reviews table with polymorphic link  
- One review per user per item  
- Display ratings, comments, statistics  
- Future-ready architecture