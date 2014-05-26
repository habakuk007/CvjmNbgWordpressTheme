<?php

class Landheim_Database
{
	var $link;
  var $index;

	function OpenDatabase()
	{
		$this->link = new wpdb("web446", "upP7H6j7", "usr_web446_3", "db1.sysproserver.de") or die("Keine Verbindung m&ouml;glich!");
    $this->link->show_errors();
	}

	function DoQuery($query)
	{
    $this->index = 0;
    $result = $this->link->get_results( $query, ARRAY_A );
		return $result;
	}

	function FetchAssoc($result)
	{
    if (array_key_exists($this->index, $result)) {
      return $result[$this->index++];
    }
		return false;
	}

	function FreeResult($result)
	{
	}

	function rewind_data($result)
	{
		$this->index = 0;
		return true;
	}
}
?>