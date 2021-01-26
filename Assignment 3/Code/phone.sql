DROP TRIGGER IF EXISTS phone_check;

delimiter $$

-- checks if the phone number already exists in the database

create trigger phone_check before insert on phone_number
for each row
begin
	if exists(select * from phone_number as p where p.phone = new.phone) then /* if there is already such phone number in the database, inserts null in primary key so that insertion is invalid*/
		set new.VAT = NULL, new.phone = NULL;
	end if;
end$$
delimiter ;
