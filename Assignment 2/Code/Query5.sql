select d.name as Medical_Condition, count(distinct p.name_med) as Number_Meds 
from prescription as p, diagnosis_code as d
where d.code = p.code
group by d.code 
order by Number_Meds;
