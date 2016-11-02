<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class HotelSearchFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'region.id' => 'required',
            'region.name' => 'required',
            'region.airport_code' => 'required',
            'checkin_date' => 'required',
            'checkout_date' => 'required'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'checkin_date.required' => 'The check in date is required.',
            'checkout_date.required' => 'The check out date is required.',
            'region.name.required' => 'The destination is required.'
        ];
    }

    /**
     * Get the proper failed validation response for the request.
     *
     * @param  array  $errors
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function response(array $errors)
    {
        // Check if the region was provided but id or airport code is missing
        if (!array_key_exists('region.name', $errors) &&
            (array_key_exists('region.id', $errors) || array_key_exists('region.airport_code', $errors))
        ) {
            $errors['region.name'] = 'We didn\'t understand your destination, please select from suggestions that appear when typing.';
        }

        // Don't wanna show these errors
        unset($errors['region.id']);
        unset($errors['region.airport_code']);

        if (($this->ajax() && ! $this->pjax()) || $this->wantsJson()) {
            return new JsonResponse($errors, 422);
        }

        return $this->redirector->to($this->getRedirectUrl())
                                        ->withInput($this->except($this->dontFlash))
                                        ->withErrors($errors, $this->errorBag);
    }
}
