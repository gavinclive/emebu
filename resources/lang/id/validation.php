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
    'unique' => ':attribute telah diambil',
    'accepted' => ':attribute harus diterima',
    'active_url' => ':attribute bukan meruapakn URL yang sah',
    'after' => ':attribute harus merupakan tanggal setelah atau sama dengan :date',
    'alpha' => ':attribute hanya boleh mengandung unsur tulisan',
    'alpha_dash' => ':attribute hanya boleh mengandung unsur tulisan, angka, garis hubung dan garis bawah',
    'alpha_num' => ':attribute hanya boleh mengandung unsur tulisan dan angka',
    'array' => ':attribute harus merupakan array',
    'before' => ':attribute harus merupakan tanggal sebelum atau sama dengan :date',
    'between' => [
        'numeric' => ':attribute harus di antara :min dan :max',
        'file' => ':attribute harus di antara :min dan :max KB',
        'string' => ':attribute harus di antara :min dan :max karakter',
        'array' => ':attribute harus di antara :min dan :max butir',
    ],
    'boolean' => ':attribute harus berupa true atau false',
    'confirmed' => 'Konfirmasi :attribute tidak cocok',
    'date' => ':attribute bukan merupakan tanggal yang sah',
    'date_equals' => ':attribute harus merupakan tanggal yang sama dengan :format',
    'date_format' => ':attribute harus menggunakan pola yang sama dengan :format',
    'different' => ':attribute harus berbeda dengan :other',
    'digits' => ':attribute harus berjumlah :digits angka',
    'digits_between' => ':attribute harus berjumlah di antara :min dan :max angka',
    'dimensions' => ':attribute memiliki dimensi gambar yang tidak sah',
    'distinct' => ':attribute memiki nilai duplikat',
    'email' => ':attribute harus merupakan alamat surel yang sah',
    'filled' => ':attribute harus memiliki nilai',
    'exists' => ':attribute tidak sah',
    'image' => ':attribute harus berupa gambar (jpeg, png, bmp atau gif)',
    'in' => ':attribute tidak sah',
    'integer' => ':attribute harus merupkan bilangan bulat',
    'ip' => ':attribute harus merupakan alamat IP yang sah',
    'max' => [
        'numeric' => ':attribute tidak boleh lebih besar dari :max',
        'file' => ':attribute tidak boleh lebih besar dari :max KB',
        'string' => ':attribute tidak boleh lebih besar dari :max karakter',
        'array' => ':attribute tidak boleh lebih besar dari :max butir',
    ],
    'mimes' => ':attribute harus berupa berkas berjenis :values',
    'mimetypes' => ':attribute harus berupa berkas berjenis :values.',
    'min' => [
        'numeric' => ':attribute tidak boleh lebih kecil dari :min',
        'string' => ':attribute tidak boleh lebih kecil dari :min karakter',
        'file' => ':attribute tidak boleh lebih kecil dari :min KB',
        'array' => ':attribute tidak boleh lebih kecil dari :min butir',
    ],
    'not_in' => ':attribute yang terpilih tidak sah',
    'numeric' => ':attribute harus merupakan angka',
    'regex' => 'Pola :attribute tidak sah',
    'required' => ':attribute diperlukan',
    'required_if' => ':attribute diperlukan ketika :other merupakan :value',
    'required_with' => ':attribute diperlukan ketika :values ada',
    'required_with_all' => ':attribute dipelrukan ketika :values ada semua',
    'required_without' => ':attribute diperlukan ketika :values tidak ada',
    'required_without_all' => ':attribute diperlukan ketika :values tidak ada semua',
    'same' => ':attribute dan :other harus sama',
    'size' => [
        'numeric' => ':attribute harus merupakan :size',
        'file' => ':attribute harus berukuran :size KB',
        'string' => ':attribute harus sepanjang :size karakter',
        'array' => ':attribute harus berisi :size butir',
    ],
    'url' => ':attribute tidak sah',
    'timezone' => ':attribute harus merupakan zona waktu yang sah',
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
    'custom' => [],
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
    'attributes' => [],
];
