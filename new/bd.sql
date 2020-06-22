drop table adresa;
drop table domenii;
drop table feeds;
drop table link_feed;
drop table relatii;
drop table userr;

create table adresa(
ID_ADRESA int not null PRIMARY KEY,
titlu  VARCHAR2(200),
domeniu  VARCHAR2(200),
link_site  VARCHAR2(200)
);
create table userr(
ID_user int not null PRIMARY KEY,
nume  VARCHAR2(200),
parola  VARCHAR2(200),
adresa_mail  VARCHAR2(200)
);

CREATE TABLE relatii(
  user_id CHAR(40),
  adresa_id CHAR(40),
  response_code INT NOT NULL,
  response_desc varchar(50) NOT NULL
  );
CREATE TABLE feeds(
 address VARCHAR2(200) PRIMARY KEY
 
 );

CREATE TABLE domenii(
 nume_domeniu VARCHAR2(20) NOT NULL,
 id_domeniu INT NOT NULL
 );

CREATE TABLE link_feed(
 user_id CHAR(40),
 feed_site VARCHAR2(200)
 );

insert into feeds VALUES ('https://www.feedforall.com/rss-video-tutorials.xml');
insert into feeds VALUES ('https://www.omnycontent.com/d/playlist/4b5f9d6d-9214-48cb-8455-a73200038129/a7c446d6-29da-43ba-bbe5-a7da00ecda4a/a65603a6-cf22-4150-91c1-a7da00ed5220/podcast.rss');
insert into feeds VALUES ('http://billmaher.hbo.libsynpro.com/rss');
insert into feeds VALUES ('http://feeds.bbci.co.uk/news/rss.xml');
insert into feeds VALUES ('http://stiri.tvr.ro/rss/homepage.xml');
insert into feeds VALUES ('https://stirileprotv.ro/rss');
insert into feeds VALUES ('http://stiri.tvr.ro/rss/vacanta.xml');
insert into feeds VALUES ('http://stiri.tvr.ro/rss/stiri.xml');
insert into feeds VALUES ('http://rss.realitatea.net/stiri.xml');
insert into feeds VALUES ('https://ziare.com/rss/12h.xml');
insert into feeds VALUES ('https://www.horoscop.ro/feed/');
insert into feeds VALUES ('https://stirileprotv.ro/rss');


insert into userr VALUES ('1','roman','1234','afaf2@mail');
insert into userr VALUES ('2','dany','1234','af@mail');
insert into userr VALUES ('3','carlos','1234','carlos@mail');
insert into userr VALUES ('4','badea','1234','badalpha@mail');



INSERT INTO adresa VALUES ('1','protv','televiziune', 'https://stirileprotv.ro/rss');
INSERT INTO adresa VALUES ('3','realitatea','televiziune', 'http://rss.realitatea.net/stiri.xml');
INSERT INTO adresa VALUES ('2','tvr','televiziune', 'http://stiri.tvr.ro/rss/homepage.xml');
INSERT INTO adresa VALUES ('4','horoscop','horoscop', 'https://www.horoscop.ro/feed/');
INSERT INTO adresa VALUES ('5','tutoriale','video', 'https://www.feedforall.com/rss-video-tutorials.xml');
INSERT INTO adresa VALUES ('6','tvr vacanta','televiziune', 'http://stiri.tvr.ro/rss/vacanta.xml  ');
INSERT INTO adresa VALUES ('7','ziare','ziare', 'https://ziare.com/rss/12h.xml');

insert into domenii VALUES ('programare','1');
insert into domenii VALUES ('alte siteuri','2');
insert into link_feed VALUES ('1','https://stirileprotv.ro/rss');
insert into link_feed VALUES ('1','http://rss.realitatea.net/stiri.xml');
insert into link_feed VALUES ('1','https://www.feedforall.com/rss-video-tutorials.xml');





COMMIT;

