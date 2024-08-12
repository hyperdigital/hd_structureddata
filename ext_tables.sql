CREATE TABLE pages (
    hd_structured_data INT(11) DEFAULT 0 NOT NULL,
);

CREATE TABLE tx_hdstructureddata_domain_model_structureddata (
	type varchar(255) DEFAULT '' NOT NULL,
	subtype varchar(255) DEFAULT '' NOT NULL,

	title varchar(255) DEFAULT '' NOT NULL,
	legal_name varchar(255) DEFAULT '' NOT NULL,
	telephone varchar(255) DEFAULT '' NOT NULL,
	description TEXT,
	abstract TEXT,
	url varchar(255) DEFAULT '' NOT NULL,
	email varchar(255) DEFAULT '' NOT NULL,
	authors int(11) DEFAULT 0 NOT NULL,
	logo int(11) DEFAULT 0 NOT NULL,
	images int(11) DEFAULT 0 NOT NULL,
	medias int(11) DEFAULT 0 NOT NULL,
	faqs int(11) DEFAULT 0 NOT NULL,
	addresses int(11) DEFAULT 0 NOT NULL,
	locations int(11) DEFAULT 0 NOT NULL,
	offers int(11) DEFAULT 0 NOT NULL,
	vat_id varchar(255) DEFAULT '' NOT NULL,
	tax_id varchar(255) DEFAULT '' NOT NULL,
	price_range varchar(255) DEFAULT '' NOT NULL,
	serves_cuisine TEXT,
	opening_hours int(11) DEFAULT 0 NOT NULL,
	menu varchar(255) DEFAULT '' NOT NULL,
	accepts_reservations int(1) NULL,
	rating_value float(14) NULL,
	rating_count int(11) NULL,
	best_rating int(11) NULL,
	worst_rating int(11) NULL,
	status varchar(255) DEFAULT '' NOT NULL,
	clips int(11) DEFAULT 0 NOT NULL,
	date_published datetime default NULL,
	date_modified datetime default NULL,
	start_date datetime default NULL,
	end_date datetime default NULL,
	organizers int(11) NULL,
	organizers_pointer int(11) NULL,
	pointed_as_organizer int(11) NULL,
	performers int(11) NULL,
	brands int(11) NULL,
	sku varchar(255) DEFAULT '' NOT NULL,
	gtin14 varchar(255) DEFAULT '' NOT NULL,
	reviews int(11) NULL,
	positive_notes int(11) NULL,
	negative_notes int(11) NULL,
    courseinstances int(11) NULL,

	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	tablename varchar(255) DEFAULT '' NOT NULL,
	foreign_uid int(11) DEFAULT 0 NOT NULL,
	fieldname varchar(255) DEFAULT '' NOT NULL,
);

CREATE TABLE tx_hdstructureddata_domain_model_structureddata_reviewnote(
	name varchar(255) DEFAULT '' NOT NULL,

	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	tablename varchar(255) DEFAULT '' NOT NULL,
	foreign_uid int(11) DEFAULT 0 NOT NULL,
	fieldname varchar(255) DEFAULT '' NOT NULL,
);

CREATE TABLE tx_hdstructureddata_domain_model_structureddata_person(
	type varchar(255) DEFAULT '' NOT NULL,
	name varchar(255) DEFAULT '' NOT NULL,
	url varchar(255) DEFAULT '' NOT NULL,

	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	tablename varchar(255) DEFAULT '' NOT NULL,
	foreign_uid int(11) DEFAULT 0 NOT NULL,
	fieldname varchar(255) DEFAULT '' NOT NULL,
);
CREATE TABLE tx_hdstructureddata_domain_model_structureddata_faq(
	question TEXT,
	answer TEXT,

	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	tablename varchar(255) DEFAULT '' NOT NULL,
	foreign_uid int(11) DEFAULT 0 NOT NULL,
	fieldname varchar(255) DEFAULT '' NOT NULL,
);
CREATE TABLE tx_hdstructureddata_domain_model_structureddata_address(
	type varchar(255) DEFAULT '' NOT NULL,

	street_address varchar(255) DEFAULT '' NOT NULL,
	address_locality varchar(255) DEFAULT '' NOT NULL,
	address_country int(11) DEFAULT 0 NOT NULL,
	address_region varchar(255) DEFAULT '' NOT NULL,
	postal_code varchar(255) DEFAULT '' NOT NULL,

	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	tablename varchar(255) DEFAULT '' NOT NULL,
	foreign_uid int(11) DEFAULT 0 NOT NULL,
	fieldname varchar(255) DEFAULT '' NOT NULL,
);
CREATE TABLE tx_hdstructureddata_domain_model_structureddata_clip(
	name varchar(255) DEFAULT '' NOT NULL,
	start_offset int(11) DEFAULT 0 NOT NULL,
	end_offset int(11) DEFAULT NULL,
	url varchar(255) DEFAULT '' NOT NULL,

	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	tablename varchar(255) DEFAULT '' NOT NULL,
	foreign_uid int(11) DEFAULT 0 NOT NULL,
	fieldname varchar(255) DEFAULT '' NOT NULL,
);
CREATE TABLE tx_hdstructureddata_domain_model_structureddata_openinghour(
	days TEXT,
	opens varchar(255) DEFAULT '' NOT NULL,
	closes varchar(255) DEFAULT '' NOT NULL,

	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	tablename varchar(255) DEFAULT '' NOT NULL,
	foreign_uid int(11) DEFAULT 0 NOT NULL,
	fieldname varchar(255) DEFAULT '' NOT NULL,
);
CREATE TABLE tx_hdstructureddata_domain_model_structureddata_location(
	type varchar(255) DEFAULT '' NOT NULL,
	url varchar(255) DEFAULT '' NOT NULL,
	name varchar(255) DEFAULT '' NOT NULL,
	addresses int(11) DEFAULT 0 NOT NULL,

	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	tablename varchar(255) DEFAULT '' NOT NULL,
	foreign_uid int(11) DEFAULT 0 NOT NULL,
	fieldname varchar(255) DEFAULT '' NOT NULL,
);
CREATE TABLE tx_hdstructureddata_domain_model_structureddata_offer(
	availability varchar(255) DEFAULT '' NOT NULL,
	price float(14) DEFAULT 0 NOT NULL,
	price_currency varchar(255) DEFAULT '' NOT NULL,
	valid_from datetime default NULL,
	valid_until datetime default NULL,
	url varchar(255) DEFAULT '' NOT NULL,
    category varchar(255) DEFAULT '' NOT NULL,

	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	tablename varchar(255) DEFAULT '' NOT NULL,
	foreign_uid int(11) DEFAULT 0 NOT NULL,
	fieldname varchar(255) DEFAULT '' NOT NULL,
);
CREATE TABLE tx_hdstructureddata_domain_model_structureddata_brand(
	name varchar(255) DEFAULT '' NOT NULL,

	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	tablename varchar(255) DEFAULT '' NOT NULL,
	foreign_uid int(11) DEFAULT 0 NOT NULL,
	fieldname varchar(255) DEFAULT '' NOT NULL,
);

CREATE TABLE tx_hdstructureddata_structureddata_organizers_mm (
		 uid_local int(11) DEFAULT '0' NOT NULL,
		 uid_foreign int(11) DEFAULT '0' NOT NULL,
		 sorting int(11) DEFAULT '0' NOT NULL,
		 sorting_foreign int(11) DEFAULT '0' NOT NULL,

		 KEY uid_local (uid_local),
		 KEY uid_foreign (uid_foreign)
);

CREATE TABLE tx_hdstructureddata_domain_model_structureddata_courseinstance(
   course_mode varchar(255) DEFAULT '' NOT NULL,
   course_schedule_repeat_count int(11) DEFAULT 0 NOT NULL,
   course_schedule_repeat_frequency varchar(255) DEFAULT '' NOT NULL,
   course_schedule_start_date datetime default NULL,
   course_schedule_end_date datetime default NULL,
   images int(11) DEFAULT 0 NOT NULL,
   instructors int(11) DEFAULT 0 NOT NULL,
   locations int(11) DEFAULT 0 NOT NULL,

    t3ver_label varchar(255) DEFAULT '' NOT NULL,
    tablename varchar(255) DEFAULT '' NOT NULL,
    foreign_uid int(11) DEFAULT 0 NOT NULL,
    fieldname varchar(255) DEFAULT '' NOT NULL,
);

CREATE TABLE sys_file_metadata (
    creator int(11) NULL,
    hd_caption TEXT NULL,
    hd_keywords TEXT NULL,
    hd_description TEXT NULL,
    credit_text TEXT NULL,
    copyright_notice TEXT NULL,
    license TEXT NULL,
    acquire_license_page TEXT NULL,
);