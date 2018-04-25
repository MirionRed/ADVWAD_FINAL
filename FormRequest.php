<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\MembershipNo;

class FormRequest extends FormRequest
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
          'membership' => [
            'required',
            'unique:customers',
            'regex:/ˆ([A-Z]{3})([0-9]{7})$/'
          ],
          'name' => 'required|max:100',
          'address' => 'required|max:500',
          'state' => 'required',
        ];
    }
}

class UploadFormRequest extends FormRequest{
  public function authorize(){
    return true;
  }
  public function rules(){
    return [
      'image' => 'required|image|mimes:jpeg|max:2000',
    ];
  }
}
