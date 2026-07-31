<?php

namespace App\Repositories;

use App\Models\Slider;

class SliderRepository implements SliderRepositoryInterface
{
    public function all(): mixed
    {
        return Slider::orderBy('created_at', 'desc')->get();
    }

    public function create(array $data): mixed
    {
        return Slider::create($data);
    }

    public function delete(int $id): bool
    {
        $slider = Slider::findOrFail($id);

        if ($slider->image && file_exists(public_path('assets/images/slider/' . $slider->image))) {
            @unlink(public_path('assets/images/slider/' . $slider->image));
        }

        return (bool) $slider->delete();
    }
}
