<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'The :attribute must be accepted.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => ':attributeは:date以降の日付を指定してください',
    'after_or_equal' => ':attributeは:date以降を選択してください。.',
    'alpha' => 'The :attribute may only contain letters.',
    'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute may only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'パスワードが一致していません.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => ':attributeは:digits桁で入力してください',
    'digits_between' => ':attributeは:min桁以上、:max桁以内で入力してください',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => ':attribute は有効なEメールアドレスを入力してください.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => '選択された:attributeは正しくありません。',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => ':attributeは半角数字で入力してください',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => ':attributeは:max字以内で入力してください',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => ':attribute は :min 字以上で入力してください.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => ':attributeは半角数字で入力してください',
    'present' => 'The :attribute field must be present.',
    'regex' => ':attributeを正しく入力してください',
    'required' => ':attributeは必須項目です。',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => ':attributeは必須項目です。',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'すでに登録されている:attributeです。',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],

        // 'email' => [
        //     'required' => 'メールアドレスを入力してください',
        // ],
        // 'password' => [
        //     'required' => 'パスワードを入力してください',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [

        'name' => '名前',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'department' => '担当',
        'zip_code' => '郵便番号',
        // 'zip_code_front' => '郵便番号',
        // 'zip_code_back' => '郵便番号',
        'prefecture' => '都道府県',
        'city' => '市区町村',
        'street' => '番地',
        'building' => '建物名称',

        'company_user_id' => '担当者',
        // 会社
        'company_name' => '会社名',
        'representive_name' => '会社名',
        'address_prefecture' => '都道府県',
        'address_city' => '市区町村・番地',
        'tel' => '電話番号',

        // 担当者
        'tel' => '電話番号',
        'tel' => '電話番号',
        
        // パートナー
        'occupations' => '職種',
        'introduction' => 'プロフィールメッセージ',
        'address_building' => '建物名',
        'financial_institution' => '金融機関',
        'branch' => '支店',
        'deposit_type' => '預金種類',
        'account_number' => '口座番号',

        // project
        'project_id'      => 'プロジェクト',
        'superior_id'      => '上長',
        'accounting_id'      => '経理',

        // task
        'task_name'       => 'タスク名',
        'task_content'    => 'タスク内容',
        'started_at'      => '開始日',
        'ended_at'        => '終了日',
        'status'          => 'ステータス',
        'budget'          => '予算',
        'price'           => '金額',
        'cases'           => '件数',
        'fee_format'      => '報酬形式',
        'payment_terms'   => '支払い条件',
        'partner_id'      => 'パートナー',
        'project_name'    => 'プロジェクト名',
        'project_detail'  => 'プロジェクト詳細',

        // doucment 作成
        'task_id'              => 'タスク',
        'task_ended_at'        => '納品日',
        'task_delivery_format' => '納品場所',
        'requested_at'         => '請求日',
        'deadline_at'          => '支払い期限',
        'tax'                  => '消費税',

        // setting
        'approval_setting'   => '上長、経理による書類・タスクの承認',
        'income_tax_setting' => '請求書の源泉所得税の有無',
        'remind_setting'     => 'リマインド設定',
    ],

];
