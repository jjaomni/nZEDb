<?php
require dirname(__FILE__) . '/../../www/config.php';

if (nZEDb_RELEASE_SEARCH_TYPE != ReleaseSearch::SPHINX) {
	exit('Error, nZEDb_RELEASE_SEARCH_TYPE in www/settings.php must be set to SPHINX!' . PHP_EOL);
}

if (!isset($argv[1]) || !isset($argv[2]) || !is_numeric($argv[2])) {
	exit('Argument 1 must the hostname or IP to the Sphinx searchd server, Argument 2 must be the port to the Sphinx searchd server.' . PHP_EOL);
}

$pdo = new nzedb\db\DB();

$pdo->queryExec('DROP TABLE IF EXISTS releases_se');

$query =
sprintf(
"CREATE TABLE releases_se
(
	id          BIGINT UNSIGNED NOT NULL,
	weight      INTEGER NOT NULL,
	query       VARCHAR(3072) NOT NULL,
	guid        VARCHAR(40) NOT NULL,
	name        VARCHAR(255) NOT NULL DEFAULT '',
	searchname  VARCHAR(255) NOT NULL DEFAULT '',
	fromname    VARCHAR(255) NULL,
	INDEX(query)
) ENGINE=SPHINX CONNECTION=\"sphinx://%s:%d/releases_rt\"",
$argv[1], $argv[2]
);

if ($pdo->queryExec($query)) {
	echo 'The releases_se table was successfully created!' . PHP_EOL;
} else {
	echo 'ERROR: An error occurred during the creation of the releases_se table, you can turn on logging/debugging in settings.php to view this error.' . PHP_EOL;
}