<?php
/*
 * this is a list of functions that are accessible from view templates
 */

/**
 * sanitize input for html
 * @param string $s
 * @return string
 */
function escape($s)
{
	return htmlspecialchars($s);
}

/**
 * echo sanitized html
 * @param string $s
 */
function echosafe($s)
{
	echo escape($s);
}