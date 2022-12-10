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

    'accepted' => ' :attribute қабылдануы керек.',
    'accepted_if' => ' :attribute қабылдану керек, егер басқасы тең:value.',
    'active_url' => ' :attribute жарамсыз URL.',
    'after' => ' :attribute т келесі күн болуы керек :күн.',
    'after_or_equal' => ' :attribute кейін немесе оған тең күн болуы керек: күн.',
    'alpha' => ' :attribute тек әріптер болуы керек..',
    'alpha_dash' => ' :attributeтек әріптер болуы керек.',
    'alpha_num' => ' :attribute тек әріптер мен сандарды қамтуы керек.',
    'array' => ' :attribute массив болуы керек.',
    'before' => ' :attribute күні болуы керек: күні.',
    'before_or_equal' => ' :attribute күн бұрын немесе оған тең болуы керек: күн.',
    'between' => [
        'array' => ' :attribute min-ден :max-қа дейінгі элементтерді қамтуы керек.',
        'file' => ' :attribute min-ден :Max килобайтқа дейін болуы керек.',
        'numeric' => ' :attribute арасында болуы керек :min және: max.',
        'string' => ' :attribute арасында болуы керек :min және: Max таңбалар.',
    ],
    'boolean' => ' :attribute өрісте атрибут шын немесе жалған болуы керек..',
    'confirmed' => ' :attribute трибуттарды растауға сәйкес келмейді.',
    'current_password' => 'Сіз құпиясөзді қате енгіздіңіз!',
    'date' => ' :attribute жарамды күн емес.',
    'date_equals' => ' :attribute күн: күнге тең болуы керек.',
    'date_format' => ' :attribute форматқа сәйкес келмейді: формат.',
    'declined' => ' :attribute қабылданбауы керек.',
    'declined_if' => ' :attribute басқа: мәнге тең болған кезде қабылданбауы керек.',
    'different' => ' :attribute және: басқа әр түрлі болуы керек.',
    'digits' => ' :attribute болуы керек: digits сандар..',
    'digits_between' => ' :attribute арасында болуы керек :минималды және: максималды сандар',
    'dimensions' => ' :attribute жарамсыз кескін өлшемдері бар.',
    'distinct' => ' :attribute атрибут өрісі: қайталанатын мәнге ие.',
    'doesnt_end_with' => ' :attribute келесі мәндердің бірімен аяқталмауы мүмкін.',
    'doesnt_start_with' => ' :attribute келесі мәндердің біреуінен басталмауы мүмкін.',
    'email' => ' :attribute Сіз e-mail мекен-жайыңызды қате жаздыңыз',
    'ends_with' => ' :attribute келесі мәндердің бірімен аяқталуы керек.',
    'enum' => ' selected :attribute таңдалған: атрибут жарамсыз.',
    'exists' => ' selected :attribute таңдалған: атрибут жарамсыз.',
    'file' => ' :attribute m Атрибут файл болуы керек.',
    'filled' => ' :attribute атрибут маңызды болуы керек.',
    'gt' => [
        'array' => ' :attribute көп элементтерден тұруы керек :value items.',
        'file' => ' :attribute мәннен үлкен болуы керек: килобайт.',
        'numeric' => ' :attribute мәннен үлкен болуы керек.',
        'string' => ' :attribute артық болуы керек :мән таңбалары.',
    ],
    'gte' => [
        'array' => ' :attribute құрамында болуы керек: мән элементтері немесе одан көп.',
        'file' => ' :attribute үлкен немесе тең болуы керек: килобайт мәні.',
        'numeric' => ' :attribute мәннен үлкен немесе оған тең болуы керек .',
        'string' => ' :attribute таңбалардан үлкен немесе тең болуы керек: мән.',
    ],
    'image' => ' :attribute сурет болуы керек..',
    'in' => ' selected :attribute таңдалған атрибут: жарамсыз',
    'in_array' => ' :attribute field does not exist in :other.',
    'integer' => ' :attributeбүтін сан болуы керек.',
    'ip' => ' :attribute жарамды IP мекенжайы болуы керек.',
    'ipv4' => ' :attribute жарамды IPv4 мекенжайы болуы керек.',
    'ipv6' => ' :attribute жарамды IPv6 мекенжайы болуы керек.',
    'json' => ' :attribute жарамды JSON жолы болуы керек.',
    'lt' => [
        'array' => ' :attribute элементтері аз болуы керек: мәні.',
        'file' => ' :attribute мәннен аз болуы керек: килобайт.',
        'numeric' => ' :attribute келесі мәннен аз болуы керек.',
        'string' => ' :attribute кішірек болуы керек: мән таңбалары..',
    ],
    'lte' => [
        'array' => ' :attribute артық элементтер болмауы керек: мән.',
        'file' => ' :attribute мәннен аз немесе оған тең болуы керек: килобайт.',
        'numeric' => ' :attribute кем немесе тең болуы керек: мәні.',
        'string' => ' :attribute аңбалардан аз немесе оған тең болуы керек :мәндер.',
    ],
    'mac_address' => ' :attribute жарамды MAC мекенжайы болуы керек.',
    'max' => [
        'array' => ' :attribute артық болмауы керек: max элементтер.',
        'file' => ' :attribute mаспауы керек: max килобайт.',
        'numeric' => ' :attribute аспауы керек :max.',
        'string' => ' :attribute аспауы керек: max таңбалар.',
    ],
    'max_digits' => ' :attribute артық болмауы керек: max сандар.',
    'mimes' => ' :attribute  values файл түрі болуы керек',
    'mimetypes' => ' :attribute файл түрі болуы керек.',
    'min' => [
        'array' => ' :attribute кем дегенде болуы керек: минималды элементтер.',
        'file' => ' :attribute кем дегенде болуы керек :min килобайт.',
        'numeric' => ' :attribute кем емес болуы керек: min.',
        'string' => ' :attribute  кем дегенде болуы керек: минималды таңбалар.',
    ],
    'min_digits' => ' :attribute кем дегенде болуы керек: минималды сандар.',
    'multiple_of' => ' :attribute еселік болуы керек: мәні.',
    'not_in' => ' selected :attribute таңдалған атрибут: жарамсыз',
    'not_regex' => ' :attribute атрибут пішімі: жарамсыз.',
    'numeric' => ' :attribute Атрибут: сан болуы керек',
    'password' => [
        'letters' => ' :attribute кемінде бір әріп болуы қажет.',
        'mixed' => ' :attribute кем дегенде бір кіші және үлкен әріп болуы қажет.',
        'numbers' => ' :attribute құрамында кем дегенде бір сан болуы қажет.',
        'symbols' => ' :attribute құрамында тым болмағанда бір таңба болуы шарт',
        'uncompromised' => ' given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'present' => ' :attribute өріс: атрибут болуы керек.',
    'prohibited' => ' :attribute field is prohibited.',
    'prohibited_if' => ' :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => ' :attribute field is prohibited unless :other is in :values.',
    'prohibits' => ' :attribute field prohibits :other from being present.',
    'regex' => ' :attribute format is invalid.',
    'required' => ' :attribute таңдалуы міндетті.',
    'required_array_keys' => ' :attribute field must contain entries for: :values.',
    'required_if' => ' :attribute field is required when :other is :value.',
    'required_if_accepted' => ' :attribute field is required when :other is accepted.',
    'required_unless' => ' :attribute field is required unless :other is in :values.',
    'required_with' => ' :attribute field is required when :values is present.',
    'required_with_all' => ' :attribute field is required when :values are present.',
    'required_without' => ' :attribute field is required when :values is not present.',
    'required_without_all' => ' :attribute field is required when none of :values are present.',
    'same' => ' :attribute and :other must match.',
    'size' => [
        'array' => ' :attribute құрамында болуы керек: өлшем элементтері.',
        'file' => ' :attribute болуы керек: килобайт мөлшері.',
        'numeric' => ' :attribute болуы керек: өлшемі.',
        'string' => ' :attribute болуы керек: таңбалардың өлшемі.',
    ],
    'starts_with' => 'The :attribute келесі мәндердің бірінен басталуы керек: :мәндер.',
    'string' => ' :attribute жол болуы керек.',
    'timezone' => ' :attribute жарамды уақыт белдеуі болуы керек.',
    'unique' => ' :attribute қазірдің өзінде қабылданды.',
    'uploaded' => ' :attribute жүктеу мүмкін болмады.',
    'url' => ' :attribute жарамды URL болуы керек.',
    'uuid' => ':attribute жарамды UUID болуы керек.',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
