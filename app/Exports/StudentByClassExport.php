<?php

namespace App\Exports;

use App\Models\Student;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StudentByClassExport implements FromView
{
    protected $class_id;

    public function __construct($class_id) {
        $this->class_id = $class_id;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {

        // $data['list_exports'] = Student::where('class_id', $this->class_id)->get();
        $exports = Student::select('hint_password', 'id_card', 'fullname_kh', 'fullname_en', 'birth_date')->where('class_id', $this->class_id);
        return view('backend.exports.studentExport', [
            'list_exports' => $exports->get(),
        ]);
    }
}
