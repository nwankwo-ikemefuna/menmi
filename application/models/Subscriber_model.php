<?php
defined('BASEPATH') or exit('Direct access to script not allowed');

/**
* @author Nwankwo Ikemefuna.
* Date Created: 31/12/2019
* Date Modified: 31/12/2019
*/

class Subscriber_model extends Core_Model {
    public function __construct() {
        parent::__construct();
    }


    public function sql($company_id) {
        $select = "m.id, m.email, m.phone,".
            full_name_select('m', true, 'subscriber_name');
        $where = ['m.company_id' => $company_id];
        return sql_data(T_SUBSCRIBERS.' m', [], $select, $where);
    }

}