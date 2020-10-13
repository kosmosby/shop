<?php

class installerViewHelper
{
    /**
     * @param null $type
     * @param null $key
     * @return string
     */
    public function getFilters($type = null, $key = null)
    {
        $filters = installerStoreHelper::getFilters();

        if ($type) {
            if (!array_key_exists($type, $filters) || $filters[$type] != $key) {
                $filters[$type] = $key;
            } else {
                unset($filters[$type]);
            }
        }
        if (!$filters) {
            return '';
        }
        ksort($filters);
        return '?'.http_build_query(array('filters' => $filters));
    }
}