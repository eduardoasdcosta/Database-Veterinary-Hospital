select  (select count(*) 
	from participation as par 
	where extract(year from par.date_timestamp) = 2017
	)/count(*) as Avg_Assistants, 
	(select count(*) 
	from medical_procedure as pro 
	where extract(year from pro.date_timestamp) = 2017
	)/count(*) as Avg_Procedures, 
	(select count(*) 
	from consult_diagnosis as d 
	where extract(year from d.date_timestamp) = 2017
	)/count(*) as Avg_Diagnostic_codes, 
	(select count(*) 
	from prescription as pre 
	where extract(year from pre.date_timestamp) = 2017
	)/count(*) as Avg_Prescriptions 
from consult 
where extract(year from date_timestamp) = 2017;
