DROP TRIGGER IF EXISTS vet_check;
DROP TRIGGER IF EXISTS assist_check;

delimiter $$

-- checks if the vat already belongs to an assistant

create trigger vet_check before insert on veterinary
for each row
begin
	if exists(select a.VAT from assistant as a where a.VAT = new.VAT) then /* if vat belongs to assistant, inserts null in primary key of veterinary so that insertion is invalid */
		set new.VAT = NULL;
	end if;
end$$
delimiter ;


delimiter $$

-- checks if the vat already belongs to a veterinary

create trigger assist_check before insert on assistant
for each row
begin
	if exists(select v.VAT from veterinary as v where v.VAT = new.VAT) then /* if vat belongs to veterinary, inserts null in primary key of assistant so that insertion is invalid */
		set new.VAT = NULL;
	end if;
end$$
delimiter ;

