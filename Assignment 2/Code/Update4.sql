select code 
from diagnosis_code 
where name = 'kidney failure';

insert into diagnosis_code(code, name) 
values(6282, 'end-stage renal disease');

update consult_diagnosis as c 
set c.code = 6282 
where exists(
	select * from produced_indicator as pi 
	where pi.name = c.name 
	and pi.VAT_owner = c.VAT_owner 
	and pi.date_timestamp = c.date_timestamp 
	and pi.indicator_name = 'Creatinine level' 
	and pi.indicator_value > 1.0) 
and c.code = 6281;
