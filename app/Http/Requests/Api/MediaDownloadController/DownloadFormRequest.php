<?php

namespace App\Http\Requests\Api\MediaDownloadController;

use App\Enums\MediaFormat;
use App\Rules\SupportedSocialNetworkUrl;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DownloadFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "url" => ["required", "url", new SupportedSocialNetworkUrl()],
            "format" => ["required", Rule::enum(MediaFormat::class)],
        ];
    }
}
