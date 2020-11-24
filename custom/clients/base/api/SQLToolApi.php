<?php
/*
 * This file is part of the 'Wonka_magic_chewing_gum'.
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *     http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * Author: Oli Nepomiachty SugarCRM
 */
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
 
 
class SQLToolApi extends SugarApi
{
    public function registerApiRest()
    {
        return array(
             'ExeSQLQueryEndpoint' => array(
                //request type
                'reqType' => 'GET',
                //endpoint path
                'path' => array('exeSqlQuery'),
                //endpoint variables
                'pathVars' => array('', '', 'data'),
                //method to call
                'method' => 'exeSqlQuery',
                //short help string to be displayed in the help documentation
                'shortHelp' => 'Run SQL Query',
                //long help to be displayed in the help documentation
                'longHelp' => '',
            ),
         );
    }
 
    /**
     * Method to be used for my MyEndpoint/GetExample endpoint
     */

	//   #######################################
	//  ############ exeSqlQuery ##############
	// #######################################
    public function exeSqlQuery($api, $args)
    {
        global $current_user;

        if (!$current_user->is_admin) {
            throw new SugarApiExceptionError(
                'Not an authorized user'
            );
        }

        if (!isset($args['sql'])) { 
            return array('Error' => 'no arg'); 
        }

        $sql = $args['sql'];
        $return = array();
        $ac = new Account();
        if (substr_count($sql, ';') >= 2) {
            $sList = explode(';', $sql);
            foreach($sList as $s) {
                $ac->db->query($s);
            }
            $return['sql_num_rows'] = 1;
            $return['sql_fields'] = array('message');
            $return['sql_records'] = array('multiple queries.');
            return $return;
        }
        
        $result = $ac->db->query($sql);
        if (!$result) {
            $return['sql_num_rows'] = 1;
            $return['sql_fields'] = array('Error');
            $return['sql_records'] = array($ac->db->lastDbError());
            throw new Exception('Query returned no results');
        }

        $num_rows = $result->num_rows;
        $field_count = $result->field_count;
        $return['sql_num_rows'] = $num_rows;
        $return['sql_fields'] = array();
        $return['sql_records'] = array();
        while($row = $ac->db->fetchByAssoc($result)) {
            $r = array();
            foreach ($row as $key => $value) {
                //$r[$key] = $value;
                array_push($r, $value);
            }
            array_push($return['sql_records'], $r);
            if (count($return['sql_fields']) == 0) {
                foreach ($row as $key => $value) array_push($return['sql_fields'], $key);
            }
        }

        return($return);

    }

}
?>
