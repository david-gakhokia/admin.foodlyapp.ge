<?php

namespace App\Http\Requests\Traits;

trait HandlesTranslatableRules
{
    /**
     * გენერირებს ვალიდაციის წესებს თითოეული ენისთვის ცალკე.
     *
     * @param array $locales ['ka', 'en', 'ru'] ან რომელ ენაზეც გინდა
     * @param array $rules ['name' => 'required|string', 'description' => 'nullable|string']
     * @return array
     */
    protected function translatableRules(array $locales, array $rules): array
    {
        $result = [];

        foreach ($locales as $locale) {
            foreach ($rules as $field => $rule) {
                $result["{$locale}.{$field}"] = $rule;
            }
        }

        return $result;
    }
}
