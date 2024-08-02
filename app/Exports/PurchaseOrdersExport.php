<?php

namespace App\Exports;

use App\Models\PurchaseOrder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PurchaseOrdersExport implements FromCollection, WithHeadings {

    /**
     * @return \Illuminate\Support\Collection
     */
    protected $data;

    function __construct($data) {
        $this->data = $data;
    }

    public function collection() {
        $pos=$this->data->get()->toArray();
        return collect($pos);
    }

    public function headings(): array {
        return [
            'Purchase Order',
            'Account Name',
            'Part Number',
            'Description',
        ];
    }

}
