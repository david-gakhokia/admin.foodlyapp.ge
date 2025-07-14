<?php

namespace App\Livewire\Admin\Cuisines;

use App\Models\Cuisine;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public ?Cuisine $cuisine = null;

    public array $name = [];
    public array $description = [];
    public array $meta_title = [];
    public array $meta_desc = [];

    public string $slug = '';
    public string $status = 'active';
    public int $rank = 0;

    public $image;
    public ?string $existingImage = null;

    public array $locales = [];
    public string $fallbackLocale = 'ka';

    public function mount(?Cuisine $cuisine = null)
    {
        $this->locales = config('app.locales');
        $this->fallbackLocale = config('app.fallback_locale', 'ka');

        $this->cuisine = $cuisine;

        if ($cuisine) {
            $this->name         = $this->getTranslatedValue('name');
            $this->description  = $this->getTranslatedValue('description');
            $this->meta_title   = $this->getTranslatedValue('meta_title');
            $this->meta_desc    = $this->getTranslatedValue('meta_desc');

            $this->slug         = $cuisine->slug;
            $this->rank         = $cuisine->rank;
            $this->status       = $cuisine->status;
            $this->existingImage = $cuisine->image;
        }
    }

    public function getTranslatedValue(string $key): array
    {
        $values = [];
        foreach ($this->locales as $locale) {
            $values[$locale] = $this->cuisine?->translate($locale)?->{$key} ?? '';
        }
        return $values;
    }

    public function updated($property): void
    {
        if ($property === 'name.' . $this->fallbackLocale && !$this->cuisine) {
            $this->slug = Str::slug($this->name[$this->fallbackLocale]);
        }
    }

    public function render()
    {
        return view('livewire.admin.cuisines.form');
    }
}
