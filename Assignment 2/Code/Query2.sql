SELECT name as Indicator_Name, reference_value as Reference_Value
FROM indicator
WHERE units = 'milligrams'
AND reference_value > 100
GROUP BY reference_value DESC;
