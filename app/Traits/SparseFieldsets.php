<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait SparseFieldsets
{
    /**
     * Specify fields that may be requested
     *
     * @return array
     */
    protected function getAvailableFields()
    {
        return isset($this->availableFields) ? $this->availableFields : [];
    }

    /**
     * Specify fields that are not generally available
     *
     * @return array
     */
    protected function getRestrictedFields()
    {
        return isset($this->restrictedFields) ? $this->restrictedFields : [];
    }

    /**
     * Specify fields that are returned by default if no fields parameter is sent
     *
     * @return array
     */
    protected function getDefaultFields()
    {
        return isset($this->defaultFields) ? $this->defaultFields : [];
    }

    /**
     * Specify field names to methods.
     *
     * @return array
     */
    protected function getAvailableFieldsMap()
    {
        return isset($this->availableFieldMap) ? $this->availableFieldMap : [];
    }

    /**
     * Retrieving the resource key for matching to the fields parameter in the request
     * @return mixed
     */
    private function getResourceKey()
    {
        return $this->getCurrentScope()->getResource()->getResourceKey();
    }

    /**
     * Get meta field name.
     *
     * @return mixed
     */
    private function getMetaFieldName()
    {
        return defined('static::META_FIELD_NAME') ? static::META_FIELD_NAME : null;
    }

    /**
     * @param $model
     * @return array
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function getFields($model)
    {
        $invalidFieldNames = [];

        // Always include ID
        $fields = ['id' => (int) $model->id];

        // Get the resource key
        $resourceKey = $this->getMetaFieldName() ?: $this->getResourceKey();

        // Retrieving default fields, can be empty
        $includedFields = $this->getDefaultFields();

        // Retrieving field maps.
        $availableFieldMaps = $this->getAvailableFieldsMap();

        $fieldsParam = 'fields.' . $resourceKey;

        // If there are requested fields, use them, will overwrite the defaults
        if (request()->has($fieldsParam)) {
            $includedFields = explode(',', request()->input('fields.' . $resourceKey));
        }

        $availableFields = $this->getAllowedFields();

        // Building the included fields array
        foreach ($includedFields as $field) {
            if (in_array($field, $availableFields)) {
                if (array_key_exists($field, $availableFieldMaps)) {
                    $methodName = 'field' . Str::studly($field);
                    $key = $this->availableFieldMap[$field];
                    $fields[$key] = $this->{$methodName}($model);
                    continue;
                }

                $fields[$field] = $model->{$field};
                continue;
            }

            $invalidFieldNames[] = $field;
        }

        if (!empty($invalidFieldNames)) {
            return abort(400, 'Requesting invalid fields: ' . implode(', ', $invalidFieldNames));
        }

        // Include meta information from the model
        if (isset($model->meta) && $model->meta) {
            $fields['meta'] = $model->meta;
        }

        return $fields;
    }

    /**
     * If the user is a machine/server, allow access to restricted fields
     *
     * @return array
     */
    private function getAllowedFields()
    {
        return $this->getAvailableFields();
    }
}
