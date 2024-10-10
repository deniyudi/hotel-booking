<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'photo' => ['required', 'image', 'mimes:jpeg,png,jpg'],
            'total_people' => ['required', 'integer'],
            'price' => ['required', 'integer'],
            'facilities' => ['required', 'array'],
            'facilities.*' => ['exists:hotel_facilities,id', 'distinct'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama kamar harus diisi.',
            'photo.required' => 'Foto kamar harus diunggah.',
            'photo.image' => 'File yang diunggah harus berupa gambar.',
            'total_people.required' => 'Jumlah orang harus diisi.',
            'price.required' => 'Harga kamar harus diisi.',
            'facilities.required' => 'Silakan pilih setidaknya satu fasilitas.',
            'facilities.*.exists' => 'Fasilitas yang dipilih tidak valid.',
            'facilities.*.distinct' => 'Fasilitas tidak boleh duplikat.',
        ];
    }
}
