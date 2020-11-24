<?php
/*
 * This file is part of the 'Wonka_magic_chewing_gum' dashlet.
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
 * Author: SugarLabs
 */


$manifest = array (
  'built_in_version' => '7.8.0.0',
  'acceptable_sugar_versions' => 
  array (
    'exact_matches' => 
    array (
    ),
    'regex_matches' => 
    array (
      0 => '^8\\.([0-9]+)\\.([0-9]+)',
      1 => '^9\\.([0-9]+)\\.([0-9]+)',
      2 => '^10\\.([0-9]+)\\.([0-9]+)',
    ),
  ),
  'readme' => '',
  'key' => 'WW',
  'author' => 'SugarLabs',
  'description' => 'A 3-Course Dinner Gum',
  'icon' => '',
  'is_uninstallable' => true,
  'name' => 'Wonka s magic chewing gum',
  'published_date' => '2020-11-02 08:00:00',
  'type' => 'module',
  'version' => '2.0.2',
  'remove_tables' => 'prompt',
);


$installdefs = array (
  'id' => 'WW_20201002_1',

    
  // ###################
  // copy 
  // ###################
  'copy' => 
  array (
  // view
    0 => 
    array (
      'from' => '<basepath>/custom/clients/base/views/wonka-magic-gum/',
      'to' => 'custom/clients/base/views/wonka-magic-gum',
    ),
	// api
    10 => 
    array (
      'from' => '<basepath>/custom/clients/base/api/SQLToolApi.php',
      'to' => 'custom/clients/base/api/SQLToolApi.php',
    ),


  ),



);
