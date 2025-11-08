<?php

namespace App\Livewire\Public;

use App\Livewire\DataTable;
use App\Models\FundDocument;
use App\Traits\WithSearch;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;

class DocumentSearchTable extends DataTable
{
    use WithSearch;

    public $tableView = 'livewire.public.document-search-table';

    public string $sortBy = 'fund_name';

    public string $sortDir = 'DESC';

    public string $tableName = 'document-search-table';

    public function mount(): void
    {
        $locale = App::currentLocale();
        $this->filters = [
            'fund_documents.fund_id' => '=', 'funds.fund_type_id' => '=',
            'fund_documents.document_type_id' => '=',
        ];


    }

    public function tableQuery(): Builder
    {
        $query = FundDocument::query()
            ->with(['fund', 'documentType'])
            ->join('funds', 'funds.id', '=', 'fund_documents.fund_id')
            ->join('document_types', 'document_types.id', '=', 'fund_documents.document_type_id')
            ->select('fund_documents.*', 'funds.name as fund_name', 'document_types.document_type_name as document_type_name');

        return $this->applySearch($query);

    }
}
