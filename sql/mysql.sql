CREATE TABLE visit_user (
   id int(11) NOT NULL auto_increment,
   visitname text,
   nvisit int(7) DEFAULT '0' NOT NULL,
   ip varchar(16) NOT NULL,
   temps varchar(30) NOT NULL,
   tempsf varchar(30) NOT NULL,
   PRIMARY KEY (id)
) ENGINE=MyISAM;

CREATE TABLE visit_user_page (
   id int(11) NOT NULL auto_increment,
   nom varchar(100) NOT NULL,
   page varchar(200) NOT NULL,
   nav varchar(150) NOT NULL,
   langue varchar(20) NOT NULL,
   enregis varchar(20) NOT NULL,
   PRIMARY KEY (id)
) ENGINE=MyISAM;
