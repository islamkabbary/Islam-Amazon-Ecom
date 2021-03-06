<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChatRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST': {
                    return [
                        'reciver_id' => 'integer|exists:stores,id',
                        'message' => 'required_without:file',
                        'file' => 'required_without:message',
                    ];
                }

            case 'GET':
            case 'DELETE': {
                    return [];
                }
            default:
                break;
        }
    }
}
