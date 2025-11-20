<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class StoreJobRequest extends FormRequest
{
    /**
 * @return bool
 * @var \Illuminate\Contracts\Auth\Guard $auth
 */
    public function authorize(): bool
    {
        // Only authenticated users can create/store a job
      
        return Auth::check();
    }
}