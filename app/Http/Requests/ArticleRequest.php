<?php

namespace Corp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::user()->canDo('ADD_ARTICLES');
    }

    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();
               
        $validator->sometimes('alias','unique:alias|max:255', function($input) {
            
            if($this->route()->hasParameter('alias')) {
                $model = $this->route()->parameter('alias');
                
                return ($model->alias !== $input->alias)  && !empty($input->alias);
            }

            return !empty($input->alias);
            
        });
        
        return $validator;
    }   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title_en'=>'required|max:255',
            'text_en'=>'required',
            'title_uz'=>'required|max:255',
            'text_uz'=>'required',
            'title_ru'=>'required|max:255',
            'text_ru'=>'required'
        ];
    }
}
