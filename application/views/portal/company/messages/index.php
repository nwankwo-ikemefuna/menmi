<?php
$headers = ['Sender Name', 'Email', 'Phone No.'];
ajax_table('messages_table', $this->c_controller.'/data_ajax', $headers, [], ['updated' => false]);