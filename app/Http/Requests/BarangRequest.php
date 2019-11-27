<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class BarangRequest extends FormRequest
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
        $method = $this->method();
        switch ($method) {
            case "GET":
                return [];
                    break;

            case "POST":
                return $this->createRules();
                    break;

            case "PUT":
                return $this->updateRules();
                    break;

            case "PATCH":
                return $this->updateRules();
                    break;

            case "DELETE":
                return [];
                    break;

            default:
                return [];
                    break;

        }
    }

    public function attributes()
    {
        return [
            'kode_barang' => 'Kode Barang',
            'nama_barang' => 'Nama Barang',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute sudah pernah diinput',
            'max' => ':attribute terlalu panjang',
            'min' => ':attribute terlalu pendek'
        ];
    }

    public function createRules()
    {
        $rules = [
            'kode_barang' => 'required|max:50|unique:barang,kode_barang',
            'nama_barang' => 'required',
        ];
        return $rules;
    }

    public function updateRules()
    {
        $rules = [
            'kode_barang' => 'max:50|unique:barang,kode_barang,'.$this->route('id'),
            'nama_barang' => 'required',
        ];
        return $rules;
    }

    /**
     *
     * Custom response struktur array json
     *
     */

    protected function failedValidation(Validator $validator)
    {
        $response = [
            'success' => false,
            'code' => 422,
            'message' => $validator->errors()->all(),
        ];
        throw new HttpResponseException(response()->json($response, 422));
    }
}
