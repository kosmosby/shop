<?php
/**
 * @author MorbiPlay.com <support@morbiplay.com>
 * @link http://morbiplay.com/
 */

class shopRevolutionsliderPluginModel extends waModel {
    protected $table = 'shop_revolutionslider';
    private $table_groups = 'shop_revolutionslider_groups';

    public function getAll($key = null, $normalize = false) {
        $sql = "SELECT * FROM {$this->table_groups} WHERE group_id != -1 ORDER BY group_id DESC";

        $groups = $this->query($sql)->fetchAll();

        $groups_arr = array();
        $groups_arr[0] = array("group_title" => "Not Grouped", "sliders" => array());
        foreach($groups as $group) {
            $groups_arr[$group['group_id']] = array("group_title" => $group['group_title'], "sliders" => array());
        }

        $sql = "SELECT * FROM {$this->table} WHERE group_id != -1 ORDER BY slider_id ASC";
        $sliders = $this->query($sql)->fetchAll();

        foreach($sliders as $slider) {
            $slider['properties'] = unserialize($slider['properties']);
            $slider['layers'] = unserialize($slider['layers']);

            array_walk_recursive($slider, function (&$item, $key) {
                    $item = stripslashes($item);
                });

            $group_id = 0;
            if (array_key_exists($slider['group_id'], $groups_arr)) {
                $group_id = $slider['group_id'];
            }

            $groups_arr[$group_id]['sliders'][] = $slider;
        }

        krsort($groups_arr);

        return $groups_arr;
    }

    public function getDemo() {
        $sql = "SELECT * FROM {$this->table} WHERE group_id = -1";

        $rows = $this->query($sql)->fetchAll();

        $slides = array();
        foreach($rows as $row) {
            $row['properties'] = unserialize($row['properties']);
            $row['layers'] = unserialize($row['layers']);

            array_walk_recursive($row, function(&$item, $key) {
                $item = stripslashes($item);
            });

            $slides[] = $row;
        }

        return $slides;
    }


    public function getAllGroups() {
        $sql = "SELECT * FROM {$this->table_groups} WHERE group_id != -1 ORDER BY group_id";

        $rows = $this->query($sql)->fetchAll();

        $groups = array();
        foreach($rows as $row) {
            $groups[] = $row;
        }

        return $groups;
    }


//    public function getAllIds() {
//        $sql = "SELECT slider_id FROM {$this->table}";
//
//        $rows = $this->query($sql)->fetchAll();
//
//        $slides = array();
//        foreach($rows as $row) {
//            $slides[] = $row;
//        }
//
//        return $slides;
//    }


//    public function addTable() {
//        $sql = "CREATE TABLE IF NOT EXISTS `shop_revolutionslider` (
//                  `slider_id` int(11) NOT NULL,
//                  `properties` mediumtext NOT NULL,
//                  `layers` longtext NOT NULL,
//                  		UNIQUE KEY `slider_id` (`slider_id`)
//               		 ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
//        $this->query($sql);
//    }


//    public function removePluginSettings() {
//        $del_sql = "DELETE FROM wa_app_settings WHERE app_id = 'revoslider'";
//        $this->query($del_sql);
//    }


    public function getById($slide_id = 0) {

        $sql = "SELECT * FROM {$this->table} WHERE slider_id = " . (int)$slide_id;

        $rows = $this->query($sql)->fetchAll();

        if(!$rows) {
            return false;
        }
        $slides = array();
        
        foreach($rows as $row) {
            $row['properties'] = unserialize($row['properties']);
            $row['layers'] = unserialize($row['layers']);

            array_walk_recursive($row, function(&$item, $key) {
                $item = stripslashes($item);
            });

            $slides[] = $row;
        }



        return $slides;
    }


    public function createSlider($group_id) {
        $sql = "SELECT MAX(slider_id) AS max_id FROM {$this->table}";
        $row = $this->query($sql)->fetchAll();

        $max_id = $row[0]['max_id'] + 1;

        $sql = "INSERT INTO {$this->table} SET slider_id ='" . (int)$max_id . "', group_id ='" . (int)$group_id . "', demo_slider = '0', properties = '', layers = ''";
        $this->query($sql);
        return $max_id;
    }


    public function cloneById($slider_id, $group_id) {
        $sql = "SELECT MAX(slider_id) AS max_id FROM {$this->table}";
        $row = $this->query($sql)->fetchAll();

        $max_id = $row[0]['max_id'] + 1;

        $sql = "SELECT * FROM {$this->table} WHERE slider_id = " . (int)$slider_id;
        $rows = $this->query($sql)->fetchAll();

        $sql = "INSERT INTO {$this->table} SET slider_id ='" . (int)$max_id . "', group_id ='" . (int)$group_id . "', demo_slider = '0', properties = '".$rows[0]['properties']."', layers = '".$rows[0]['layers']."'";
        $this->query($sql);

        return $max_id;
    }


    public function deleteSlider($slider_id) {
        if(in_array($slider_id, array(1,2,3,4,5,6,7))) {
            return false;
        }

        $sql = "DELETE FROM {$this->table} WHERE slider_id = '" . (int)$slider_id . "'";

        $this->query($sql);

//        $slider_dir = realpath(dirname(__FILE__).'/../../slider_images/files/' . "slider_" . $slider_id);
//        if(is_dir($slider_dir)) unlink($slider_dir);

        return true;
    }


    public function saveById($slider_id, $slider = array()) {
        if(in_array($slider_id, array(1,2,3,4,5,6))) {
            return false;
        }

        error_reporting(E_ALL & ~E_NOTICE);

//        foreach($slider as $sliderid => $slider) {
            $slider['properties']['globalstoviewport'] = (isset($slider['properties']['globalstoviewport']) && $slider['properties']['globalstoviewport'] == 1 ? 'true' : 'false');
            $slider['properties']['globalsProgressBar'] = (isset($slider['properties']['globalsProgressBar']) && $slider['properties']['globalsProgressBar'] == 1 ? 'on' : 'off');
            $slider['properties']['keyboardnavigation'] = (isset($slider['properties']['keyboardnavigation']) && $slider['properties']['keyboardnavigation'] == 1 ? 'on' : 'off');
            $slider['properties']['mousescrollnavigation'] = (isset($slider['properties']['mousescrollnavigation']) && $slider['properties']['mousescrollnavigation'] == 1 ? 'on' : 'off');
            $slider['properties']['onhoverstop'] = (isset($slider['properties']['onhoverstop']) && $slider['properties']['onhoverstop'] == 1 ? 'on' : 'off');
            $slider['properties']['touchenabled'] = (isset($slider['properties']['touchenabled']) && $slider['properties']['touchenabled'] == 1 ? 'on' : 'off');

            $slider['properties']['arrowsenabled'] = (isset($slider['properties']['arrowsenabled']) && $slider['properties']['arrowsenabled'] == 1 ? 'true' : 'false');
            $slider['properties']['arrowshideonmobile'] = (isset($slider['properties']['arrowshideonmobile']) && $slider['properties']['arrowshideonmobile'] == 1 ? 'true' : 'false');
            $slider['properties']['arrowshideonleave'] = (isset($slider['properties']['arrowshideonleave']) && $slider['properties']['arrowshideonleave'] == 1 ? 'true' : 'false');

            $slider['properties']['bulletenabled'] = (isset($slider['properties']['bulletenabled']) && $slider['properties']['bulletenabled'] == 1 ? 'true' : 'false');
            $slider['properties']['bullethideonmobile'] = (isset($slider['properties']['bullethideonmobile']) && $slider['properties']['bullethideonmobile'] == 1 ? 'true' : 'false');
            $slider['properties']['bullethideonleave'] = (isset($slider['properties']['bullethideonleave']) && $slider['properties']['bullethideonleave'] == 1 ? 'true' : 'false');

            $slider['properties']['thumbenabled'] = (isset($slider['properties']['thumbenabled']) && $slider['properties']['thumbenabled'] == 1 ? 'true' : 'false');
            $slider['properties']['thumbhideonmobile'] = (isset($slider['properties']['thumbhideonmobile']) && $slider['properties']['thumbhideonmobile'] == 1 ? 'true' : 'false');
            $slider['properties']['thumbhideonleave'] = (isset($slider['properties']['thumbhideonleave']) && $slider['properties']['thumbhideonleave'] == 1 ? 'true' : 'false');

            $slider['properties']['tabenabled'] = (isset($slider['properties']['tabenabled']) && $slider['properties']['tabenabled'] == 1 ? 'true' : 'false');
            $slider['properties']['tabhideonmobile'] = (isset($slider['properties']['tabenabled']) && $slider['properties']['tabenabled'] == 1 ? 'true' : 'false');
            $slider['properties']['tabhideonleave'] = (isset($slider['properties']['tabenabled']) && $slider['properties']['tabenabled'] == 1 ? 'true' : 'false');

            $slider['properties']['globalsparallaxbg'] = (isset($slider['properties']['globalsparallaxbg']) && $slider['properties']['globalsparallaxbg'] == 1 ? 'on' : 'off');
            $slider['properties']['globalsparallaxmobileoff'] = (isset($slider['properties']['globalsparallaxmobileoff']) && $slider['properties']['globalsparallaxmobileoff'] == 1 ? 'on' : 'off');

            $slider['properties']['globalsparallaxdddshadow'] = (isset($slider['properties']['globalsparallaxdddshadow']) && $slider['properties']['globalsparallaxdddshadow'] == 1 ? 'on' : 'off');
            $slider['properties']['globalsparallaxdddbgfreeze'] = (isset($slider['properties']['globalsparallaxdddbgfreeze']) && $slider['properties']['globalsparallaxdddbgfreeze'] == 1 ? 'on' : 'off');
            $slider['properties']['globalsparallaxdddoverflow'] = (isset($slider['properties']['globalsparallaxdddoverflow']) && $slider['properties']['globalsparallaxdddoverflow'] == 1 ? 'hidden' : 'visible');
            $slider['properties']['globalsparallaxdddlayeroverflow'] = (isset($slider['properties']['globalsparallaxdddlayeroverflow']) && $slider['properties']['globalsparallaxdddlayeroverflow'] == 1 ? 'hidden' : 'visible');


            $slider_group_id = $slider['properties']['globallslidergroup'];


            array_walk_recursive($slider, function(&$item, $key) {
                $item = addslashes($item);
            });

            $sql = "UPDATE {$this->table} SET
                        group_id = '" . (int)$slider_group_id . "',
                        properties = '" . addslashes(serialize($slider['properties'])) . "',
                        layers = '" . addslashes(serialize($slider['layers'])) . "'
                WHERE slider_id = '" . (int)$slider_id . "'";
            $this->query($sql);
//        }
    }


    public function createGroup($title) {
        $sql = "SELECT MAX(group_id) AS max_id FROM {$this->table_groups}";
        $row = $this->query($sql)->fetchAll();

        $max_id = $row[0]['max_id'] + 1;

        $sql = "INSERT INTO {$this->table_groups} SET group_id ='" . (int)$max_id . "', group_title = '" . $title . "'";
        $this->query($sql);

        return $max_id;
    }


    public function renameGroup($group_id, $name) {
        if((int)$group_id == 0) return;

        $sql = "UPDATE {$this->table_groups} SET
                        group_title = '" . (string)$name . "'
                WHERE group_id = '" . (int)$group_id . "'";
        $this->query($sql);

        die((string)$name);
    }


    public function deleteGroup($group_id) {
        if((int)$group_id == 0) return;

        $sql = "UPDATE {$this->table} SET group_id = '0' WHERE group_id = '" . (int)$group_id . "'";
        $this->query($sql);

        $sql = "DELETE FROM {$this->table_groups} WHERE group_id = '" . (int)$group_id . "'";
        $this->query($sql);
    }

}
