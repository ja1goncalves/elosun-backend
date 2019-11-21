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

    'accepted' => ':attribute deve ser aceito.',
    'active_url' => ':attribute não é uma URL válida.',
    'after' => ':attribute deve ser uma data depois de :date.',
    'alpha' => ':attribute deve conter somente letras.',
    'alpha_dash' => ':attribute deve conter letras, números e traços.',
    'alpha_num' => ':attribute deve conter somente letras e números.',
    'array' => ':attribute deve ser um array.',
    'before' => ':attribute deve ser uma data antes de :date.',
    'between' => [
        'numeric' => ':attribute deve estar entre :min e :max.',
        'file' => ':attribute deve estar entre :min e :max kilobytes.',
        'string' => ':attribute deve estar entre :min e :max caracteres.',
        'array' => ':attribute deve ter entre :min e :max itens.',
    ],
    'boolean' => ':attribute deve ser verdadeiro ou falso.',
    'confirmed' => 'A confirmação de :attribute não confere.',
    'date' => ':attribute não é uma data válida.',
    'date_format' => ':attribute não confere com o formato :format.',
    'different' => ':attribute e :other devem ser diferentes.',
    'digits' => ':attribute deve ter :digits dígitos.',
    'digits_between' => ':attribute deve ter entre :min e :max dígitos.',
    'email' => ':attribute deve ser um endereço de e-mail válido.',
    'exists' => 'O :attribute selecionado é inválido.',
    'cached_exists' => 'O :attribute selecionado é inválido.',
    'filled' => ':attribute é um campo obrigatório.',
    'image' => ':attribute deve ser uma imagem.',
    'in' => ':attribute é inválido.',
    'integer' => ':attribute deve ser um inteiro.',
    'ip' => ':attribute deve ser um endereço IP válido.',
    'json' => ':attribute deve ser um JSON válido.',
    'max' => [
        'numeric' => ':attribute não deve ser maior que :max.',
        'file' => ':attribute não deve ter mais que :max kilobytes.',
        'string' => ':attribute não deve ter mais que :max caracteres.',
        'array' => ':attribute não pode ter mais que :max itens.',
    ],
    'mimes' => ':attribute deve ser um arquivo do tipo: :values.',
    'min' => [
        'numeric' => ':attribute deve ser no mínimo :min.',
        'file' => ':attribute deve ter no mínimo :min kilobytes.',
        'string' => ':attribute deve ter no mínimo :min caracteres.',
        'array' => ':attribute deve ter no mínimo :min itens.',
    ],
    'not_in' => 'O :attribute selecionado é inválido.',
    'numeric' => ':attribute deve ser um número.',
    'regex' => 'O formato de :attribute é inválido.',
    'required' => 'O campo :attribute é obrigatório.',
    'required_if' => 'O campo :attribute é obrigatório quando :other é :value.',
    'required_with' => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_with_all' => 'O campo :attribute é obrigatório quando :values estão presentes.',
    'required_without' => 'O campo :attribute é obrigatório quando :values não está presente.',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum destes estão presentes: :values.',
    'same' => ':attribute e :other devem ser iguais.',
    'size' => [
        'numeric' => ':attribute deve ser :size.',
        'file' => ':attribute deve ter :size kilobytes.',
        'string' => ':attribute deve ter :size caracteres.',
        'array' => ':attribute deve conter :size itens.',
    ],
    'string' => ':attribute deve ser uma string',
    'timezone' => ':attribute deve ser uma timezone válida.',
    'unique' => ':attribute já está em uso.',
    'url' => 'O formato de :attribute é inválido.',

    'greater_or_equal' => 'The :attribute must be greater or equal to the initial date.',

    'newer_or_equal' => 'O :attribute deve ser mais recente.',
    'older_or_equal' => 'O :attribute deve ser mais velho.',

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
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'adults'                => 'Adultos',
        'adults.*.name'         => 'Nome do adulto',
        'adults.*.surname'      => 'Sobrenome do adulto',
        'adults.*.birthday'     => 'Aniversário do adulto',
        'adults.*.email'        => 'Email do adulto',
        'adults.*.cpf'          => 'Cpf do adulto',
        'adults.*.phone'        => 'Telefone do adulto',
        'adults.*.gender'       => 'Gênero do adulto',
        'adults.*.baggage_departure' => 'Bagagem de ida do adulto',
        'adults.*.baggage_return'    => 'Bagagem de retorno do adulto',
        'name'                  => 'Nome',
        'surname'               => 'Sobrenome',
        'type'                  => 'Tipo',
        'fullname'              => 'Nome',
        'email'                 => 'E-Mail',
        'email_2'               => 'Segundo e-mail',
        'password'              => 'Senha',
        'phone'                 => 'Telefone',
        'phone_2'               => 'Segundo telefone',
        'phone_3'               => 'Terceiro telefone',
        'code'                  => 'Código',
        'title'                 => 'Título',
        'description'           => 'Descrição',
        'observation'           => 'Observação',
        'display_name'          => 'Nome de exibição',
        'search_limit'          => 'Limite de Busca',
        'roles_id'              => 'Grupos/Papéis',
        'users_id'              => 'Usuários',
        'companies_id'          => 'Companhia',
        'subtitle'              => 'Nome',
        'country'               => 'País',
        'city'                  => 'Cidade',
        'initials'              => 'Iniciais',
        'group'                 => 'Grupo',
        'value'                 => 'Valor',
        'category'              => 'Categoria',
        'connection'            => 'Conexão',
        'program'               => 'Programa',
        'image'                 => 'Imagem',
        'groups_id'             => 'Grupo',
        'payment'               => 'Tipo de pagamento',
        'card_number'           => 'Numero do cartão',
        'expiration_date'       => 'Data de expiração',
        'securityCode'          => 'Código de segurança',
        'reference'             => 'Referência',
        'file_type'             => 'Tipo de arquivo',
        'cpf'                   => 'CPF',
        'cpf_cnpj'              => 'CPF ou CNPJ',
        'addresses'     =>  [
            'street'            => 'Logradouro',
            'neighborhood'      => 'Bairro',
            'city'              => 'Cidade',
            'region'            => 'Regional',
            'zip_code'          => 'CEP',
            'state'             => 'Estado',
            'number'            => 'Número',
        ],
        'zip_code'              => 'CEP',
        'address'               => 'Endereço',
        'state'                 => 'Estado',
        'neighborhood'          => 'Bairro',
        'company'               => 'Empresa',
        'comment'               => 'Comentário',
        'quotation'             => 'cotação',
        'birthday'              => 'Data de nascimento',
        'cellphone'             => 'Celular',
        'restriction'           => 'Restrição',
        'quotation_status_id'   => 'Status da cotação',
        'occupation'            => 'Ocupação',
        'gender'                => 'Sexo',
        'bank_id'               => 'Banco',
        'provider_id'           => 'Fornecedor',
        'agency'                => 'Agência',
        'account'               => 'Conta',
        'account_digit'         => 'Dígito da conta',
        'agency_digit'          => 'Dígito da agência',
        'main'                  => 'Titular',
    ],

];
