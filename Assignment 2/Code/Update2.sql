update indicator as i 
set i.reference_value = i.reference_value*1.1 
where exists(
	select indicator_name 
	from produced_indicator as pi, test_procedure as tp 
	where tp.name = pi.name 
	and tp.vat_owner = pi.vat_owner 
	and pi.date_timestamp = tp.date_timestamp 
	and tp.num = pi.num 
	and tp.test_type = 'blood' 
	and i.name = pi.indicator_name
	) 
and i.units = 'milligrams';
