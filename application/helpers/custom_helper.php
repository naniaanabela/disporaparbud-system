<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('is_login')) {
	function is_login() {
		$ci =& get_instance();

		if($ci->session->has_userdata('logged_in')) {
			return true;
		} else {
			return false;
		}
	}
}

if(!function_exists('get_cluster_name')) {
  function get_cluster_name($cluster) {
    return str_replace('w', 'Cluster ', $cluster);
  }
}