drop table if exists produced_indicator;
drop table if exists test_procedure;
drop table if exists radiography;
drop table if exists performed;
drop table if exists medical_procedure;
drop table if exists indicator;
drop table if exists prescription;
drop table if exists medication;
drop table if exists consult_diagnosis;
drop table if exists diagnosis_code;
drop table if exists participation;
drop table if exists consult;
drop table if exists animal;
drop table if exists generalization_species;
drop table if exists species;
drop table if exists phone_number;
drop table if exists assistant;
drop table if exists veterinary;
drop table if exists client;
drop table if exists person;

create table person(
					VAT int CHECK( VAT > 0),
					name varchar(255) not null,
					address_street varchar(255) not null,
					address_city varchar(255) not null,
					address_zip varchar(255) not null,
					primary key(VAT));

create table client(
					VAT int CHECK( VAT > 0),
					primary key(VAT),
					foreign key(VAT) references person(VAT) ON DELETE CASCADE);
					
create table veterinary(
					VAT int CHECK( VAT > 0),
					specialization varchar(255),
					bio varchar(255),
					primary key(VAT),
					foreign key(VAT) references person(VAT) ON DELETE CASCADE);

create table assistant(
					VAT int CHECK( VAT > 0),
					primary key(VAT),
					foreign key(VAT) references person(VAT) ON DELETE CASCADE);
					
create table phone_number(
					VAT int CHECK( VAT > 0),
					phone varchar(255),
					primary key(VAT, phone),
					foreign key(VAT) references person(VAT) ON DELETE CASCADE);
						
create table species(
					name varchar(255),
					description varchar(255),
					primary key(name));

create table generalization_species(
					name1 varchar(255),
					name2 varchar(255),
					primary key(name1),
					foreign key(name1) references species(name) ON DELETE CASCADE,
					foreign key(name2) references species(name) ON DELETE CASCADE);
									
create table animal(
					name varchar(255),
					VAT int CHECK( VAT > 0),
					species_name varchar(255),
					colour varchar(255),
					gender varchar(255),
					birth_year year,
					age int,
					primary key(name, VAT),
					foreign key(VAT) references client(VAT) ON DELETE CASCADE,
					foreign key(species_name) references species(name));
					
create table consult(
					name varchar(255),
					VAT_owner int CHECK( VAT_owner > 0),
					date_timestamp date,
					s varchar(255),
					o varchar(255),
					a varchar(255),
					p varchar(255),
					VAT_client int CHECK( VAT_client > 0),
					VAT_vet int CHECK( VAT_vet > 0),
					weight real CHECK( weight > 0),
					primary key(name, VAT_owner, date_timestamp),
					foreign key(name, VAT_owner) references animal(name, VAT) ON DELETE CASCADE,
					foreign key(VAT_client) references client(VAT),
					foreign key(VAT_vet) references veterinary(VAT));
					 
create table participation (
					name varchar(255),
					VAT_owner int CHECK( VAT_owner > 0),
					date_timestamp date,
					VAT_assistant int CHECK( VAT_assistant > 0),
					primary key(name, VAT_owner, date_timestamp, VAT_assistant),
					foreign key(name, VAT_owner, date_timestamp) references consult(name, VAT_owner, date_timestamp) ON DELETE CASCADE,
					foreign key(VAT_assistant) references assistant(VAT) ON DELETE CASCADE);
							
create table diagnosis_code(
					code int CHECK( code > 0), 
					name varchar(255),
					primary key(code));
							
create table consult_diagnosis(
					code int CHECK( code > 0),
					name varchar(255),
					VAT_owner int CHECK( VAT_owner > 0),
					date_timestamp date,
					primary key(code, name, VAT_owner, date_timestamp),
					foreign key(name, VAT_owner, date_timestamp) references consult(name, VAT_owner, date_timestamp) ON DELETE CASCADE,
					foreign key(code) references diagnosis_code(code) ON DELETE CASCADE);
							   
create table medication(
					name varchar(255),
					lab varchar(255),
					dosage varchar(255),
					primary key(name, lab, dosage));
						
create table prescription(
					code int CHECK( code > 0),
					name varchar(255),
					VAT_owner int CHECK( VAT_owner > 0),
					date_timestamp date,
					name_med varchar(255),
					lab varchar(255),
					dosage varchar(255),
					regime varchar(255),
					primary key(code, name, VAT_owner, date_timestamp, name_med, lab, dosage),
					foreign key(code, name, VAT_owner, date_timestamp) references consult_diagnosis(code, name, VAT_owner, date_timestamp) ON DELETE CASCADE ON UPDATE CASCADE,
					foreign key(name_med, lab, dosage) references medication(name, lab, dosage) ON DELETE CASCADE);
					
create table indicator(
					name varchar(255),
					reference_value real CHECK( reference_value > 0),
					units varchar(255),
					description varchar(255),
					primary key(name));
					 
create table medical_procedure(
					name varchar(255),
					VAT_owner int CHECK( VAT_owner > 0),
					date_timestamp date,
					num int,
					description varchar(255),
					primary key(name, VAT_owner, date_timestamp, num),
					foreign key(name, VAT_owner, date_timestamp) references consult(name, VAT_owner,date_timestamp) ON DELETE CASCADE);
					 
create table performed(
					name varchar(255),
					VAT_owner int CHECK( VAT_owner > 0),
					date_timestamp date,
					num int,
					VAT_assistant int CHECK( VAT_assistant > 0),
					primary key(name, VAT_owner, date_timestamp, num, VAT_assistant),
					foreign key(name, VAT_owner, date_timestamp, num) references medical_procedure(name, VAT_owner, date_timestamp, num) ON DELETE CASCADE,
					foreign key(VAT_assistant) references assistant(VAT) ON DELETE CASCADE);
					   
create table radiography(
					name varchar(255),
					VAT_owner int CHECK( VAT_owner > 0),
					date_timestamp date,
					num int,
					rad_file varchar(255),
					primary key(name, VAT_owner, date_timestamp, num),
					foreign key(name, VAT_owner, date_timestamp, num) references medical_procedure(name, VAT_owner, date_timestamp, num) ON DELETE CASCADE);
						
create table test_procedure(
					name varchar(255),
					VAT_owner int CHECK( VAT_owner > 0),
					date_timestamp date,
					num int,
					test_type varchar(255) CHECK (test_type = 'blood' OR test_type = 'urine'),
					primary key(name, VAT_owner, date_timestamp, num),
					foreign key(name, VAT_owner, date_timestamp, num) references medical_procedure(name, VAT_owner, date_timestamp, num) ON DELETE CASCADE);
							
create table produced_indicator(
					name varchar(255),
					VAT_owner int CHECK( VAT_owner > 0),
					date_timestamp date,
					num int,
					indicator_name varchar(255),
					indicator_value real CHECK( indicator_value > 0),
					primary key(name, VAT_owner, date_timestamp, num, indicator_name),
					foreign key(name, VAT_owner, date_timestamp, num) references test_procedure(name, VAT_owner, date_timestamp, num) ON DELETE CASCADE,
					foreign key(indicator_name) references indicator(name) ON DELETE CASCADE);


