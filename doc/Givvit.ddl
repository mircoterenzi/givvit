-- *********************************************
-- * Standard SQL generation                   
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Mon Jan 15 19:33:20 2024 
-- * LUN file: C:\Users\Aless\OneDrive\Desktop\Givvit\Givvit.lun 
-- * Schema: Givvit_log/SQL 
-- ********************************************* 


-- Database Section
-- ________________ 

create database Givvit_log;


-- DBSpace Section
-- _______________


-- Tables Section
-- _____________ 

create table comment (
     post -- Index attribute not implemented -- not null,
     text varchar(150) not null,
     date date not null,
     comment_id -- Index attribute not implemented -- not null,
     user -- Index attribute not implemented -- not null,
     notification -- Object attribute not implemented -- not null,
     rensponded_by -- Object attribute not implemented --,
     constraint ID_comment_ID primary key (post, comment_id),
     constraint SID_comment_1_ID unique (rensponded_by),
     constraint SID_comment_ID unique (notification));

create table donation (
     user -- Index attribute not implemented -- not null,
     post -- Index attribute not implemented -- not null,
     amount numeric(1) not null,
     notification -- Object attribute not implemented -- not null,
     constraint ID_donation_ID primary key (user, post),
     constraint SID_donation_ID unique (notification));

create table like (
     user -- Index attribute not implemented -- not null,
     post -- Index attribute not implemented -- not null,
     notification -- Object attribute not implemented -- not null,
     constraint ID_like_ID primary key (post, user),
     constraint SID_like_ID unique (notification));

create table files (
     post_id -- Index attribute not implemented -- not null,
     files varchar(255) not null,
     constraint ID_files_ID primary key (post_id, files));

create table followed (
     user_id -- Index attribute not implemented -- not null,
     followed -- Object attribute not implemented -- not null,
     constraint ID_followed_ID primary key (user_id, followed));

create table follows (
     follows -- Index attribute not implemented -- not null,
     followed -- Object attribute not implemented -- not null,
     constraint ID_follows_ID primary key (user_id, follows));

create table notification (
     user_for -- Index attribute not implemented -- not null,
     notification_id -- Index attribute not implemented -- not null,
     user -- Index attribute not implemented --,
     post -- Index attribute not implemented --,
     date date not null,
     visualized char not null,
     notification_type char(1) not null,
     user_from -- Index attribute not implemented -- not null,
     constraint ID_notification_ID primary key (user_for, notification_id));

create table post (
     post_id -- Index attribute not implemented -- not null,
     short_description varchar(50),
     long_description varchar(500) not null,
     amount_requested numeric(1) not null,
     date date not null,
     closed char not null,
     user -- Index attribute not implemented -- not null,
     notification -- Object attribute not implemented --,
     topic varchar(20) not null,
     constraint ID_post_ID primary key (post_id),
     constraint SID_post_ID unique (notification));

create table topic (
     name varchar(20) not null,
     constraint ID_topic_ID primary key (name));

create table user (
     user_id -- Index attribute not implemented -- not null,
     user_name varchar(20) not null,
     first_name varchar(20) not null,
     last_name char(20) not null,
     password varchar(20) not null,
     description varchar(200),
     profile_img char(1),
     constraint ID_user_ID primary key (user_id));


-- Constraints Section
-- ___________________ 

alter table comment add constraint REF_comme_user_FK
     foreign key (user)
     references user;

alter table comment add constraint REF_comme_post
     foreign key (post)
     references post;

alter table donation add constraint REF_donat_post_FK
     foreign key (post)
     references post;

alter table donation add constraint REF_donat_user
     foreign key (user)
     references user;

alter table like add constraint REF_like_post
     foreign key (post)
     references post;

alter table like add constraint REF_like_user_FK
     foreign key (user)
     references user;

alter table files add constraint FKpos_fil
     foreign key (post_id)
     references post;

alter table followed add constraint FKuse_fol_1
     foreign key (user_id)
     references user;

alter table follows add constraint FKuse_fol
     foreign key (user_id)
     references user;

alter table notification add constraint REF_notif_user_1
     foreign key (user_for)
     references user;

alter table notification add constraint REF_notif_user_FK
     foreign key (user_from)
     references user;

alter table post add constraint REF_post_user_FK
     foreign key (user)
     references user;

alter table post add constraint REF_post_topic_FK
     foreign key (topic)
     references topic;


-- Index Section
-- _____________ 

create unique index ID_comment_IND
     on comment (post, comment_id);

create unique index SID_comment_1_IND
     on comment (rensponded_by);

create unique index SID_comment_IND
     on comment (notification);

create index REF_comme_user_IND
     on comment (user);

create unique index ID_donation_IND
     on donation (user, post);

create unique index SID_donation_IND
     on donation (notification);

create index REF_donat_post_IND
     on donation (post);

create unique index ID_like_IND
     on like (post, user);

create unique index SID_like_IND
     on like (notification);

create index REF_like_user_IND
     on like (user);

create unique index ID_files_IND
     on files (post_id, files);

create unique index ID_followed_IND
     on followed (user_id, followed);

create unique index ID_follows_IND
     on follows (user_id, follows);

create unique index ID_notification_IND
     on notification (user_for, notification_id);

create index REF_notif_user_IND
     on notification (user_from);

create unique index ID_post_IND
     on post (post_id);

create unique index SID_post_IND
     on post (notification);

create index REF_post_user_IND
     on post (user);

create index REF_post_topic_IND
     on post (topic);

create unique index ID_topic_IND
     on topic (name);

create unique index ID_user_IND
     on user (user_id);

