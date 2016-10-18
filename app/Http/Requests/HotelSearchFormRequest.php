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
            'region.name.required' => 'The destination is missing or invalid.'
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
        if (($this->ajax() && ! $this->pjax()) || $this->wantsJson()) {
            return new JsonResponse($errors, 422);
        }

        unset($errors['region.id']);
        unset($errors['region.airport_code']);

        return $this->redirector->to($this->getRedirectUrl())
                                        ->withInput($this->except($this->dontFlash))
                                        ->withErrors($errors, $this->errorBag);
    }
}
