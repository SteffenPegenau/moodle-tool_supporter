<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Class containing data for index page
 *
 * @package    tool_supporter
 * @copyright  2016 Benedikt Schneider, Klara Saary
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace tool_supporter\output;

//require_once("$CFG->dirroot/user/externallib.php");
require_once("$CFG->dirroot/config.php");

use renderable;
use templatable;
use renderer_base;
use stdClass;

/**
 * Class containing data for index page
 * Gets passed to the renderer
 *
 * @copyright  2016 Klara Saary
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course_table implements renderable, templatable {

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @return stdClass
     */
    /**function get_category_name($category){
      $catgory = $DB->get_record('course_categories', array('id'=> (string)$category ), 'name, parent');
      $category['parent_category'] = $DB->get_record('course_categories', array('id'=> (string)$category['parent'] ), 'name');
      echo "<pre>" . print_r($category, true) . "</pre>";
    }*/

    public function export_for_template(renderer_base $output) {
        // "Flattens" the data
        global $DB;
        $rs = $DB->get_recordset('course', null, null, 'id, fullname, shortname, category' );
        foreach ($rs as $record) {
          $record = (array)$record;
          $category = $DB->get_record('course_categories', array('id'=> $record['category'] ), 'name, parent');
          $record['category'] = null;
          $record['parent-category'] = null;
          if ($category !=null){
            $parent = $DB->get_record('course_categories', array('id'=> $category->parent ), 'name');
            $record['category'] = $category->name;
            if($parent != null){
              $record['parent-category'] = $parent->name;
            }
          }
          $courses[] = $record;
        }
        $data['courses'] = $courses;
        echo "<pre>" . print_r($data, true) . "</pre>";
        return $data;
    }
}
