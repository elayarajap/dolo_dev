INSERT INTO `#__menu` (
menutype, title, alias, path, link, type, published, parent_id, level, component_id, access,lft,rgt) VALUES

((select a.menutype from `#__menu` as a where a.home=1), 'User Management','mshahfrontendusermanager','mshahfrontendusermanager', 'index.php?option=com_mshahfrontendusermanager&view=reports&task=providers', 'component', 1,1,1,22,2,(SELECT max(`a`.`rgt`)+1 FROM `#__menu` as a),(SELECT max(a.rgt)+2 FROM `#__menu` AS a )),

((select a.menutype from `#__menu` as a where a.home=1), 'Active/Inactive Userlist',(SELECT DATE_FORMAT(now(), '%Y-%m-%d-%H-%i-%s')+ INTERVAL 1 SECOND) ,(SELECT DATE_FORMAT(now(),'%Y-%m-%d-%H-%i-%s')+ INTERVAL 1 SECOND), 'index.php?option=com_mshahfrontendusermanager&view=reports&task=userlist', 'url', 1,(SELECT max(a.id) FROM `#__menu`as a ),2,0,2,(SELECT max(a.rgt)+1 FROM `#__menu` as a ),(SELECT max(a.rgt)+2 FROM `#__menu` AS a ));

INSERT INTO `#__usergroups` ( parent_id,lft,rgt,title) VALUES

(2,(SELECT max(a.rgt)+1 FROM `#__usergroups` as a WHERE a.parent_id=2 ),(SELECT max(a.rgt)+2 FROM `#__usergroups` AS a WHERE a.parent_id=2 ),'ums');


UPDATE `#__menu` SET rgt = (select * from (SELECT MAX(rgt)+1 FROM `#__menu`) as t) WHERE alias = 'root';

UPDATE `#__modules` SET `params` = '{"menutype":"mainmenu","startLevel":"1","endLevel":"0","showAllChildren":"0","tag_id":"","class_sfx":"","window_open":"","layout":"","moduleclass_sfx":"_menu","cache":"0","cache_time":"900","cachemode":"itemid"}' WHERE `title` ='This Site';
