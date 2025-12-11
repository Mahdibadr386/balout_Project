<?php

namespace App\Rules\Option;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Option;

class OptionCategoryMatch implements Rule
{
    protected int $categoryId;
    protected array $invalidOptions = [];

    public function __construct(int $categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function passes($attribute, $value): bool
    {
        if (empty($value)) {
            return true;
        }


        $optionIds = [];
        foreach ($value as $option) {
            if (is_array($option) && isset($option['id'])) {
                $optionIds[] = $option['id'];
            }
        }


        if (empty($optionIds)) {
            return true;
        }

        $options = Option::whereIn('id', $optionIds)->get(['id', 'category_id']);


        foreach ($optionIds as $optionId) {
            $option = $options->firstWhere('id', $optionId);
            if (!$option || $option->category_id != $this->categoryId) {
                $this->invalidOptions[] = $optionId;
            }
        }

        return empty($this->invalidOptions);
    }

    public function message(): string
    {
        if (empty($this->invalidOptions)) {
            return 'یکی از گزینه‌های انتخاب شده با دسته‌بندی محصول همخوانی ندارد.';
        }

        return 'گزینه(های) زیر با دسته‌بندی محصول همخوانی ندارند: ' . implode(', ', $this->invalidOptions);
    }
}
