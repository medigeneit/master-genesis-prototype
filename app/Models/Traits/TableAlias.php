<?php
namespace App\Models\Traits;

trait TableAlias{

    
    /**
     * Begin querying the model with table alias.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function queryTableAs($alias)
    {
        $query = (new static);
        if( $alias ) {
            $query->table = $query->getTable(). ' as '.$alias;
        }
        return $query->newQuery();
    }
}