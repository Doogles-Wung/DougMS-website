<?php
/*
+--------------------------------------------------------+
|                   Made by HoltHelper                   |
|                                                        |
| Please give proper credits when using this code since  |
| It took me over a couple of months to finish this code |
|                                                        |
+--------------------------------------------------------+
*/
$mysqli = new mysqli("localhost", "root", "", "");
$debug = false;
extract($_GET);

class Controller {

    private $stand = 1;
    private $debug;
    private $vslot;

    //Default Clothes
    private $clothes = array(
		'coat' => array(
			0 => array( // Male
				1 => '{"mailChestBelowPants":["41,56,iVBORw0KGgoAAAANSUhEUgAAAA4AAAALCAYAAABPhbxiAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAB0SURBVChTlY6BDYAgDATZfwNnYQVXYAVWQK7hG0CQeEnjp\/5Vw4bSpme1Gyh3LnNptRso9X1fsHyUYvKCDVx1eRQFB8RJ9HIvkfl1RA7Qa+N4SU8gI0mMKb9FkKgymTKzEq0g5syx3Rc\/RUBG1BEcE\/9PCA8sDiTZ\/gcNBgAAAABJRU5ErkJggg=="]}',
				2 => '{"mailChestBelowPants":["41,56,iVBORw0KGgoAAAANSUhEUgAAAA4AAAALCAYAAABPhbxiAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAB2SURBVChTlY6BDYAgDARZwfGdhRVcgRVYoXKEJ42A6CUNtfxVwgJrJfTtZwN2ZVPoaKefTbFy7wPfpJh6oBacZbgVBQvETuxhL9HzdEQWkGvV6SGdQI8kMaY8iiBRYXrC1EysAfHsWbb646sIyIhaglPF\/xXsBq2iJ+cLo7qUAAAAAElFTkSuQmCC"]}'
			),
			1 => array( // Female
				1 => '{"mailChestBelowPants":["41,56,iVBORw0KGgoAAAANSUhEUgAAAA4AAAALCAYAAABPhbxiAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAABvSURBVChTlZCLDcAgCETd2uGchRVcgXKADVps60su\/u5pYtnAnki2N8FMtJayvQnm3mNB5yeSCQLV+kNsTcsTctmbaIUMF\/Eyep4bK8TgdZc0WEvQNcV4FhchE03YMS77FFGIYI1zGdcfHpODlHIBAWYmHFkK86MAAAAASUVORK5CYII="]}',
				2 => '{"mailChestBelowPants":["41,56,iVBORw0KGgoAAAANSUhEUgAAAA4AAAALCAYAAABPhbxiAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAABvSURBVChTpZCJDcAgDAPZmuGYhRVYIY3zVGmAPupJVgn1gUTZQBbH57g3QdR7LMk67U0QjfFLUoHptb4QW5PyBT7sTtTCChNxM3qWEy3E4HaTJJg56KqizMUkrEQVdvhhjyIKEcz4z9\/8wr74kEIHX0ApGaO\/CigAAAAASUVORK5CYII="]}'
			)
		),
		'pants' => array(
			0 => array( // Male
				1 => '{"pantsBelowShoes":["41,66,iVBORw0KGgoAAAANSUhEUgAAAA4AAAAHCAYAAAA4R3wZAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAABUSURBVChTrY\/RDQAQDAW7\/wZmsYIVrGCF6onnQ3yIuKSq2hMs8Mcwz9UX+75FLrGkKMi5tjsRkBGR\/og0GCJTi5PIcyXCGlJD6EL9k94wJjq4DLMO9qv3PLKxMzsAAAAASUVORK5CYII="]}',
				2 => '{"pantsBelowShoes":["41,66,iVBORw0KGgoAAAANSUhEUgAAAA4AAAAHCAYAAAA4R3wZAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAABUSURBVChTrY\/RDQAQDAW7\/wZmsYIVrGCF6onnQ3yIuKSq2hMs8Mcwz9UX+75FLrGkKMi5tjsRkBGR\/og0GCJTi5PIcyXCGlJD6EL9k94wJjq4DLMO9qv3PLKxMzsAAAAASUVORK5CYII="]}'
			),
			1 => array( // Female
				1 => '{"pantsBelowShoes":["41,66,iVBORw0KGgoAAAANSUhEUgAAAA4AAAAHCAYAAAA4R3wZAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAABaSURBVChTnY\/RCcAwCETdOsNlFlfIClfP9sDYfJQ+kGD0KVqAn2HAWsCcOMKae9Z9jHx3sVMHFfktSq7CQ246imoOOfNO2cghEsndwAHRsOUkxH6f0MfHMLsA\/IP2PQJUsTYAAAAASUVORK5CYII="]}',
				2 => '{"pantsBelowShoes":["41,66,iVBORw0KGgoAAAANSUhEUgAAAA4AAAAHCAYAAAA4R3wZAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAABaSURBVChTnY\/RCcAwCETdOsNlFlfIClfP9sDYfJQ+kGD0KVqAn2HAWsCcOMKae9Z9jHx3sVMHFfktSq7CQ246imoOOfNO2cghEsndwAHRsOUkxH6f0MfHMLsA\/IP2PQJUsTYAAAAASUVORK5CYII="]}'
			)
		)
	);

    function __construct($debug = false) {
        if(!$debug) {
            header('Content-type: image/png');
            $this->image = ImageCreateTrueColor(96, 96);
            ImageSaveAlpha($this->image, true);
            ImageFill($this->image, 0, 0, ImageColorAllocateAlpha($this->image, 0, 0, 0, 127));
        }
    }

    public function setConstants($variable) {
		foreach($variable as $type => $sql) {
			$this->$type = $sql;
		}
		if(array_key_exists('cap', $variable)) {
			$this->vslot = self::json($variable['cap']['info'])['vslot'];
        }
		foreach(array('coat', 'pants') as $clothes) {
			if(!array_key_exists($clothes, $variable)) {
				$this->$clothes = $this->clothes[$clothes][$variable['gender']];
			}
		}
		if(array_key_exists('weapon', $variable)) {
			if(array_key_exists('base', $variable['weapon'])) {
				$this->weapon = $variable['weapon']['base'];
				$this->stand = self::json($variable['weapon']['base']['info'])['stand'];
			}
			if(array_key_exists('cash', $variable['weapon'])) {
				$this->weapon = $variable['weapon']['cash'];
			}
		}
        return $this;
    }

    public function skin($type) {
        if(isset($this->skin)) {
            if($type == "head" || ($type == "ear" && ($this->job == 2002 || ($this->job >= 2300 && $this->job <= 2312)))) {
				list($x, $y, $image) = explode(",", self::json($this->skin['default'])[$type]);
                self::useImage($image, $x, $y);
            } elseif($type == "body" ||  $type == "arm" || $type == "hand") {
				if(array_key_exists($type, self::json($this->skin[$this->stand]))) {
					list($x, $y, $image) = explode(",", self::json($this->skin[$this->stand])[$type]);
					self::useImage($image, $x, $y);
				}
            }
        }
        return $this;
    }

    public function hair($z) {
        $removeHair = array(
            "hairOverHead" => array( array("H1", "H4", "H5"), 2 ),
            "hair" => array( array("H1", "H2", "H4"), 3 ),
            "hairBelowBody" => array( array("H1", "Hb"), 2 )
        );
        if(isset($this->hair) && !(count(array_intersect($removeHair[$z][0], str_split($this->vslot, 2))) >= $removeHair[$z][1])) {
			if(array_key_exists($z, self::json($this->hair['default']))) {
				foreach(self::json($this->hair['default'])[$z] as $hair) {
					list($x, $y, $image) = explode(",", $hair);
					self::useImage($image, $x, $y);
				}
			}
        }
        return $this;
    }

    public function accessory($type, $z) {
        $vslot = array("face" => "Af", "eyes" => "Ay", "ears" => "Ae");
        $faceException = array("CpH1H2H3H5HfHsAfAyAsAeHbH4H6","CpHdH1H2H3H4H5HfHsFcAfAyAsAfAe","CpH1H2H3H4H5H6HfHsHbHcAfAyAsAfAe");
        if(isset($this->accessory)) {
            if(isset($this->accessory[$type]) && (($type == "face" && in_array($this->vslot, $faceException)) || !in_array($vslot[$type], str_split($this->vslot, 2)))) {
				if(array_key_exists($z, self::json($this->accessory[$type]['default']))) {
					foreach(self::json($this->accessory[$type]['default'])[$z] as $item) {
						list($x, $y, $image) = explode(",", $item);
						self::useImage($image, $x, $y);
					}
				}
            }
        }
        return $this;
    }
	
	public function layer($wz, $z) {
		if(isset($this->$wz)) {
			$directory = $this->$wz;
			if(!empty($directory[$this->stand])) {
				$directory = $directory[$this->stand];
			} elseif(!empty($directory['default'])) {
				$directory = $directory['default'];
			} else {
				$directory = null;
			}
			if(isset($directory) && array_key_exists($z, self::json($directory))) {
				foreach(self::json($directory)[$z] as $item) {
					list($x, $y, $image) = explode(",", $item);
					self::useImage($image, $x, $y);
				}
			}
			
		}
		return $this;
	}

    public function useImage($string, $x = 0, $y = 0) {
        if(strlen($string) > 0 && !$this->debug) {
            if(!empty($x) && !empty($y)) {
                $img = imagecreatefromstring(base64_decode($string));
            } else {
                $img = imagecreatefrompng("./characters/".$string.".png");
            }
            imagecopy($this->image, $img, $x, $y, 0, 0, imagesx($img), imagesy($img));
        }
        return $this;
    }
    
    public function createImage($name) {
        if(isset($name) && !$this->debug) {
            imagepng($this->image, "./characters/".$name.".png");
        }
        return $this;
    }
    
    public function addID($string) {
		$addion = 0;
        foreach($string as $lv1) {
			if(is_int($lv1)) {
				$addion += $lv1;
			} elseif(is_array($lv1) && array_key_exists('item_id', $lv1)) {
				$addion += $lv1['item_id'];
			} elseif(is_array($lv1)) {
				$addion += self::addID($lv1);
			}
        }
        return $addion;
    }
	
	private function json($string) {
		return json_decode($string, true);
	}

    public function show($string) {
        echo "<pre>";
        print_r($string);
        echo "</pre>";
    }

    public function display() {
        if(!$this->debug) {
            imagepng($this->image);
        }
    }

    public function debug() {
        return self::show(get_object_vars($this));
    }

    function __destruct() {
        if(!$this->debug) {
            ImageDestroy($this->image);
        }
    }
}
$Image = new Controller($debug);

if(!empty($name) && $name = stripslashes(htmlentities($name))) {
    $cache = "./characters/".$name.".png";
    $minutes = 5; // Minutes until next hash update
    
    if(file_exists($cache) && (time() - ($minutes * 60) < filemtime($cache)) && !$debug) {
        $Image->useImage($name)->display();
    } else { // Lets create the image
		if($character = $mysqli->query("SELECT `id`, `job`, `skincolor`, `gender`, `hair`, `face`, `hash` FROM `characters` WHERE `name` = '".$mysqli->real_escape_string($name)."' LIMIT 1")->fetch_row()) {
			$equip = $mysqli->query("SELECT CONCAT(',', GROUP_CONCAT(`itemid`)) FROM `inventoryitems` WHERE `characterid` = '".$character[0]."' AND `inventorytype` = '-1'")->fetch_row()[0];
			$list = $mysqli->query("SELECT `item_id`, `directory`, `position`, `info`, `default`, `stand1` AS `1`, `stand2` AS `2` FROM `wz`.`character` WHERE `item_id` IN (".$character[2].",".$character[4].",".$character[5].$equip.") ORDER BY `position` ASC");
			$variables = array("debug" => (bool)$debug, "gender" => $character[3], "job" => $character[1]);
			while($item = $list->fetch_assoc()) {
				switch($item['position']) {
					case 0: $variables[$item['directory']]           = $item;break;
					case 1: case 101:$variables['cap']               = $item;break;
					case 2: case 102:$variables['accessory']['face'] = $item;break;
					case 3: case 103:$variables['accessory']['eyes'] = $item;break;
					case 4: case 104:$variables['accessory']['ears'] = $item;break;
					case 5: case 105:$variables['coat']              = $item;break;
					case 6: case 106:$variables['pants']             = $item;break;
					case 7: case 107:$variables['shoes']             = $item;break;
					case 8: case 108:$variables['glove']             = $item;break;
					case 9: case 109:$variables['cape']              = $item;break;
					case 10:case 110:$variables['shield']            = $item;break;
					case 11: $variables['weapon']['base']            = $item;break;
					case 111:$variables['weapon']['cash']            = $item;break;
				}
			}
			$hash = hash("sha1", $Image->addID($variables));
            
			if($debug) {
                $Image->setConstants($variables)->debug();
            } elseif($hash == $character[6] && file_exists($cache)) {
                $Image->useImage($name)->display();
                touch($cache);
            } else {
                $mysqli->query("UPDATE `characters` SET `hash` = '".$hash."' WHERE `id` = '".$character[0]."'");
                $Image->setConstants($variables)
                ->layer('weapon', 'characterEnd')
                ->layer('cape', '0')
                ->layer('cap', 'backHair')
                ->layer('cape', 'backWing')
                ->layer('cap', 'backHairOverCape')
                ->layer('cap', 'capBelowBody')
                ->layer('cap', 'capBelowHead')
                ->layer('weapon', 'weaponOverGloveBelowMailArm')
                ->layer('weapon', 'weaponBelowBody')
                ->layer('cap', 'capeBelowBody')
                ->layer('cap', 'backCap')
                ->hair('hairBelowBody')
                ->layer('cape', 'capeBelowBody')
                ->layer('shoes', 'capAccessoryBelowBody')
                ->layer('cap', 'capAccessoryBelowBody')
                ->layer('weapon', 'capAccessoryBelowBody') // Cap
                ->layer('shield', 'shield')
                ->layer('shield', 'shieldBelowBody')
                ->skin('body')
                ->layer('cap', 'body')
                ->layer('pants', 'pantsBelowShoes')
                ->layer('coat', 'pantsBelowShoes')
                ->layer('glove', 'gloveOverBody')
                ->layer('glove', 'gloveWristOverBody')
                ->layer('shield', 'gloveOverBody') // Weapon
                ->layer('coat', 'mailChestBelowPants')
                ->layer('shoes', 'shoes')
                ->layer('pants', 'pants')
                ->layer('coat', 'pants')
                ->layer('coat', 'mailArmOverHair')
                ->layer('shoes', 'shoesOverPants')
                ->layer('coat', 'pantsOverShoesBelowMailChest')
                ->layer('shoes', 'shoesTop')
                ->layer('coat', 'backMailChest')
                ->layer('pants', 'pantsOverShoesBelowMailChest')
                ->layer('coat', 'mailChest')
                ->layer('coat', 'mailChestOverPants')
                ->layer('pants', 'pantsOverMailChest')
                ->layer('coat', 'mailChestOverHighest')
                ->layer('shoes', 'pantsOverMailChest')
                ->layer('shoes', 'mailChestTop')
                ->layer('shoes', 'weaponOverBody')
                ->layer('coat', 'capeBelowBody')
                ->layer('coat', 'mailChestTop')
                ->layer('weapon', 'weaponOverArmBelowHead')
                ->layer('shield', 'weaponOverArmBelowHead') // Weapon
                ->layer('weapon', 'weapon')
                ->layer('weapon', 'armBelowHeadOverMailChest')
                ->layer('weapon', 'weaponOverBody')
                ->skin('arm')
                ->layer('glove', 'gloveBelowMailArm')
                ->layer('glove', 'glove')
                ->layer('glove', 'gloveWrist')
                ->layer('coat', 'mailArm')
                ->layer('coat', 'capeBelowBody')
                ->layer('weapon', 'emotionOverBody')
                ->skin('head')
                ->layer('cape', 'cape')
                ->accessory('face', 'accessoryFaceBelowFace')
                ->accessory('eyes', 'accessoryEyeBelowFace')
                ->layer('face', 'face')
                ->accessory('face', 'accessoryFace')
                ->accessory('face', 'accessoryFaceOverFaceBelowCap')
                ->layer('coat', 'accessoryFaceOverFaceBelowCap')
                ->accessory('face', 'weaponBelowArm')
                ->accessory('face', 'capeOverHead')
                ->layer('cap', 'capBelowAccessory')
                ->layer('cap', 'capAccessoryBelowAccFace')
                ->accessory('eyes', 'accessoryEye')
                ->accessory('ears', 'accessoryEar')
                ->layer('cap', 'accessoryEar')
                ->hair('hair')
                ->layer('cap', 'cap')
                ->layer('weapon', 'cap') // Cap
                ->skin('ear')
                ->accessory('eyes', 'accessoryEyeOverCap')
                ->layer('cap', 'accessoryEyeOverCap')
                ->hair('hairOverHead')
                ->layer('weapon', 'weaponOverArm')
                ->layer('weapon', 'weaponBelowArm')
                ->layer('weapon', 'weaponOverHand')
                ->skin('hand')
                ->layer('glove', 'gloveOverHair')
                ->layer('glove', 'gloveWristOverHair')
                ->layer('weapon', 'weaponOverGlove')
                ->layer('weapon', 'weaponWristOverGlove')
                ->layer('cape', 'capeOverHead')
                ->accessory('eyes', 'accessoryOverHair')
                ->accessory('eyes', 'hairOverHead')
                ->accessory('eyes', 'accessoryEarOverHair')
                ->layer('cap', 'capOverHair')
                ->layer('cap', '0')
                ->accessory('ears', 'capOverHair')
                ->layer('cape', 'capeOverWepon')
                ->layer('cape', 'capOverHair')
                ->createImage($name)
                ->display();
            }
        } else { // Cant find Character Name
            $Image->useImage("faek")->display();
        }
    }
} else { // variable Name is empty
    $Image->useImage("faek")->display();
}