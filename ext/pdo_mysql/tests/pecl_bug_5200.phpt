--TEST--
PDO MySQL PECL Bug #5200 (Describe table gives unexpected result mysql and type enum)
--EXTENSIONS--
pdo
pdo_mysql
--SKIPIF--
<?php
require __DIR__ . '/config.inc';
require __DIR__ . '/../../../ext/pdo/tests/pdo_test.inc';
PDOTest::skip();
?>
--FILE--
<?php
require __DIR__ . '/../../../ext/pdo/tests/pdo_test.inc';
$db = PDOTest::test_factory(__DIR__. '/common.phpt');

$db->exec("CREATE TABLE test_pecl_bug_5200 (bar INT NOT NULL, phase enum('please_select', 'I', 'II', 'IIa', 'IIb', 'III', 'IV'))");

foreach ($db->query('DESCRIBE test_pecl_bug_5200 phase')->fetchAll(PDO::FETCH_ASSOC) as $row) {
    print_r($row);
}
?>
--CLEAN--
<?php
require __DIR__ . '/mysql_pdo_test.inc';
MySQLPDOTest::dropTestTable(NULL, 'test_pecl_bug_5200');
?>
--EXPECT--
Array
(
    [field] => phase
    [type] => enum('please_select','I','II','IIa','IIb','III','IV')
    [null] => YES
    [key] => 
    [default] => 
    [extra] => 
)
