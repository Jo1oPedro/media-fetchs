<?php

namespace App\View\Components\Inputs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputPassword extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $id = "password",
        public bool $showLabel = true,
        public string $label = "Password",
        public string $inputPlaceholder = "Enter your password",
        public string $inputId = "password",
        public string $inputName = "password",
        public string $errorBag = "password"
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.inputs.input-password');
    }
}
