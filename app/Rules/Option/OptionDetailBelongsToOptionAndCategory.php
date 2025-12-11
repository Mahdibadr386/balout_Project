<?php

namespace App\Rules\Option;

use App\Models\OptionDetail;
use Illuminate\Contracts\Validation\Rule;

class OptionDetailBelongsToOptionAndCategory implements Rule
{
    protected array $invalidDetails = [];

    public function passes($attribute, $value): bool
    {

        $parts = explode('.', $attribute);
        $index = $parts[1] ?? null;
        if ($index === null) return false;

        $optionId = request()->input("options.$index.id");
        if (!$optionId) return false;


        $detailIds = is_array($value) ? $value : [$value];


        foreach ($detailIds as $detailId) {
            $exists = OptionDetail::where('id', $detailId)
                ->where('option_id', $optionId)
                ->exists();

            if (!$exists) {
                $this->invalidDetails[] = $detailId;
            }
        }

        return empty($this->invalidDetails);
    }

    public function message(): string
    {
        if (empty($this->invalidDetails)) {
            return 'جزئیات انتخاب‌شده با گزینه انتخابی مطابقت ندارد.';
        }

        return 'جزئیات نامعتبر برای گزینه انتخاب شده: ' . implode(', ', $this->invalidDetails);
    }
}

