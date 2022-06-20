<?php
declare(strict_types=1);


interface iDBfunctions {
        public function get(); 
        public function getAll();
        public function where();
        public function delete();
        public function showQuery();
        public function update(Array $values);
        public function whereOr();
        public function select(Array $fieldList=null);
        public function from($table);
        public function table($tablename);
        public function insert(Array $values);
}