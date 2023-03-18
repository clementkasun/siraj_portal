<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateGraduateRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'address' => 'required',
            'tel' => 'required|max:10',
            'email' => 'required|email',
            'gender' => 'required|max:6',
            'nic' => 'max:20',
            'dob' => 'required',
            'person_type' => 'required',
            'civil_status' => 'required|max:10',
            'gn_division_id' => 'required',
            'electorate_division_id' => 'required',
            'university_id' => 'max:255',
            'educational_qualification' => 'max:255',
            'nvq_level' => 'max:255',
            'degree_type' => 'max:255',
            'degree' => 'max:255',
            'degree_class' => 'max:255',
            'year' => 'max:255',
            'service_category_id' => 'max:255',
            'nic_image' => 'required|mimes:jpeg,jpg,png|max:3072',
            'nic_image_two' => 'required|mimes:jpeg,jpg,png|max:3072',
            'user_image' => 'mimes:jpeg,jpg,png|image|max:3072',
            'degree_cert' => 'mimes:jpeg,jpg,png|image|max:3072',
        ];
    }

}
