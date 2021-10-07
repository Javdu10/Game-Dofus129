<?php

namespace Azuriom\Plugin\Dofus129\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Schema;

class HasColumn implements Rule
{
    protected $tableName;
    protected $connection;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $tableName, string $connection)
    {
        $this->tableName = $tableName;
        $this->connection = $connection;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Schema::connection($this->connection)->hasColumn($this->tableName, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The column doesn't exits in the table: {$this->tableName}";
    }
}
