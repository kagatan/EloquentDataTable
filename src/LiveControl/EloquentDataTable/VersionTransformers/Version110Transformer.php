<?php
namespace LiveControl\EloquentDataTable\VersionTransformers;

class Version110Transformer implements VersionTransformerContract
{
    public function transform($name)
    {
        return $name; // we use the same as the requested name
    }

    public function getSearchValue()
    {
        if(isset($_GET['search']) && isset($_GET['search']['value']))
            return $_GET['search']['value'];
        return '';
    }

    public function isColumnSearched($columnIndex)
    {
        return (
            isset($_GET['columns'])
            &&
            isset($_GET['columns'][$columnIndex])
            &&
            isset($_GET['columns'][$columnIndex]['search'])
            &&
            isset($_GET['columns'][$columnIndex]['search']['value'])
            &&
            $_GET['columns'][$columnIndex]['search']['value'] != ''
        );
    }

    public function getColumnSearchValue($columnIndex)
    {
        return $_GET['columns'][$columnIndex]['search']['value'];
    }

    public function isOrdered()
    {
        return (isset($_GET['order']) && isset($_GET['order'][0]));
    }

    public function getOrderedColumns()
    {
        $columns = [];
        foreach($_GET['order'] as $i => $order)
        {
            $columns[(int) $order['column']] = ($order['dir'] == 'asc' ? 'asc' : 'desc');
        }
        return $columns;
    }
}
