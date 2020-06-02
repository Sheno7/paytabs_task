<?php


class Category extends \CodeIgniter\Model
{
    protected $table      = 'categories';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';

    protected $allowedFields = ['name', 'parent_id'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';

}