<?php

namespace BTAL\XYZ\ABC\Http\Controllers;

use App\Http\Controllers\Controller;

class ABCController extends Controller
{
    protected $blackListedInsertUpdateColumns  =   ['id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by'];
    protected $specialInsertUpdateColumns      =   ['sequence_number'];

    protected function processHistoryColumns($columns, $identifier)
    {
        $historyColumns =   [];

        foreach ($columns as $column)
        {
            if ($column !== 'id')
            {
                $historyColumns[$column]   =   $column;
                continue;
            }

            //$historyColumns["{$identifier}_id"]     =   $column;
            $historyColumns['source_id']   =   $column;
        }

        return $historyColumns;
    }

    protected function processMutableColumns($columns)
    {
        $mutableColumns    =   [];

        foreach ($columns as $column)
        {
            if (in_array($column, $this->blackListedInsertUpdateColumns) || in_array($column, $this->specialInsertUpdateColumns))
            {
                continue;
            }

            $mutableColumns[]  =   $column;
        }

        return $mutableColumns;
    }

    protected function prepareColumnsMap($entity)
    {
        $allColumns         =   $entity->getTableColumns();

        $columns            =   [];

        foreach ($allColumns as $column)
        {
            if (in_array($column, $this->blackListedInsertUpdateColumns))
            {
                continue;
            }

            $viewColumnName =   '';
            $columnSegments =   explode('_', $column);

            foreach ($columnSegments as $columnSegment)
            {
                $columnSegment  =   \ucfirst($columnSegment);
                $viewColumnName .=  "{$columnSegment} ";
            }

            $viewColumnName     =   trim($viewColumnName);

            $columns[$column]   =   $viewColumnName;
        }

        return $columns;
    }
}
