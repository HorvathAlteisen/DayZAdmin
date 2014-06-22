<?php
/*
RPTScan.php - a very kludgy script to automagically generate items.xml, vehicles.xml and bat files to generate images
Special thanks to R4Z0R49 for help with the SQF
2013-09-19 wriley http://www.github.com/wriley

This script relies on log output in the RPT generated by DEVTOOLS in a custom mission. The SQF is documented here to
keep the 2 parts together.

// SQF
    case "ListWeapons":
	{
		hint "Generating Weapon listings...";        
		_cfgweapons = configFile >> "cfgWeapons";

		for "_i" from 0 to (count _cfgweapons)-1 do {
			_vehicle = _cfgweapons select _i;
			if (isClass _vehicle) then {
				_veh_class = configName(_vehicle);
				_veh_name = (getText(_vehicle >> "displayname"));
				_veh_pic = (getText(_vehicle >> "picture"));
				_veh_type = (getNumber(_vehicle >> "type"));
				if ((getNumber(_vehicle >> "scope")==2)and(getText(_vehicle >> "picture")!= "")) then {
					diag_log format ["WEAPONSLIST,%1,%2,%3,%4",_veh_class,_veh_name,_veh_pic,_veh_type];
				};
			};
		};
	};
	case "ListMagazines":
	{
		hint "Generating Magazine listings...";
		_cfgmags = configFile >> "CfgMagazines";

		for "_i" from 0 to (count _cfgmags)-1 do {
			_mag = _cfgmags select _i;
			if (isClass _mag) then {
				_veh_class = configName(_mag);
				_veh_name = (getText(_mag >> "displayname"));
				_veh_pic = (getText(_mag >> "picture"));
				_veh_type = (getNumber(_mag >> "type"));
				if ((getNumber(_mag >> "scope")==2)and(getText(_mag >> "picture")!= "")) then {
					diag_log format ["MAGAZINESLIST,%1,%2,%3,%4",_veh_class,_veh_name,_veh_pic,_veh_type];
				};
			};
		};
	};
	case "ListVehicles":
	{
		hint "Generating Vehicle listings...";
		_cfgvehicles = configFile >> "CfgVehicles";

		for "_i" from 0 to (count _cfgvehicles)-1 do {
			_vehicle = _cfgvehicles select _i;
			if (isClass _vehicle) then {
				_veh_class = configName(_vehicle);
				_veh_name = (getText(_vehicle >> "displayname"));
				_veh_pic = (getText(_vehicle >> "picture"));
				_veh_type = (getText(_vehicle >> "vehicleclass"));
				_veh_side = (getNumber(_vehicle >> "side"));
				_veh_faction = (getText(_vehicle >> "faction"));
				_veh_cargo = (getNumber(_vehicle >> "transportsoldier"));
				_veh_weapons = (getNumber(_vehicle >> "transportmaxweapons"));
				_veh_magazines = (getNumber(_vehicle >> "transportmaxmagazines"));
				_veh_backpacks = (getNumber(_vehicle >> "transportmaxbackpacks"));
				if (
					getNumber(_vehicle >> "scope")==2 and (
						_veh_type == "Air" or
						_veh_type == "Backpacks" or
						_veh_type == "Car" or
						_veh_type == "CarD" or
						_veh_type == "CarW" or
						_veh_type == "Ship"
						)
					) then {
					diag_log format ["VEHICLESLIST,%1,%2,%3,%4,%5,%6,%7,%8,%9,%10",_veh_class,_veh_name,_veh_pic,_veh_type,_veh_side,_veh_faction,_veh_cargo,_veh_weapons,_veh_magazines,_veh_backpacks];
				};
			};
		};
	};
// END SQF

*/

if($argc != 2) {
    printf("Usage: %s <RPT file>\n", basename($argv[0]));
    exit(0);
}

$rpt = $argv[1];
// path to Pal2PacE.exe for converting thumbnails
$convertcmd = "\"c:\Program Files (x86)\Bohemia Interactive\Tools\TexView 2\Pal2PacE.exe\"";

// These weapons are able to be carried on the back
$carry = array(
    'MeleeHatchet',
    'MeleeCrowbar',
    'MeleeMachete',
    'MeleeBaseBallBat',
    'MeleeBaseBallBatBarbed',
    'MeleeBaseBallBatNails',
    'MeleeFishingPole',
);

// Ignore these classes
$ignore = array(
'10Rnd_9x19_Compact',
'10Rnd_762x51_CZ750',
'18Rnd_9x19_Phantom',
'18Rnd_9x19_PhantomSD',
'20Rnd_9x19_EVO',
'20Rnd_9x19_EVOSD',
'460Rnd_762x51_M240_ACR',
'5Rnd_127x99_as50',
'5Rnd_86x70_L115A1',
'BAF_AS50_scoped_Large',
'BAF_L85A2_RIS_SUSAT',
'Crossbow',
'CZ805_A1_ACR',
'CZ805_A1_GL_ACR',
'CZ805_A2_ACR',
'CZ805_A2_SD_ACR',
'CZ805_B_GL_ACR',
'CZ_750_S1_ACR',
'CZ_75_D_COMPACT',
'CZ_75_P_07_DUTY',
'CZ_75_SP_01_PHANTOM',
'CZ_75_SP_01_PHANTOM_SD',
'DMR',
'EvMap',
'Evo_ACR',
'Evo_mrad_ACR',
'evo_sd_ACR',
'ItemMap_Debug',
'Laserbatteries',
'LRTV_ACR',
'M240',
'M249',
'm8_SAW_Large',
'MG36_camo_Large',
'Mk_48',
'Mk_48_DES_EP1',
'NLAW_Big',
'PG7VR',
'PMC_AS50_scoped_Large',
'PMC_AS50_TWS_Large',
'SCAR_L_CQC',
'SMAW_HEDP_Big',
'SVD',
'SVD_CAMO',
'UK59_ACR',
);

// define custom items not found in regular classes, like mispelled things,
// then we'll add the real items below
$items = array(
    array("class" => "HandGrenade_west", "type" => "heavyammo", "slots" => 1, "picture" => "CA\weapons\data\equip\m_M67_CA.paa"),
    array("class" => "HandGrenade_east", "type" => "heavyammo", "slots" => 1, "picture" => "CA\weapons\data\equip\m_RGD5_ca.paa"),
    array("class" => "Pipebomb", "type" => "heavyammo", "slots" => 2, "picture" => "CA\weapons\data\equip\m_satchel_CA.paa"),
);

$vehicles = array();
$sides = array(
	0 => "NONE",
	1 => "WEST",
	2 => "EAST",
	3 => "GUER",
	4 => "CIV",
);

/*
=== Weapons/Magazines (includes toolbelt and loot items)
types
131072 = toolbelt
4096 = binoc
256 = heavyammo
16 = smallammo
5 (1+4) = machine gun
2 = pistol
1 = rifle

IGNORE,class,name,picture,type
"WEAPONSLIST,Binocular_Vector,Rangefinder,\CA\weapons_E\Data\icons\bino_vector_CA.paa,4096"
"WEAPONSLIST,AK_74_GL_kobra,AK-74 GP-25 Kobra,\ca\weapons_E\AK\data\Equip\w_AK74GL_kobra_Ca.paa,1"
"WEAPONSLIST,RPK_74_Large,RPK,\CA\weapons\AK\data\Equip\w_RPK_74_CA.paa,5"
"WEAPONSLIST,ItemCompass,Compass,\ca\ui\data\gear_picture_compass_ca.paa,131072"
"MAGAZINESLIST,30Rnd_556x45_Stanag,30Rnd. STANAG,\ca\weapons\data\equip\m_30stanag_CA.paa,256"
"MAGAZINESLIST,Attachment_Silencer,Silencer ATTACHMENT,\z\addons\dayz_communityassets\CraftingPlaceHolders\equip_part_silencer.paa,256"
"MAGAZINESLIST,equip_floppywire,Floppy Wire,\z\addons\dayz_communityassets\pictures\equip_floppywire.paa,256"
"MAGAZINESLIST,20Rnd_B_765x17_Ball,20Rnd. Sa-61 Mag.,\Ca\weapons_e\Data\Icons\m_sa61_CA.paa,16"
"MAGAZINESLIST,100Rnd_556x45_M249,M249 Mag.,\CA\weapons_E\Data\icons\m_m245_CA.paa,512"
"MAGAZINESLIST,6Rnd_Smoke_M203,M203 Smoke,\CA\weapons_E\Data\icons\m_6x40mmSmoke_CA.paa,512"

=== Vehicles (includes backpacks)
sides
1 = WEST
2 = EAST
3 = GUER
4 = CIV

IGNORE,class,name,picture,type,side,faction,cargo,weapons,magazines,backpacks
"VEHICLESLIST,SUV_DZ,SUV,\CA\wheeled_e\Data\UI\Picture_suv_CA.paa,Car,3,BIS_TK_CIV,5,10,50,2"
"VEHICLESLIST,US_Assault_Pack_EP1,Assault Pack (ACU),\ca\weapons_e\data\icons\backpack_US_ASSAULT_CA.paa,Backpacks,3,Default,0,0,8,1"

*/

$lines = file($rpt);
printf("Read %d lines from %s\n", sizeof($lines), $rpt);

foreach($lines as $line) {
    $line = trim($line);

// find fakes and banned
// Updating base class VehicleMagazine->FakeMagazine, by dayz_anim\config.cpp/CfgMagazines/48Rnd_40mm_MK19/
// Updating base class AH64_base_EP1->Banned, by dayz_anim\config.cpp/CfgVehicles/AH64D/

    if(preg_match('/FakeAmmo|FakeWeapon|FakeMagazine|->Banned/', $line, $matches) == 1) {
        $tokens = preg_split('/ /', $line);
        $tokens2 = preg_split('/\//', $tokens[sizeof($tokens) - 1]);
        array_push($ignore, $tokens2[sizeof($tokens2) - 2]);
    }




// find weapons/magazines
    if((strpos($line, "WEAPONSLIST") !== false) || (strpos($line, "MAGAZINESLIST") !== false)) {
        $line = preg_replace('/"/', '', $line);
        $line = preg_replace('/WEAPONSLIST,/', '', $line);
		$line = preg_replace('/MAGAZINESLIST,/', '', $line);
        $tokens = preg_split('/,/', $line);
        $class = $tokens[0];
        $picture = $tokens[2];
        $type_raw = $tokens[3];

        $picture = preg_replace('/^\\\\/', '', $picture);
        $picture = preg_replace('/^z\\\\addons\\\\/', '', $picture);
        $picture = preg_replace('/^ca\\\\/i', '', $picture);

		// skip if class is in the ignore list
        if(array_search($class, $ignore) !== false) {
            continue;
        }
        
        if($type_raw >= 131072) {
            $type = "item";
            $slots = 1;
		} elseif($type_raw >= 4096) {
            $type = "binocular";
            $slots = 1;
        } elseif($type_raw >= 256) {
            $type = "heavyammo";
            $slots = $type_raw / 256;
        } elseif($type_raw >= 16) {
            $type = "smallammo";
            $slots = $type_raw / 16;
		} elseif($type_raw == 5) { // machine guns that take up backpack slot are type 5 (1 + 4)
            $type = "rifle";
            $slots = 10;
        } elseif($type_raw >= 2) {
            $type = "pistol";
            $slots = 5;
        } elseif($type_raw >= 1) {
            if(array_search($class, $carry) !== false) {
                $type = "carry";
            } else {
                $type = "rifle";
            }
            $slots = 10;
        } else {
            $type = "UNKNOWN";
			printf("ERROR: Unable to determine type for class %s\n", $class);
        }

		if($type != "UNKNOWN") {
			$items[] = array("class" => $class, "type" => $type, "slots" => $slots, "picture" => $picture);
		}
    }
	
	// find vehicles/backpacks
    if(strpos($line, "VEHICLESLIST")) {
        $line = preg_replace('/"/', '', $line);
        $line = preg_replace('/VEHICLESLIST,/', '', $line);
        $tokens = preg_split('/,/', $line);
        $class = $tokens[0];
		$name = $tokens[1];
        $picture = $tokens[2];
        $type = $tokens[3];
		$side_raw = $tokens[4];
		$faction = $tokens[5];
		$cargo = $tokens[6];
		$weapons = $tokens[7];
		$magazines = $tokens[8];
		$backpacks = $tokens[9];

        $picture = preg_replace('/^\\\\/', '', $picture);
        $picture = preg_replace('/^z\\\\addons\\\\/', '', $picture);
        $picture = preg_replace('/^ca\\\\/i', '', $picture);

		if(array_key_exists($side_raw, $sides)) {
			$side = $sides[$side_raw];
		} else {
			$side = "UNKNOWN";
			printf("ERROR: Could not determine side from %d for %s\n", $side_raw, $class);
		}
		
		// skip if class is in the ignore list
        if(array_search($class, $ignore) !== false) {
            continue;
        }
		
		if($type == "Backpacks") {
			$items[] = array("class" => $class, "type" => $type, "slots" => $slots, "picture" => $picture, "maxmagazines" => $magazines, "maxweapons" => $weapons);
		} else {
			$vehicles[] = array(
				"class" => $class,
				"name" => $name,
				"picture" => $picture,
				"type" => $type,
				"side" => $side,
				"faction" => $faction,
				"cargo" => $cargo,
				"weapons" => $weapons,
				"magazines" => $magazines,
				"backpacks" => $backpacks,
			);
		}
	}
}

//sort by class
$classes = array();
foreach($items as $key => $row) {
    $classes[$key] = $row["class"];
}
array_multisort($classes, SORT_STRING|SORT_FLAG_CASE, $items);

printf("Found %d weapons/magazines\n", sizeof($classes));

// sort by class
$classes = array();
foreach($vehicles as $key => $row) {
    $classes[$key] = $row["class"];
}
array_multisort($classes, SORT_STRING|SORT_FLAG_CASE, $vehicles);

printf("Found %d vehicles/backpacks\n", sizeof($classes));

// create items.xml
/*
<?xml version="1.0" encoding="utf-8"?>
<items>
  <s100Rnd_762x51_M240>
    <Slots>2</Slots>
    <Type>heavyammo</Type>
  </s100Rnd_762x51_M240>
  <sDZ_ALICE_Pack_EP1>
    <Slots>1</Slots>
    <Type>backpack</Type>
    <maxmagazines>16</maxmagazines>
    <maxweapons>2</maxweapons>
  </sDZ_ALICE_Pack_EP1>
</items>
*/
$itemsxml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n<items>\n";
foreach($items as $item) {
	if($item["type"] == "Backpacks") {
		$itemsxml .= sprintf(
			"  <s%s>\n".
			"    <Slots>%d</Slots>\n".
			"    <Type>%s</Type>\n".
			"    <maxmagazines>%d</maxmagazines>\n".
			"    <maxweapons>%d</maxweapons>\n".
			"  </s%s>\n",
			$item["class"],
			$item["slots"],
			$item["type"],
			$item["maxmagazines"],
			$item["maxweapons"],
			$item["class"]
		);
	} else {
		$itemsxml .= sprintf(
			"  <s%s>\n".
			"    <Slots>%d</Slots>\n".
			"    <Type>%s</Type>\n".
			"  </s%s>\n",
			$item["class"],
			$item["slots"],
			$item["type"],
			$item["class"]
		);
	}
}
$itemsxml .= "</items>\n";

$bytes = file_put_contents("items.xml", $itemsxml);
if($bytes === false) {
    print("Error writing to items.xml!\n");
    exit(1);
} else {
    printf("Wrote %d bytes to items.xml\n", $bytes);
}

// create vehicles.xml
/*
<?xml version="1.0" encoding="utf-8"?>
<vehicles>
    <sAn2_1_TK_CIV_EP1>
        <Type>Air</Type>
        <Side>CIV</Side>
        <Faction>BIS_TK_CIV</Faction>
        <Name>An-2 (Aeroshrot)</Name>
        <transportmaxweapons>3</transportmaxweapons>
        <transportmaxmagazines>20</transportmaxmagazines>
        <transportmaxbackpacks>0</transportmaxbackpacks>
        <cargo>15</cargo>
    </sAn2_1_TK_CIV_EP1>
</vehicles>
*/
$vehiclesxml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n<vehicles>\n";
foreach($vehicles as $vehicle) {
    $vehiclesxml .= sprintf(
		"  <s%s>\n".
		"    <Type>%s</Type>\n".
		"    <Side>%s</Side>\n".
		"    <Faction>%s</Faction>\n".
		"    <Name>%s</Name>\n".
		"    <transportmaxweapons>%d</transportmaxweapons>\n".
		"    <transportmaxmagazines>%d</transportmaxmagazines>\n".
		"    <transportmaxbackpacks>%d</transportmaxbackpacks>\n".
		"    <cargo>%d</cargo>\n".
		"  </s%s>\n",
		$vehicle["class"],
		$vehicle["type"],
		$vehicle["side"],
		$vehicle["faction"],
		$vehicle["name"],
		$vehicle["weapons"],
		$vehicle["magazines"],
		$vehicle["backpacks"],
		$vehicle["cargo"],
		$vehicle["class"]
	);
}
$vehiclesxml .= "</vehicles>\n";

$bytes = file_put_contents("vehicles.xml", $vehiclesxml);
if($bytes === false) {
    print("Error writing to vehicles.xml!\n");
    exit(1);
} else {
    printf("Wrote %d bytes to vehicles.xml\n", $bytes);
}

//
// item thumbs
//
// sort by picture
$pics = array();
foreach($items as $key => $row) {
    $pics[$key] = $row["picture"];
}
array_multisort($pics, SORT_STRING|SORT_FLAG_CASE, $items);

// create bat file for item thumbnail creation
$piclines = "@echo off\nmkdir thumbs\n";
foreach($items as $item) {
	if($item["picture"] != "") {
		$piclines .= sprintf("%s \"%s\" \"thumbs\%s.png\" >nul || echo Error, couldn't create thumb for %s\n", $convertcmd, $item["picture"], $item["class"], $item["picture"]);
	}
}

$bytes = file_put_contents("itemthumbs.bat", $piclines);
if($bytes === false) {
    print("Error writing to itemthumbs.bat!\n");
    exit(1);
} else {
    printf("Wrote %d bytes to itemthumbs.bat\n", $bytes);
}

//
// vehicle thumbs
//
// sort by picture
$pics = array();
foreach($vehicles as $key => $row) {
    $pics[$key] = $row["picture"];
}
array_multisort($pics, SORT_STRING|SORT_FLAG_CASE, $vehicles);

// create bat file for vehicle thumbnail creation
$piclines = "@echo off\nmkdir vehicles\n";
foreach($vehicles as $vehicle) {
	if($vehicle["picture"] != "") {
		$piclines .= sprintf("%s \"%s\" \"vehicles\%s.png\" >nul || echo Error, couldn't create thumb for %s\n", $convertcmd, $vehicle["picture"], $vehicle["class"], $vehicle["picture"]);
	}
}

$bytes = file_put_contents("vehiclethumbs.bat", $piclines);
if($bytes === false) {
    print("Error writing to vehiclethumbs.bat!\n");
    exit(1);
} else {
    printf("Wrote %d bytes to vehiclethumbs.bat\n", $bytes);
}
?>
