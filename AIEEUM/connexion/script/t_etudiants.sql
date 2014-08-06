create database aeeium;
use aeeium;

create table t_etudiants(
  et_id		varchar(7)  not null,
  et_prenom	varchar(45) not null,
  et_nom	varchar(45) not null,
  et_email	varchar(45) not null,
  et_passwdhash	varchar(60) not null,
  et_cnxfirst	datetime not null default '00-00-0000 00:00:00',
  et_cnxlast	datetime not null default '00-00-0000 00:00:00',
  PRIMARY KEY (et_id),
  UNIQUE  KEY email_UNIQUE (et_email),
  UNIQUE  KEY etid_UNIQUE (et_id),
  )ENGINE=InnoDb DEFAULT CHARSET=utf8;
