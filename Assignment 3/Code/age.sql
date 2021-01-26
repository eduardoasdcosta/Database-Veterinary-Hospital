DROP TRIGGER IF EXISTS update_age;

delimiter $$

-- updates age of an animal when a consult occurs

create trigger update_age after insert on consult
for each row
begin
	update animal as a, consult as c
	set a.age = year(current_timestamp) - a.birth_year
	where a.name = c.name
	and a.VAT = c.VAT_owner;
end$$
delimiter ;