DROP PROCEDURE IF EXISTS mg2cg;

delimiter $$

-- changes all indicators units from milligrams to centigrams, and adjusts its units accordingly

create procedure mg2cg()
begin
	update produced_indicator as p
	set p.indicator_value = p.indicator_value*0.1
	where exists(
		select p.indicator_name
		from indicator as i
		where i.name = p.indicator_name
		and i.units = 'milligrams');
	
	update indicator
	set units = 'centigrams', reference_value = reference_value*0.1
	where units = 'milligrams';
	
end$$

delimiter ;