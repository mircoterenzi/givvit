create database Givvit;

use Givvit;

create table comments (
     comment_id int not null,
     post int not null,
     text varchar(512) not null,
     user int not null,
     responded_by int,
     constraint PK_comments primary key (post, comment_id));

create table donation (
     user int not null,
     post int not null,
     amount int not null,
     constraint PK_donation primary key (user, post));

create table files (
     file_id int not null,
     post int not null,
     name varchar(255) not null,
     constraint PK_files primary key (post, file_id));

create table follow (
     follower int not null,
     followed int not null,
     constraint PK_follow primary key (follower, followed));

create table likes (
     user int not null,
     post int not null,
     constraint PK_likes primary key (post, user));

create table notification (
     notification_id int not null,
     user_for int not null,
     date date not null,
     notification_type varchar(255) not null,
     user_from int not null,
     visualized int not null default 0,
     post_id int,
     constraint PK_notification primary key (user_for, notification_id));

create table post (
     post_id int not null auto_increment,
     title varchar(64) not null,
     short_description varchar(255),
     long_description varchar(1024) not null,
     amount_requested int not null,
     date date not null,
     user int not null,
     topic varchar(32) not null,
     constraint PK_post primary key (post_id));

create table topic (
     name varchar(32) not null,
     constraint PK_topic primary key (name));

create table user_profile (
     user_id int not null auto_increment,
     username varchar(32) not null,
     first_name varchar(32) not null,
     last_name varchar(32) not null,
     password varchar(255) not null,
     salt char(255) not null,
     email char(125) ,
     description varchar(512),
     profile_img varchar(512),
     constraint PK_user_profile primary key (user_id));


-- Constraints Section
-- ___________________ 

alter table comments add constraint REF_comme_user__FK
     foreign key (user)
     references user_profile(user_id);

alter table comments add constraint REF_comme_post
     foreign key (post)
     references post(post_id);

alter table donation add constraint REF_donat_post_FK
     foreign key (post)
     references post(post_id);

alter table donation add constraint REF_donat_user_
     foreign key (user)
     references user_profile(user_id);

alter table files add constraint REF_files_post
     foreign key (post)
     references post(post_id);

alter table follow add constraint REF_follo_user__1_FK
     foreign key (followed)
     references user_profile(user_id);

alter table follow add constraint REF_follo_user_
     foreign key (follower)
     references user_profile(user_id);

alter table likes add constraint REF_likes_post
     foreign key (post)
     references post(post_id);

alter table likes add constraint REF_likes_user__FK
     foreign key (user)
     references user_profile(user_id);

alter table notification add constraint REF_notif_user__1
     foreign key (user_for)
     references user_profile(user_id);

alter table notification add constraint REF_notif_user__FK
     foreign key (user_from)
     references user_profile(user_id);

alter table notification add constraint REF_notif_post_FK
     foreign key (post_id)
     references post(post_id);

alter table post add constraint REF_post_user__FK
     foreign key (user)
     references user_profile(user_id);

alter table post add constraint REF_post_topic_FK
     foreign key (topic)
     references topic(name);


-- Index Section
-- _____________ 

create unique index ID_comments_IND
     on comments (post, comment_id);

create index REF_comme_user__IND
     on comments (user);

create unique index ID_donation_IND
     on donation (user, post);

create index REF_donat_post_IND
     on donation (post);

create unique index ID_files_IND
     on files (post, file_id);

create unique index ID_follow_IND
     on follow (follower, followed);

create index REF_follo_user__1_IND
     on follow (followed);

create unique index ID_likes_IND
     on likes (post, user);

create index REF_likes_user__IND
     on likes (user);

create unique index ID_notification_IND
     on notification (user_for, notification_id);

create index REF_notif_user__IND
     on notification (user_from);

create index REF_notif_post_IND
     on notification (post_id);

create unique index ID_post_IND
     on post (post_id);

create index REF_post_user__IND
     on post (user);

create index REF_post_topic_IND
     on post (topic);

create unique index ID_topic_IND
     on topic (name);

create unique index ID_user_profile_IND
     on user_profile (user_id);
