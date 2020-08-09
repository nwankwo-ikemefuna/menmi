<?php
$headers = ['Subscriber Name', 'Email', 'Phone No.'];
ajax_table('subscribers_table', $this->c_controller.'/data_ajax', $headers, [], ['updated' => false]);