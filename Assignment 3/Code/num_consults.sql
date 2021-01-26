DROP FUNCTION IF EXISTS count_consults;

delimiter $$

-- counts the number of consults an animal has participated in a given year

create function count_consults(c_name varchar(255), c_year int)
returns integer
begin
	declare c_count integer;
	select count(name) into c_count
	from consult
	where c_name = name
	and c_year = year(date_timestamp);
	return c_count;
end$$

delimiter ;